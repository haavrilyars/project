<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 11/8/14
 * Time: 9:42 AM
 */
class Cart extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){

        $this->load->view('cart/cart');
    }
    function add_cart_item(){

        if($this->Cart_model->validate_add_cart_item() == TRUE){

            // Check if user has javascript enabled
            if($this->input->post('ajax') != '1'){
                redirect('cart'); // If javascript is not enabled, reload the page with new data
            }else{
                echo 'true'; // If javascript is enabled, return true, so the cart gets updated
            }
        }

    }

    function show_cart(){
        $this->load->view('cart/cart');
    }
    function update_cart(){
        $this->Cart_model->validate_update_cart();
        redirect('cart');
    }
    function empty_cart(){
        $this->cart->destroy(); // Destroy all cart data
        redirect('cart'); // Refresh te page
    }
}