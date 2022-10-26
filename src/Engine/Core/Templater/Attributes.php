<?php

namespace Winspiker\HidemyCMS\Engine\Core\Templater;

class Attributes
{


    public string $extendsContent;
    public array $yieldsFullName;
    public array $yieldsContent;

    public function __construct($extendContent, $yieldsFullName, $yieldsContent)
    {
        $this->extendsContent = $extendContent;
        $this->yieldsFullName = $yieldsFullName;
        $this->yieldsContent = $yieldsContent;

    }

}