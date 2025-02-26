<?php
declare(strict_types=1);

namespace Yireo\LokiComponents\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Element\AbstractBlock;
use Yireo\LokiComponents\Component\ComponentRegistry;
use Yireo\LokiComponents\Exception\NoComponentFoundException;
use Yireo\LokiComponents\Util\ComponentUtil;

class AddComponentToBlock implements ObserverInterface
{
    public function __construct(
        private ComponentRegistry $componentRegistry,
        private ComponentUtil $componentUtil,
    ) {
    }

    public function execute(Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();
        if (false === $block instanceof AbstractBlock) {
            return;
        }

        try {
            $component = $this->componentRegistry->getComponentFromBlock($block);
        } catch (NoComponentFoundException $exception) {
            return;
        }

        $viewModel = $component->getViewModel();
        if (!empty($viewModel->getTemplate())) {
            $block->setTemplate($viewModel->getTemplate());
        }

        $block->setViewModel($viewModel);
        $block->assign('viewModel', $viewModel);
        $block->assign('componentUtil', $this->componentUtil);
    }
}
