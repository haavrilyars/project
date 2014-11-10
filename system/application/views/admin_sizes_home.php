<h1><?php echo $title; ?></h1>
<p><?php echo anchor('admin/sizes/create','Create size'); ?></p>
<?php
if($this->session->flashdata('message')){
    echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
if(count($sizes)){
    echo "<table border = '1' cellspacing = '0' cellpadding ='3' width = '400'> \n";
    echo "<tr valign = 'top'>\n";
    echo "<th>ID</th>\n<th>Name</th>\n<th>Status</th>\n<th>Action</th>\n";
    echo "</tr>\n";
    foreach($sizes as $list){
        echo "<tr valign='top'>\n";
        echo "<td>".$list['id']."</td>\n";
        echo "<td>".$list['name']."</td>\n";
        echo "<td>".$list['status']."</td>\n";
        echo "<td>".anchor('admin/sizes/edit/'.$list['id'],'Edit')."|".anchor('admin/sizes/delete/'.$list['id'],'Delete')."</td>\n";
        echo "</tr>\n";
    }
    echo "</table>";
}
?>