<h1><?php echo $title; ?></h1>
<?php
echo form_open('admin/categories/edit/'.$category['id']);
echo "<p> <label for='catname'> Name</label><br />";
$data = array('name' =>'name','id' => 'catname','size' => 25,'value'=>$category['name']);
echo form_input($data) ."</p>";

echo "<p> <label for='short'> Short Description</label><br />";
$data = array('name' =>'shortdesc','id' => 'short','size' => 40,'value' =>$category['shortdesc']);
echo form_input($data) ."</p>";


echo "<p> <label for='long'> Long Description</label><br />";
$data = array('name' =>'longdesc','id' => 'long','rows' => 5,'cols' =>40 , 'value' =>$category['longdesc']);
echo form_textarea($data) ."</p>";

echo "<p> <label for='status'> Status</label><br />";
$data = array('active' =>'active','inactive'=>'inactive');
echo form_dropdown('status',$data,$category['status']) ."</p>";

echo "<p> <label for='parent'> Parent Category</label><br />";
echo form_dropdown('parentid',$categories,$category['parentid']) ."</p>";

echo form_submit('submit','update category');
echo form_close();

?>