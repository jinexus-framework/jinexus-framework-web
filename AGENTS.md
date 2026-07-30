# AGENTS.md

Guidance for AI coding agents (and humans) working on the
`jinexus-framework/jinexus-framework-web` project. Read this before making changes.

## What this project is

The official JiNexus Framework documentation and developer guide, served as a PHP web
application. It provides tutorials, API references, and a changelog for developers building
applications with the JiNexus Framework. The site is built on the framework itself — every
page is rendered by an MVC controller that returns a `ViewModel`.

Unlike the sibling library packages (`jinexus-http`, `jinexus-route`, `jinexus-mvc`), this
is a **project** (type `project`), not a reusable library. It depends on the framework
libraries and adds its own application-specific controllers, views, and configuration.

## Build & test commands

Run everything from the project root (the directory containing `composer.json`).

```bash
# Install dependencies
composer install

# Regenerate autoloader after adding/moving/renaming classes or namespaces
composer dump-autoload

# Start the built-in PHP web server for development
composer serve                              # php -S localhost:8000 -t public

# Run the full test suite (auto-discovers phpunit.dist.xml)
./vendor/bin/phpunit

# Equivalent via Composer scripts
composer test
composer test:coverage        # sets XDEBUG_MODE=coverage and prints a text report
composer test:testdox         # readable, per-test output

# Silence the local Xdebug "could not connect" notice
XDEBUG_MODE=off ./vendor/bin/phpunit

# Run a single test file / a single test by name (regex)
XDEBUG_MODE=off ./vendor/bin/phpunit test/Application/Controller/IndexControllerTest.php
XDEBUG_MODE=off ./vendor/bin/phpunit --filter index_action_redirects_to_author
```

There is no build step — this is a PHP web application served directly by the built-in
server or a production web server pointed at `public/`.

The suite is currently **41 tests / 81 assertions** at **100 % line, method, and class
coverage**. Treat a coverage regression as a failure, not a detail.

## Project architecture

```
public/                             Web server entry point (index.php)
module/Application/
  src/                              Namespace: Application\
    Controller/
      IndexController.php           Home page (indexAction returns ViewModel)
      AboutController.php           About pages: author, conduct, credits, license
      ChangelogController.php       Changelog page
      DocumentationController.php   Documentation: getting-started, walkthrough
    Model/                          (future — domain models)
    config/
      module.config.php             Route definitions + view_manager configuration
    view/
      layout/
        layout.phtml                Master layout template
        header.phtml                Shared header partial
        footer.phtml                Shared footer partial
      error/
        404.phtml                   404 error page
  Module.php                        Module bootstrap (VERSION constant, getConfig)
test/                               Namespace: Application\Test\
  Application/
    Controller/
      IndexControllerTest.php       Tests for IndexController
      AboutControllerTest.php       Tests for AboutController
      ChangelogControllerTest.php   Tests for ChangelogController
      DocumentationControllerTest.php
                                    Tests for DocumentationController
    Fixture/
      ApplicationDouble.php         ApplicationInterface test double
      ViewDouble.php                View test double (extends View)
      RedirectDouble.php            Redirect test double (overrides terminate)
    ModuleTest.php                  Module bootstrap tests
```

### Route naming convention

Routes use dot-separated names that mirror the URL hierarchy:

| Route name | URI | Action |
|---|---|---|
| `application.home` | `/` | IndexController::indexAction |
| `application.about` | `/about` | AboutController::indexAction (redirect) |
| `application.about.author` | `/about/author` | AboutController::authorAction |
| `application.changelog` | `/changelog` | ChangelogController::indexAction |
| `application.documentation.getting-started.introduction` | `/documentation/getting-started/introduction` | DocumentationController::gettingStartedIntroductionAction |

All routes are registered in `module/Application/config/module.config.php`.

### Controller conventions

- Every controller extends `JiNexus\Mvc\Controller\AbstractController`.
- Actions that render a page return `ViewModel` with `title`, `meta` (with `og`), and
  optionally `mainSidebar`.
- Actions that redirect call `$this->redirect->toRoute(...)` and are declared `void`.
- The `$request` and `$view`/`$this->redirect` properties are set by
  `AbstractController::__construct(ApplicationInterface $app)`.

### Redirect test seam

Actions that redirect call `$this->redirect->toRoute()` which terminates with `exit()`.
Tests use `Fixture/RedirectDouble` (extends `AbstractRedirect`) to override `terminate()`
so the test process survives. The double also captures `sentHeaders` and `terminateCount`
for assertions. When writing a redirect-test, assign the redirect to a typed local variable
with a `@var RedirectDouble` PHPDoc annotation so the static analyser sees the right type:

