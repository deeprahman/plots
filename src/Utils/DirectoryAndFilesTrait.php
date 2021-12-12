<?php


namespace Plots\Utils;


trait DirectoryAndFilesTrait
{
    protected function list(string $dirPath, $order = 0):array
    {
        return array_diff(scandir($dirPath, $order), array('..', '.')); // NOTE: Slow algorithm
    }
}