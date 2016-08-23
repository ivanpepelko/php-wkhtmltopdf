<?php

/**
 * Join path.
 *
 * @param string $args
 *
 * @return string
 */
function join_path($args)
{
    $args = func_get_args();
    $forwardSlash = reset($args)[0] === '/' ? '/' : '';

    return $forwardSlash . implode(DIRECTORY_SEPARATOR, array_map(function ($arg) {
        return trim($arg, " \t\n\r\0\x0b\/\\");
    }, $args));
}
