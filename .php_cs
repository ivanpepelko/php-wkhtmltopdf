<?php

use Symfony\CS\Config;
use Symfony\CS\Finder;
use Symfony\CS\FixerInterface;

require_once __DIR__ . '/vendor/autoload.php';

$finder = Finder::create()
        ->files()
        ->in(__DIR__ . '/src');

return Config::create()
                ->level(FixerInterface::SYMFONY_LEVEL)
                ->fixers([
                    '-concat_without_spaces',
                    '-unneeded_control_parentheses',
                    'phpdoc_order',
                    'concat_with_spaces'
                ])
                ->finder($finder)
;

