<div>
    <header>
        <div id="logo"><img src="img/cd-logo.svg" alt="Homepage"></div>
        <div id="cd-hamburger-menu"><a class="cd-img-replace" href="#0">Menu</a></div>
        <div id="cd-cart-trigger"><a class="cd-img-replace" href="#0">Cart</a></div>
    </header>

    <nav id="main-nav">
        <ul>
            <li><a class="current" href="#0">Trang Chu</a></li>
            <li><a class="current1" <?php echo anchor('welcome/pages/about_us','About Us');?></a></li>
            <li><a class="current2" <?php echo anchor('welcome/pages/contact','Contact');?></a></li>
            <li><a class="current3" <?php echo anchor('welcome/register','register');?></a></li>
            <li><a class="current4" <?php echo anchor('welcome/login','login');?></a></li>
            <li><a class="current5"<?php
                echo form_open("welcome/search");
                $data = array(
                    "name" => "term",
                    "id"=>"term",
                    "maxlenght" =>"64",
                    "sizre"=>30
                );
                echo form_input($data);
                echo form_submit("submit","search");
                echo form_close();
                ?></a></li>
            <li><?php if(isset($_SESSION['user_id'])){
                    echo 'hello '. anchor('welcome/customer/'.$_SESSION["user_id"],$customer['username']);
                }?></li>

        </ul>
    </nav>
    <div id="cd-cart">
        <h2>Gio Hang</h2>
        <ul class="cd-cart-items">
            <li>
                <span class="cd-qty">1x</span> San Pham 1
                <div class="cd-price">$9.99</div>
                <a href="#0" class="cd-item-remove cd-img-replace">Remove</a>
            </li>

            <li>
                <span class="cd-qty">2x</span> San Pham 2
                <div class="cd-price">$19.98</div>
                <a href="#0" class="cd-item-remove cd-img-replace">Remove</a>
            </li>

            <li>
                <span class="cd-qty">1x</span> San Pham 3
                <div class="cd-price">$9.99</div>
                <a href="#0" class="cd-item-remove cd-img-replace">Remove</a>
            </li>
        </ul>

        <div class="cd-cart-total">
            <p>Tong <span>$39.96</span></p>
        </div>

        <a href="#0" class="checkout-btn">Mua Hang</a>

        <p class="cd-go-to-cart"><a href="#0">Trang Chu</a></p>
    </div>

<?php /*echo anchor('welcome/pages/about_us','about us');*/?><!--
--><?php /*echo anchor('welcome/pages/contact','contact');*/?>
<?php echo anchor('welcome/cart','cart');?>
<?php /*echo anchor('welcome/register','register');*/?><!--
<?php /*echo anchor('welcome/login','login');*/?>
<?php /*if(isset($_SESSION['user_id'])){
    echo 'hello '. anchor('welcome/customer/'.$_SESSION["user_id"],$customer['username']);
}*/?>
--><?php
/*echo form_open("welcome/search");
$data = array(
        "name" => "term",
        "id"=>"term",
        "maxlenght" =>"64",
        "sizre"=>30
    );
echo form_input($data);
echo form_submit("submit","search");
echo form_close();
*/?>
</div>