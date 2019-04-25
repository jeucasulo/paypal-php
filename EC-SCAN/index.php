<?php


$test = file_get_contents('https://www.google.com.br/');
preg_match('/<div id="prm-pt" style="margin-top:12px">(.+?<\/div>)/ngi', $test, $myRerturn);
echo $myRerturn;

// $content = "<div id='content_message'>My first post.</div>";

// preg_match("|<div id='content_message'>(.+?)<\/div>|", $content, $return);

// print_r($return);

?>

 

<!--outupt-->

<!--Array ( [0] =>-->

<!--My first post.-->

<!--[1] => My first post. )-->

 

<!--https://regexr.com/-->

<!--Expression:-->

<!--<div id="content_message_(?:\d+)">(.+?)<\/div>-->

<!--Text:-->

<!--<div id="content_message_56384">My first post.</div>-->

<!--------------------------------------------------------->

<!--https://regex101.com/-->

 

<!--regular expression-->

<!--<div id="content_message_(?:\d+)">(.+?)<\/div>-->

 

<!--Test string-->

<!--<div id="content_message_56384">My first post.</div>-->

<!--------------------------------------------------------->

 

 

<!--This-->

<!--https://stackoverflow.com/questions/17379731/regular-expression-to-extract-content-from-a-div-whose-id-starts-with-a-specifc-->

 

 

<!--outros-->

<!--https://stackoverflow.com/questions/33313047/extract-inner-text-from-a-div-by-id-using-an-html-string-->

 