```php
/** @var RedirectDouble $redirect */
$redirect = $this->app->route->redirect;
self::assertCount(1, $redirect->sentHeaders);
```

## Coding standards

- **Language:** PHP `^8.5`. Every PHP file starts with `declare(strict_types=1);`.
- **Autoloading:** PSR-4. `Application\` → `module/Application/src/`,
  `Application\Test\` → `test/Application/`. One class/interface per file; the file name
  matches the type name.
- **Naming:** controllers are suffixed `Controller` and live in
  `module/Application/src/Controller/`; test doubles are suffixed `Double` and live in
  `test/Application/Fixture/`. Namespaces mirror the directory layout.
- **Property hooks:** The framework libraries use PHP 8.4+ property hooks
  (`public RedirectInterface $redirect { get { … } }`). The concrete subclasses (`Route`,
  `Redirect`, `Request`, `Http`) are deliberately empty — do not declare real properties
  that could shadow a hook in the abstract parent.
- **Errors:** framework-level exceptions are thrown by the library packages. The web
  application catches them at the dispatch layer; controllers typically declare
  `@throws RouteException` in their docblock.
- **PHP 8.5 features are in use.** The framework libraries use the pipe operator `|>` and
  other 8.5-era constructs. Keep the `php: "^8.5"` constraint in mind.

### Test conventions

- Tests extend `PHPUnit\Framework\TestCase` and are declared `final`. No class-level
  docblocks (except for `@throws` on individual test methods).
- Use PHPUnit **attributes**, not annotations: `#[Test]`, `#[CoversClass(...)]`.
- `#[CoversClass]` targets the **concrete controller class** (e.g. `IndexController::class`).
- Test method names are `snake_case` and describe the behaviour.
- PHPUnit 13: use `expectExceptionMessageMatches()` (regex), **not**
  `expectExceptionMessage()`. Wrap literal text with `preg_quote($text, '/')`.
- **Do not assert types that the compiler guarantees.** `createController()` returns
  `IndexController`, so `assertInstanceOf(AbstractController::class, $controller)` is
  always true and must be omitted. Similarly, a method declared `: ViewModel` makes the
  `assertInstanceOf(ViewModel::class, $result)` redundant.
- **Prefer assertions that reflect a real runtime contract.** Assert on values (`assertSame`,
  `assertStringContainsString`, `assertCount`, `assertArrayHasKey`) rather than types.
- **`$_SERVER` must be snapshotted.** Every controller test snapshots `$_SERVER` in
  `setUp()` and restores it in `tearDown()`, because the framework libraries read it
  directly.
- **Commented code is dead code.** Do not leave commented-out assertions, unused variables,
  or `var_dump`/`print_r` calls. The CI suite runs with `failOnWarning="true"` and
  `beStrictAboutOutputDuringTests="true"` — any stray output or warning fails the build.

## Workflow rules

- **Before finishing any change, run the suite** and make sure it's green:
  `XDEBUG_MODE=off ./vendor/bin/phpunit`. Then check coverage is still 100 %:
  `composer test:coverage`.
- **After touching classes/namespaces**, run `composer dump-autoload`.
- **New controller actions require new tests.** Every public action method must be executed
  by at least one test. If an action is genuinely untestable (e.g. it calls `exit()`
  directly), isolate the terminating call behind a seam and test through a double.
- **Commands:** follow
  [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/). Format:
  `type(scope): description`, with an optional body and footers.
  - Common types: `feat`, `fix`, `docs`, `test`, `refactor`, `chore`, `build`, `ci`.
  - Scope is optional and names the affected area (e.g. `feat(about): …`).
  - Subject is imperative and lowercase, no trailing period.
  - Breaking changes: add `!` after the type/scope (`feat!:`) and a `BREAKING CHANGE:`
    footer describing the break and its migration.
- **Changelog:** update `CHANGELOG.md` for every user-visible change, following the Keep a
  Changelog structure already in the file (Added / Changed / Deprecated / Removed / Fixed).
  Newest release on top.
- **Versioning:** semantic versioning. When bumping the minor/major line, also update
  `extra.branch-alias.dev-main` in `composer.json` to match the next dev series.
- **Config files:** `phpunit.dist.xml` is the committed default; a local `phpunit.xml`
  (gitignored) overrides it for personal tweaks. Don't commit `phpunit.xml`, `vendor/`, or
  `.phpunit.cache/`.
