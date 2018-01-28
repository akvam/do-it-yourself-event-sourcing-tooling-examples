<?php declare(strict_types=1);

namespace Acme\Infra\EventSourcing\CodeGeneration;

use function Acme\Infra\EventSourcing\canonical_to_fully_qualified;

/**
 * @copyright Marijn Huizendveld 2018. All rights reserved.
 */
final class CodeGenerator {

    function generate(array $dsl): string {
        $namespaces = [];

        foreach ($dsl as $canonicalModuleName => $moduleSpecification)
        {
            $module = canonical_to_fully_qualified($canonicalModuleName);
            $namespaces[] = <<<PHP
namespace {$module} {
{$this->generateEvents($moduleSpecification['events'])}
{$this->generateCommands($moduleSpecification)}
}
PHP;
        }

        $code = implode(PHP_EOL, $namespaces);

        return <<<PHP
<?php declare(strict_types=1);

/**
 * WARNING! This file has been generated.
 *
 * Modify by changing the underlying DSL. Convention stipulates that the file has an identical filename with a .yaml extension.
 * Are you a first-timer? Ask someone to help you. Have a nice day :-)
 *
 * @see \Acme\Infra\EventSourcing\CodeGeneration\CodeGenerator
 */

{$code}

PHP;
    }

    private function generateMessageConstructor (array $messageSpecification): string {
        $docBlocks = ['@api'];

        foreach ($messageSpecification['attributes'] as $attribute => $attributeSpecification)
        {
            $typeConstraint = $this->typeConstraintOfAttribute($attributeSpecification);
            $doc = is_array($attributeSpecification) && array_key_exists('doc', $attributeSpecification)
                ? $attributeSpecification['doc']
                : "";
            $docBlocks[] = <<<DOCBLOCK
@param {$typeConstraint} \${$attribute} {$doc}
DOCBLOCK;
        }

        return <<<PHP
{$this->generateDockBlocks(... $docBlocks)}
function __construct({$this->generateConstructorParametersList($messageSpecification)}) {
    {$this->generateConstructorAttributeAssignment($messageSpecification)}
}
PHP;
    }

    private function generateMessageAttributes (array $messageSpecification): string {
        $eventAttributes = [];

        foreach ($messageSpecification['attributes'] as $attribute => $attributeSpecification)
        {
            $typeConstraint = $this->typeConstraintOfAttribute($attributeSpecification);
            $eventAttributes[] = <<<PHP
private \${$attribute};
function {$attribute}(): {$typeConstraint} { return \$this->{$attribute}; }
PHP;
        }

        return implode(PHP_EOL, $eventAttributes);
    }

    private function generateRawMessagePayload (array $messageSpecification): string {
        $attributeToValues = [];

        foreach ($messageSpecification['attributes'] as $attribute => $attributeSpecification)
        {
            $attributeToValues[] = <<<PHP
'{$attribute}' => \$this->{$attribute},
PHP;
        }

        $attributeToValuesCode = implode(PHP_EOL, $attributeToValues);

        return <<<PHP
function rawMessagePayload(): array {
    return [
        {$attributeToValuesCode}
    ];
}
PHP;
    }

    private function generateEvent (string $eventClassName, array $eventSpecification): string {
        return <<<PHP
{$this->generateMessageDocBlock($eventSpecification)}
final class {$eventClassName} implements \Acme\Infra\EventSourcing\Event {
{$this->generateMessageConstructor($eventSpecification)}
{$this->generateMessageAttributes($eventSpecification)}
{$this->generateRawMessagePayload($eventSpecification)}
}
PHP;
    }

    private function generateEvents (array $eventSpecifications): string {
        $events = [];

        foreach ($eventSpecifications as $event => $eventSpecification)
        {
            $events[] = $this->generateEvent($event, $eventSpecification);
        }

        return implode(PHP_EOL, $events);
    }

    private function typeConstraintOfAttribute (array $attributeSpecification = null): string {
        return is_array($attributeSpecification) && array_key_exists('constrainType', $attributeSpecification)
            ? $attributeSpecification['constrainType']
            : "string";
    }

    private function generateConstructorParametersList (array $messageSpecification): string {
        $constructorParameters = [];

        foreach ($messageSpecification['attributes'] as $attribute => $attributeSpecification)
        {
            $typeConstraint = $this->typeConstraintOfAttribute($attributeSpecification);
            $constructorParameters[] = <<<PHP
{$typeConstraint} \${$attribute},
PHP;
        }

        return rtrim(implode(PHP_EOL, $constructorParameters), ',');
    }

    private function generateConstructorAttributeAssignment (array $messageSpecification): string {
        $constructorAttributes = [];

        foreach ($messageSpecification['attributes'] as $attribute1 => $attributeSpecification)
        {
            $constructorAttributes[] = <<<PHP
\$this->{$attribute1} = \${$attribute1};
PHP;
        }

        return implode(PHP_EOL, $constructorAttributes);
    }

    private function generateDockBlocks (string ... $docBlocks): string {
        $docBlockStatements = implode(PHP_EOL . ' * ', $docBlocks);

        return <<<DOCBLOCK
/**
 * {$docBlockStatements}
 */
DOCBLOCK;
    }

    private function generateCommands ($moduleSpecification): string {
        $commands = [];

        foreach ($moduleSpecification['commands'] as $commandClassName => $commandSpecification)
        {
            $command = $this->generateCommand($commandClassName, $commandSpecification);
            $commands[] = $command;
        }

        return implode(PHP_EOL, $commands);
    }

    private function generateCommand (string $commandClassName, array $commandSpecification): string {
        return <<<PHP
{$this->generateMessageDocBlock($commandSpecification)}
final class {$commandClassName} implements \Acme\Infra\EventSourcing\Command {
{$this->generateMessageConstructor($commandSpecification)}
{$this->generateMessageAttributes($commandSpecification)}
{$this->generateRawMessagePayload($commandSpecification)}
}
PHP;
    }

    private function generateMessageDocBlock (array $messageSpecification): string {
        $docBlocks = [];

        if (array_key_exists('doc', $messageSpecification))
        {
            $docBlocks[] = $messageSpecification['doc'];
            $docBlocks[] = '';
        }

        $docBlocks[] = '@api';
        $docBlocks[] = '@category generated';

        return $this->generateDockBlocks(... $docBlocks);
    }
}
