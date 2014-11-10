<?php
/**
 * Created by PhpStorm.
 * User: haho
 * Date: 10/25/14
 * Time: 1:43 PM
 */
class MPages extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getPage($id){
        $data = array();
        $this->db->where('id',$id);
        $Q= $this->db->get('pages');
        if($Q->num_rows()>0){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }
    function getPathPage($path){
        $data = array();
        $this->db->where('path',$path);
        $Q = $this->db->get('pages');
        if($Q->num_rows()>0){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;

    }
    function getAllPages(){
        $data = array();
        $this->db->where('status','active');
        $Q = $this->db->get('pages');
        if($Q->num_rows()>0){
            foreach($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    function addPage(){
        $data = array(
            'name' => $_POST['name'],
            'keywords' => $_POST['keywords'],
            'description' => $_POST['description'],
            'path' =>$_POST['path'],
            'content' => $_POST['content'],
            'status' => $_POST['status']
        );
        $this->db->insert('pages',$data);
    }
    function updatePage($id){
        $data = array(
            'name' => $_POST['name'],
            'keywords' => $_POST['keywords'],
            'description' => $_POST['description'],
            'path' =>$_POST['path'],
            'content' => $_POST['content'],
            'status' => $_POST['status']
        );
        $this->db->where('id',$id);
        $this->db->update('pages',$data);
    }
    function deletePage($id){
        $data = array(
            'status' => 'inactive'
        );
        $this->db->where('id',$id);
        $this->db->update('pages',$data);
    }

}