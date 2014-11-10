<?php
class Sizes extends CI_Controller{
    public function __construct(){
        parent::__construct();
        session_start();
        if($_SESSION['userid']>1){
            redirect('welcome/verify','refresh');
        }
    }
    public function index(){
        $data['title'] = 'Manage sizes';
        $data['main'] = 'admin_sizes_home';
        $data['sizes'] = $this->MSizes->getAllSizes();
        $this->load->view('dashboard',$data);
    }
    public function create(){
        $data['title'] = 'Create sizes';
        if($this->input->post('name')){
            $this->MSizes->createSize();
            $this->session->set_flashdata('message','Size has been created');
            redirect('admin/sizes/index','refresh');

        }
        else{
            $data['main'] = 'admin_sizes_create';
            $this->load->view('dashboard',$data);
        }
    }
    public function edit($id){
        $data['title'] = 'Update sizes';
        if($this->input->post('name')){
            $this->MSizes->updateSize($id);
            $this->session->set_flashdata('message','Size has been updated');
            redirect('admin/size/index','refresh');
        }
        else{
            $data['size']=$this->MSizes->getSize($id);
            $data['main'] = 'admin_sizes_update';
            $this->load->view('dashboard',$data);
        }
    }
    public function delete($id){
        $this->MSizes->deleteSize($id);
        $this->session->set_flashdata('message','Size has been deleted');
        redirect('admin/size/index','refresh');
    }
}