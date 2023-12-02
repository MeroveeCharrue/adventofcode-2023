<?php

declare(strict_types=1);

namespace Advent2023\Tests;

use Advent2023\SantaCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class SantaTest extends TestCase
{
    public function testSantaKnowsStuff(): void
    {
        $command = new SantaCommand();
        $command->setAutoExit(false);
        $commandTester = new CommandTester($command);

        $commandTester->execute([]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Hello there.', $output);
    }
}
