<?php
/**
 * Created by PhpStorm.
 * User: haho
 * Date: 10/24/14
 * Time: 2:00 PM
 */
class MSizes extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getSize($id){
        $data = array();
        $this->db->where('id',$id);
        $Q = $this->db->get('sizes');
        if($Q->num_rows()>0){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }
    function getAllSizes(){
        $data = array();
        $Q = $this->db->get('sizes');
        if($Q->num_rows() >0){
            foreach($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    function createSize(){
        $data = array(
            'name' => $_POST['name'],
            'status' => $_POST['status']
        );
        $this->db->insert('sizes',$data);
    }
    function updateSize($id){
        $data = array(
            'name' =>$_POST['name'],
            'status' => $_POST['status']
        );
        $this->db->where('id',$id);
        $this->db->update('sizes',$data);
    }
    function deleteSize($id){
        $data = array(
            'status' => 'inactive'
        );
        $this->db->where('id',$id);
        $this->db->update('sizes',$data);
    }
    function getActiveSizes(){
        $data =array();
        $this->db->where('status','active');
        $this->db->select('id,name');
        $Q  = $this->db->get('sizes');
        if($Q->num_rows()>0){
            foreach($Q->result_array() as $row){
                $data[$row['id']] = $row['name'];
            }
        }
        $Q->free_result();
        return $data;
    }
}