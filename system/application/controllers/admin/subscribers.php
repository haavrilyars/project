<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 11/5/14
 * Time: 9:17 AM
 */
class Subscribers extends CI_Controller{
    public function __construct(){
        parent::__construct();
        session_start();
        $this->tinyMce = '
		<!-- TinyMCE -->
		<script type="text/javascript" src="'. base_url().'js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
        tinymce.init({
        selector: "textarea",
        plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],

        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

        menubar: false,
        toolbar_items_size: "small",

        style_formats: [
                {title: "Bold text", inline: "b"},
                {title: "Red text", inline: "span", styles: {color: "#ff0000"}},
                {title: "Red header", block: "h1", styles: {color: "#ff0000"}},
                {title: "Example 1", inline: "span", classes: "example1"},
                {title: "Example 2", inline: "span", classes: "example2"},
                {title: "Table styles"},
                {title: "Table row 1", selector: "tr", classes: "tablerow1"}
        ],

        templates: [
                {title: "Test template 1", content: "Test 1"},
                {title: "Test template 2", content: "Test 2"}
        ]
});</script>
		<!-- /TinyMCE -->
		';
    }
    public function index(){
        $data['title'] = 'Subscribers manage';
        $data ['main'] = 'admin_subs_home';
        $data['subscribers'] = $this->MSubscribers->getAllSubscribers();
        $this->load->view('dashboard',$data);
    }
    public function delete($id){
        $this->MSubscribers->removeSubscriber($id);
        $this->session->set_flashdata('message','Subscriber has been deleted!');
        redirect('admin/subscribers/index','refresh');
    }
    public function sendmail(){
        if($this->input->post('subject')){
            $subject = $this->input->post('subject');
            $msg = $this->input->post('message');
            $subs = $this->MSubscribers->getAllSubscribers();
            foreach($subs as $list){
                $unsub = "<p> <a href= '".base_url().'welcome/unsubscribe/'.$list['id']."'/>Unsubscribe</p>";
                $this->email->clear();
                $this->email->from('sihalala@gmail.com','Si ha shopping');
                $this->email->to($list['email']);
                $this->email->subject($subject);
                $this->email->message($msg.$unsub);
                $this->email->send();
            }
            $this->session->set_flashdata('message','Emails have been sent !');
            redirect('admin/subscribers','refresh');
        }
        else{
            $data['title'] = 'Send Email ';
            $data['main'] = 'admin_subs_mail';
            $this->load->view('dashboard',$data);
        }
    }

}