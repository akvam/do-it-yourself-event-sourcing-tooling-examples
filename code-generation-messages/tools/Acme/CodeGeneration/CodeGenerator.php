<?php declare(strict_types=1);

namespace Acme\CodeGeneration;

/**
 * @copyright Marijn Huizendveld 2018. All rights reserved.
 */
final class CodeGenerator {

    function generate(array $dsl): string {
        $namespaces = [];

        foreach ($dsl as $module => $moduleSpecification)
        {
            $namespaces[] = <<<PHP
namespace {$module} {
{$this->generateEvents($moduleSpecification['events'])}
}
PHP;
        }

        $code = implode(PHP_EOL, $namespaces);

        return <<<PHP
<?php declare(strict_types=1);

{$code}

PHP;
    }

    private function generateMessageConstructor (array $messageSpecification): string {
        $constructorParameters = [];
        $constructorAttributes = [];

        foreach ($messageSpecification['attributes'] as $attribute => $attributeSpecification)
        {
            $typeConstraint = "string";
            $constructorParameters[] = <<<PHP
{$typeConstraint} \${$attribute},
PHP;
            $constructorAttributes[] = <<<PHP
\$this->{$attribute} = \${$attribute};
PHP;
        }

        $constructorParametersCode = rtrim(implode(PHP_EOL, $constructorParameters), ',');
        $constructorAttributesCode = implode(PHP_EOL, $constructorAttributes);

        return <<<PHP
function __construct(
    {$constructorParametersCode}
) {
    {$constructorAttributesCode}
}
PHP;
    }

    private function generateMessageAttributes (array $messageSpecification): string {
        $eventAttributes = [];

        foreach ($messageSpecification['attributes'] as $attribute => $attributeSpecification)
        {
            $eventAttributes[] = <<<PHP
private \${$attribute};
function {$attribute}(): string { return \$this->{$attribute}; }
PHP;
        }

        $eventAttributesCode = implode(PHP_EOL, $eventAttributes);

        return $eventAttributesCode;
    }

    private function generateEvent (string $eventClassName, array $eventSpecification): string {
        $messageCode = <<<PHP
final class {$eventClassName} implements \Acme\Infra\EventSourcing\Event {
{$this->generateMessageConstructor($eventSpecification)}
{$this->generateMessageAttributes($eventSpecification)}
}
PHP;

        return $messageCode;
    }

    private function generateEvents (array $eventSpecifications): string {
        $events = [];

        foreach ($eventSpecifications as $event => $eventSpecification)
        {
            $events[] = $this->generateEvent($event, $eventSpecification);
        }

        return implode(PHP_EOL, $events);
    }
}
