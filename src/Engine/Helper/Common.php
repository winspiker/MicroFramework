<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Helper;

class Common
{
    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';

    }

    /**
     * @return mixed
     */
    public static function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return mixed|string
     */
    public static function getPathUrl(): mixed
    {
        $pathUrl = $_SERVER['REQUEST_URI'];

        if ($position = strpos($pathUrl, '?')) {
            $pathUrl = substr($pathUrl, 0, $position);
        }

        return $pathUrl;
    }
}