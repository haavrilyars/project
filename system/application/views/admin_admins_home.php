<h1><?php echo $title; ?></h1>
<p><?php echo anchor('admin/admins/create','Create user'); ?></p>
<?php
if($this->session->flashdata('message')){
    echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
//var_dump($this->session->flashdata('message'));
if(count($users)){
    echo "<table border = '1' cellspacing = '0' cellpadding ='3' width = '400'> \n";
    echo "<tr valign = 'top'>\n";
    echo "<th>ID</th>\n<th>Username</th>\n</ht><th>Email</th>\n<th>Status</th>\n<th>Action</th>\n";
    echo "</tr>\n";
    foreach($users as $list){
        echo "<tr valign='top'>\n";
        echo "<td>".$list['id']."</td>\n";
        echo "<td>".$list['username']."</td>\n";
        echo "<td>".$list['email']."</td>\n";
        echo "<td>".$list['status']."</td>\n";
        echo "<td>".anchor('admin/admins/edit/'.$list['id'],'Edit')."|".anchor('admin/admins/delete/'.$list['id'],'Delete')."</td>\n";
        echo "</tr>\n";
    }
    echo "</table>";
}
?>