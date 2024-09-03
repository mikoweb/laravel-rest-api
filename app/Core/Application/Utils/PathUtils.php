<?php

namespace App\Core\Application\Utils;

use DirectoryIterator;

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
}
