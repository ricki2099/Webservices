<?php
include("simple_html_dom.php") ;

$html = file_get_html("http://jcgrafficdesigns.net/Nereo/ejemplo1.php");

foreach($html->find('json') as $noscript)
{

    echo $noscript->innertext;
}
?>