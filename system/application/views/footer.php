<footer>
    <ul>
        <li>
            <p class="home">Home</p>
            <a class="logo" href="#">Company Name <i>&copy;<?php echo date("Y"); ?></i></a>
        </li>
        <li>
            <p class="services">Services</p>

            <ul>
                <li><a href="#">3D modeling</a></li>
                <li><a href="#">Web development</a></li>
                <li><?php echo anchor("welcome/verify",'Dashboard');?></li>
                <li><?php echo anchor("welcome/privacy","privacy policy");?></li>
            </ul>
        </li>
        <li>
            <p class="reachus">Reach us</p>

            <ul>
                <li>
                    <div class='row'>
                        <i class='icon-facebook'></i>
                        <i class='icon-googleplus'></i>
                    </div>
                </li>
                <li>0988849124</li>
            </ul>
        </li>
        <li>
            <p class="clients">Subscribe new letter</p>

            <ul>
                <li> <?php
                    if($this->session->flashdata('subscriber_msg')){
                        echo "<div class = 'message'>";
                        echo $this->session->flashdata('subscriber_msg');
                        echo "</div>";
                    }
                    echo form_open("welcome/subscribe");
                    echo "<label for='name'>Name </label><br />  ";
                    $data = array('name' => 'name','id' =>'name','size' => '25');
                    echo form_input($data).'<br />';
                    $data = array('name' => 'email','id' =>'email','size' => '25');
                    echo "<label for = 'email'>Email</label><br />";
                    echo form_input($data).'<br />';
                    echo form_submit('submit','subscribe');
                    echo form_close();
                    ?>
                </li>
            </ul>
        </li>
    </ul>
</footer>



