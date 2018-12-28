<?
session_start();
$site = $_SERVER['SERVER_NAME'];
$cookie = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


<?php

	require __DIR__ . '/vendor/autoload.php';
	// include_once __DIR__ . '/unsorted/accept.php';
	$theme = $_POST['theme'];
	$phone = $_POST['phone'];
	$phone = preg_replace('![^0-9]+!','',$phone);
	$first = substr($phone, "0",1);
	// echo '<pre>';
	// print_r($phone);
	// print_r($first);
	// echo '</pre>';
	if(!preg_match("/^[0-9]{10,10}+$/", $phone)) echo ("Телефон задан в неверном формате");
	if($first == 3) {
		try {
			// Создание клиента
			$subdomain = 'turboinsta';            // Поддомен в амо срм
			$login     = 'turboinsta.com.ua@gmail.com';            // Логин в амо срм
			$apikey    = 'feb8f31899f8afc44a02bf56fd7d0553';            // api ключ

			$amo = new \AmoCRM\Client($subdomain, $login, $apikey);



				// Вывести полученые из амо данные
				// echo '<pre>';
				// print_r($amo->account->apiCurrent());
				// print_r($contacts);
				// print_r($theme);
				// echo '</pre>';
				$contacts = $amo->contact->apiList([
					"query" => $phone,
					"-100000 DAYS"
				]);
				$contactsId = $contacts[0][id];
				if(count($contacts) == 0 ){
							// создаем лида
					$lead = $amo->lead;
					$lead['name'] =  $theme;
					$lead['responsible_user_id'] = 13823083; // ID ответсвенного
					$lead['pipeline_id'] = 23076754; // ID воронки

					$lead->addCustomField(305117, [ // ID  поля в которое будт приходить заявки
							[$_POST['name']], // сюда вписать значение из атрибута "name" пример: <input name="phone">
					]);
					$id = $lead->apiAdd();
					$contact = $amo->contact;
					// Заполнение полей модели
					$contact['name'] = isset($_POST['name']) ? $_POST['name'] : 'Заявка с сайта';
					$contact['linked_leads_id'] = [(int)$id];
					$contact->addCustomField(90897, [
							[$phone, 'MOB'],
					]);
					$contact->addCustomField(596303, [
							[$theme],
					]);
					$contact->addCustomField(204967, [
							["0 DAYS"],
					]);
					// Добавление нового контакта и получение его ID
					$contactId = $contact->apiAdd();


					// Добавление и обновление задач
					// Метод позволяет добавлять задачи по одной или пакетно,
					// а также обновлять данные по уже существующим задачам

					$task = $amo->task;
					// $task->debug(true); // Режим отладки
					$task['element_id'] = $contactId;
					$task['element_type'] = 1;
					$task['date_create'] = '0 DAY';
					$task['task_type'] = 1;
					$task['text'] = "Провести\nКонсультацию";
					$task['responsible_user_id'] = 13823083;
					$task['complete_till'] = '0 DAY';

					$taskId = $task->apiAdd();

					$note = $amo->note;
					// $note->debug(true); // Режим отладки
					$note['element_id'] = $contactId;
					$note['element_type'] = \AmoCRM\Models\Note::TYPE_CONTACT; // 1 - contact, 2 - lead
					$note['note_type'] = \AmoCRM\Models\Note::COMMON; // @see https://developers.amocrm.ru/rest_api/notes_type.php
					$note['text'] = $_POST['msg'];
					$noteId = $note->apiAdd();
				}
			  if( count($contacts) > 0){
					$task = $amo->task;
					$task['element_id'] = $contactsId;
					$task['element_type'] = 1;
					$task['date_create'] = '0 DAY';
					$task['task_type'] = 1;
					$task['text'] = "Провести\nКонсультацию";
					$task['responsible_user_id'] = 13823083;
					$task['complete_till'] = '0 DAY';
					$taskId = $task->apiAdd();
				}

		} catch (\AmoCRM\Exception $e) {
			printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
		}
		$subject = 'Заявка Turboinsta';
		$emailTo = "turboinsta.com.ua@gmail.com, turboinsta@mail.ua, info@turboinsta.com.ua";

		if($theme){
			$theme = $theme;
		}

		$subject = "Order from turboinsta.com.ua. ".$theme;

		$headers  = "From: \"TurboInsta\" <info@turboinsta.com.ua>\r\n";

		$headers .= "X-Mailer: PHPMail Tool\r\n";

		if($_POST['name']){
  	$body  = "Имя: " . $_POST['name'];
  	}

  	$body .= "\nНомер телефона: " . $_POST['phone'];
		$body .= "\nСообщение: " . $_POST['msg'];
  	mail($emailTo, $subject, $body, $headers);

  	// Отправка заявки в телеграм
		$telegram_text = "*$theme*\r\n\n"."*Имя*: " . $_POST['name']."\r\n"."*Номер телефона*: " .$_POST['phone']."\r\n"."*Сообщение*: " .$_POST['msg'];
		include "telegram.php";

		$timetable = array(
			1 => array('08:30', '19:00'),
			2 => array('08:30', '19:00'),
			3 => array('08:30', '19:00'),
			4 => array('08:30', '19:00'),
			5 => array('08:30', '19:00'),
			6 => array('08:30', '17:00'),
			7 => array(),
		);

		$currentDate = new DateTime();
		$day = new DateTime($currentDate->format('Y-m-d'));// 2017-12-05 00:00:00

		$weekDay = $currentDate->format('N'); // 6
		$currentTime = $currentDate->format('h:i:s'); // 20:55:22
		$time = $timetable[$weekDay];
		$isNeedSms = false;
		if (count($time) != 0) {
			$time1 = explode(':', $time[0]);
			$day1 = clone $day;
			$day2 = clone $day;
			$t1 = $day1->modify("{$time1[0]} hour {$time1[1]} minute");
			$time2 = explode(':', $time[1]);
			$t2 = $day2->modify("{$time2[0]} hour {$time2[1]} minute");
			if ($currentDate < $t1 || $currentDate > $t2) {
				$isNeedSms = true;
			}

		} else {
			$isNeedSms = true;
		}

		if ($isNeedSms) {
			include "smsc_api.php";
			list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, "Благодарим Вас за оставленную заявку на нашем сайте: turboinsta.com.ua. В рабочее время наш менеджер свяжется с Вами и проведет консультацию.",  0);
		}





	}


?>


	<title>Ваша заявка успешно отправлена</title>
	<!-- Style -->
 <!-- Bootstrap core CSS -->
 		<link href="css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap-reboot.min.css" rel="stylesheet">
    <!-- Style -->
    <link rel="stylesheet" href="css/main.min.css">
    <!-- Fonts -->
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
		<script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-92168083-1', 'auto');
        setTimeout(function() {
            ga('send', 'event', 'Новый посетитель', location.pathname);
        }, 15000);
    </script>
</head>

<body>
	<style>
	#step-one.step-one{
		background: -webkit-gradient(linear, left top, right top, from(#4776E6), to(#8E54E9));
    background: -webkit-linear-gradient(left, #4776E6 0, #8E54E9 100%);
    background: -o-linear-gradient(left, #4776E6 0, #8E54E9 100%);
    background: linear-gradient(90deg, #4776E6 0, #8E54E9 100%);
	}
	.step-two__action{
		margin-top: 15px;
		background: none;
		color: #ffffff;
		max-width: 100%;
	}
	.youtube{
		margin-top: 15px;
	}
	h3{
		font-size: 1.8rem;
	}
	.action, .action a{
		font-size: 1.6rem;
	}
	</style>
<div class="step-one" id="step-one">
        <header class="header d-flex align-items-center">
            <div class="container-fluid">
                <div class="row d-flex justify-content-between">
                    <div class="col-auto">
                        <div class="header__logo-block d-flex ">
                            <a href="#" class="header__logo-img d-flex">
                                <div class="header-logo-img d-inline-flex">
																<svg width="302px" height="143px" viewBox="0 0 302 143" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
																			<!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
																			<title>logo1</title>
																			<desc>Created with Sketch.</desc>
																			<defs></defs>
																			<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<g id="Artboard" transform="translate(-161.000000, -118.000000)" fill-rule="nonzero">
																							<g id="logo1" transform="translate(158.000000, 114.000000)">
																									<g id="1" transform="translate(3.000000, 21.000000)" fill="#FFFFFF">
																											<path d="M218.1,44.9 L199.5,44.9 C197.5,44.9 196.7,45.6 196.3,47.6 L191,78 L203.5,78 L204.5,72.2 L211.8,72.2 C214.5,72.2 215.7,73.3 215.2,75.9 C215.1,76.8 214.8,77.5 214.4,78 L228,78 L228,77.9 C228.9,72.4 227.4,68.3 223.6,66.5 L223.7,66.2 C227.3,64 229.1,61.6 229.9,57.3 C231.4,49.9 226.9,44.9 218.1,44.9 Z M217,58.7 C216.6,61.2 215,62.1 212.5,62.1 L206.4,62.1 L207.6,55.1 L213.7,55.1 C216.3,55.1 217.4,56.2 217,58.7 Z M71.3,56.1 L80.7,56.1 L75.2,87.3 C74.8,89.3 75.4,90 77.4,90 L84.6,90 C86.6,90 87.4,89.3 87.8,87.3 L93.3,56.1 L102.7,56.1 C104.7,56.1 105.5,55.4 105.9,53.4 L106.9,47.7 C107.3,45.7 106.7,45 104.7,45 L73.3,45 C71.3,45 70.5,45.7 70.1,47.7 L69.1,53.4 C68.8,55.4 69.3,56.1 71.3,56.1 Z M122.9,47.7 C123.3,45.7 122.7,45 120.7,45 L113.5,45 C111.5,45 110.7,45.7 110.3,47.7 L106,72.4 C104.1,83 109.5,91 122.1,91 C124.1,91 126,90.8 127.7,90.5 L129.5,80.1 C129.5,79 130.4,78.2 131.4,78.2 L142.8,78.2 C143.2,77.1 143.5,75.9 143.7,74.6 L148.4,47.8 C148.8,45.8 148.1,45.1 146.2,45.1 L139,45.1 C137,45.1 136.2,45.8 135.9,47.8 L131.3,74 C130.7,77.7 128.1,79.8 123.8,79.8 C119.4,79.8 117.6,77.7 118.2,74 L122.9,47.7 Z M258.8,73.8 C258.5,75.7 257.6,77.1 256.4,78.1 L270.2,78.1 C270.7,76.8 271,75.5 271.3,74 L273.3,62.5 C275.2,51.5 269.4,44 256.9,44 C244.4,44 236.5,50.2 234.6,61.1 L232.6,72.6 C232.3,74.5 232.2,76.4 232.4,78.1 L245.8,78.1 C244.9,77.1 244.6,75.6 245,73.8 L247.2,61.3 C247.9,57.3 250.8,55.2 255.2,55.2 C259.6,55.2 261.7,57.3 261,61.3 L258.8,73.8 Z M205.5,7.9 C232.8,6.3 257.7,4.6 277.6,11.8 C286,14.8 290.1,18.1 292,20.9 C292.5,22 292.7,23.9 291.2,26.4 C289,30.2 270.7,42.6 270.7,42.6 L273.1,45.5 C273.1,45.5 289.1,33.4 293.3,27 C293.2,27.2 293.2,27.4 293.2,27.4 C293.8,26.5 294.2,25.7 294.6,24.9 C295.5,23.1 296.1,21.3 296.1,19.6 L295.9,19.6 C295.8,4.3 258.3,-1.7 204.6,2.1 C173.8,4.3 140.8,11.1 115.2,18.5 C88.7,26.1 70.2,34.3 70.2,34.3 L74.1,39.2 C105,22.8 178.2,9.5 205.5,7.9 Z M188.8,60.8 C190.6,51 185.3,45 175.8,45 L157.8,45 C155.8,45 155,45.7 154.6,47.7 L149.3,78.1 L161.8,78.1 L162.3,75 L163.9,75 C166.6,75 167.1,76 167.8,78.1 L181.7,78.1 L181,76.1 C180.6,75.1 180.2,74.2 179.8,73.4 C184.4,70.9 187.7,66.9 188.8,60.8 Z M175.8,60.2 C175.4,62.8 173.6,64.4 170.9,64.4 L164.1,64.4 L165.6,56 L172.4,56 C175.1,56.1 176.3,57.7 175.8,60.2 Z M186.5,80.1 L179.9,80.1 C177.9,80.1 177.1,80.8 176.8,82.8 L175,93.2 C173.9,99.7 174.2,102.7 175,109.2 L174.5,109.2 C173.6,105 173,101.5 171.2,97.6 L163.7,81.4 C163.3,80.5 162.6,80.1 161.2,80.1 L154,80.1 C152,80.1 151.2,80.8 150.8,82.8 L143.8,122.4 C143.4,124.4 144,125.1 146,125.1 L152.6,125.1 C154.6,125.1 155.4,124.4 155.8,122.4 L157.6,112.1 C158.8,105.1 158.7,101.8 158.4,95.8 L158.9,95.8 C159.6,101.5 160.2,104.6 162.2,108.8 L169.2,123.8 C169.6,124.7 170.2,125.1 171.5,125.1 L178.5,125.1 C180.5,125.1 181.3,124.4 181.7,122.4 L188.7,82.8 C189.1,80.8 188.5,80.1 186.5,80.1 Z M142.3,80.1 L134.8,80.1 C132.9,80.1 132.2,80.7 131.8,82.6 L124.8,122.5 C124.5,124.4 125,125 126.9,125 L134.4,125 C136.3,125 137.1,124.4 137.4,122.5 L144.4,82.6 C144.8,80.7 144.2,80.1 142.3,80.1 Z M268.4,88.4 L269.4,82.7 C269.8,80.7 269.2,80 267.2,80 L235.9,80 C233.9,80 233.1,80.7 232.7,82.7 L231.7,88.4 C231.4,90.4 231.9,91.1 233.9,91.1 L243.3,91.1 L237.8,122.3 C237.4,124.3 238,125 240,125 L247.2,125 C249.2,125 250,124.3 250.4,122.3 L255.9,91.1 L265.3,91.1 C267.3,91.2 268.1,90.5 268.4,88.4 Z M212.8,79.1 C200.7,79.1 193.6,83.8 192.1,92.2 C190,104.5 199.8,106.9 207,107.9 C211.1,108.5 214.2,109.2 213.8,111.6 C213.3,114.3 210.6,115.2 206.3,115.2 C202.8,115.2 200.5,114.1 199.8,111.8 C199.2,110 198.3,109.8 196.3,110.4 L190,112.6 C188,113.3 187.3,114.2 187.7,116.1 C189,122.6 195.7,125.9 205.1,125.9 C216.8,125.9 224.7,121.9 226.4,112.6 C228.5,101 219.4,97.7 212.3,96.7 C207.7,96.1 204.2,95.6 204.6,92.8 C205,90.6 206.9,89.5 211.2,89.5 C214.1,89.5 216.2,90.4 217,92.8 C217.7,94.6 218.3,94.9 220.2,94.1 L226.5,91.6 C228.5,90.8 229,90.1 228.4,88.3 C226.6,82.6 222.2,79.1 212.8,79.1 Z M6.8,95.6 C3.7,93.9 1.2,88.8 1.9,86.8 L1.9,86.7 C4.4,81.6 11.5,73.2 31.1,61.5 C31.1,61.5 31.8,57 28.2,57.6 C28.2,57.6 2.7,72.8 0.4,86.9 C-2.18991492e-14,88.2 0.2,89.8 0.4,90.9 C0.4,91.1 0.5,91.3 0.5,91.5 C0.6,91.9 0.7,92.3 0.8,92.5 C0.8,92.6 0.9,92.7 0.9,92.7 C9.7,115.9 124.6,101.5 124.6,101.5 L123.6,95.7 C51.8,107.7 19.2,102.4 6.8,95.6 Z M31.1,48.2 L34.2,49.6 C35.1,50 35.8,50.7 36.3,51.5 L37.3,53.3 L34.9,54.7 C34.5,55 34.3,55.5 34.6,55.9 L35.4,57.3 C35.7,57.7 36.2,57.9 36.7,57.6 L39.1,56.2 L40.1,58 C40.6,58.8 40.8,59.8 40.7,60.7 L40.5,64.1 C40.5,64.4 40.6,64.7 40.9,64.9 C41.2,65.1 41.6,65.1 41.8,64.9 L46.7,62 C48.5,61 49.6,59.1 49.8,57.1 L49.9,56.1 L54,53.7 C63.2,48.3 66.6,41.2 67.6,38.5 C67.7,38.2 67.7,37.9 67.5,37.6 C67.3,37.3 67.1,37.2 66.8,37.1 C63.9,36.6 56.1,36 46.8,41.4 L42.7,43.8 L41.7,43.4 C39.9,42.6 37.7,42.7 35.9,43.7 L31,46.6 C30.7,46.8 30.5,47.1 30.5,47.4 C30.6,47.8 30.8,48.1 31.1,48.2 Z M54.1,41.9 C55.6,41 57.6,41.5 58.4,43 C59.3,44.5 58.7,46.4 57.2,47.3 C55.7,48.2 53.8,47.7 52.9,46.2 C52,44.7 52.5,42.8 54.1,41.9 Z M301,122.4 L293.5,82.1 C293.2,80.5 292.4,80 290.5,80 L283.3,80 C281.5,80 280.6,80.4 279.6,82.2 L258,122.4 C257.1,124.1 257.2,125 259.2,125 L266.2,125 C269.4,125 270.3,124.3 271.3,122.3 L273.5,117.7 L287.2,117.7 L287.8,122.3 C288,124.3 288.8,125 292,125 L298.6,125 C300.7,125 301.3,124.1 301,122.4 Z M278.2,107.9 L281.8,100.4 C283.8,96.2 284.6,91.6 284.6,91.6 L285.2,91.6 C285.2,91.6 284.5,96.2 285,100.5 L286,107.9 L278.2,107.9 Z" id="Shape"></path>
																									</g>
																									<g id="santa-hat" transform="translate(47.500000, 47.500000) rotate(9.000000) translate(-47.500000, -47.500000) translate(6.000000, 6.000000)">
																											<path d="M68.8170654,25.3641091 C59.6298104,6.89100733 48.0825355,0.00358222857 42.9700811,0.00358222857 C41.0507957,-0.0446158596 39.1502199,0.394231817 37.44455,1.27927942 C36.43553,1.89409097 35.1611583,1.85716633 34.188907,1.18517061 C32.5950069,0.42069992 30.8532192,0.0173064299 29.0868649,0.00358222857 C24.3978995,0.00358222857 11.5803202,14.991227 10.035716,22.3108011 C9.93566003,22.7985004 10.0480807,23.3059691 10.3446694,23.7049512 L20.5625825,37.3891237 C20.9548345,38.8321254 21.5725786,41.8192632 22.2215596,44.96668 C23.3530871,50.4529295 24.6510492,56.670973 25.6922823,59.8219843 C25.8769385,60.3627832 26.3140937,60.7784304 26.8618799,60.933808 C27.021156,60.9785751 27.185801,61.0007952 27.3512595,60.9999783 C27.7544119,60.9991614 28.1445489,60.857508 28.4549665,60.5991989 L68.3688471,27.4867856 C68.9924481,26.9701675 69.1780804,26.0900214 68.8170654,25.3641091 Z" id="Shape" fill="#F44336"></path>
																											<path d="M78.6664272,28.3155998 C72.9063223,22.5831338 63.5786031,22.5584207 57.787802,28.2601579 C56.8055243,29.1516183 55.0778847,30.6256253 52.9111918,32.4674023 C44.6211014,39.5361647 30.7402249,51.3672408 26.3792452,57.7874467 C20.5734225,63.5223514 20.5355421,72.8580539 26.2948307,78.6392957 C32.0541193,84.4205376 41.4295154,84.4582576 47.2353381,78.7233528 C48.4946977,77.4794054 49.5192643,76.0201939 50.260381,74.4154676 C55.4320337,68.0856597 61.5048151,62.5421189 68.2862211,57.9609262 C72.0646266,55.4164514 75.5504387,52.465511 78.6803058,49.1612706 C84.4453091,43.3961248 84.4391045,34.0731041 78.6664272,28.3155998 Z" id="Shape" fill="#E4E4E9"></path>
																											<path d="M21.6917366,30.9999994 C20.7553469,30.9978332 19.9979378,30.2003128 20.0000042,29.2186594 C20.00064,28.901051 20.0825006,28.5892749 20.2370025,28.3159917 C20.6609291,27.5659625 24.523159,21 29.3044528,21 C30.2408425,21 31,21.795854 31,22.7775074 C31,23.7591607 30.2408425,24.5550147 29.3044528,24.5550147 C27.0427164,24.5550147 24.1806162,28.3124923 23.1498087,30.1326585 C22.843666,30.6710598 22.2897162,31.0004993 21.6917366,30.9999994 Z" id="Shape" fill="#D32F2F"></path>
																											<circle id="Oval" fill="#E4E4E9" cx="12" cy="33" r="12"></circle>
																									</g>
																							</g>
																					</g>
																			</g>
																	</svg>
                                </div>
                                <p class="header__logo-about">Эффективное продвижение
                                    <br> Online</p>
                            </a>
                        </div>
                        <!-- /.header__logo -->
                    </div>
                    <!-- /.col-lg-6 -->
                    <div class="col-auto d-flex align-items-center justify-content-end">
                        <nav class="d-flex align-items-center justify-content-end">
                            <ul class="d-flex align-items-center header__menu">

                                <li>
                                    <a href="tel:+380931702224" class="header__menu-link header__menu-button btn" data-type="color"  onclick="ga('send', 'event', 'brief', 'Click');">+380931702224</a>
                                </li>
                                <!-- /.header__menu-link -->
                            </ul>
                        </nav>
                        <!-- /.header__menu -->
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </header>
        <!-- /.header -->
        <div class="step-one__block">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <h1 class="main-title">Привлекаем качественную аудиторию из интернета и социальных сетей</h1>
                        <!-- /.main-title -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="step-one__advantages">
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-auto col-lg-auto col-md-auto">
												<div class="step-one__video youtube"  style="max-width: 100%; max-height: 100%;">
												<iframe width="560" height="315" src="//www.youtube.com/embed/FtGNBxSMilQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
											</div>
                            <!-- /.step-one__video -->
                        </div>
                    </div>
										<!-- /.row -->
										<div class="row d-flex justify-content-center">
											<h2 class="title" style="color: #fff">Благодарим Вас за оставленную заявку!</h2>
											<!-- /.h2 -->
											</div>
										<!-- /.row -->
											<h2 class="title d-flex justify-content-center" style="color: #fff">Мы вскоре свяжемся с Вами</h2>
											<h3 class="step-two__action">Привлекайте своих друзей, у нас действует акция: <br>Продвигайте больше - Платите меньше! При покупке продвижения на 2 аккаунта сразу Вы получите -10% скидки, <br>3 аккаунта -15%, 4 акаунта и более -20%</p>
											<h3 class="step-two__action action">Если Вы хотите еще раз ознакомиться с нашим сайтом и услагами, нажмите: <a href="javascript: history.back(-1);" style="text-decoration: none; border-bottom: 1px dotted" >Вернуться назад</a>

                </div>
                <!-- /.step-one__advantages -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.step-one__block -->

    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
		 <!-- Snowfall -->
    <script src="js/library/snowfall.js"></script>
    <!-- Index JS -->
    <script src="js/index-min.js "></script>
    <script type="text/javascript ">
        $(document).snowfall({
            flakeCount: 100,
            image: "img/snow/2.png",
            minSize: 5,
            maxSize: 10,
            round: true,
            shadow: false,
        });
    </script>
</body>

</html>