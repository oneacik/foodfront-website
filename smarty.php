<?php
require('Smarty/Smarty.class.php');
class SSmarty {

    static $smarty=NULL;
    
    /**
     * 
     * @return Smarty
     */
    static function returnSmarty() {
        if(self::$smarty!=NULL){return self::$smarty;}
        
        $smarty = new Smarty();
        

        $smarty->setTemplateDir('templates');
        $smarty->setCompileDir('templates_c');
        $smarty->setCacheDir('cache');
        $smarty->setConfigDir('configs');
        $smarty->caching = 0;
        $smarty->compile_check = true;


        self::$smarty=$smarty;
        return $smarty;
    }

}
