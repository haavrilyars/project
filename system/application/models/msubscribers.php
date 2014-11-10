<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 11/5/14
 * Time: 8:16 AM
 */
class MSubscribers extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    function createSubscriber(){
        $data = array(
            'name' => $_POST['name'],
            'email' => $_POST['email']
        );
        $this->db->insert('subscribers',$data);
    }
    function removeSubscriber($id){
        $this->db->where('id',$id);
        $this->db->delete('subscribers');
    }
    function getAllSubscribers(){
        $data = array();
        $Q = $this->db->get('subscribers');
        if($Q->num_rows() >0){
            foreach($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
}