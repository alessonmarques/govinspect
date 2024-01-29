<?php

namespace App\Services\Api;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class PluginAbstract
{
    /**
     * The request's url storage.
     *
     * @var string
     */
    private $url;

    /**
     * The request's method storage.
     *
     * @var string
     */
    private $method;

    public function __construct(
        private HttpClientInterface $client,
        private LoggerInterface $logger,
    ) {
        $reflection = new \ReflectionClass($this);
        $pluginData = current($reflection->getAttributes())->getArguments();
        $this->url = $pluginData["baseUrl"] . $pluginData["endpoint"];
        $this->method = strtolower($pluginData["method"]);
    }

    protected function do(array $params = []): array
    {
        try {
            $this->adjustUrl($params);
            $response = [
                'requestDate' => date('Y-m-d H:i:s'),
                'data' => $this->{$this->method}($params),
            ];
        } catch (\Exception $e) {
            $this->logger->error("Error trying to {$this->method} from {$this->url} with parameters " .
            json_encode($params) . "\n" . $e->getMessage());
            return [
                'error' => $e->getMessage(),
            ];
        }
        return $response;
    }

    private function get(array $params = []): array
    {
        try {
            $response = $this->client->request(
                'GET',
                $this->url,
                $params,
            );
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return [
                'error' => $e->getMessage(),
            ];
        }
        $content = json_decode($response->getContent(), true);
        return $content;
    }

    private function post($body = []): array
    {
        try {
            $response = $this->client->request(
                'POST',
                $this->url,
                $body,
            );
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return [
                'error' => $e->getMessage(),
            ];
        }
        $content = json_decode($response->getContent(), true);
        return $content;
    }

    private function patch($body = []): array
    {
        try {
            $response = $this->client->request(
                'PATCH',
                $this->url,
                $body,
            );
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return [
                'error' => $e->getMessage(),
            ];
        }
        $content = json_decode($response->getContent(), true);
        return $content;
    }

    private function delete(): array
    {
        try {
            $response = $this->client->request(
                'DELETE',
                $this->url
            );
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return [
                'error' => $e->getMessage(),
            ];
        }
        $content = json_decode($response->getContent(), true);
        return $content;
    }

    private function adjustUrl(array &$params = []): void
    {
        $url = parse_url($this->url);
        $path = $url['path'];
        preg_match_all('/\{([^}]+)\}/', $path, $hits);
        if (!empty($hits[0])) {
            foreach ($hits[1] as $parameter) {
                if (isset($params[$parameter])) {
                    $path = str_replace('{' . $parameter . '}', $params[$parameter], $path);
                    unset($params[$parameter]);
                } else {
                    $path = str_replace('/{' . $parameter . '}', '', $path);
                }
            }
        }
        $url['path'] = $path;
        $this->url = $this->remountUrl($url);
    }

    private function remountUrl(array $parsedUrl): string
    {
        return $parsedUrl['scheme'] . '://'
        . $parsedUrl['host']
        . (isset($parsedUrl['port']) ? ':' . $parsedUrl['port'] : '')
        . (isset($parsedUrl['path']) ? $parsedUrl['path'] : '')
        . (isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '')
        . (isset($parsedUrl['fragment']) ? '#' . $parsedUrl['fragment'] : '');
    }
}
