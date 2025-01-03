<?php
declare(strict_types=1);

namespace Yireo\LokiComponents\Messages;

use JsonSerializable;

class LocalMessage implements JsonSerializable
{
    const TYPE_NOTICE = 'notice';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';
    const TYPE_ERROR = 'error';

    public function __construct(
        private string $componentName,
        private string $text,
        private string $type = self::TYPE_NOTICE
    ) {
    }

    public function getComponentName(): string
    {
        return $this->componentName;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function toArray(): array
    {
        return [
            'text' => $this->getText(),
            'type' => $this->getType(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
