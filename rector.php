<?php
    declare(strict_types=1);

    use Rector\Config\RectorConfig;
    use Rector\Naming\Rector\Assign\RenameVariableToMatchMethodCallReturnTypeRector;

    return RectorConfig::configure()
        ->withPaths([
            __DIR__.'/app',
            __DIR__.'/src',
            __DIR__.'/bootstrap',
            __DIR__.'/database',
            __DIR__.'/config',
            __DIR__.'/lang',
            __DIR__.'/public',
            __DIR__.'/resources',
            __DIR__.'/routes',
            __DIR__.'/tests',
            __DIR__.'/stubs'
    ])
        // uncomment to reach your current PHP version
        // ->withPhpSets()

    // 1. Laravel specifieke Kracht
    // Dit activeert regels voor Laravel (bijvoorbeeld van Facade naar Type-hint, Collection verbeteringen)
    ->withComposerBased(phpunit: true, laravel: true)

    // 2. PSR / PhpStorm Style (Indentation & Imports)
    ->withIndent()
    ->withImportNames(removeUnusedImports: true)
    ->withFluentCallNewLine()

    // 3. Kwaliteit & Modernisering (Laravel 10/11 stijl)
    // Zorgt voor PSR-stijl syntax
    // Zorgt voor consistente naming conventions
    // Voegt missing return types/params toe
        ->withPreparedSets(privatization: true, naming: true, earlyReturn: true)
        // from AI
        // Voor het stapsgewijs verwijderen van ongebruikte code.
        ->withDeadCodeLevel(0)

        // Voor het stapsgewijs verbeteren van de algemene codekwaliteit.
        ->withCodeQualityLevel(0)

        // Voor het stapsgewijs toevoegen van ontbrekende type-declaraties.
        ->withTypeCoverageLevel(0)

        // Voor het stapsgewijs moderniseren en opschonen van de programmeerstijl.
        ->withCodingStyleLevel(0)

        // Voor het stapsgewijs introduceren van modernere PHP-functies op basis van versie.
        ->withPhpLevel(0)

        // Voor het stapsgewijs strenger maken van je code (bijv. voor static analysis).
        //                   ->withStrictBooleansLevel(0)

        // Voor het stapsgewijs toepassen van 'Early Return' principes (minder nesting).
        //    ->withEarlyReturnLevel(0)

        // Voor het stapsgewijs automatiseren van naamgevingsconventies.
        //    ->withNamingLevel(0)

        // Voor het stapsgewijs 'privatiseren' van classes en methodes (final/private).
        //    ->withPrivatizationLevel(0);

        // 4. Optioneel: Laravel IDE Helper integratie
        // Als je de 'ide-helper:generate' gebruikt, help je Rector hiermee:
        ->withAutoloadPaths([__DIR__.'/_ide_helper_models.php'])

        // 5. Vermijd conflicten met Laravel-specifieke magie
        // Soms wil je bepaalde naamgeving in Laravel behouden (zoals underscores in migrations)
        ->withSkip([RenameVariableToMatchMethodCallReturnTypeRector::class]);
