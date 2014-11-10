<?php
class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index(){
        $data['title'] = 'Product Management';
        $data['main'] = 'admin_product_home';
        $data['products'] = $this->MProducts->getAllProducts();
        $data['categories'] = $this->MCats->getCategoriesDropdown();
        $data['colors'] =$this->MColors->getActiveColors();
        $data['sizes'] = $this->MSizes->getActiveSizes();
        $this->load->view('dashboard',$data);
    }
    public function create(){
        if($this->input->post('name')){
            $this->MProducts->addProduct();
            $this->session->flashdata('message','Product has been added !');
            redirect('admin/products/index','refresh');

        }
        else{
            $data['title'] = 'Create product';
            $data['main'] = 'admin_product_create';
            $data['categories'] = $this->MCats->getCategoriesDropdown();
            $this->load->view('dashboard',$data);
        }
    }
    public function edit($id){
        if($this->input->post('name')){
            $this->MProducts->updateProduct($id);
            $this->session->set_flashdata('message','Product has been updated !');
            redirect('admin/products/index','refresh');
        }
        else{
            $data['title'] = 'Update product';
            $data['main'] = 'admin_product_update';
            $data['product'] = $this->MProducts->getProduct($id);
            $data['categories'] = $this->MCats->getCategoriesDropdown();
            $data['assigned_colors']= $this->MProducts->getAssignedColors($id);
            $data['assigned_sizes'] = $this->MProducts->getAssignedSizes($id);
            $data['colors'] = $this->MColors->getActiveColors();
            $data['sizes'] = $this->MSizes->getActiveSizes();
            $this->load->view('dashboard',$data);
        }

    }
    public function delete($id){
        $this->MProducts->deleteProduct($id);
        $this->session->flashdata('message','Product has been deleted !');
        redirect('admin/products/index','refresh');
    }
    public function batchmode(){
        $this->MProducts->batchmode();
        redirect('admin/products/index','refresh');
    }
    public function export(){
        $this->load->helper('download');
        $csv = $this->MProducts->exportCSV();
        $name = 'products_export.csv';
        force_download($name,$csv);
    }
}
?>