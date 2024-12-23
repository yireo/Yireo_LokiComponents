<?php
declare(strict_types=1);

namespace Yireo\LokiComponents\Messages;

use Magento\Framework\Message\ManagerInterface as CoreMessageManager;

class MessageManager
{
    /** @var Message[] */
    private array $messages = [];

    public function __construct(
        private CoreMessageManager $messageManager,
    ) {
    }

    public function addGlobalNotice(string $message): void
    {
        $this->messageManager->addNoticeMessage($message);
    }

    public function addLocalNotice(string $message): void
    {
        $this->messages[] = new Message($message, Message::TYPE_NOTICE);
    }

    public function addGlobalWarning(string $message): void
    {
        $this->messageManager->addWarningMessage($message);
    }

    public function addLocalWarning(string $message): void
    {
        $this->messages[] = new Message($message, Message::TYPE_WARNING);
    }

    public function addGlobalError(string $message): void
    {
        $this->messageManager->addErrorMessage($message);
    }

    public function addLocalError(string $message): void
    {
        $this->messages[] = new Message($message, Message::TYPE_ERROR);
    }

    public function getLocalMessages(): array
    {
        return $this->messages;
    }

    public function hasLocalMessages(): bool
    {
        return count($this->messages) > 0;
    }

    public function clearLocalMessages(): void
    {
        $this->messages = [];
    }
}
