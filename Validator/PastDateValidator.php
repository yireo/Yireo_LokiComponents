<?php declare(strict_types=1);

namespace Yireo\LokiComponents\Validator;

use Yireo\LokiComponents\Component\ComponentInterface;

class PastDateValidator implements ValidatorInterface
{
    public function validate(mixed $value, ?ComponentInterface $component = null): true|array
    {
        $date = trim((string)$value);
        if (empty($date)) {
            return true;
        }

        if (strtotime($date) > time()) {
            return ['Date needs to be in the past'];
        }

        return true;
    }
}
