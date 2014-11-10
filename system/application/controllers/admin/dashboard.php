<?php
class Dashboard extends CI_Controller{
	public function __construct(){
		parent ::__construct();
		session_start();
        if($_SESSION['userid']<1){
            redirect('welcome/verify','refresh');
        }
	}
    public function index(){
        $data['title'] = 'Dashboard Home';
        $data['main'] = 'admin_home';
        $this->load->view('dashboard',$data);
    }
    public function logout(){
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        $this->session->set_flashdata('error','You have logged out from system !');
        redirect('welcome/verify','refresh');
    }
}
?>