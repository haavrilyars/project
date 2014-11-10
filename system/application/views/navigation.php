<?php

if (count($navlist)){
  echo "<ul>";
  foreach ($navlist as $key => $list){
  	foreach ($list as $topkey => $toplist){
    	echo "<li class='cat'>";
    	echo anchor("welcome/cat/$topkey",$toplist['name']);
    	echo "</li>\n";
    	if (count($toplist['children'])){
    		foreach ($toplist['children'] as $subkey => $subname){
    			echo "\n<li class='subcat'>";
    			echo anchor("welcome/cat/$subkey",$subname);	
    			echo "</li>";
    		}
    	}
	}
  }
  echo "</ul>\n";
}
?>