<?php

namespace Wellrad\Tracy\Panels;

// use Wellrad\Application\Application;

class RoutingPanel implements \Tracy\IBarPanel
{

    protected $router  = NULL;
    protected $request = NULL;
    protected $currentRoute = NULL;

    public function __construct($container, $request)
    {
        $this->router  = $container->router;
        $this->request = $request;
    }

    public function getTab()
    {
        $route = $this->request->getAttribute('route');
        if (!$route)
        {
            $message = "No matching route for " . $this->request->getUri()->getPath();
        } else
        {
            
            $callable = $route->getCallable();
            if (is_string($callable))
            {
                $message = $callable;
            } elseif (is_array($callable))
            {
                $object  = $callable[0];
                $action  = $callable[1];
                $message = get_class($object) . ':' . $action;
            } else
            {
                $info    = new \ReflectionFunction($callable);
                $message = $info->getName();
            }
        }

        ob_start();
        include __DIR__ . '/../templates/routingtab.phtml';
        return ob_get_clean();
      //  return '<span class="icon-forward"></span>Route: ' . $strInfo;
    }

    public function getPanel()
    {
        $router  = $this->router;
        $request = $this->request;

        ob_start();
        include __DIR__ . '/../templates/routingpanel.index.html';
        return ob_get_clean();
    }

}
