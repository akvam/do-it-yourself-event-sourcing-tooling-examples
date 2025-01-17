<?php declare(strict_types=1);

namespace Acme\Infra\Testing;

use Acme\Infra\Testing\ScenarioVisualization\VisualScenario;

/**
 * @copyright Marijn Huizendveld 2018. All rights reserved.
 */
interface TestScenario {
    /** @throws \PHPUnit\Framework\AssertionFailedError */
    function assert(): void;

    function visualScenario(): VisualScenario;
}
