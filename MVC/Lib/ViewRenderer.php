<?php

namespace Lib;

   
class ViewRenderer {
     /**
     * @var viewRenderer
     */
    private static $instance;
    
    private $viewDir;
    
    private $layoutPath;

    private function __construct() { }
    
    /**
     * @return viewRenderer
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)){
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    public function render($view, $parameters = []) 
    {
        extract($parameters);
        ob_start();
        include $this->viewDir . $view;
        $pageContentForLayout = ob_get_clean();
        
        include $this->layoutPath;
    }
    
    public function getViewDir() {
        return $this->viewDir;
    }

    public function getLayoutPath() {
        return $this->layoutPath;
    }

    public function setViewDir($viewDir) {
        $this->viewDir = $viewDir;
        return $this;
    }

    public function setLayoutPath($layoutPath) {
        $this->layoutPath = $layoutPath;
        return $this;
    }


}
