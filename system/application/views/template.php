<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link href="<?= base_url();?>css/style-social.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url();?>css/info-product.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url();?>css/product.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url();?>css/overlay.css" rel="stylesheet" type="text/css" />

    <!--script hien product-->
    <script>
        $(document).ready(function() {
            $("aside.preview nav").show();
            var previewImg = $("img#main");
            $("a:first").addClass("active");
            $("nav a img").click(function(){
                var link = $(this).parent();
                var linkHref = link.attr("href");
                var linkAlt = link.attr("alt");
                if( $(link).hasClass("active") == false)
                {
                    $("a").removeClass("active");
                    link.addClass("active");
                    $(previewImg).animate({
                        opacity: 0.8,
                    }, 300, function() {
                        previewImg.attr("src", linkHref);
                        previewImg.attr("alt", linkAlt);
                        $(this).animate({
                                opacity: 1,
                            }, 300
                        );
                    });
                }
                return false;
            });
            $("input").click(function(){
                $("p.more").fadeIn("slow");
            })
        });
    </script>

    <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:700" rel="stylesheet" />
    <link href="<?= base_url();?>css/style-footer.css" rel="stylesheet" type="text/css" />

    <link href="<?= base_url();?>css/demo.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url();?>css/style2.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="<?php echo base_url(); ?>js/modernizr.custom.28468.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Economica:700,400italic' rel='stylesheet' type='text/css'>


    <script src="http://code.jquery.com/jquery-1.6.1.min.js"></script>


    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="<?= base_url();?>css/reset.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url();?>css/style.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="<?php echo base_url(); ?>js/modernizr.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js">
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.3.2.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#activator').click(function(){
                $('#overlay').fadeIn('fast',function(){
                    $('#box').animate({'top':'50px'},500);
                });
            });
            $('#activator2').click(function(){
                $('#overlay').fadeIn('fast',function(){
                    $('#box').animate({'top':'50px'},500);
                });
            });
            $('#boxclose').click(function(){
                $('#box').animate({'top':'-1000px'},500,function(){
                    $('#overlay').fadeOut('fast');
                });
            });

        });
    </script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.cslider.js"></script>
    <script type="text/javascript">
        $(function() {

            $('#da-slider').cslider({
                autoplay	: true,
                bgincrement	: 450
            });

        });
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>


    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php echo $title; ?></title>
    <!--<link href="<?/*= base_url();*/?>css/default.css" rel="stylesheet" type="text/css" />-->
    <noscript>
        Javascript is not enabled! Please turn on Javascript to use this site.
    </noscript>

    <script type="text/javascript">
        //<![CDATA[
        base_url = '<?= base_url();?>';
        //]]>
    </script>
</head>
<body>
<div id="wrapper">
    <div id="header">
        <?php $this->load->view('header');?>
    </div>

    <div id="nav">
        <?php $this->load->view('navigation');?>
    </div>
    <div id="main">
        <?php $this->load->view($main);?>
    </div>

    <div>
        <?php $this->load->view('footer');?>
    </div>
</div>
</body>
</html>
