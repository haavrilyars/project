<h1><?php echo $title; ?></h1>
<?php
echo form_open('admin/admins/edit/'.$user['id']);
echo "<p> <label for='email'> Email</label><br />";
$data = array('name' =>'email','id' => 'email','size' => 25,'value' => $user['email']);
echo form_input($data) ."</p>";

echo "<p> <label for='username'> Username</label><br />";
$data = array('name' =>'username','id' => 'username','size' => 40,'value' =>$user['username']);
echo form_input($data) ."</p>";

echo "<p> <label for='status'> Status</label><br />";
$data = array('active' =>'active','inactive'=>'inactive');
echo form_dropdown('status',$data,$user['status']) ."</p>";

echo "<p> <label for='password'> Password</label><br />";
$data = array('name' =>'password','id' => 'password','size' => 40);
echo form_password($data) ."</p>";

echo form_submit('submit','update user');
echo form_close();
?>