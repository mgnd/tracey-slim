<?php

namespace Wellrad\Tracy;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TracyMiddleware
 *
 * @project slim
 * @author Martin Damken <md@zeichenkombinat.de>
 */
class TracyMiddleware
{

    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
        require __DIR__ . '/shortcuts.php';
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {
        \Tracy\Debugger::enable();
        \Tracy\Debugger::getBar()->addPanel(new Panels\RequestPanel($this->container));
        \Tracy\Debugger::getBar()->addPanel(new Panels\RoutingPanel($this->container, $request));
        return $next($request, $response);
    }

}
