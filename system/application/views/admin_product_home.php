<h1><?php echo $title; ?></h1>
<p><?php echo anchor('admin/products/create','Create product'); ?> | <?php echo anchor('admin/products/export','Export') ?> </p>

<?php
if($this->session->flashdata('message')){
    echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
if(count($products)){
	echo form_open("admin/products/batchmode");
	echo "Category ". form_dropdown('category_id',$categories);
	$data = array('name' => 'grouping','size' => 10);
    echo "&nbsp;";
    echo "Grouping : ";
	echo form_input($data);
	echo form_submit('submit','Batch mode');
	
    echo "<table border = '1' cellspacing = '0' cellpadding ='3' width = '400'> \n";
    echo "<tr valign = 'top'>\n";
    echo "<th>&nbsp;</th>\n<th>ID</th>\n<th>Name</th>\n<th>Status</th>\n<th>Action</th>\n";
    echo "</tr>\n";
    foreach($products as $list){
        echo "<tr valign='top'>\n";
        echo "<td align = 'center'>". form_checkbox('p_id[]',$list['id'],false) ."</td>\n";
        echo "<td>".$list['id']."</td>\n";
        echo "<td>".$list['name']."</td>\n";
        echo "<td>".$list['status']."</td>\n";
        echo "<td>".anchor('admin/products/edit/'.$list['id'],'Edit')."|".anchor('admin/products/delete/'.$list['id'],'Delete')."</td>\n";
        echo "</tr>\n";
    }
    echo "</table>";
    echo form_close();
}
?>