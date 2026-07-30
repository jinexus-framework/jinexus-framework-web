<?php

declare(strict_types=1);

namespace Application\Test\Fixture;

use JiNexus\Route\Redirect\AbstractRedirect;

final class RedirectDouble extends AbstractRedirect
{
    public bool $headersAlreadySent = false;

    public array $sentHeaders = [];

    public int $terminateCount = 0;

    protected function headersSent(): bool
    {
        return $this->headersAlreadySent || parent::headersSent();
    }

    protected function sendHeader(string $header, bool $replace, int $statusCode): void
    {
        $this->sentHeaders[] = [
            'header' => $header,
            'replace' => $replace,
            'statusCode' => $statusCode,
        ];

        parent::sendHeader($header, $replace, $statusCode);
    }

    protected function terminate(): void
    {
        $this->terminateCount++;
    }
}
