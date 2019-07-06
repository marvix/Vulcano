<?php

namespace App\Helpers;

class Helper
{
    /**
     * ------------------------------------------------------------------------
     * Count number of files of any pattern in a directory
     * ------------------------------------------------------------------------.
     *
     * @param string $directory
     * @param string $pattern
     * @return int $count
     */
    public static function countFiles($directory, $pattern)
    {
        ini_set('max_execution_time', 0);

        $dir = opendir($directory);
        $count = 0;
        while (false !== ($filename = readdir($dir))) {
            preg_match($pattern, $filename, $matches);
            if (null != $matches) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * ------------------------------------------------------------------------
     * Select any background image stored in a directory
     * ------------------------------------------------------------------------.
     *
     * @param string $path
     * @param string $orefix
     * @param string $pattern
     *
     * @return string $backgroundImage
     */
    public static function selectBackgroundImage($path, $prefix, $pattern)
    {
        $imgNumber = self::countFiles(public_path().$path, $pattern);
        $path = asset($path).'/'.$prefix;

        return $path.rand(1, $imgNumber).'.jpg';
    }
}
