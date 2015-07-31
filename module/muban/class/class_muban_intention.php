<?php
if(!defined ('IN_GESHAI')){
    exit('no derict class allowed');
}

class class_muban_intention extends geshai_model {
    public $t_muban_intention = 'muban_intention';
    function __construct() {
        parent::__construct();
    }

    function class_muban_intention() {
        $this->__construct();
    }

    //查询一条记录
    function find($k, $v = null) {
        $this->db->from($this->t_muban_intention);
        $this->db->where($k, $v);
        $this->db->select();
        return $this->db->get_one();
    }

    //返回资源
    function finds($k, $v, $symbol) {
        $this->db->from($this->t_muban_intention);
        $this->db->where($k, $v, $symbol);
        $this->db->select();
        return $this->db->get_list();
    }

    //返回一个结果集
    function find_array($k, $v, $symbol) {
        $resource = $this->finds($k, $v, $symbol);
        $result = array();
        while($row = $this->db->fetch_row($resource)) {
            array_push($result, $row);
        }
        return $result;
    }

}

?>