<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Helper;

final class Common
{
    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';

    }

    public static function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getPathUrl(): ?string
    {
        $pathUrl = $_SERVER['REQUEST_URI'];

        if ($position = strpos($pathUrl, '?')) {
            $pathUrl = substr($pathUrl, 0, $position);
        }

        return $pathUrl;
    }
}