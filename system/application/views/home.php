<main>
    <ul id="cd-gallery-items" class="cd-container">
        <li>
            <div class="item">
                <div class="item-overlay">
                    <a href="#"><img src=<?php echo base_url().$mainf['image']; ?> id="img2"  width="372px" height="350px"></a>
                    <div class="sale-tag"><span>SALE</span></div>
                </div>
                <div class="item-content">
                    <div class="item-top-content">
                        <div class="item-top-content-inner">
                            <div class="item-product">
                                <div class="item-top-title">
                                    <h2><?php echo $mainf['name']; ?></h2>
                                    <br>
                                    <p class="subdescription">
                                        <?php echo $mainf['shortdesc']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="item-product-price">
                                <span class="price-num">$17</span>
                                <p class="subdescription">$36</p>
                                <div class="old-price"></div>
                            </div>
                        </div>
                    </div>
                    <div class="item-add-content">
                        <div class="item-add-content-inner"></div>
                        <a id="activator" a href="#" class="btn buy expand">Xem</a>
                    </div>
                </div>
            </div>
        </li>
       </ul>
    </main>
<!--<div id = 'pleft'>
    <?php
/*    echo form_open('cart/add_cart_item');
    $temp = base_url().$mainf['image'];
    echo "<img src='".$temp."' border='0' align='left'/>\n";
    echo "<h2>".$mainf['name']."</h2>\n";
    echo "<p>".$mainf['shortdesc'] . "<br/>\n";
    echo anchor('welcome/product/'.$mainf['id'],'see details') . "<br/>\n";
    echo form_hidden('product_id', $mainf['id']). "</p>\n";
    echo form_submit('add', 'Add'). "</p>\n";
    echo form_close();
    */?>
    <br style="clear:both"><br/>-->
   <!-- --><?php
/*    if($this->session->flashdata('subscriber_msg')){
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
    */?>
</div>

<div id='pright'>
    <?php
    foreach ($sidef as $key => $list){
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