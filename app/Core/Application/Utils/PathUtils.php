<?php

namespace App\Core\Application\Utils;

use DirectoryIterator;

use function Symfony\Component\String\u;

class PathUtils
{
    /**
     * @var string[]|null
     */
    private static ?array $modulesPaths = null;

    /**
     * @return string[]
     */
    public static function getModulesPaths(): array
    {
        if (is_null(self::$modulesPaths)) {
            $paths = [];

            foreach (new DirectoryIterator(__DIR__ . '/../../../Module') as $path) {
                /** @var DirectoryIterator $path */
                if (!$path->isDot() && $path->isDir()) {
                    $paths[] = $path->getRealPath();
                }
            }

            self::$modulesPaths = $paths;
        }

        return self::$modulesPaths;
    }

    /**
     * @return string[]
     */
    public static function getRoutesPaths(string $type): array
    {
        return array_filter([
            ...array_map(fn (string $path) =>  "$path/Infrastructure/routes/$type.php", self::getModulesPaths()),
            __DIR__ . "/../../../Shared/Infrastructure/routes/$type.php",
            __DIR__ . "/../../../../routes/$type.php",
        ], fn (string $path) => file_exists($path));
    }

    public static function getDatasetPath(?string $path = null): string
    {
        return resource_path(self::concatPath('dataset', $path));
    }

    public static function concatPath(string $basePath, ?string $path): string
    {
        if (empty($path)) {
            return $basePath;
        }

        if (u($path)->startsWith('/')) {
            $path = u($path)->slice(1)->toString();
        }

        return "$basePath/$path";
    }
}
