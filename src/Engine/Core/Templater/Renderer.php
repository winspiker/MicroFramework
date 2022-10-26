<?php

namespace Winspiker\HidemyCMS\Engine\Core\Templater;

use Winspiker\HidemyCMS\Engine\Core\FileManager\FileManager;

class Renderer // Renderer
{
    private Parser $parser;
    public string $templateDir;
    private FileManager $fm;

    public function __construct(string $templateDir , FileManager $fileManager, Parser $parser)
    {
        $this->parser = $parser;
        $this->fm = $fileManager;
        $this->templateDir = $templateDir;
    }

    public function render(string $tempalateName): string
    {
        $tempalateFilePath = $this->fm->fileExist($this->templateDir, $tempalateName);
        $attributes = $this->parser->parseContent($this->templateDir, $tempalateFilePath);
        $pageContent = preg_replace($attributes->yieldsFullName, $attributes->yieldsContent, $attributes->extendsContent);

        return $pageContent;
    }
}
