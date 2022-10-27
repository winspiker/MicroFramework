<?php

namespace Winspiker\MicroFramework\Engine\Core\FileManager;

class FileManager
{
    public function saveResult(string $tempalateName, string $content): string
    {
        $hash = hash('md5', $tempalateName . hash('md5', $content));
        $fileName = $tempalateName . '-' . $hash . '.php';
        $fullFileName = ROOT_DIR . 'cache/' . $fileName;
        if (!is_file($fullFileName)) {
            file_put_contents($fullFileName, $content);
        }
        $this->removeOldPages($fileName);
        return $fullFileName;
    }

    public function fileExist(string $templateDir, string $tempalateName): string
    {
        $templates = scandir($templateDir);
        $templateFullName = $tempalateName . '.blade.php';
        if (\is_array($templates) && \in_array($templateFullName, $templates, true)) {
            return $tempalateName;
        }
        throw new \InvalidArgumentException(
            sprintf('%s template does not exist in directory %s', strtoupper($tempalateName), $templateDir)
        );
    }

    public function getFiles(string $dirPath): array
    {
        if (!is_dir($dirPath)) {
            throw new \InvalidArgumentException(
                sprintf('"%s" is not directory', $dirPath)
            );
        }
        $scanned_directory = array_diff(scandir($dirPath), ['..', '.']);
        return $this->addPath($scanned_directory, $dirPath);


    }

    private function addPath(array $filesName, string $dirPath): array
    {
        foreach ($filesName as $file) {
            $result[] = sprintf('%s/%s', $dirPath, $file);
        }

        return $result;
    }

    private function removeOldPages(string $fileName): void
    {
        $files = scandir(ROOT_DIR . 'cache');
        foreach ($files as $file) { // ебашим по $templateName
            if ($file !== $fileName && !is_dir($file)) {
                unlink(ROOT_DIR . 'cache/' . $file);
            }
        }
    }

    public function getFileContent(string $fileDir, string $fileName, bool $isExtends = false): string
    {
        $file = sprintf('%s/%s.blade.php', $fileDir, $fileName);
        $message = sprintf('File %s not found in "%s"', $fileName, $file);

        if (is_file($file)) {
            return file_get_contents($file);
        }
        if ($isExtends === true) {
            $message = sprintf('Extends %s not found in "%s"', $fileName, $file);
        }
        throw new \InvalidArgumentException($message);

    }

}