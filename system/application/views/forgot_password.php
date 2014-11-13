<?php
echo form_open('welcome/forgot_password');

echo 'email : '. form_input('email');
echo form_submit('recover','recover');
echo form_close();
?>