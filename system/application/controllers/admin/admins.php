<?php
class Admins extends CI_Controller{
	public function __construct(){
		parent ::__construct();
		session_start();
	}
    public function index(){
        $data['title'] = 'Manage Users';
        $data['main'] = 'admin_admins_home';
        $data['users'] = $this->MAdmins->getAllUsers();
        $this->load->view('dashboard',$data);
    }
    public function create(){
        $data['title'] = 'Create User';
        $data['main'] = 'admin_admins_create';
        if($this->input->post('email')){
            $this->MAdmins->addUser();
            $this->session->set_flashdata('message','User has been created');
            redirect('admin/admins/index','refresh');
        }
        else{
            $this->load->view('dashboard',$data);
        }
    }
    public function edit($id){
        var_dump($this->input->post('email'));
        if($this->input->post('email')){
            $this->MAdmins->updateUser($id);
            $this->session->set_flashdata('message','User has been updated');
            redirect('admin/admins/index','refresh');
        }
        else{
            $data['title'] = 'Update user';
            $data['main'] = 'admin_admins_update';
            $data['user'] = $this->MAdmins->getUser($id);
            $this->load->view('dashboard',$data);
        }
    }
    public function delete($id){
        $this->MAdmins->deleteUser($id);
        $this->session->set_flashdata('message','User has been updated');
        redirect('admin/admins/index','refresh');
    }
}
?>