<?php
    declare(strict_types=1);

    use Rector\Config\RectorConfig;
    use Rector\Naming\Rector\Assign\RenameVariableToMatchMethodCallReturnTypeRector;

    return RectorConfig::configure()->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/resources',
        __DIR__ . '/tests',
        __DIR__ . '/stubs',
    ])
        //     ->withPhpSets()

        // 1. Laravel specifieke Kracht
        // Dit activeert regels voor Laravel (bijvoorbeeld van Facade naar Type-hint, Collection verbeteringen)
        ->withComposerBased(phpunit: true, laravel: true)

        // 2. PSR / PhpStorm Style (Indentation & Imports)
        ->withIndent()->withImportNames(removeUnusedImports: true)->withFluentCallNewLine()

        // 3. Kwaliteit & Modernisering (Laravel 10/11 stijl)
        // Zorgt voor PSR-stijl syntax
        // Zorgt voor consistente naming conventions
        // Voegt missing return types/params toe
        ->withPreparedSets(deadCode: true, codeQuality: true, codingStyle: true, typeDeclarations: true, naming: true, privatization: true, earlyReturn: true, strictBooleans: true)

        // 4. Optioneel: Laravel IDE Helper integratie
        // Als je de 'ide-helper:generate' gebruikt, help je Rector hiermee:
        ->withAutoloadPaths([__DIR__ . '/_ide_helper_models.php'])

        // 5. Vermijd conflicten met Laravel-specifieke magie
        // Soms wil je bepaalde naamgeving in Laravel behouden (zoals underscores in migrations)
        ->withSkip([RenameVariableToMatchMethodCallReturnTypeRector::class]);
