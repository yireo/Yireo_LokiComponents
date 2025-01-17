<?php declare(strict_types=1);

namespace Yireo\LokiComponents\Validator;

use Yireo\LokiComponents\Component\ComponentInterface;
use Yireo\LokiComponents\Component\ComponentRepositoryInterface;
use Yireo\LokiComponents\Component\ComponentViewModelInterface;

class LengthValidator implements ValidatorInterface
{
    public function validate(ComponentInterface $component, mixed $value): bool
    {
        if (false === is_string($value)) {
            return true;
        }

        $viewModel = $component->getViewModel();
        $repository = $component->getRepository();
        if (false === $repository instanceof ComponentRepositoryInterface) {
            return true;
        }

        if ($viewModel->hasMinLength() && strlen($value) < $viewModel->getMinLength()) {
            $msg = __('This value should be %1 characters or more in length', $viewModel->getMinLength());
            $repository->getLocalMessageRegistry()->addError($component, (string) $msg);

            return false;
        }

        if ($viewModel->hasMaxLength() && strlen($value) > $viewModel->getMaxLength()) {
            $msg = __('This value should be %1 characters or less in length: '.$value, $viewModel->getMaxLength());
            $repository->getLocalMessageRegistry()->addError($component, (string) $msg);

            return false;
        }

        return true;
    }
}
