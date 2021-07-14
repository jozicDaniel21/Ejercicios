<?php 

require __DIR__.'/vendor/autoload.php';
use GuzzleHttp\Client;

$isn_answered=0;
$is_answered=0;
$answer_owners = 0;
$question_title = "";
$link_question = "";
$views = array(array());
$dates = [];

$client = new Client([
    'base_uri' => 'https://api.stackexchange.com/2.2/search?order=desc&sort=activity&intitle=perl&site=stackoverflow',
    'timeout'  => 5.0,
]);
//Hacer la llamada al metodo get, sin ningún parametro
$res = $client->request('GET');
if ($res->getStatusCode() == '200') //Verifico que me retorne 200 = OK
{
	$json2Array = json_decode($res->getBody(), true);
	foreach ($json2Array['items'] as $key => $value) {
		
		$value['is_answered'] != true ? $isn_answered++ : $is_answered++;

		if($value['answer_count'] > $answer_owners)
		{
			$answer_owners = $value['answer_count'];
			$question_title = $value['title'];
			$link_question = $value['link'];
		}

		$views[0][] = $value['view_count'];
		$views[1][] = $value['title'];

		$dates[] = date("Y-m-d H:i:s",  $value['last_activity_date']);

		usort($dates, function($a, $b) {
		    $dateTimestamp1 = strtotime($a);
		    $dateTimestamp2 = strtotime($b);

		    return $dateTimestamp1 < $dateTimestamp2 ? -1: 1;
		});

	}
		$min_views = min($views[0]);
		$position = array_search($min_views, $views);
		$title = $views[1][$position];



  		echo '<br><strong>Pregunta 1</strong><br>';
		echo 'Respuestas correctas: '.$is_answered."<br>";
		echo 'Respuestas incorrectas: '.$isn_answered."<br>";
		echo '<br><strong>Pregunta 2</strong><br>';
		echo 'Pregunta con mayor owners: '.$question_title."<br>";
		echo 'Link de la pregunta: '.$link_question."<br>";
		echo 'Total de owners: '.$answer_owners."<br>";
		echo '<br><strong>Pregunta 3</strong><br>';
		echo 'Titulo de la pregunta: '.$title."<br>";
		echo 'Número de vistas: '.$min_views."<br>";
		echo '<br><strong>Pregunta 4</strong><br>';
		echo 'Fecha mas antigua: ' . $dates[0]."<br/>";
		echo 'Fecha mas reciente: ' . $dates[count($dates) - 1];
} 
	
	
?>