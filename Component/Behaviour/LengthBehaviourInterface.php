<?php declare(strict_types=1);

namespace Yireo\LokiComponents\Component\Behaviour;

interface LengthBehaviourInterface
{
    public function getMinLength(): int;

    public function hasMinLength(): bool;

    public function getMaxLength(): int;

    public function hasMaxLength(): bool;
}
