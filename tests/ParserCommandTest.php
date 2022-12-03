<?php

namespace DevOmelchenkoTest\Gentree;

use DevOmelchenko\Gentree\Gentree;
use DevOmelchenko\Gentree\ParserCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

use function PHPUnit\Framework\assertEquals;

class ParserCommandTest extends TestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $app = new Application(Gentree::name(), Gentree::version());

        $command = new ParserCommand();

        $app->add($command);

        /** @var string $commandName */
        $commandName = $command->getName();
        $app->setDefaultCommand($commandName, true);
        $command = $app->find($commandName);

        $this->commandTester = new CommandTester($command);
    }

    public function testExecute(): void
    {
        $this->commandTester->execute([
            'inputFile' => $inputFile = 'test.csv',
            'outputFile' => $outputFile = 'test.json',
        ]);
        $this->commandTester->assertCommandIsSuccessful();

        $output = $this->commandTester->getDisplay();
        self::assertEquals(
            sprintf(
                <<<'EOF'
                Input empty
                %s
                EOF,
                realpath(__DIR__ . '/../src/' . $outputFile),
            ),
            $output
        );
    }
}
