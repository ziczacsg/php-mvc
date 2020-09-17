<?php
require_once('vendor/smarty/smarty/libs/Smarty.class.php');

class PortalSmarty extends Smarty {
   
    function __construct(){
        parent::__construct();

        // read the entire parsed .ini file
        $ini_array = parse_ini_file("appsetting.ini");
        // foreach($ini_array as $k=>$v)
        // {
        //     echo "$k => $v <br/>";
        // }

        // setting smarty
        $this->setTemplateDir($ini_array['template_dir'])
             ->setConfigDir($ini_array['cache_dir'])
             ->setCompileDir($ini_array['compile_dir'])
             ->setCacheDir($ini_array['cache_dir']);

        $this->clearAllCache($ini_array['clear_all_cache']);
        $this->setCaching($ini_array['caching']);
        $this->setForceCompile($ini_array['force_compile']);
        $this->setDebugging($ini_array['debugging']);
    }
}
?>