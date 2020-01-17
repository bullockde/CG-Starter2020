<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	$cmd='curl --request POST --data "{ \"fromDate\":\"01/01/2018\" }" --header "accept:application/json" --header "content-type: application/json" "https://api.birdeye.com/resources/v1/review/businessId/152174415213546?sindex=0&count=500&api_key=HwW8maPzrd2ByEOhUOHMZH2o6EJ4NObV"';
	$json=`$cmd`;
	
	$jsonIterator=new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($json,TRUE)),RecursiveIteratorIterator::SELF_FIRST);
	$text="";
	$name="";
	$avatar="";
	
	
	foreach ($jsonIterator as $key => $val) {
		if($text!="" && $name!="" && $avatar!="") {
			echo "<div class='row'>";
			echo "<div class='col-sm-6'>";
			echo "<div class='testimonial-item'>";
			echo "<p>".str_replace("more","<a href='https://birdeye.com/evans-pest-control-inc-152174415213546'>more</a>",$text)."</p>";
			echo "<div class='testimonial-author'>";
			echo "<img src='".$avatar."' alt='image'>";
			echo "<string>".$name."</strong>";
			echo "</div></div></div></div></div>";
			
			$text="";
			$name="";
			$avatar="";
		}
		
		if($key=="comments") { $text=$val; }
		if($key=="nickName") { $name=$val; }
		if($key=="thumbnailUrl") { $avatar=$val; }
		
		
	}
?>