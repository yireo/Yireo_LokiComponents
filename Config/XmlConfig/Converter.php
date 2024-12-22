<?php declare(strict_types=1);

namespace Yireo\LokiComponents\Config\XmlConfig;

use DOMDocument;
use Magento\Framework\Config\ConverterInterface;
use Yireo\LokiComponents\Exception\XmlConfigException;

class Converter implements ConverterInterface
{
    /**
     * @param DOMDocument $source
     * @return array
     */
    public function convert($source)
    {
        return [
            'components' => $this->getComponentDefinitions($source),
        ];
    }

    private function getComponentDefinitions(DOMDocument $source): array
    {
        $componentDefinitions = [];
        $componentElements = $source->getElementsByTagName('component');

        foreach ($componentElements as $componentElement) {
            $name = (string)$componentElement->getAttribute('name');
            $viewModel = (string)$componentElement->getAttribute('viewModel');
            $mutator = (string)$componentElement->getAttribute('mutator');

            $blockDefinitions = [];
            $blockElements = $componentElement->getElementsByTagName('block');
            foreach ($blockElements as $blockElement) {
                $role = (string)$blockElement->getAttribute('role');
                if (empty($role)) {
                    throw new XmlConfigException('Block in component "' . $name . '" does not have "role" attribute');
                }

                $blockDefinitions[] = [
                    'name' => (string)$blockElement->getAttribute('name'),
                    'role' => $role,
                ];
            }

            $validatorDefinitions = [];
            $validatorElements = $componentElement->getElementsByTagName('validator');
            foreach ($validatorElements as $validatorElement) {
                $validatorDefinitions[] = [
                    'name' => (string)$validatorElement->getAttribute('name'),
                    'disabled' => (bool)$validatorElement->getAttribute('disabled'),
                ];
            }

            $filterDefinitions = [];
            $filterElements = $componentElement->getElementsByTagName('filter');
            foreach ($filterElements as $filterElement) {
                $filterDefinitions[] = [
                    'name' => (string)$filterElement->getAttribute('name'),
                    'disabled' => (bool)$filterElement->getAttribute('disabled'),
                ];
            }

            $componentDefinitions[$name] = [
                'name' => $name,
                'viewModel' => $viewModel,
                'mutator' => $mutator,
                'blocks' => $blockDefinitions,
                'validators' => $validatorDefinitions,
                'filters' => $filterDefinitions,
            ];
        }

        return $componentDefinitions;
    }
}
