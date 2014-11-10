<div id ="pleft">
    <?php
    if($this->session->flashdata('error')){
        echo $this->session->flashdata('error');
    }
    $udata = array(
        'name' =>'username',
        'id' =>'u',
        'size' => 15
    );
    $pdata = array(
        'name' => 'password',
        'id' => 'p',
        'size' =>15
    );

    echo form_open('welcome/verify');
    echo "<label> Username : </label> <br />";
    echo form_input($udata)."<br />";
    echo "<labe> Password : </labe> <br />";
    echo form_password($pdata)."<br />";
    echo form_submit('submit','login');
    echo form_close();
    ?>
</div>