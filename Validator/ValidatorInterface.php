<?php declare(strict_types=1);

namespace Yireo\LokiComponents\Validator;

use Yireo\LokiComponents\Component\ComponentInterface;

interface ValidatorInterface
{
    public function validate(mixed $value, ?ComponentInterface $component = null): true|array;
}
