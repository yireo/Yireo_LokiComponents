<?php declare(strict_types=1);

namespace Yireo\LokiComponents\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Config implements ArgumentInterface
{
    public function __construct(
        private ScopeConfigInterface $scopeConfig,
    ) {
    }

    public function isDebug(): bool
    {
        return (bool)$this->scopeConfig->getValue('yireo_loki_components/general/debug');
    }

    public function onlyValidateAjax(): bool
    {
        return (bool)$this->scopeConfig->getValue('yireo_loki_components/general/only_validate_ajax');
    }

    public function getGlobalMessagesTimeout(): int
    {
        return (int)$this->scopeConfig->getValue('yireo_loki_components/global_messages/timeout');
    }

    public function enableMxValidationForEmail(): bool
    {
        return (bool)$this->scopeConfig->getValue('yireo_loki_checkout/validators/enable_mx_validation_for_email');
    }
}
