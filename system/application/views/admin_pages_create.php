<?php echo $this->tinyMce;?>
<h1><?php echo $title;?></h1>

<?php
echo form_open('admin/pages/create');
echo "<p><label for='pname'>Name</label><br/>";
$data = array('name'=>'name','id'=>'pname','size'=>25);
echo form_input($data) ."</p>";

echo "<p><label for='short'>Keywords</label><br/>";
$data = array('name'=>'keywords','id'=>'short','size'=>40);
echo form_input($data) ."</p>";

echo "<p><label for='desc'>Description</label><br/>";
$data = array('name'=>'description','id'=>'desc','size'=>40);
echo form_input($data) ."</p>";

echo "<p><label for='fpath'>Path/FURL</label><br/>";
$data = array('name'=>'path','id'=>'fpath','size'=>50);
echo form_input($data) ."</p>";

echo "<p><label for='long'>Content</label><br/>";
$data = array('name'=>'content','id'=>'long','rows'=>5, 'cols'=>'40');
echo form_textarea($data) ."</p>";

echo "<p><label for='status'>Status</label><br/>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options) ."</p>";


echo form_submit('submit','create page','class = "btn btn-primary"');
echo form_close();


?>