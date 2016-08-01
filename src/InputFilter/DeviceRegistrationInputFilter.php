<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\InputFilter;

use InteractiveSolutions\PushNotification\Entity\AndroidDeviceEntity;
use InteractiveSolutions\PushNotification\Entity\AppleDeviceEntity;
use InteractiveSolutions\PushNotification\Validator\DeviceDoesNotExist;
use Zend\Filter\StringToLower;
use Zend\Filter\StringTrim;
use Zend\InputFilter\InputFilter;
use Zend\Validator\InArray;

final class DeviceRegistrationInputFilter extends InputFilter
{
    public function init()
    {
        $this->add([
            'name'       => 'type',
            'validators' => [
                [
                    'name'    => InArray::class,
                    'options' => [
                        'strict'   => InArray::COMPARE_STRICT,
                        'haystack' => [
                            AppleDeviceEntity::DEVICE_TYPE,
                            AndroidDeviceEntity::DEVICE_TYPE,
                        ],
                    ],
                ],
            ],

            'filters' => [
                [
                    'name' => StringToLower::class,
                ],
                [
                    'name' => StringTrim::class,
                ],
            ],
        ]);

        $this->add([
            'name'    => 'name',
            'filters' => [
                [
                    'name' => StringTrim::class,
                ],
            ],
        ]);

        $this->add([
            'name'       => 'deviceId',
            'validators' => [
                [
                    'name' => DeviceDoesNotExist::class,
                ],
            ],

            'filters' => [
                [
                    'name' => StringTrim::class,
                ],
            ],
        ]);
    }
}
