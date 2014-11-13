<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct(){
        parent::__construct();
        session_start();
    }


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $data['title']= 'Welcome to my testing ebook';
        if(isset($_SESSION['user_id'])){
            $data['customer'] = $this->MCustomers->getCustomer($_SESSION['user_id']);
        }
        $data['navlist'] = $this->MCats->getCategoriesNav();
        $data['mainf'] = $this->MProducts->getMainFeature();
        $skip = $data['mainf']['id'];
        $data['sidef'] = $this->MProducts->getRandomProducts($skip,3);
        $data['main'] = 'home';
        /*echo "<pre>";
        print_r($data);
        echo "</pre>";*/
        //print_r($data);
		$this->load->view('template',$data);
	}
    public function cat($catid){
        $cat = $this->MCats->getCategory($catid);
        if(!count($cat)){
            redirect("welcome/index",'refresh');
        }
        $data['title']= 'TESTING BOOK SHOP |'.$cat['name'];
        if($cat['parentid']<1){
            $data['listing'] = $this->MCats->getSubCategories($catid);
            $data['level']= 1;
        }
        else{
            $data['listing'] = $this->MProducts->getProductsByCateogry($catid);
            $data['level']=2;
        }
        $data ['navlist'] = $this->MCats->getCategoriesNav();
        if(isset($_SESSION['user_id'])){
            $data['customer'] = $this->MCustomers->getCustomer($_SESSION['user_id']);
        }
        $data['main'] = 'category';
        $data['category']=$cat;
        $this->load->view('template',$data);
    }
    public function product($id){
        $product = $this->MProducts->getProduct($id);
        if(!count($product)){
            redirect("welcome/index",'refresh');
        }
        $data['title'] = 'TESTING BOOK SHOP |'.$product['name'];
        if(isset($_SESSION['user_id'])){
            $data['customer'] = $this->MCustomers->getCustomer($_SESSION['user_id']);
        }
        $data['grouplist'] = $this->MProducts->getProductsByGroup($product['id'],$product['grouping']);
        $data ['navlist'] = $this->MCats->getCategoriesNav();
        $data['assigned_colors']= $this->MProducts->getAssignedColors($id);
        $data['assigned_sizes'] = $this->MProducts->getAssignedSizes($id);
        $data['colors'] = $this->MColors->getActiveColors();
        $data['sizes'] = $this->MSizes->getActiveSizes();
        $data['main'] = 'product';
        $data['product']= $product;
        $this->load->view('template',$data);
    }
    public function search(){
        if($this->input->post('term')){
            $data['result'] = $this->MProducts->search($this->input->post('term'));
        }
        else{
            redirect("welcome/index",'refresh');
        }
        $data['title'] = "The results of ".$this->input->post('term');
        $data['navlist'] = $this->MCats->getCategoriesNav();
        if(isset($_SESSION['user_id'])){
            $data['customer'] = $this->MCustomers->getCustomer($_SESSION['user_id']);
        }
        $data['main'] = 'search';
        $this->load->view('template',$data);

    }
    public function cart(){
        //$this->cart->destroy();
        $product = $this->MProducts->getProduct($this->uri->segment(3));
        
        $insert = array(
            'id' =>$this->uri->segment(3),
            'qty'=>1,
            'price' =>element('price',$product),
            'name' => element('name',$product)
        );
        $this->cart->insert($insert);
        $data['main'] = 'shoppingcart';
        $data['navlist'] = $this->MCats->getCategoriesNav();
        if(isset($_SESSION['user_id'])){
            $data['customer'] = $this->MCustomers->getCustomer($_SESSION['user_id']);
        }
        $data ['title'] = "The testing book shop | Shopping cart";
        $this->load->view('template',$data);
        
        //echo "We've added this product to your cart";
    }
    public function verify(){
        if($this->input->post('username')){
            $u = $this->input->post('username');
            $p = $this->input->post('password');
            $this->MAdmins->verifyUser($u,$p);
            if($_SESSION['admin_id']>0){
                redirect('admin/dashboard','refresh');
            }
        }
        $data['role'] = 'admin';
        $data['main'] = 'login';
        $data['navlist'] = $this->MCats->getCategoriesNav();
        if(isset($_SESSION['user_id'])){
            $data['customer'] = $this->MCustomers->getCustomer($_SESSION['user_id']);
        }
        $data['title'] = "The testing book shop | Login";
        $this->load->view('template',$data);
    }
    function pages($path){
        $page = $this->MPages->getPathPage($path);
        $data['main'] = 'page';
        $data['title'] = $page['name'];
        $data['page'] = $page;
        $data['navlist'] = $this->MCats->getCategoriesNav();
        if(isset($_SESSION['user_id'])){
            $data['customer'] = $this->MCustomers->getCustomer($_SESSION['user_id']);
        }
        $this->load->view('template',$data);
    }
    function subscribe(){
        if($this->input->post('email')){
            $this->load->helper('email');
            if(!valid_email($_POST['email'])){
                $this->session->set_flashdata('subscriber_msg','Invalid email , please try again');
                redirect('welcome/index','refresh');
            }
            else{
                $this->MSubscribers->createSubscriber();
                $this->session->set_flashdata('subscriber_msg','Thanks for your subscriber !');
                redirect('welcome/index','refresh');
            }
        }
        else{
            $this->session->set_flashdata('subscriber_msg','You must enter something in subscriber form !');
            redirect('welcome/index','refresh');
        }
    }
    function unsubcribe($id){
        $this->MSubscriber->removeSubscriber($id);
        $this->session->set_flashdata('message','you have been unsubscribe');
        redirect('welcome/index','refresh');
    }
    function register(){
        if($this->input->post('register')){
            $this->MCustomers->saveRegister();
            $u = $this->input->post('username');
            $p = $this->input->post('password');
            $this->MCustomers->verifyUser($u,$p);
            $this->session->set_flashdata('message','You have register a account !');
            redirect('welcome/index','refresh');
        }
        else{
            $data['navlist'] = $this->MCats->getCategoriesNav();
            if(isset($_SESSION['user_id'])){
                $data['customer'] = $this->MCustomers->getCustomer($_SESSION['user_id']);
            }
            $data['main'] = 'register';
            $data['title'] = 'Register';
            $this->load->view('template',$data);
        }
    }
    function login(){
        if($this->input->post('username')){
            $u = $this->input->post('username');
            $p = $this->input->post('password');
            $this->MCustomers->verifyUser($u,$p);
            if($_SESSION['user_id']>0){
                redirect('welcome/index','refresh');
            }
        }
        $data['role'] = 'customer';
        $data['main'] = 'login';
        $data['navlist'] = $this->MCats->getCategoriesNav();
        if(isset($_SESSION['user_id'])){
            $data['customer'] = $this->MCustomers->getCustomer($_SESSION['user_id']);
        }
        $data['title'] = "The testing book shop | Login";
        $this->load->view('template',$data);
    }
    function forgot_password(){
        if($this->input->post('email')){
            if( $this->MCustomers->checkEmail($this->input->post('email'))){
                $this->load->helper('string');
                $new_pass=random_string('alnum',8);
                $this->MCustomers->updatePassword($_POST['email'],$new_pass);

                $config = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'sihalala@gmail.com',
                    'smtp_pass' => 'Lovehaho93',
                    'mailtype' => 'html',
                    'newline' => "\r\n",
                    'charset' => 'iso-8859-1'
                );
                $this->load->library('email',$config);
                $this->email->from('sihalala@gmail.com', 'Admin AIObookstore');
                $this->email->to("sihalala@gmail.com");
                $this->email->subject('[AIOBookstore] Recovery your password');
                $this->email->message('Your password is '.$new_pass. ' Plesase remember');
                $this->email->send();
                $this->session->set_flashdata('message','Please check your mail box to recover your password !');
                redirect('welcome/login','refresh');
            }
            else{
                $this->session->set_flashdata('message','The email is invalid !');
                redirect('welcome/forgot_password','refresh');
            }
        }
        else{
            $this->load->view('forgot_password');
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */