<?php
declare(strict_types=1);

namespace Yireo\LokiComponents\Component;

use Magento\Framework\View\Element\AbstractBlock;
use Yireo\LokiComponents\Messages\MessageManager;

abstract class ComponentViewModel implements ComponentViewModelInterface
{
    public function __construct(
        protected ComponentInterface $component,
        protected MessageManager $messageManager,
        protected AbstractBlock $block,
    ) {
    }

    public function getElementId(): string
    {
        return preg_replace('/([^a-zA-Z0-9\-]+)/', '-', $this->block->getNameInLayout());
    }

    public function getData(): mixed
    {
        return $this->getComponent()->getRepository()->get();
    }

    public function getBlock(): AbstractBlock
    {
        return $this->block;
    }

    public function getTargets(): array
    {
        return $this->getComponent()->getTargets();
    }

    public function getTargetString(): string
    {
        return $this->getComponent()->getTargetString();
    }

    public function getValidators(): array
    {
        return $this->getComponent()->getValidators();
    }

    public function getFilters(): array
    {
        return $this->getComponent()->getFilters();
    }

    public function getMessageManager(): MessageManager
    {
        return $this->messageManager;
    }

    public function getContext(): ComponentContextInterface
    {
        return $this->component->getContext();
    }

    protected function getComponent(): ComponentInterface
    {
        return $this->component;
    }

    protected function getRepository(): ?ComponentRepositoryInterface
    {
        return $this->component->getRepository();
    }
}