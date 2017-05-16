<?php

namespace Budgegeria\Bundle\IntlFormatBundle\Tests\DependencyInjection;

use Budgegeria\Bundle\IntlFormatBundle\DependencyInjection\Compiler\FormatterPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class FormatterPassTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildMissingSprintfService()
    {
        $container = $this->createMock(ContainerBuilder::class);
        $container->expects($this->once())
            ->method('has')
            ->with('intl_format.sprintf')
            ->willReturn(false);

        (new FormatterPass())->process($container);
    }

    public function testBuildNoTagsAvailable()
    {
        $definition = new Definition();
        $container = $this->createMock(ContainerBuilder::class);
        $container->expects($this->once())
            ->method('has')
            ->with('intl_format.sprintf')
            ->willReturn(true);
        $container->expects($this->once())
            ->method('findDefinition')
            ->with('intl_format.sprintf')
            ->willReturn($definition);
        $container->expects($this->once())
            ->method('findTaggedServiceIds')
            ->with('intl_format.formatter')
            ->willReturn([]);

        (new FormatterPass())->process($container);

        self::assertCount(0, $definition->getMethodCalls());
    }

    public function testBuild()
    {
        $definition = new Definition();
        $container = $this->createMock(ContainerBuilder::class);
        $container->expects($this->once())
            ->method('has')
            ->with('intl_format.sprintf')
            ->willReturn(true);
        $container->expects($this->once())
            ->method('findDefinition')
            ->with('intl_format.sprintf')
            ->willReturn($definition);
        $container->expects($this->once())
            ->method('findTaggedServiceIds')
            ->with('intl_format.formatter')
            ->willReturn(['myformatter' => []]);

        (new FormatterPass())->process($container);

        $calls = $definition->getMethodCalls();

        self::assertCount(1, $calls);
        self::assertSame('addFormatter', $calls[0][0]);
        self::assertInstanceOf(Reference::class, $calls[0][1][0]);
        self::assertSame('myformatter', (string) $calls[0][1][0]);
    }
}
