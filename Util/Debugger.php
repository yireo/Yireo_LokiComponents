<?php declare(strict_types=1);

namespace Yireo\LokiComponents\Util;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Debugger implements ArgumentInterface
{
    private array $data = [];

    public function add(string $name, mixed $value): void
    {
        $this->data[$name] = $value;
    }

    public function getData(): array
    {
        return $this->data;
    }
}