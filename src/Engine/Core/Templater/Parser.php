<?php

declare(strict_types=1);

namespace Winspiker\HidemyCMS\Engine\Core\Templater;

use mysql_xdevapi\Exception;
use Winspiker\HidemyCMS\Engine\Core\FileManager\FileManager;

class Parser
{
    public array $regex = [
        'extends' => "/\@extends\('([a-z]+)'\)/",
        'sections' => "/\@section\('([a-z]+)'\)((?:(?!\@endsection).*\s*)*)\@endsection/",
        'yields' => "/\@yield\('([a-z]+)'\)/"
    ];

    private FileManager $fileManager;


    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function parseContent(string $templateDir, string $templateName): Attributes
    {
        $fileContent = $this->fileManager->getFileContent($templateDir, $templateName);

        preg_match($this->regex['extends'], $fileContent, $extends);
        preg_match_all($this->regex['sections'], $fileContent, $sections);
        /** ExtendName      $extend[1] **/
        $extend = $extends[1];
        /** SectionsName    $sections[1]
         * SectionsContent $sections[2] **/
        $sections = array_combine($sections[1], $sections[2]);
        $extendContent = $this->fileManager->getFileContent($templateDir, $extend, true);
        preg_match_all($this->regex['yields'], $extendContent, $extendAttributes);
        $extendAttributes = array_combine($extendAttributes[0], $extendAttributes[1]);
        $yields = $this->compareYieldsAndSections($extendAttributes, $sections);
        $yieldsFullName = array_keys($yields);
        $yieldsContent = array_values($yields);
        return new Attributes($extendContent, $yieldsFullName, $yieldsContent);
    }

    private function compareYieldsAndSections(array $yields, array $sections): array
    {
        $yieldsContent = [];
        foreach ($yields as $yieldFullName => $yieldName) {
            if (!\array_key_exists($yieldName, $sections)) {
                throw new Exception(sprintf('Not enough %s yields in sections', $yieldName));
            }
            $yieldsContent[$this->toRegexModel($yieldFullName)] = $sections[$yieldName];
        }
        return $yieldsContent;
    }

    private function toRegexModel(string $yieldFullName): string
    {
        return '/' . quotemeta($yieldFullName) . '/';
    }
}

