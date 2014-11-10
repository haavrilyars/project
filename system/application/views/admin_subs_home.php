<h1><?php echo $title; ?></h1>
<p><?php echo anchor('admin/subscribers/sendmail','Create a new email'); ?></p>
<?php
if($this->session->flashdata('message')){
    echo "<div class = 'message'>".$this->session->flashdata('message')."</div>";
}
if(count($subscribers)){
    echo "<table border = '1' cellspacing = '0' cellpadding ='3' width = '400'> \n";
    echo "<tr valign = 'top'>\n";
    echo "<th>ID</th>\n<th>Name</th>\n<th>Email</th>\n<th>Action</th>\n";
    echo "</tr>\n";
    foreach($subscribers as $list){
        echo "<tr valign='top'>\n";
        echo "<td>".$list['id']."</td>\n";
        echo "<td>".$list['name']."</td>\n";
        echo "<td>".$list['email']."</td>\n";
        echo "<td>".anchor('admin/subscribers/remove/'.$list['id'],'Unsubscribe')."</td>\n";
        echo "</tr>\n";
    }
    echo "</table>";

}

?>