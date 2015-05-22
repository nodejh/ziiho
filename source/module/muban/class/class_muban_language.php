<?php
if(!defined ('IN_GESHAI')){
    exit('no derict class allowed');
}

class class_muban_language extends geshai_model {
    public $t_muban_language = 'muban_language';
    function __construct() {
        parent::__construct();
    }

    function class_muban_language() {
        $this->__construct();
    }

    //查询一条记录
    function find($k, $v = null) {
        $this->db->from($this->t_muban_language);
        $this->db->where($k, $v);
        $this->db->select();
        return $this->db->get_one();
    }

}

?>