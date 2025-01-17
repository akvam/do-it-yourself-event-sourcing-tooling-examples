<?php declare(strict_types=1);

namespace Acme\Infra\EventSourcing\Testing;

use Acme\Infra\Testing\ScenarioTestRunner;
use Acme\Infra\Testing\TestScenario;
use PHPUnit\Framework\TestCase;

/**
 * @copyright Marijn Huizendveld 2018. All rights reserved.
 */
abstract class EventSourcedCommandHandlerTestCase extends TestCase implements ScenarioTestRunner {

    /** @var \Acme\Infra\EventSourcing\Testing\EventSourcedCommandHandlerScenario */
    protected $scenario;

    protected function setUp () {
        parent::setUp();

        $this->scenario = new EventSourcedCommandHandlerScenario(
            // TODO inject required services
        );
    }

    protected function assertPreConditions () {
        parent::assertPreConditions();

        assertThat($this->scenario, isInstanceOf(TestScenario::class));
    }

    function scenario (): TestScenario { return $this->scenario; }
}
