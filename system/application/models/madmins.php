<?php
class MAdmins extends CI_Model{
	public function __construct(){
		parent :: __construct();
	}
	function verifyUser($u,$p){
		$this->db->where('username',$u);
		$this->db->where('password', substr(do_hash($p),0,16));
        //$this->db->where('password',$p);
		$this->db->limit(1);
		$Q = $this->db->get('admins');
		if($Q->num_rows()>0){
			$row = $Q->row_array();
			$_SESSION['userid'] = $row['id'];
            $_SESSION['username'] = $row['username'];
		}
        else {
            $this->session->set_flashdata('error', 'Sorry your username or password is incorrect !');
        }
	}
    function getUser($id){
        $data = array();
        $this->db->where('id',$id);
        $Q = $this->db->get('admins');
        if($Q->num_rows()>0){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }
    function getAllUsers(){
        $data = array();
        $this->db->where('status','active');
        $Q = $this->db->get('admins');
        if($Q->num_rows()>0){
            foreach($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    function addUser(){
        $data = array(
            'username' => $this->input->post('username'),
            'email' =>$this->input->post('email'),
            'status' => $this->input->post('status'),
            'password' => substr(do_hash($this->input->post('password')),0,16)
        );
        $this->db->insert('admins',$data);
    }
    function updateUser($id){
        $data = array(
            'username' => $this->input->post('username'),
            'email' =>$this->input->post('email'),
            'status' => $this->input->post('status'),
            'password' =>substr(do_hash($this->input->post('password')),0,16)
        );
        $this->db->where('id',$id);
        $this->db->update('admins',$data);
    }
    function deleteUser($id){
        $data = array(
            'status' => 'inactive'
        );
        $this->db->where('id',$id);
        $this->db->update('admins',$data);
    }
} 

?>