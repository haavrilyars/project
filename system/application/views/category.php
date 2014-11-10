<div id = 'pleft'>
    <?php
    echo "<h2>".$category['name']."</h2> \n";
    echo "<p>".$category['shortdesc']."</p> \n";
    foreach($listing as $list){
        echo "<img src = '".base_url().$list['thumbnail']."' border = '0' align = 'left'/> \n";
        echo "<h4>";
        switch($level){
            case "1":
                echo anchor('welcome/cat/'.$list['id'],$list['name']);
                break;
            case "2":
                echo anchor('welcome/product/'.$list['id'],$list['name']);
        }
        echo "</h4> \n";
        echo "<p>".$list['shortdesc']. "</p><br style='clear:both'/ > ";
    }
    ?>

</div>