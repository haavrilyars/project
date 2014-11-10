<a href="<?php echo base_url();?>">
    <img src="<?php echo base_url();?>images/logo.jpg" border="0"/>
</a>
<div>
<?php echo anchor('welcome/pages/about_us','about us');?>
<?php echo anchor('welcome/pages/contact','contact');?>
<?php echo anchor('welcome/cart','cart');?>
<?php
echo form_open("welcome/search");
$data = array(
        "name" => "term",
        "id"=>"term",
        "maxlenght" =>"64",
        "sizre"=>30
    );
echo form_input($data);
echo form_submit("submit","search");
echo form_close();
?>
</div>