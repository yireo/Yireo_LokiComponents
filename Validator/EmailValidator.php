<?php declare(strict_types=1);

namespace Yireo\LokiComponents\Validator;

use Magento\Customer\Api\AccountManagementInterface;
use Yireo\LokiComponents\Component\ComponentInterface;

class EmailValidator implements ValidatorInterface
{
    public function __construct(
        private AccountManagementInterface $accountManagement,
    ) {
    }

    public function validate(ComponentInterface $component, mixed $value): bool
    {
        $email = trim((string)$value);

        if (empty($email)) {
            $component->getMessages()->addError('This value is required');

            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $component->getMessages()->addError( 'Invalid email');

            return false;
        }

        $parts = explode('@', $email);
        $domain = $parts[1];
        if (false === checkdnsrr($domain)) {
            $message = (string)__('Domain "%s" does not seem to be valid');
            $component->getMessages()->addError( sprintf($message, $domain));
            return false;
        }

        // Mental note, this only triggers if `checkout/options/enable_guest_checkout_login` is enabled
        if (false === $this->accountManagement->isEmailAvailable($email)) {
            $component->getMessages()->addError( 'This email address is not available');

            return false;
        }

        return true;
    }
}