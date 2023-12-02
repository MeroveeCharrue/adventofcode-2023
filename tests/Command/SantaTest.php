<?php

declare(strict_types=1);

namespace Advent2023\Tests\Command;

use Advent2023\Command\SantaCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class SantaTest extends TestCase
{
    public function testSantaKnowsStuff(): void
    {
        $command = new SantaCommand();
        $command->setAutoExit(false);
        $commandTester = new CommandTester($command);
        $commandTester->setInputs(['1']);

        $commandTester->execute([]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('This is Santa speaking.', $output);
        $this->assertStringContainsString('Solving the day!', $output);
    }
}
