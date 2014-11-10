<?php
class Categories extends CI_Controller{
	public function __construct(){
		parent ::__construct();
		session_start();
	}
    public function index(){
        $data['title'] = 'Manage categories';
        $data['main'] = 'admin_cat_home';
        $data['categories'] = $this->MCats->getAllCategories();
        $this->load->view('dashboard',$data);

    }
    public function create(){
        if($this->input->post('name')){
            $this->MCats->addCategory();
            $this->session->flashdata('message','Category is created');
            redirect('admin/categories/index','refresh');
        }
        else{
            $data['title'] = 'Create categories';
            $data['main'] = 'admin_cat_create';
            $data['categories'] = $this->MCats->getTopCategories();
            $this->load->view('dashboard',$data);
        }
    }
    public function edit($id){
        $cat = $this->MCats->getCategory($id);
        if(!count($cat)){
            redirect('admin/categories/index','refresh');
        }
        if($this->input->post('name')){
            $this->MCats->updateCategory($id);
            $this->session->set_flashdata('message','Category has been updated');
            redirect('admin/categories/index','refresh');
        }
        else{
            $data['title'] = 'Update categories';
            $data['main'] = 'admin_cat_update';
            $data['categories'] = $this->MCats->getTopCategories();
            $data['category'] = $this->MCats->getCategory($id);
            $this->load->view('dashboard',$data);
        }
    }
    public  function delete($id){
        //var_dump($this->MCats->checkOrphans($id));
        if($this->MCats->checkOrphans($id)){
            $orphans = $this->MCats->checkOrphans($id);
            $this->session->set_userdata('orphans',$orphans);
            redirect('admin/categories/reassign/'.$id,'refresh');
        }
        else{

            $cat = $this->MCats->getCategory($id);
            if(!count($cat)){
                redirect('admin/categories/index','refresh');
            }
            $this->MCats->deleteCategory($id);
            $this->session->set_flashdata('message','Category has been deleted');
            redirect ('admin/categories/index','refresh');
        }
    }
    public function export(){
        $this->load->helper('download');
        $csv = $this->MCats->exportCSV();
        $name = "categories_export.csv";
        force_download($name,$csv);
    }
    public function reassign($id){
        //var_dump($_POST);
        if($_POST){
            $this->MProducts->reassignProducts();
            $this->session->set_flashdata('message','Products have been reassigned');
            redirect('admin/categories/index','refresh');
        }
        else{
            $data['title'] = 'Reassign products';
            $data['categories'] = $this->MCats->getCategoriesDropdown();
            $data['category'] = $this->MCats->getCategory($id);
            $data['main'] = 'admin_cat_reassign';
            $this->load->view('dashboard',$data);
        }
    }
}
?>