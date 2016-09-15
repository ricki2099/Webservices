<?

$url_servicio = '10.20.0.149/urano/index.php?data=sj7574MlJOsg4LjjeAOJP5CBi1dRh84M-gX_Z-i_0Ol7TIQjdwZpa36rW8uzbT71_GMpcRAta2MSZGt9OmeQN3O0c9_4iv7A6ODAQz8nzk3-L-wp9KXARJdYvqggsPUb';

$cliente = curl_init(); 

curl_setopt($cliente, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($cliente, CURLOPT_URL, $url_servicio); 

$repuestaWeb = curl_exec($cliente); 
curl_close($cliente); 
$repuestaWeb = explode("<json>", $repuestaWeb); 

$json = $repuestaWeb[1];
echo $json;

?>

