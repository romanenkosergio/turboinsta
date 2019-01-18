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
	.btn{
		border: none;
	}
	#step-one.step-one{
		background: -webkit-gradient(linear, left top, right top, from(#4776E6), to(#8E54E9));
    background: -webkit-linear-gradient(left, #4776E6 0, #8E54E9 100%);
    background: -o-linear-gradient(left, #4776E6 0, #8E54E9 100%);
    background: linear-gradient(90deg, #4776E6 0, #8E54E9 100%);
	}
	.offer__title{
		font-size: 3rem;
		line-height: normal;
	}
	.youtube{
		margin-top: 15px;
	}
	.nazad{
		font-size: 2rem;
		display: flex;
    width: max-content;
    align-self: center;

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
										<div class="header__logo-block d-flex">
                        <a href="#" class="header__logo-img d-flex">
                            <div class="header-logo-img d-inline-flex">
                                <img src="img/logo.svg" alt="">
                            </div>
                            <p class="header__logo-about">Эффективное продвижение
                                <br> Online
                            </p>
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
        <div class="offer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<h1 class="offer__title">Комплексное продвижение в социальных сетях,<br>мы работаем на качество аудитории, а не количество!</h1>
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
										<div class="row d-flex flex-column justify-content-center">
											<h2 class="title" style="color: #fff">Благодарим Вас за оставленную заявку!</h2>
											<!-- /.h2 -->
											<a  class="nazad"href="javascript: history.back(-1);" style="text-decoration: none; border-bottom: 1px dotted; text-align: center" >Вернуться назад</a>
										</div>
										<!-- /.row -->


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