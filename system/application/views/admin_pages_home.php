<h1><?php echo $title; ?></h1>
<p><?php echo anchor('admin/pages/create','Create Page'); ?></p>
<?php
if($this->session->flashdata('message')){
    echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
if(count($pages)){
    echo "<table border = '1' cellspacing = '0' cellpadding ='3' width = '400'> \n";
    echo "<tr valign = 'top'>\n";
    echo "<th>ID</th>\n<th>Name</th>\n<th>Keywords</th>\n<th>Description</th>\n<th>Status</th>\n<th>Action</th>\n";
    echo "</tr>\n";
    foreach($pages as $list){
        echo "<tr valign='top'>\n";
        echo "<td>".$list['id']."</td>\n";
        echo "<td>".$list['name']."</td>\n";
        echo "<td>".$list['keywords']."</td>\n";
        echo "<td>".$list['description']."</td>\n";
        echo "<td>".$list['status']."</td>\n";
        echo "<td>".anchor('admin/pages/edit/'.$list['id'],'Edit')."|".anchor('admin/pages/delete/'.$list['id'],'Delete')."</td>\n";
        echo "</tr>\n";
    }
    echo "</table>";
}
?>