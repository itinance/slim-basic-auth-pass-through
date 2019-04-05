<?php

namespace itinance\Middleware;

use Tuupola\Middleware\HttpBasicAuthentication\AuthenticatorInterface;

final class PassThroughAuthenticator implements AuthenticatorInterface
{
    /**
     * @param array $arguments
     * @return bool
     */
    public function __invoke(array $arguments): bool
    {
        return true; // pass through everything
    }
}