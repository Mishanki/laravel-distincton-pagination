<?php

declare(strict_types=1);

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$header = <<<'EOF'
    This file is part of PHP CS Fixer.

    (c) Fabien Potencier <fabien@symfony.com>
        Dariusz Rumiński <dariusz.ruminski@gmail.com>

    This source file is subject to the MIT license that is bundled
    with this source code in the file LICENSE.
    EOF;

$finder = (new Finder())
    ->ignoreDotFiles(false)
    ->ignoreVCSIgnored(true)
    ->exclude(['dev-tools/phpstan', 'tests/Fixtures'])
    ->in(__DIR__)
;

return (new Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@PSR12:risky' => true,
        '@PHP82Migration' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        'blank_line_before_statement' => true,
        'comment_to_phpdoc' => false,
        'yoda_style' => [
            'equal' => false,
            'identical' => false,
            'less_and_greater' => false,
        ],
        'phpdoc_add_missing_param_annotation' => true,
        'no_superfluous_phpdoc_tags' => false,
        'phpdoc_align' => [
            'align' => 'left',
        ],
        'no_unused_imports' => true,
        'single_line_comment_style' => false,
        'strict_comparison' => false,
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'new_line_for_chained_calls',
        ],
    ])
    ->setFinder($finder);
