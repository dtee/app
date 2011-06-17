#!/usr/bin/env php

<?php
if (count($argv) < 2) {
   die("Usage: {$argv[0]} dirpath");
}
else {
    unset($argv[0]);

    $filePaths = array();
    foreach ($argv as $filePath) {
        $rootDir = __DIR__;
        $gitModule = $rootDir . '/' . $filePath . '/.gitmodules';
        if (!file_exists($gitModule)) {
            die("No git module file ({$gitModule}) found");
        }
        else {
            $filePaths[] = $gitModule;
        }
    }
}

$paths = array();
foreach ($filePaths as $moduleFilename) {
    $deps = parse_ini_file($moduleFilename, true, INI_SCANNER_RAW);

    // Switch working directory
    foreach ($deps as $name => $dep) {
        $localPath = $dep['path'];
        $url = $dep['url'];

        $urlParts = split('@|://', $url);
        $lastUrlPast = str_replace(':', '/', end($urlParts));
        $urlParts = explode("/", $lastUrlPast);

        unset($urlParts[0]);
        $path = implode('/', $urlParts);
        $path = str_replace('~', 'dtee', $path);
        $path = str_replace('.git', '', $path);

        $odlUrl = "git@cornerstone:{$path}.git";
        $paths[$path] = array(
            'upstream' => $url,
            'origin' => $odlUrl,
            'mod-path' => $localPath
        );
    }
}

ksort($paths);

echo "\n\n";
print_r(implode(" ", array_keys($paths)));
echo "\n\n";
print_r($paths);
