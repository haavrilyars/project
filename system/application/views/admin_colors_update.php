<h1><?php echo $title; ?></h1>
<?php
echo form_open('admin/colors/edit/'.$color['id']);
echo "<p> <label for='name'> Name</label><br />";
$data = array('name' =>'name','id' => 'name','size' => 15,'value' => $color['name']);
echo form_input($data) ."</p>";

echo "<p> <label for='status'> Status</label><br />";
$data = array('active' =>'active','inactive'=>'inactive');
echo form_dropdown('status',$data,$color['status']) ."</p>";

echo form_submit('submit','update color');
echo form_close();
?>