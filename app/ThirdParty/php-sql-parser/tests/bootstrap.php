<?php

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Helper function for getting the expected array
 * from a file as serialized string.
 * Returns an unserialized value from the given file.
 *
 * @param string $filename
 * @param mixed  $path
 * @param mixed  $unserialize
 */
function getExpectedValue($path, $filename, $unserialize = true)
{
    $path    = explode(DIRECTORY_SEPARATOR, $path);
    $content = file_get_contents(__DIR__ . '/expected/' . array_pop($path) . '/' . $filename);

    return $unserialize ? unserialize($content) : $content;
}

function setExpectedValue($path, $filename, $data, $serialize = true)
{
    $path = explode(DIRECTORY_SEPARATOR, $path);

    return file_put_contents(__DIR__ . '/expected/' . array_pop($path) . '/' . $filename, $serialize ? serialize($data) : $data);
}
