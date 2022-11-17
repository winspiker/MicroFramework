<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Core\HttpBasics\Request;


class Request
{
    private static $requestFactory;

    private array $headers;
    private array $request;
    private array $query;
    private array $attributes;
    private array $cookies;
    private array $files;
    private array $server;
    private string $path;

    private ?string $content;
    private string $requestMethod;


    /**
     * @param array $query The GET parameters
     * @param array $request The POST parameters
     * @param array $attributes The request attributes (parameters parsed from the PATH_INFO, ...)
     * @param array $cookies The COOKIE parameters
     * @param array $files The FILES parameters
     * @param array $server The SERVER parameters
     * @param string|null $content The raw body data
     */

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {

        $this->request = $request;
        $this->requestMethod = $this->setRequestMethod($server);
        $this->query = $query;
        $this->attributes = $attributes;
        $this->cookies = $cookies;
        $this->files = $files;
        $this->server = $server;
        $this->headers = $this->setRequestHeaders($server);
        $this->content = $content;
        $this->path = $this->setPath($server);

    }

    private function setRequestHeaders(array $server): array
    {
        $hasHeader = static function ($key) {
            if (str_starts_with($key,"HTTP_")) {
                return $key;
            }
            return false;
        };

        return array_filter($server, $hasHeader, ARRAY_FILTER_USE_KEY);
    }

    private function setRequestMethod(array $server)
    {
        return $server['REQUEST_METHOD'];
    }

    private function setPath($server): string
    {
        $url = $server['REQUEST_URI'];
        return parse_url($url, PHP_URL_PATH);
    }

    public static function createFromGlobals(): static
    {
        return new static($_GET, $_POST, [], $_COOKIE, $_FILES, $_SERVER);
    }

    public function getRequestHeaders(): array
    {
        return $this->headers;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getServer(): array
    {
        return $this->server;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function getCookies(): array
    {
        return $this->cookies;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getQuery(): array
    {
        return $this->query;
    }

    public function getRequest(): array
    {
        return $this->request;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->requestMethod??'GET';
    }


}