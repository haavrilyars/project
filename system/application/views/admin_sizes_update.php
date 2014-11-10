<h1><?php echo $title; ?></h1>
<?php
echo form_open('admin/sizes/edit/'.$size['id']);
echo "<p> <label for='name'> Name</label><br />";
$data = array('name' =>'name','id' => 'name','size' => 15,'value' => $size['name']);
echo form_input($data) ."</p>";

echo "<p> <label for='status'> Status</label><br />";
$data = array('active' =>'active','inactive'=>'inactive');
echo form_dropdown('status',$data,$size['status']) ."</p>";

echo form_submit('submit','update size');
echo form_close();
?>