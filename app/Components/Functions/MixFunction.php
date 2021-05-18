<?php


namespace App\Components\Functions;


use Nette\Utils\FileSystem;
use Nette\Utils\Strings;

class MixFunction
{

    /**
     * @param $path
     * @param string $manifestDirectory
     * @return mixed
     * @throws \Exception
     */
    public static function mix($path, string $manifestDirectory = ''): mixed
    {
        static $manifests = [];

        if (!Strings::startsWith($path, '/')) {
            $path = "/$path";
        }

        if ($manifestDirectory && !Strings::endsWith($manifestDirectory, '/')) {
            $manifestDirectory = "$manifestDirectory/";
        }

        $manifestPath = $manifestDirectory.'mix-manifest.json';

        if (!isset($manifests[$manifestPath])) {
            if (!is_file($manifestPath)) {
                throw new \Exception('The mix manifest does not exist');
            }

            $manifests[$manifestPath] = json_decode(FileSystem::read($manifestPath), true);
        }

        $manifest = $manifests[$manifestPath];

        if (!isset($manifest[$path])) {
            throw new \Exception("Unable to locate Mix file: $path.");
        }

        return $manifestDirectory.$manifest[$path];
    }

}