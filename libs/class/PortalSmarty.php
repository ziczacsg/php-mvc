<?php
require_once('vendor/smarty/smarty/libs/Smarty.class.php');

class PortalSmarty extends Smarty {
   
    function __construct(){
        parent::__construct();

        // read the entire parsed .ini file
        $iniArray = parse_ini_file("appsetting.ini");
        // foreach($iniArray as $k=>$v)
        // {
        //     echo "$k => $v <br/>";
        // }

        // setting smarty
        $this->setTemplateDir($iniArray['template_dir'])
             ->setConfigDir($iniArray['cache_dir'])
             ->setCompileDir($iniArray['compile_dir'])
             ->setCacheDir($iniArray['cache_dir']);

        $this->clearAllCache($iniArray['clear_all_cache']);
        $this->setCaching($iniArray['caching']);
        $this->setForceCompile($iniArray['force_compile']);
        $this->setDebugging($iniArray['debugging']);
    }
}
?>