<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Controller;

use InteractiveSolutions\PushNotification\Domain\DeviceRegistration;
use InteractiveSolutions\PushNotification\Entity\AbstractDeviceEntity;
use InteractiveSolutions\PushNotification\InputFilter\DeviceRegistrationInputFilter;
use InteractiveSolutions\PushNotification\MobileDevicePermissions;
use InteractiveSolutions\PushNotification\Repository\DeviceRepository;
use InteractiveSolutions\PushNotification\Service\DeviceServiceInterface;
use Canine\User\Entity\UserEntity;
use Canine\User\Repository\Exception\UserNotFoundException;
use Canine\User\Repository\UserRepository;
use DateTime;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\View\Model\JsonModel;
use ZfrRest\Http\Exception\Client\ForbiddenException;
use ZfrRest\Http\Exception\Client\NotFoundException;
use ZfrRest\Http\Exception\Client\UnprocessableEntityException;
use ZfrRest\Mvc\Controller\AbstractRestfulController;
use ZfrRest\View\Model\ResourceViewModel;

/**
 * Class DeviceCollectionController
 *
 * @method Request getRequest
 * @method Response getResponse
 * @method bool isGranted($permission, $context = null)
 */
final class DeviceCollectionController extends AbstractRestfulController
{
    /**
     * @var DeviceServiceInterface
     */
    private $service;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var DeviceRepository
     */
    private $deviceRepository;

    /**
     * DeviceCollectionController constructor.
     *
     * @param DeviceServiceInterface $service
     * @param UserRepository         $userRepository
     * @param DeviceRepository       $deviceRepository
     */
    public function __construct(
        DeviceServiceInterface $service,
        UserRepository $userRepository,
        DeviceRepository $deviceRepository
    ) {
        $this->service          = $service;
        $this->userRepository   = $userRepository;
        $this->deviceRepository = $deviceRepository;
    }

    /**
     * Attempt to retrieve the user
     *
     * @param string $permission
     *
     * @throws ForbiddenException
     * @throws NotFoundException
     *
     * @return UserEntity
     */
    private function getUser($permission = MobileDevicePermissions::CREATE): UserEntity
    {
        try {
            $user = $this->userRepository->getById((int) $this->params('user_id'));

            if (!$this->isGranted($permission, $user)) {
                throw new ForbiddenException();
            }

            return $user;
        } catch (UserNotFoundException $e) {
            throw new NotFoundException('The user with the given id was not found');
        }
    }

    /**
     * Associate a new device with a user
     *
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws UnprocessableEntityException
     *
     * @return Response
     */
    public function post(): Response
    {
        $user   = $this->getUser();
        $values = $this->validateIncomingData(DeviceRegistrationInputFilter::class);

        $device = new DeviceRegistration(
            $values['type'],
            $values['name'],
            $values['deviceId']
        );

        $this->service->register($device, $user);

        $response = $this->getResponse();
        $response->setStatusCode(204);

        return $response;
    }

    /**
     * List all devices that belong to the user
     *
     * @throws ForbiddenException
     * @throws NotFoundException
     */
    public function get(): JsonModel
    {
        $devices = $this->deviceRepository->getAllForUser($this->getUser(MobileDevicePermissions::DEVICE_LIST));
        $devices = array_map(function (AbstractDeviceEntity $device) {
            return [
                'type'      => $device->getType(),
                'uuid'      => $device->getUuid(),
                'name'      => $device->getName(),
                'deviceId'  => $device->getDeviceId(),
                'createdAt' => $device->getCreatedAt()->format(DateTime::ISO8601),
            ];
        }, $devices);

        // todo: perhaps we should use a proper paginator
        // but I simply don't see anyone have so many devices it would be required
        return new JsonModel([
            'data' => $devices,
            'meta' => [
                'total'  => count($devices),
                'limit'  => count($devices),
                'offset' => 0
            ]
        ]);
    }
}
