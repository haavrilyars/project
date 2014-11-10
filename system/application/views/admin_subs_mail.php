<?php
echo $this->tinyMce;
echo form_open('admin/subscribers/sendmail');
echo "<p> <label for='subject'>Subject</label>"."<br />";
$data = array('name'=>'subject','id'=>'subject','size' => '50');
echo form_input($data)."<br />";
echo "</p>";
echo "<label for = 'message'>Message</label>"."<br />";
$data = array('name' =>'message','id' =>'message','cols'=>'50','rows' => '20');
echo form_textarea($data)."<br />";
echo "</p>";
echo form_submit('submit' ,'send mail');
echo form_close();
?>