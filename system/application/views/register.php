<div id = 'pleft'>
    <?php
    echo form_open('welcome/register');
    echo "<p> <label for='name'> Name</label><br />";
    $data = array('name' =>'name','id' => 'name','size' => 15);
    echo form_input($data) ."</p>";

    echo "<p> <label for='email'> Email</label><br />";
    $data = array('name' =>'email','id' => 'email','size' => 15);
    echo form_input($data) ."</p>";

    echo "<p> <label for='address'> Address</label><br />";
    $data = array('name' =>'address','id' => 'address','size' => 75);
    echo form_input($data) ."</p>";

    echo "<p> <label for='password'> Password</label><br />";
    $data = array('name' =>'password','id' => 'password','size' => 15);
    echo form_password($data) ."</p>";

    echo "<p> <label for='username'> Username</label><br />";
    $data = array('name' =>'username','id' => 'username','size' => 15);
    echo form_input($data) ."</p>";

    echo "<p> <label for='phone_num'> Phone number</label><br />";
    $data = array('name' =>'phone_num','id' => 'phone_num','size' => 15);
    echo form_input($data) ."</p>";

    echo "<p> <label for='birthday'> Birthday</label><br />";
    echo "<input type = 'date' id='birthday' name='birthday' /> </p>";

    echo form_submit('register','register');
    echo form_close();
    ?>
</div>