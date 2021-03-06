<?php

if (false === getenv('SYMFONY_PATCH_TYPE_DECLARATIONS')) {
    putenv('SYMFONY_PATCH_TYPE_DECLARATIONS=force=1&php71-compat=0');
}

require __DIR__.'/../.phpunit/phpunit-8.3-0/vendor/autoload.php';

$loader = require __DIR__.'/../vendor/autoload.php';

Symfony\Component\ErrorHandler\DebugClassLoader::enable();

foreach ($loader->getClassMap() as $class => $file) {
    switch (true) {
        case false !== strpos(realpath($file), '/vendor/'):
        case false !== strpos($file, '/src/Symfony/Bridge/PhpUnit/'):
        case false !== strpos($file, '/src/Symfony/Bundle/FrameworkBundle/Tests/Fixtures/Validation/Article.php'):
        case false !== strpos($file, '/src/Symfony/Component/Config/Tests/Fixtures/BadParent.php'):
        case false !== strpos($file, '/src/Symfony/Component/DependencyInjection/Tests/Compiler/OptionalServiceClass.php'):
        case false !== strpos($file, '/src/Symfony/Component/DependencyInjection/Tests/Fixtures/ParentNotExists.php'):
        case false !== strpos($file, '/src/Symfony/Component/DependencyInjection/Tests/Fixtures/Prototype/BadClasses/MissingParent.php'):
        case false !== strpos($file, '/src/Symfony/Component/DependencyInjection/Tests/Fixtures/php/'):
        case false !== strpos($file, '/src/Symfony/Component/ErrorHandler/Tests/Fixtures/'):
        case false !== strpos($file, '/src/Symfony/Component/PropertyInfo/Tests/Fixtures/Dummy.php'):
        case false !== strpos($file, '/src/Symfony/Component/PropertyInfo/Tests/Fixtures/ParentDummy.php'):
        case false !== strpos($file, '/src/Symfony/Component/Serializer/Tests/Normalizer/Features/ObjectOuter.php'):
        case false !== strpos($file, '/src/Symfony/Component/VarDumper/Tests/Fixtures/NotLoadableClass.php'):
        case false !== strpos($file, '/src/Symfony/Component/VarDumper/Tests/Fixtures/Php74.php') && \PHP_VERSION_ID < 70400:
            continue 2;
    }

    class_exists($class);
}

Symfony\Component\ErrorHandler\DebugClassLoader::disable();
