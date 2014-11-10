<h1><?php echo $title ?></h1>
<?php
echo form_open_multipart('admin/products/create');
echo "<p> <label for='name'> Name</label><br />";
$data = array('name' =>'name','id' => 'pname','size' => 25);
echo form_input($data) ."</p>";

echo "<p> <label for='short'> Short Description</label><br />";
$data = array('name' =>'shortdesc','id' => 'short','size' => 40);
echo form_input($data) ."</p>";


echo "<p> <label for='long'> Long Description</label><br />";
$data = array('name' =>'longdesc','id' => 'long','rows' => 5,'cols' =>40);
echo form_textarea($data) ."</p>";

echo "<p> <label for='status'> Status</label><br />";
$data = array('active' =>'active','inactive'=>'inactive');
echo form_dropdown('status',$data) ."</p>";

echo "<p> <label for='parent'> Category</label><br />";
echo form_dropdown('category_id',$categories) ."</p>";

echo "<p> <label for = 'uimage' >Image</label> <br />";
$data = array('name' =>'image','id' =>'uimage');
echo form_upload($data) ."</p>";

echo "<p> <label for='ugrouping'> Group</label><br />";
$data = array('name' =>'grouping','id' => 'ugrouping','size' => 25);
echo form_input($data) ."</p>";

echo "<p> <label for='price'> Price</label><br />";
$data = array('name' =>'price','id' => 'price','size' => 25);
echo form_input($data) ."</p>";

echo "<p> <label for='featured'> Featured</label><br />";
$data = array('true' =>'true','false'=>'false');
echo form_dropdown('featured',$data) ."</p>";

echo form_fieldset('Colors');
foreach($colors as $key =>$value){
    echo form_checkbox('colors[]',$key,false) .$value;
}
echo form_fieldset_close();

echo form_fieldset('Sizes');
foreach($sizes as $key => $value){
    echo form_checkbox('sizes[]',$key,false) .$value;
}
echo form_fieldset_close();

echo form_submit('submit','Creat product');
echo form_close();
?>