<?php

namespace Winspiker\MicroFramework\Engine\Core\Templater;

use Winspiker\MicroFramework\Engine\Core\FileManager\FileManager;

final class Renderer
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
        $templateFilePath = $this->fm->fileExist($this->templateDir, $tempalateName);
        $attributes = $this->parser->parseContent($this->templateDir, $templateFilePath);
        $pageContent = preg_replace($attributes->yieldsFullName, $attributes->yieldsContent, $attributes->extendsContent);

        return $pageContent;
    }
}
