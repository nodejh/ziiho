<?php
if(!defined ('IN_GESHAI')){
    exit('no derict class allowed');
}

class class_muban_html extends geshai_model {
    public $t_muban_html = 'muban_html';
    function __construct() {
        parent::__construct();
    }

    function class_muban_html() {
        $this->__construct();
    }

    //查询一条记录
    function find($k, $v = null) {
        $this->db->from($this->t_muban_html);
        $this->db->where($k, $v);
        $this->db->select();
        return $this->db->get_one();
    }

    //查询多条记录
    function finds($k, $v, $symbol) {
        $this->db->from($this->t_muban_html);
        $this->db->where($k, $v, $symbol);
        $this->db->select();
        return $this->db->get_list();
    }

}

?>