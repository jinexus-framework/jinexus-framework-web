# JiNexus Framework Website

The official documentation and developer guide for the **JiNexus Framework** — a modular,
lightweight, and easy-to-use PHP MVC framework. This site provides tutorials, API
references, and a changelog to help developers build and manage applications.

- **Website:** https://framework.jinexus.com
- **Issues:** https://github.com/jinexus-framework/jinexus-framework-web/issues

## Requirements

- PHP `^8.5`
- Composer
- A web server (Apache, Nginx, or the built-in PHP server)

## Quick start

```bash
# Clone and install dependencies
git clone https://github.com/jinexus-framework/jinexus-framework-web.git
cd jinexus-framework-web
composer install

# Start the development server
composer serve
# → http://localhost:8000
```

## Serving in production

Point your web server's document root to the `public/` directory. The `index.php`
front controller handles all requests through the framework's MVC dispatch pipeline.

Example Nginx configuration:

```nginx
root /path/to/jinexus-framework-web/public;
index index.php;

location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    include fastcgi_params;
    fastcgi_pass unix:/var/run/php/php8.5-fpm.sock;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
}
```

## Pages

| Route | Page |
|---|---|
| `/` | Home — project introduction |
| `/about/author` | About the author |
| `/about/conduct` | Code of conduct |
| `/about/credits` | Credits and inspirations |
| `/about/license` | BSD-3-Clause license |
| `/changelog` | Framework changelog |
| `/documentation/getting-started/introduction` | Getting started guide |
| `/documentation/getting-started/installation` | Installation instructions |
| `/documentation/walkthrough/*` | Walkthrough series (introduction, module-manager, controller, route, http, view, config) |

## Testing

```bash
composer test                    # run the full suite
composer test:testdox            # readable, per-test output
composer test:coverage           # text coverage report (requires Xdebug)
XDEBUG_MODE=off ./vendor/bin/phpunit --filter indexAction
```

The suite runs at **100 % line, method, and class coverage**. See
[AGENTS.md](AGENTS.md) for detailed build, style, and workflow conventions.

## Project structure

```
public/                           Web server entry point
module/Application/
  src/                            Application controllers and configuration
  src/Controller/                 MVC controllers (Index, About, Changelog, Documentation)
  src/config/module.config.php    Route definitions and view manager settings
  src/view/                       PHTML layout and page templates
test/                             PHPUnit test suite
```

The site is built *on* the JiNexus Framework — every page is rendered by a controller
that extends `JiNexus\Mvc\Controller\AbstractController` and returns a `ViewModel`.
Dependencies are installed via Composer and include `jinexus-framework/jinexus-mvc`,
`jinexus-framework/jinexus-route`, and `jinexus-framework/jinexus-http`.

## Extending

To add a new page:

1. Create a controller in `module/Application/src/Controller/` extending
   `AbstractController`.
2. Add the route to `module/Application/config/module.config.php`.
3. Create a view template in `module/Application/view/`.
4. Write a PHPUnit test in `test/Application/Controller/`.
5. Run the test suite and confirm 100 % coverage.

## Contributing

Please see [CONDUCT.md](CONDUCT.md) for the code of conduct. Contributions should include
tests and a `CHANGELOG.md` entry. See [AGENTS.md](AGENTS.md) for detailed build, style,
and workflow conventions.

## License

BSD-3-Clause. See [LICENSE.md](LICENSE.md).
