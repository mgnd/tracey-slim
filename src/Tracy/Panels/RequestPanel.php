<?php

namespace Wellrad\Tracy\Panels;

class RequestPanel extends \Wellrad\Controller implements \Tracy\IBarPanel
{

    protected $request;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->request = $container->request;
    }

    public function getTab()
    {
        return 'Request';
    }

    public function getPanel()
    {
        ob_start();
        include __DIR__ . '/../templates/requestpanel.index.html';
        return ob_get_clean();
    }

}
