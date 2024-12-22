<?php declare(strict_types=1);

namespace Yireo\LokiComponents\ViewModel;

use Yireo\LokiComponents\Component\ViewModel\ViewModelInterface;

class Debugger implements ViewModelInterface
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
