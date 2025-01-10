<?php declare(strict_types=1);

namespace Yireo\LokiComponents\Util\Controller;

use Magento\Framework\Event\Manager as EventManager;
use Magento\Framework\View\Element\BlockInterface;
use Magento\Framework\View\LayoutInterface;
use Yireo\LokiComponents\Component\ComponentRegistry;
use Yireo\LokiComponents\Messages\GlobalMessageRegistry;

class TargetRenderer
{
    public function __construct(
        private GlobalMessageRegistry $globalMessageRegistry,
        private readonly EventManager $eventManager,
        private readonly ComponentRegistry $componentRegistry,
    ) {
    }

    public function render(LayoutInterface $layout, array $targetNames): array
    {
        return $this->renderBlocks($layout, $this->getTargetBlockNames($targetNames));
    }

    private function renderBlocks(LayoutInterface $layout, array $blockNames): array
    {
        $htmlParts = [];
        foreach ($blockNames as $blockName) {
            $block = $layout->getBlock($blockName);
            if ($block instanceof BlockInterface) {
                $htmlParts[] = $block->toHtml();
            } else {
                $this->globalMessageRegistry->addError('Block with name "'.$blockName.'" not found');
            }
        }

        return $htmlParts;
    }

    private function getTargetBlockNames(array $targets): array
    {
        $blockNames = $this->convertTargetsToBlockNames($targets);
        $blockNames = array_unique($blockNames);
        $this->eventManager->dispatch('loki_components_blocks', ['blocks' => $blockNames]);

        return $blockNames;
    }


    private function convertTargetsToBlockNames(array $targets): array
    {
        $blockNames = [];
        foreach ($targets as $target) {
            $blockNames[] = $this->componentRegistry->getBlockNameFromElementId($target);
        }

        return $blockNames;
    }
}