<?php
declare(strict_types=1);

namespace Yireo\LokiComponents\Component;

use Yireo\LokiComponents\Filter\Filter;
use Yireo\LokiComponents\Validator\Validator;
use Yireo\LokiComponents\Messages\MessageManager;

abstract class ComponentRepository implements ComponentRepositoryInterface
{
    public function __construct(
        protected ComponentInterface $component,
        protected Validator $validator,
        protected Filter $filter,
        protected MessageManager $messageManager,
    ) {
    }

    public function get(): mixed
    {
        // @todo: Add validation here as well?
        return $this->filter($this->getData());
    }

    public function save(mixed $data): void
    {
        $data = $this->filter($data);

        if ($this->validate($data)) {
            $this->saveData($data);
        }
    }

    abstract protected function getData(): mixed;

    abstract protected function saveData(mixed $data): void;

    protected function getContext(): ComponentContextInterface
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
