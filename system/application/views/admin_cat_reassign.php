<h1><?php echo $title; ?></h1>

<p>The following products are about to be orphaned . They used to belong to <?php echo $category['name'] ?> category, but now they need to be reassigned .</p>
<?php
foreach($this->session->userdata('orphans') as $id => $name){
    echo "<ul>\n";
    echo "<li>\n";
    echo $name;
    echo "</li>\n";
    echo "</ul>";
}
//var_dump($this->MCats->checkOrphans($category['id']));
echo form_open('admin/categories/reassign/'.$category['id']);
echo form_dropdown('category_id',$categories);
echo form_submit('submit','Reassign');
echo form_close();
?>