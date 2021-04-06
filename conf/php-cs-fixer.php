<?php

// see https://cs.symfony.com/doc/config.html
//require_once './vendor/autoload.php';

$finder = PhpCsFixer\Finder::create()
//        ->exclude('')
//        ->notPath('')
        ->in('src/')
;

$config = new PhpCsFixer\Config();
return $config->setRules([
                    '@PSR12' => true,
                    'strict_param' => true,
                    'array_syntax' => ['syntax' => 'short'],
                ])
                ->setFinder($finder)
;
