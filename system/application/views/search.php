<div id = 'pleft'>
    <h2>Search results</h2>
    <?php
    if(count($result)){
        foreach($result as $list){
            echo "<img src = '".base_url().$list['thumbnail']."' border = '0' align = 'left' /> \n";
            echo "<h4>";
            echo anchor('welcome/product/'.$list['id'],$list['name']);
            echo "<h4> \n";
            echo $list['shortdesc'];
        }

    }
    else {
        echo ' Sorry , no records were found !';
    }
    ?>
</div>