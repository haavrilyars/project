<div id = pleft>
    <?php
    echo form_open('cart/add_cart_item');
    echo "<img src = '".base_url().$product['image']."' border = '0' align = 'left' /> \n";
    echo "<h2> ".$product['name']."</h2>\n";
    echo "<p>".$product['longdesc']."</p>\n";
    echo "Colors : ";
    foreach($assigned_colors as $value){
        echo $colors[$value] . "&nbsp;";
    }
    echo "<br />";
    echo "Sizes :";
    foreach($assigned_sizes as $value){
        echo $sizes[$value]. "&nbsp";
    }
    //var_dump($assigned_sizes);
    echo form_hidden('product_id', $product['id']). "</p>\n";
    echo form_submit('add', 'Add'). "</p>\n";
    echo form_close();
    ?>
    <br style="clear:both"><br/>
    <?php
    if($this->session->flashdata('subscriber_msg')){
        echo "<div class = 'message'>";
        echo $this->session->flashdata('subscriber_msg');
        echo "</div>";
    }
    echo form_open("welcome/subscribe");
    echo form_fieldset('Subscribe to our new letter');
    echo "<p> <label for='name'>Name </label><br />  ";
    $data = array('name' => 'name','id' =>'name','size' => '25');
    echo form_input($data).'<br />';
    $data = array('name' => 'email','id' =>'email','size' => '25');
    echo "<label for = 'email'>Email</label><br /></p>";
    echo form_input($data).'<br />';
    echo form_submit('submit','subscribe');
    echo form_fieldset_close();
    echo form_close();
    ?>
</div>

<div id='pright'>
    <?php
    foreach ($grouplist as $list){
        echo form_open('cart/add_cart_item');
        echo "<div class='productlisting'><img src='". base_url().$list['thumbnail']."' border='0' class='thumbnail'/>\n";
        echo "<h4>".$list['name']."</h4>\n";
        echo anchor('welcome/product/'.$list['id'],'see details') . "<br/>\n";
        echo form_hidden('product_id', $list['id']). "</p>\n";
        echo form_submit('add', 'Add'). "</p>\n";
        echo form_close();
    }
    ?>
</div>