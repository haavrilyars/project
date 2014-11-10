<?php
/**
 * Created by PhpStorm.
 * User: haho
 * Date: 10/24/14
 * Time: 1:59 PM
 */
class MColors extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getColor($id){
        $data = array();
        $this->db->where('id',$id);
        $Q = $this->db->get('colors');
        if($Q->num_rows()>0){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }
    function getAllColors(){
        $data = array();
        $Q = $this->db->get('colors');
        if($Q->num_rows() >0){
            foreach($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    function createColor(){
        $data = array(
            'name' => $_POST['name'],
            'status' => $_POST['status']
        );
        $this->db->insert('colors',$data);
    }
    function updateColor($id){
        $data = array(
            'name' =>$_POST['name'],
        'status' => $_POST['status']
        );
        $this->db->where('id',$id);
        $this->db->update('colors',$data);
    }
    function deleteCOlor($id){
        $data = array(
            'status' => 'inactive'
        );
        $this->db->where('id',$id);
        $this->db->update('colors',$data);
    }
    function getActiveColors(){
        $data =array();
        $this->db->where('status','active');
        $this->db->select('id,name');
        $Q  = $this->db->get('colors');
        if($Q->num_rows()>0){
            foreach($Q->result_array() as $row){
                $data[$row['id']] = $row['name'];
            }
        }
        $Q->free_result();
        return $data;
    }
}