<?php

namespace Wellrad\Tracy\Panels;

// use Wellrad\Application\Application;

class ViewPanel implements \Tracy\IBarPanel
{

    protected $router = NULL;
    protected $route;

    public function __construct()
    {
        parent::__construct();
        $this->router = app()->getRouter();
        $this->route  = $this->router->getCurrentRoute(app()->getRequest());
        #   $this->view = Application::getInstance()->view;
    }

    public function getTab()
    {
        return 'Template (View)';
        //     return str_replace(realpath(__DIR__), '',$this->view->getPath()); Appli
    }

    public function getPanel()
    {
        $shortenPath = function($path) {
            return str_replace(
                    DIRECTORY_SEPARATOR, '/', str_replace(
                            realpath(__DIR__ . '/../../../../'), '', $path));
        };


        ob_start();

        dump($this->route->getController());
        //     include __DIR__ . '/templates/viewpanel.index.html';
        return ob_get_clean();
    }

}
