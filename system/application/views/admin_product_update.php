<h1><?php echo $title ?></h1>
<?php
echo form_open_multipart('admin/products/edit/'.$product['id']);
echo "<p> <label for='name'> Name</label><br />";
$data = array('name' =>'name','id' => 'pname','size' => 25,'value'=> $product['name']);
echo form_input($data) ."</p>";

echo "<p> <label for='short'> Short Description</label><br />";
$data = array('name' =>'shortdesc','id' => 'short','size' => 40,'value' => $product['shortdesc']);
echo form_input($data) ."</p>";



echo "<p> <label for='long'> Long Description</label><br />";
$data = array('name' =>'longdesc','id' => 'long','rows' => 5,'cols' =>40,'value' => $product['longdesc']);
echo form_textarea($data) ."</p>";

echo "<p> <label for='status'> Status</label><br />";
$data = array('active' =>'active','inactive'=>'inactive');
echo form_dropdown('status',$data,$product['status']) ."</p>";

echo "<p> <label for='parent'> Category</label><br />";
echo form_dropdown('category_id',$categories,$product['category_id']) ."</p>";

echo "<p> <label for = 'uimage' >Image</label> <br />";
$data = array('name' =>'image','id' =>'uimage');
echo form_upload($data) ."</p><br />";
echo "Current image : ".$product['image'];

echo "<p> <label for='ugrouping'> Group</label><br />";
$data = array('name' =>'grouping','id' => 'ugrouping','size' => 25);
echo form_input($data) ."</p>";

echo "<p> <label for='price'> Price</label><br />";
$data = array('name' =>'price','id' => 'price','size' => 25);
echo form_input($data) ."</p>";

echo "<p> <label for='featured'> Featured</label><br />";
$data = array('true' =>'true','false'=>'false');
echo form_dropdown('featured',$data,$product['featured']) ."</p>";

echo form_fieldset('Colors');
if(!count($assigned_colors)){
    $assigned_colors = array();
}
foreach($colors as $key=>$value){
    if (in_array($key ,$assigned_colors)){
        $check = true;
    }
    else
    {
        $check = false;
    }
    echo form_checkbox('colors[]',$key,$check) . $value;
}
echo form_fieldset_close();

echo form_fieldset('Sizes');
if(!count($assigned_sizes)){
    $assigned_sizes = array();
}
foreach($sizes as $key=>$value){
    if ( in_array($key,$assigned_sizes) ){
        $check = true;
    }
    else{
        $check = false;
    }
    echo form_checkbox('sizes[]',$key,$check) . $value;
}
echo form_fieldset_close();

//var_dump($assigned_sizes);
//var_dump($assigned_colors);
echo form_submit('submit','Update product');
echo form_close();
?>