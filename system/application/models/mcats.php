<?php
/**
 * Created by PhpStorm.
 * User: haho
 * Date: 10/15/2014
 * Time: 1:57 PM
 */
class MCats extends CI_Model{
    function __construct(){
        parent::__construct();

    }

    function getCategory($id){
        $data = array();
        $options = array('id' =>$id);
        $this->db->where('id',$options['id']);
        $Q = $this->db->get('categories');
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }

        $Q->free_result();
        return $data;
    }
    function getAllCategories(){
        $data = array();
        $this->db->where('status','active');
        $Q = $this->db->get('categories');
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
     function getCategoriesNav(){
     $data = array();
     $this->db->select('id,name,parentid');
     $this->db->where('status', 'active');
         $this->db->order_by('parentid','asc');
         $this->db->order_by('name','asc');
         $this->db->group_by('parentid,id');
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result() as $row){
            if ($row->parentid > 0){
                $data[0][$row->parentid]['children'][$row->id] = $row->name;
            
            }else{
                $data[0][$row->id]['name'] = $row->name;
            }
        }
    }
    $Q->free_result(); 
    return $data; 
 }

    function getSubCategories($catid){
        $data = array();
        $this->db->select('id,name,shortdesc');
        $this->db->where('parentid',$catid);
        $this->db->order_by('name','asc');
        $this->db->where('status','active');
        $Q1 = $this->db->get('categories');
        if($Q1->num_rows>0){
            foreach ($Q1->result_array() as $row){
                $Q2 = $this->db->query("select thumbnail from products where category_id = ".$row['id']." limit 1");
                if($Q2->num_rows>0){
                    $thumb = $Q2->row_array();
                    $THUMB = $thumb['thumbnail'];
                }
                else
                    $THUMB = '';
                $data[] = array(
                    'id'=> $row['id'],
                    'name'=>$row['name'],
                    'shortdesc'=>$row['shortdesc'],
                    'thumbnail'=> $THUMB
                );
            }
        }
        $Q1->free_result();
        return $data;
    }
    function getProductsByCategory($catid){
        $data = array();
        $this->db->where('category_id',$catid);
        $this->db->where('statuc','active');
        $this->db->order_by('name','asc');
        $Q1=$this->db->get('products');
        if($Q1->num_rows>0){
            foreach($Q1->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q1->free_result();
        return $data;
    }
    function getTopCategories(){
        $data = array();
        $data[0] = 'root';
        $this->db->where('parentid',0);
        $Q = $this->db->get('categories');
        if($Q->num_rows>0){
            foreach ($Q->result_array() as $row){
                $data[$row['id']] = $row['name'];
            }
        }
        $Q->free_result();
        return $data;
    }
    function getCategoriesDropdown(){
        $data = array();
        $this->db->where('parentid',0);
        $Q = $this->db->get('categories');
        if($Q->num_rows>0){
            foreach ($Q->result_array() as $row){
                $data[$row['id']] = $row['name'];
            }
        }
        $Q->free_result();
        return $data;
    }
    function addCategory(){
        $data = array(
            'id' => $_POST['id'],
            'name' =>$_POST['name'],
            'shortdesc' =>$_POST['shortdesc'],
            'longdesc' =>$_POST['longdesc'],
            'status' =>$_POST['status'],
            'parentid' =>$_POST['parentid']
        );
        $this->db->insert('categories',$data);
    }
    function updateCategory($id){
        $data = array(
            'name' =>$_POST['name'],
            'shortdesc' =>$_POST['shortdesc'],
            'longdesc' =>$_POST['longdesc'],
            'status' =>$_POST['status'],
            'parentid' =>$_POST['parentid']
        );
        $this->db->where('id',$id);
        $this->db->update('categories',$data);
    }

    function deleteCategory($id)
    {
        $data = array(
            'status' => 'inactive'
        );
        $this->db->where('id', $id);
        $this->db->update('categories', $data);
    }
    function exportCSV(){
        $this->load->dbutil();
        $Q = $this->db->query('select * from categories');
        return $this->dbutil->csv_from_result($Q,",","\n");
    }
    function checkOrphans($id){
        $data = array();
        $this->db->where('category_id',$id);
        $Q = $this->db->get('products');
        if($Q->num_rows()>0){
            foreach($Q->result_array() as $row){
                $data[$row['id']] = $row['name'];
            }
        }
        $Q->free_result();
        return $data;
    }
}