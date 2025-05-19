<?php 

class Controller {

    private $ctrl_name;
    protected $template = "default";
    protected $vars = [];

    public function __construct() {
        if(method_exists($this, "__init")) {
            $this->__init();
        }

        $this->ctrl_name = str_replace("Controller", "", get_class($this));
        $this->loadModel($this->ctrl_name);
        
    }

    protected function render($view = "") {   
        if($view == "") {
            $view = debug_backtrace()[1]['function'];
        }

        ob_start();

        extract($this->vars);

        if(file_exists(VIEW.DS.$this->ctrl_name.DS.$view.".php")) {
            include_once(VIEW.DS.$this->ctrl_name.DS.$view.".php");
        } else {
            echo "Erreur 404 : La page n'existe pas";
        }

        $content_for_layout = ob_get_clean();

        if(file_exists(TEMPLATE.DS.$this->template.".php")) {
            include_once(TEMPLATE.DS.$this->template.".php");
        } else {
            echo "Erreur : Le template n'existe pas";
        }
    }

    protected function loadModel($model) {
        $model_name = $model."Model";
        
        if(file_exists(MODEL.DS.$model_name.".php")) {
            include_once(MODEL.DS.$model_name.".php");
        } else {
            echo "Erreur : Le modèle n'existe pas";
        }
        $this->$model = new $model_name();
    }

    protected function set($var) {
        $this->vars = array_merge($this->vars, $var);
    }

    public function add_css($css) {
        if(!empty($css) && is_array($css)) {
            foreach ($css as $c) {
                echo "<link rel=\"stylesheet\" href=\"/css/".$c.".css\">";
            }
        }
    }

    public function add_script($scripts) {
        if(!empty($scripts) && is_array($scripts)) {
            foreach ($scripts as $script) {
                echo "<script src=\"/js/".$script.".js\"></script>";
            }
        }
    }

}