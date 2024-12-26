<?php
declare(strict_types=1);

namespace Yireo\LokiComponents\Util;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class CamelCaseConvertor implements ArgumentInterface
{
    public function toCamelCase(string $text): string
    {
        $text = ucwords($text, '_.-');

        return preg_replace('#[_.-]+#', '', $text);
    }
}