<?php

declare(strict_types=1);

namespace Application\Test;

use Application\Module;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Module::class)]
final class ModuleTest extends TestCase
{
    #[Test]
    public function it_has_a_version_constant(): void
    {
        self::assertNotEmpty(Module::VERSION);
    }

    #[Test]
    public function get_config_returns_an_array(): void
    {
        $module = new Module();

        self::assertIsArray($module->getConfig());
    }

    #[Test]
    public function get_config_contains_routes(): void
    {
        $module = new Module();
        $config = $module->getConfig();

        self::assertArrayHasKey('routes', $config);
    }

    #[Test]
    public function get_config_contains_view_manager(): void
    {
        $module = new Module();
        $config = $module->getConfig();

        self::assertArrayHasKey('view_manager', $config);
    }

    #[Test]
    public function get_config_contains_application_home_route(): void
    {
        $module = new Module();
        $config = $module->getConfig();

        self::assertArrayHasKey('application.home', $config['routes']);
    }

    #[Test]
    public function get_config_view_manager_has_template_map(): void
    {
        $module = new Module();
        $config = $module->getConfig();

        self::assertArrayHasKey('template_map', $config['view_manager']);
    }

    #[Test]
    public function get_config_view_manager_has_template_path_stack(): void
    {
        $module = new Module();
        $config = $module->getConfig();

        self::assertArrayHasKey('template_path_stack', $config['view_manager']);
    }
}
