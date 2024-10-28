<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude([
        'docker',
        'frontend',
        'public',
        'resources',
        'storage',
        'vendor',
    ])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PER-CS' => true,
        '@PHP83Migration' => true,
        'fully_qualified_strict_types' => true,
    ])
    ->setFinder($finder)
;

