<?php

namespace Winspiker\MicroFramework\Engine\Core\Templater;

final class Attributes
{


    public string $extendsContent;
    public array $yieldsFullName;
    public array $yieldsContent;

    public function __construct(string $extendContent, array $yieldsFullName, array $yieldsContent)
    {
        $this->extendsContent = $extendContent;
        $this->yieldsFullName = $yieldsFullName;
        $this->yieldsContent = $yieldsContent;

    }

}