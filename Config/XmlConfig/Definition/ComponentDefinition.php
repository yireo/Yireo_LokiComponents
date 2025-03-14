<?php declare(strict_types=1);

namespace Yireo\LokiComponents\Config\XmlConfig\Definition;

class ComponentDefinition
{
    public function __construct(
        private string $name,
        private string $className,
        private string $context = '',
        private string $viewModel = '',
        private string $repository = '',
        private array $targets = [],
        private array $validators = [],
        private array $filters = [],
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getContext(): ?string
    {
        if (!empty($this->context)) {
            return $this->context;
        }

        return null;
    }
    public function getViewModelClass(): ?string
    {
        if (!empty($this->viewModel)) {
            return $this->viewModel;
        }

        return null;
    }

    public function getRepositoryClass(): ?string
    {
        if (!empty($this->repository)) {
            return $this->repository;
        }

        return null;
    }
    public function getTargets(): array
    {
        return $this->targets;
    }

    public function getValidators(): array
    {
        return $this->validators;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }
}
