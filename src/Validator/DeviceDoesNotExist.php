<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Validator;

use DoctrineModule\Validator\NoObjectExists;

final class DeviceDoesNotExist extends NoObjectExists
{
}
