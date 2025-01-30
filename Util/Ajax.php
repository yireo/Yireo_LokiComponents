<?php
declare(strict_types=1);

namespace Yireo\LokiComponents\Util;

use Magento\Framework\App\Request\Http as HttpRequest;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Ajax implements ArgumentInterface
{
    public function __construct(
        private HttpRequest $httpRequest
    ) {
    }

    public function isAjax(): bool
    {
        $value = $this->httpRequest->getHeader('X-Alpine-Request');
        return in_array($value, [1, 'true', true]);
    }
}
