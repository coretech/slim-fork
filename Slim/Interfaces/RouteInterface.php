<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/3.x/LICENSE.md (MIT License)
 */

namespace Slim\Interfaces;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface RouteInterface
{
    /**
     * Retrieve a specific route argument
     *
     * @param string      $name
     * @param string|null $default
     *
     * @return string|null
     */
    #[\ReturnTypeWillChange]
    public function getArgument($name, $default = null);

    /**
     * Get route arguments
     *
     * @return string[]
     */
    #[\ReturnTypeWillChange]
    public function getArguments();

    /**
     * Get route name
     *
     * @return null|string
     */
    #[\ReturnTypeWillChange]
    public function getName();

    /**
     * Get route pattern
     *
     * @return string
     */
    #[\ReturnTypeWillChange]
    public function getPattern();

    /**
     * Set a route argument
     *
     * @param string $name
     * @param string $value
     *
     * @return RouteInterface
     */
    #[\ReturnTypeWillChange]
    public function setArgument($name, $value);

    /**
     * Replace route arguments
     *
     * @param string[] $arguments
     *
     * @return RouteInterface
     */
    #[\ReturnTypeWillChange]
    public function setArguments(array $arguments);

    /**
     * Set output buffering mode
     *
     * One of: false, 'prepend' or 'append'
     *
     * @param boolean|string $mode
     *
     * @throws InvalidArgumentException If an unknown buffering mode is specified
     */
    #[\ReturnTypeWillChange]
    public function setOutputBuffering($mode);

    /**
     * Set route name
     *
     * @param string $name
     *
     * @return RouteInterface
     *
     * @throws InvalidArgumentException if the route name is not a string
     */
    #[\ReturnTypeWillChange]
    public function setName($name);

    /**
     * Add middleware
     *
     * This method prepends new middleware to the route's middleware stack.
     *
     * @param callable|string $callable The callback routine
     *
     * @return RouteInterface
     */
    #[\ReturnTypeWillChange]
    public function add($callable);

    /**
     * Prepare the route for use
     *
     * @param ServerRequestInterface $request
     * @param array                  $arguments
     */
    #[\ReturnTypeWillChange]
    public function prepare(ServerRequestInterface $request, array $arguments);

    /**
     * Run route
     *
     * This method traverses the middleware stack, including the route's callable
     * and captures the resultant HTTP response object. It then sends the response
     * back to the Application.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     *
     * @return ResponseInterface
     */
    #[\ReturnTypeWillChange]
    public function run(ServerRequestInterface $request, ResponseInterface $response);

    /**
     * Dispatch route callable against current Request and Response objects
     *
     * This method invokes the route object's callable. If middleware is
     * registered for the route, each callable middleware is invoked in
     * the order specified.
     *
     * @param ServerRequestInterface $request  The current Request object
     * @param ResponseInterface      $response The current Response object
     *
     * @return ResponseInterface
     */
    #[\ReturnTypeWillChange]
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response);
}
