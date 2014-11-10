<?php echo $this->tinyMce;?>

<h1><?php echo $title;?></h1>

<?php
echo form_open('admin/pages/edit/'.$page['id']);
echo "<p><label for='pname'>Name</label><br/>";
$data = array('name'=>'name','id'=>'pname','size'=>25, 'value' => $page['name']);
echo form_input($data) ."</p>";

echo "<p><label for='short'>Keywords</label><br/>";
$data = array('name'=>'keywords','id'=>'short','size'=>40, 'value' => $page['keywords']);
echo form_input($data) ."</p>";

echo "<p><label for='desc'>Description</label><br/>";
$data = array('name'=>'description','id'=>'desc','size'=>40, 'value' => $page['description']);
echo form_input($data) ."</p>";

echo "<p><label for='fpath'>Path/FURL</label><br/>";
$data = array('name'=>'path','id'=>'fpath','size'=>50, 'value' => $page['path']);
echo form_input($data) ."</p>";

echo "<p><label for='long'>Content</label><br/>";
$data = array('name'=>'content','id'=>'long','rows'=>5, 'cols'=>'40', 'value' => $page['content']);
echo form_textarea($data) ."</p>";

echo "<p><label for='status'>Status</label><br/>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options,$page['status']) ."</p>";

echo form_hidden('id',$page['id']);
echo form_submit('submit','update page');
echo form_close();


?>