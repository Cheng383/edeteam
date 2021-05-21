<?php
	function url($id,$titulo) {
		$titulo = $id . '/' . $titulo;
		$titulo = strtolower($titulo);
		$titulo = trim($titulo);
		$titulo = str_replace(
		      array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
		      'a',
		      $titulo);
		  $titulo = str_replace(
		      array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
		      'e',
		      $titulo);
		  $titulo = str_replace(
		      array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
		      'i',
		      $titulo);
		  $titulo = str_replace(
		      array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
		      'o',
		      $titulo);
		  $titulo = str_replace(
		      array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
		      'u',
		      $titulo);
		  $titulo = str_replace(
		      array('ñ', 'Ñ', 'ç', 'Ç'),
		      array('n', 'N', 'c', 'C',),
		      $titulo);
		    $titulo = str_replace(
		        array("\\", "¨", "º", "-", "~",
		             "#", "@", "|", "!", "\"",
		             "·", "$", "%", "&",
		             "(", ")", "?", "'", "¡",
		             "¿", "[", "^", "`", "]",
		             "+", "}", "{", "¨", "´",
		             ">", "< ", ";", ",", ":",
		             "."),
		        '-',
		        $titulo);
		    $titulo = str_replace("/", "/", $titulo);
		    $titulo = str_replace(" ", "-", $titulo);
		  return $titulo;
	}
	function titulo($titulito){
		$titulito = "<title>" . ucwords($titulito) . " | Mr comic</title>";
		$titulito = str_replace("-", " ", $titulito);
		echo $titulito;
	}
	function urlCap($url,$IdCap){
		$url = $url . '/' . $IdCap;
		$url = strtolower($url);
		$url = trim($url);
		$url = str_replace(
		      array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
		      'a',
		      $url);
		  $url = str_replace(
		      array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
		      'e',
		      $url);
		  $url = str_replace(
		      array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
		      'i',
		      $url);
		  $url = str_replace(
		      array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
		      'o',
		      $url);
		  $url = str_replace(
		      array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
		      'u',
		      $url);
		  $url = str_replace(
		      array('ñ', 'Ñ', 'ç', 'Ç'),
		      array('n', 'N', 'c', 'C',),
		      $url);
		    $url = str_replace(
		        array("\\", "¨", "º", "-", "~",
		             "#", "@", "|", "!", "\"",
		             "·", "$", "%", "&",
		             "(", ")", "?", "'", "¡",
		             "¿", "[", "^", "`", "]",
		             "+", "}", "{", "¨", "´",
		             ">", "< ", ";", ",", ":",
		             "."),
		        '-',
		        $url);
		    $url = str_replace("/", "/", $url);
		    $url = str_replace(" ", "-", $url);
		  return $url;
	}
	function space($dato){
		$dato = $dato . '/';
		$dato = strtolower($dato);
		$dato = trim($dato);
		$dato = str_replace(
		      array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
		      'a',
		      $dato);
		  $dato = str_replace(
		      array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
		      'e',
		      $dato);
		  $dato = str_replace(
		      array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
		      'i',
		      $dato);
		  $dato = str_replace(
		      array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
		      'o',
		      $dato);
		  $dato = str_replace(
		      array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
		      'u',
		      $dato);
		  $dato = str_replace(
		      array('ñ', 'Ñ', 'ç', 'Ç'),
		      array('n', 'N', 'c', 'C',),
		      $dato);
		    $dato = str_replace(
		        array("\\", "¨", "º", "-", "~",
		             "#", "@", "|", "!", "\"",
		             "·", "$", "%", "&",
		             "(", ")", "?", "'", "¡",
		             "¿", "[", "^", "`", "]",
		             "+", "}", "{", "¨", "´",
		             ">", "< ", ";", ",", ":",
		             "."),
		        '-',
		        $dato);
		    $dato = str_replace("/", "/", $dato);
		    $dato = str_replace(" ", "-", $dato);
		  return $dato;
	}
?>
