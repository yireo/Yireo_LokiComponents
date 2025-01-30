<?php declare(strict_types=1);

namespace Yireo\LokiComponents\Util\Controller;

use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use RuntimeException;
use Yireo\LokiComponents\Util\Ajax;

class RequestDataLoader
{
    public function __construct(
        private readonly RequestInterface $request,
        private readonly Ajax $ajax
    ) {
    }

    public function load(): array
    {
        $data = json_decode($this->request->getContent(), true);
        $this->sanityCheck($data);

        return $data;
    }

    public function mergeRequestParams()
    {
        $data = $this->load();
        $params = array_merge($data['request'], $this->request->getParams());
        $this->request->setParams($params);
    }

    private function sanityCheck(array $requestData): void
    {
        if (false === $this->ajax->isAjax()) {
            throw new RuntimeException('Not an Alpine request');
        }

        $requiredFields = ['targets', 'componentData', 'block', 'handles'];
        foreach ($requiredFields as $requiredField) {
            if (false === array_key_exists($requiredField, $requestData)) {
                throw new RuntimeException('No '.$requiredField.' in request');
            }
        }
    }
}
