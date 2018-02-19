<?php

namespace ACore;

class Opts {
    
    private static $instance=null;
    
    public $acore_plg_name="AzerothCore WP Integration";
    public $acore_org_name="ACore";
    public $acore_org_alias="acore";
    public $acore_page_alias="wp-acore";
    public $acore_soap_host="";
    public $acore_soap_user="";
    public $acore_soap_pass="";
    public $acore_db_chars_host="";
    public $acore_db_chars_user="";
    public $acore_db_chars_pass="";
    public $acore_db_chars_name="";
    public $acore_db_auth_host="";
    public $acore_db_auth_user="";
    public $acore_db_auth_pass="";
    public $acore_db_auth_name="";
    public $acore_db_world_host="";
    public $acore_db_world_user="";
    public $acore_db_world_pass="";
    public $acore_db_world_name="";
    
    public function loadFromArray($confs) {
        foreach ($confs as $conf => $value) {
            $this->$conf=$value; // variables variable ( created dynamically if not exists )
        }
    }
    
    public function loadFromDb() {
        $confs=get_object_vars($this);
        foreach ($confs as $conf => $value) {
            $this->$conf=get_option($conf, $value); // variables variable ( created dynamically if not exists )
        }
    }
    
    private function __construct() {
        $this->loadFromDb();
    }
    
    /**
     * Singleton
     * @return Opts
     */
    public static function I() {
        if (!self::$instance) {
            self::$instance=new self();
        }
        
        return self::$instance;
    }
    
    public function getConfs() {
        return get_object_vars();
    }
}

/**
 * @return Opts
 */
function sOpts() {
    return Opts::I();
}

function sOptsConfNames() {
    return get_object_vars(sOpts());
}