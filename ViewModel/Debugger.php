<?php declare(strict_types=1);

namespace Yireo\LokiComponents\ViewModel;

use Yireo\LokiComponents\Component\ComponentInterface;

class Debugger implements ComponentInterface
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
