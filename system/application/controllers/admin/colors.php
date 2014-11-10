<?php
class Colors extends CI_Controller{
    public function __construct(){
        parent::__construct();
        session_start();
        if($_SESSION['userid']<1){
            redirect("welcome/verify","refresh");
        }

    }
    public function index(){
        $data['title'] = 'Manage Colors';
        $data['main'] = 'admin_colors_home';
        $data['colors'] = $this->MColors->getAllColors();
        $this->load->view('dashboard',$data);
    }
    public function create(){
        $data['title'] = 'Create Colors';
        if($this->input->post('name')){
            $this->MColors->createColor();
            $this->session->set_flashdata('message','Color has been created');
            redirect('admin/colors/index','refresh');

        }
        else{
            $data['main'] = 'admin_colors_create';
            $this->load->view('dashboard',$data);
        }
    }
    public function edit($id){
        $data['title'] = 'Update colors';
        if($this->input->post('name')){
            $this->MColors->updateColor($id);
            $this->session->set_flashdata('message','Color has been updated');
            redirect('admin/colors/index','refresh');
        }
        else{
            $data['color']=$this->MColors->getColor($id);
            $data['main'] = 'admin_colors_update';
            $this->load->view('dashboard',$data);
        }
    }
    public function delete($id){
        $this->MColors->deleteColor($id);
        $this->session->set_flashdata('message','Color has been deleted');
        redirect('admin/color/index','refresh');
    }
}