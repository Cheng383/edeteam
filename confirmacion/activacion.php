<?php
	header('Content-type: application/json');
	require 'php-activerecord/ActiveRecord.php';
	require 'Mailer/PHPMailerAutoload.php';
	require '../config/conexion.php';
	//Activacion
	$url_activacion='http://localhost/mrcomics/confimacion/activacion.php';

	$mail= new PHPMailer;
	$mail->isSMTP();

	$mail->Host = 'smtp.google.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'tucorreo@gmail.com';
	$mail->Password = 'tupassword';
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;

	$mail->From = 'tucorreo@gmail.com';
	$mail->FromName = 'tunombre';
	$mail->isHTML(true);
	$mail->CharSet = 'UTF-8';
?>