<?php
include("simple_html_dom.php") ;

$html = file_get_html("10.20.0.149/urano/index.php?data=sj7574MlJOsg4LjjeAOJP5CBi1dRh84M-gX_Z-i_0Ol7TIQjdwZpa36rW8uzbT71_GMpcRAta2MSZGt9OmeQN3O0c9_4iv7A6ODAQz8nzk3-L-wp9KXARJdYvqggsPUb");

foreach($html->find('json') as $noscript)
{

    echo $noscript->innertext;
}
?>
