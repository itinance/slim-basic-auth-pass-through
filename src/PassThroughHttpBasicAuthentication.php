<?php

namespace itinance\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Http\Request;
use Tuupola\Middleware\DoublePassTrait;
use Tuupola\Middleware\HttpBasicAuthentication;

final class PassThroughHttpBasicAuthentication implements MiddlewareInterface
{
    use DoublePassTrait;

    /**
     * @var HttpBasicAuthentication
     */
    private $authenticator;

    /**
     * PassThroughHttpBasicAuthentication constructor.
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $options['authenticator'] = new PassThroughAuthenticator();
        $options['before'] = function (Request $request, $arguments) {
            return $request->withAttributes(
                ["user" => $arguments["user"], "password" => $arguments["password"]
                ]);
        };

        $this->authenticator = new HttpBasicAuthentication($options);
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $this->authenticator->process($request, $handler);
    }
}