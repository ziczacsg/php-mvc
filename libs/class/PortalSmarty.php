<?php
require_once('vendor/smarty/smarty/libs/Smarty.class.php');

class PortalSmarty extends Smarty {
   
    function _construct(){
        $this->Smarty();
        $this->template_dir = 'view';
        // $this->cache_dir = 'view_t';
        $this->compile_dir = 'view_c';
        // $this->force_compile = $QConfig->smarty_force_compile;
        $this->use_sub_dirs = false;
    }
}
?>