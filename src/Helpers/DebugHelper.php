<?php

namespace LaraToolkit\Helpers;

use Illuminate\Support\Facades\App;

class DebugHelper
{
    public static function inFile(string $fileName, array|string|object $data): void
    {
        try {
            if (is_array($data) || is_object($data)) {
                $data = json_encode($data, JSON_PRETTY_PRINT);

                if ($data === false) {
                    throw new \Exception('Error converting data to JSON: ' . json_last_error_msg());
                }
            }

            $fileName = !str_contains($fileName, '.') ? $fileName . '.json' : $fileName;
            $basePath = App::basePath();
            $filePath = $basePath . DIRECTORY_SEPARATOR . $fileName;

            file_put_contents($filePath, $data . PHP_EOL, FILE_APPEND);

        } catch (\Throwable $exception) {
            try {
                $logger = \Illuminate\Container\Container::getInstance()->make(\Psr\Log\LoggerInterface::class);
                $logger->error('Failed to write data to file', [
                    'file' => $fileName,
                    'data' => $data,
                    'error' => $exception->getMessage(),
                    'exception' => $exception,
                ]);
            } catch (\Throwable $loggerException) {
                error_log('Failed to log exception: ' . $loggerException->getMessage());
                error_log($exception->getMessage());
            }
        }
    }
}