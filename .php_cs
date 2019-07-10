<?php
$date = date('Y-m-d');
$header = <<<EOF
A modern CSS theme for Kanboard.
============================================================================
Copyright © Stack Strategy Inc. All Rights Reserved.
Website: https://viggo.coding.me/blog/
----------------------------------------------------------------------------
For the full copyright and license information, please view the LICENSE 
file that was distributed with this source code.
============================================================================
Author: Viggo <leanclose@gmail.com>
Date: $date
EOF;

$finder = PhpCsFixer\Finder::create()
    ->exclude(['vendor', 'thinkphp'])
    ->in(__DIR__);

$fixers = [
    '@PSR1'                               => true,
    '@PSR2'                               => true,
    '@PHP56Migration'                     => true,
    '@PHP71Migration:risky'               => true,
    '@PHPUnit60Migration:risky'           => true,
    '@Symfony'                            => true,
    '@Symfony:risky'                      => true,
    'align_multiline_comment'             => ['comment_type' => 'phpdocs_only'],
    'array_indentation'                   => true,
    'array_syntax'                        => ['syntax' => 'short'],
    'blank_line_after_opening_tag'        => false,
    'class_keyword_remove'                => false,
    'combine_consecutive_issets'          => true,
    'combine_consecutive_unsets'          => true,
    'comment_to_phpdoc'                   => true,
    'compact_nullable_typehint'           => true,
    'concat_space'                        => ['spacing' => 'one'],
    'date_time_immutable'                 => true,
    'declare_equal_normalize'             => ['space' => 'single'],
    'declare_strict_types'                => false,
    'linebreak_after_opening_tag'         => true,
    'list_syntax'                         => ['syntax' => 'short'],
    'logical_operators'                   => true,
    'method_chaining_indentation'         => true,
    'class_attributes_separation'         => false,
    'no_blank_lines_before_namespace'     => true,
    'no_null_property_initialization'     => true,
    'no_short_echo_tag'                   => true,
    'no_superfluous_elseif'               => true,
    'no_superfluous_phpdoc_tags'          => true,
    'no_unset_on_property'                => true,
    'no_useless_else'                     => true,
    'no_useless_return'                   => true,
    'not_operator_with_space'             => false,
    'not_operator_with_successor_space'   => false,
    'no_leading_namespace_whitespace'     => true,
    'single_blank_line_before_namespace'  => false,
    'header_comment'                      => ['header' => $header, 'separate' => 'none', 'commentType' => 'PHPDoc', 'location' => 'after_open'],
    'yoda_style'                          => true,
    'binary_operator_spaces'              => ['align_equals' => false, 'align_double_arrow' => true],
    'no_binary_string'                    => true,
    'native_function_invocation'          => false,
    'void_return'                         => false
];

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setUsingCache(true)
    ->setRules($fixers)
    ->setFinder($finder);