<?php
if(!defined ('IN_GESHAI')){
    exit('no derict class allowed');
}

class class_muban_muban extends geshai_model {
    public $t_muban_muban = 'muban_muban';
    function __construct() {
        parent::__construct();
    }

    function class_muban_muban() {
        $this->__construct();
    }

    //查询一条记录
    function find($k, $v = null) {
        $this->db->from($this->t_muban_muban);
        $this->db->where($k, $v);
        $this->db->select();
        return $this->db->get_one();
    }

    //返回资源
    function finds($k, $v, $symbol, $order = null) {
        $this->db->from($this->t_muban_muban);
        $this->db->where($k, $v, $symbol);
        if(!empty($order)){
            $this->db->order_by ( $order );
        }
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

    //更新数据
    function update($set_k, $set_v, $where_k, $where_v) {
        $this->db->from($this->t_muban_muban);
        $this->db->set($set_k, $set_v);
        $this->db->where($where_k, $where_v);
        $result = $this->db->update();
        return $result;
    }

}

?>