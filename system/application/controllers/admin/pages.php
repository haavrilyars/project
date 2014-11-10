<?php
/**
 * Created by PhpStorm.
 * User: haho
 * Date: 10/25/14
 * Time: 1:44 PM
 */
class Pages extends CI_Controller{
    public function __construct(){
        parent::__construct();
        session_start();
        if($_SESSION['userid']<1){
            redirect('welcome/verify','refresh');
        }

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
        $data['title'] = 'Manage Pages';
        $data['main'] = 'admin_pages_home';
        $data['pages'] = $this->MPages->getAllPages();
        $this->load->view('dashboard',$data);
    }
    public function create(){
        if($this->input->post('name')){
            $this->MPages->addPage();
            $this->session->set_flashdata('message','Page is created!');
            redirect('admin/pages/index','refresh');
        }
        else{
            $data['title'] = 'Create Page';
            $data['main'] = 'admin_pages_create';
            $this->load->view('dashboard',$data);
        }
    }
    public function edit($id){
        if ($this->input->post('name')){
            //var_dump($id);
            $this->MPages->updatePage($id);
            $this->session->set_flashdata('message','Page updated');
            redirect('admin/pages/index','refresh');
        }else{
            //$id = $this->uri->segment(4);
            $data['title'] = "Edit Page";
            $data['main'] = 'admin_pages_update';
            $data['page'] = $this->MPages->getPage($id);
            if (!count($data['page'])){
                redirect('admin/pages/index','refresh');
            }
            $this->load->view('dashboard',$data);
        }
    }

    public  function delete($id){
        //$id = $this->uri->segment(4);
        $this->MPages->deletePage($id);
        $this->session->set_flashdata('message','Page deleted');
        redirect('admin/pages/index','refresh');
    }
}