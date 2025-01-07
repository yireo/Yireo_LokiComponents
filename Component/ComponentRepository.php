<?php
declare(strict_types=1);

namespace Yireo\LokiComponents\Component;

use Yireo\LokiComponents\Filter\Filter;
use Yireo\LokiComponents\Messages\GlobalMessageRegistry;
use Yireo\LokiComponents\Validator\Validator;
use Yireo\LokiComponents\Messages\LocalMessageRegistry;

abstract class ComponentRepository implements ComponentRepositoryInterface
{
    public function __construct(
        protected ComponentInterface $component,
        protected Validator $validator,
        protected Filter $filter,
    ) {
    }

    public function get(): mixed
    {
        $data = $this->filter($this->getValue()); // @todo: Move filtering outside of repository
        $this->validate($data); // @todo: Move validation outside of repository
        return $data;
    }

    public function save(mixed $data): void
    {
        $data = $this->filter($data); // @todo: Move filtering outside of repository

        if ($this->validate($data)) {
            $this->saveValue($data);
        }
    }

    public function getComponentName(): string
    {
        return $this->component->getName();
    }

    public function getGlobalMessageRegistry(): GlobalMessageRegistry
    {
        return $this->component->getGlobalMessageRegistry();
    }

    public function getLocalMessageRegistry(): LocalMessageRegistry
    {
        return $this->component->getLocalMessageRegistry();
    }

    abstract protected function getValue(): mixed;

    abstract protected function saveValue(mixed $data): void;

    protected function getContext(): ComponentContext
    {
        return $this->component->getContext();
    }

    protected function filter(mixed $data): mixed
    {
        return $this->filter->filter($this->component->getFilters(), $data);
    }

    protected function validate(mixed $data): bool
    {
        return $this->validator->validate($this->component, $data);
    }
}
