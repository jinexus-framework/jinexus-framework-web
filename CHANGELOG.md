# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## v1.1.0 - 2026-07-30

### Added

- `AboutController` with five actions: `indexAction` (redirect), `authorAction`, `conductAction`, `creditsAction`, and `licenseAction`.
- `ChangelogController::indexAction` rendering the framework changelog page.
- `DocumentationController` with twelve actions: `indexAction`, `gettingStartedAction`, `walkthroughAction` (all redirects), plus `gettingStartedIntroductionAction`, `gettingStartedInstallationAction`, `walkthroughIntroductionAction`, `walkthroughModuleManagerAction`, `walkthroughControllerAction`, `walkthroughRouteAction`, `walkthroughHttpAction`, `walkthroughViewAction`, and `walkthroughConfigAction`.
- Route definitions for all documentation and about pages in `module.config.php`.
- View templates (`layout.phtml`, `header.phtml`, `footer.phtml`, `404.phtml`) and PHTML page templates for every controller action.
- PHPUnit 13 unit-test suite covers all four controllers at 100 % line, method, and class coverage.
- `ApplicationDouble`, `ViewDouble`, and `RedirectDouble` test fixtures for controller and redirect testing.
- `composer serve` script to start the built-in PHP web server.
- `composer test:coverage` and `composer test:testdox` scripts.
- `AGENTS.md` with build, coding-standard, architecture, and workflow guidance.
- Expanded `README.md` with installation, production deployment, page listing, and extending sections.

### Changed

- Raised the minimum PHP requirement to `^8.5`; the application depends on the 1.1 releases of the framework libraries which use PHP property hooks and the pipe operator.
- IndexController now uses `$request->baseUrl()` for OG meta-URLs instead of a hardcoded value.
- Branch alias updated to `dev-main: 1.1.x-dev`.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v1.0.0 - 2018-07-10

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.
