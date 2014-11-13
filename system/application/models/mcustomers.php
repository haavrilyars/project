<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 11/12/14
 * Time: 2:02 PM
 */
class MCustomers extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    public function saveRegister(){
        $data = array(
            'address' => $_POST['address'],
            'birthday' =>$_POST['birthday'],
            'email' =>$_POST['email'],
            'name'=>$_POST['name'],
            'password' =>substr(do_hash($this->input->post('password')),0,16),
            'phone_num' =>$_POST['phone_num'],
            'status' => 'Active',
            'username' =>$_POST['username']
        );
        $this->db->insert('customers',$data);
    }
    public function getCustomer($id){
        $data = array();
        $this->db->where('id',$id);
        $Q = $this->db->get('customers');
        if($Q->num_rows() >0){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }
    public function checkEmail($email){
        $this->db->where('email',$email);
        $Q = $this->db->get('customers');
        if($Q->num_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }
    public function updatePassword($email,$new_pass){
        $this->load->helper('string');
        $this->db->where('email',$email);
        $data = array(
            'password' => substr(do_hash($new_pass),0,16)
        );
        $this->db->update('customers',$data);
    }
    public function verifyUser($u,$p){
        $this->db->where('username',$u);
        $this->db->where('password', substr(do_hash($p),0,16));
        //$this->db->where('password',$p);
        $this->db->limit(1);
        $Q = $this->db->get('customers');
        if($Q->num_rows()>0){
            $row = $Q->row_array();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
        }
        else {
            $this->session->set_flashdata('error', 'Sorry your username or password is incorrect !');
        }
    }
}