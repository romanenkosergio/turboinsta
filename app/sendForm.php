<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ваша форма успешно отправлена</title>
	<!-- Style -->
<?php
require __DIR__ . '/vendor/autoload.php';
// include_once __DIR__ . '/unsorted/accept.php';
$formName = $_POST['formName'];
$formCity = $_POST['formCity'];
$formSearch = $_POST['formSearch'];
$formMassanger = $_POST['formMassanger'];
$formPhone = $_POST['formPhone'];
$formEmail = $_POST['formEmail'];
$formInstagram = $_POST['formInstagram'];
$formSite = $_POST['formSite'];
$formText = $_POST['formText'];
$formOld = $_POST['formOld'];
$formGeo = $_POST['formGeo'];
$formPromo = $_POST['formPromo'];
$formGender = $_POST['formGender'];
$formAge = $_POST['formAge'];
$formIntersting = $_POST['formIntersting'];
$formCompetitor = $_POST['formCompetitor'];
$formBudget = $_POST['formBudget'];

$ageForm = implode(",", $formAge);
$formPhone = preg_replace('![^0-9]+!', '', $formPhone);
try {

    // Создание клиента
    $subdomain = 'turboinsta'; // Поддомен в амо срм
    $login = 'turboinsta.com.ua@gmail.com'; // Логин в амо срм
    $apikey = 'feb8f31899f8afc44a02bf56fd7d0553'; // api ключ

    $amo = new \AmoCRM\Client($subdomain, $login, $apikey);
		// Вывести полученые из амо данные

		$contacts = $amo->contact->apiList([
			"query" => $formPhone,
			"limit_rows" => 1
		]);
		$companys = $amo->company->apiList([
			"query" => $formPhone,
			"limit_rows" => 1
		]);
		$contactsId = $contacts[0][id];
		$companysId = $companys[0][id];
		if(count($contacts) > 0 && count($companys) == 0) {
			$lead = $amo->lead;
			$lead['name'] =  $formPromo;
			$lead['responsible_user_id'] = 13823083; // ID ответсвенного
			$lead['pipeline_id'] = 23076754; // ID воронк
			$lead->addCustomField(305117, [ // ID  поля в которое будт приходить заявки
					[$_POST['name']], // сюда вписать значение из атрибута "name" пример: <input name="phone">
			]);
			$id = $lead->apiAdd();

			$company = $amo->company;
			// Настройка компании
			$company['linked_leads_id'] = [(int)$id];
			// Добавление поля Имя
			$company['name'] = $formText;
			// Добавление поля телефон
			$company['phone'] = $formPhone;
			$company->addCustomField(90897,[
			[$formPhone,'WORK'],
			]);
			$company->addCustomField(90899,[
			[$formEmail,'WORK'],
			]);
			$company->addCustomField(90901, $formInstagram);
			$company->addCustomField(90905, $formCity);
			$company->addCustomField(204907, $formSite);
			$company['responsible_user_id'] = 13823083;
			$company['date_create'] = '0 DAY';

			$companyId = $company->apiAdd();

			$contact = $amo->contact;
			$contact['linked_leads_id'] = [(int)$id];
			$contact['linked_company_id'] = [(int)$companyId];
			// Добавление поля Имя
			$contact['name'] = $formName;


			// Добавление поля телефон
			$contact['phone'] = $formPhone;
			$contact->addCustomField(90897,[
			[$formPhone,'WORK'],
			]);
			// Добавление поля почта
			$contact->addCustomField(90899, [
				[$formEmail, 'WORK'],
			]);
			// Добавление поля SKYPE
			$contact->addCustomField(90903, [
				[$formMassanger, 'SKYPE'],
			]);
			// Добавление поля Пакет услуг
			$contact->addCustomField(596303, $formPromo);
			// Добавления поля Возраст аккаунта
			$contact->addCustomField(599413, $formOld);
			// Добавления поля География работы
			$contact->addCustomField(599415, $formGeo);
			// Добавления поля Пол аудитории
			$contact->addCustomField(599417, $formGender);
			// Добавления поля Возраст аудитории
			$contact->addCustomField(599441, $ageForm);
			// Добавления поля Интересы аудитории
			$contact->addCustomField(599561, $formIntersting);
			// Добавления поля Конкуренты
			$contact->addCustomField(599423, $formCompetitor);
			// Добавления поля Бюджет
			$contact->addCustomField(599425, $formBudget);
			// Добавления поля Описание
			$contact->addCustomField(599459, $formText);

			$contact->apiUpdate((int)$contactsId);

			$task = $amo->task;
			// $task->debug(true); // Режим отладки
			$task['element_id'] = $contactsId;
			$task['element_type'] = 1;
			$task['date_create'] = '0 DAY';
			$task['task_type'] = 501964;
			$task['text'] = "Отправить договор на ".$formPromo;
			$task['responsible_user_id'] = 13823083;
			$task['complete_till'] = '0 DAY';

			$taskId = $task->apiAdd();

			$link = $amo->links;
    	$link['from'] = 'company';
    	$link['from_id'] = $companyId;
    	$link['to'] = 'contacts';
			$link['to_id'] = $contactsId;
			$link->apiLink();
			// print_r($contactsId);
			// print_r($companyId);

		}else if (count($contacts) > 0 && count($companys) > 0){
			// $lead = $amo->lead;
			// $lead['name'] =  $formPromo;
			// $lead['responsible_user_id'] = 13823083; // ID ответсвенного
			// $lead['pipeline_id'] = 23076754; // ID воронк
			// $lead->addCustomField(305117, [ // ID  поля в которое будт приходить заявки
			// 		[$_POST['name']], // сюда вписать значение из атрибута "name" пример: <input name="phone">
			// ]);
			// $id = $lead->apiAdd();
			// $lead->apiUpdate((int)$id);

				$company = $amo->company;
			// Настройка компании
			// $company['linked_leads_id'] = [(int)$id];
			// Добавление поля Имя
			$company['name'] = $formText;
			// Добавление поля телефон
			$company['phone'] = $formPhone;
			$company->addCustomField(90897,[
			[$formPhone,'WORK'],
			]);
			$company->addCustomField(90899,[
			[$formEmail,'WORK'],
			]);
			$company->addCustomField(90901, $formInstagram);
			$company->addCustomField(90905, $formCity);
			$company->addCustomField(204907, $formSite);
			$company['responsible_user_id'] = 13823083;
			$company['date_create'] = '0 DAY';

			$company->apiUpdate((int)$companysId);

			$contact = $amo->contact;
			// $contact['linked_leads_id'] = [(int)$id];
			$contact['linked_company_id'] = [(int)$companysId];
			// Добавление поля Имя
			$contact['name'] = $formName;


			// Добавление поля телефон
			$contact['phone'] = $formPhone;
			$contact->addCustomField(90897,[
			[$formPhone,'WORK'],
			]);
			// Добавление поля почта
			$contact->addCustomField(90899, [
				[$formEmail, 'WORK'],
			]);
			// Добавление поля SKYPE
			$contact->addCustomField(90903, [
				[$formMassanger, 'SKYPE'],
			]);
			// Добавление поля Пакет услуг
			$contact->addCustomField(596303, $formPromo);
			// Добавления поля Возраст аккаунта
			$contact->addCustomField(599413, $formOld);
			// Добавления поля География работы
			$contact->addCustomField(599415, $formGeo);
			// Добавления поля Пол аудитории
			$contact->addCustomField(599417, $formGender);
			// Добавления поля Возраст аудитории
			$contact->addCustomField(599441, $ageForm);
			// Добавления поля Интересы аудитории
			$contact->addCustomField(599561, $formIntersting);
			// Добавления поля Конкуренты
			$contact->addCustomField(599423, $formCompetitor);
			// Добавления поля Бюджет
			$contact->addCustomField(599425, $formBudget);
			// Добавления поля Описание
			$contact->addCustomField(599459, $formText);


			$contact->apiUpdate((int)$contactsId);

			$task = $amo->task;
			// $task->debug(true); // Режим отладки
			$task['element_id'] = $contactsId;
			$task['element_type'] = 1;
			$task['date_create'] = '0 DAY';
			$task['task_type'] = 501964;
			$task['text'] = "Отправить договор на ".$formPromo;
			$task['responsible_user_id'] = 13823083;
			$task['complete_till'] = '0 DAY';

			$taskId = $task->apiAdd();

			$link = $amo->links;
    	$link['from'] = 'company';
    	$link['from_id'] = $companysId;
    	$link['to'] = 'contacts';
    	$link['to_id'] = $contactsId;
			$link->apiLink();

		} else if (count($contacts) == 0 && count($companys) == 0) {
			$lead = $amo->lead;
			$lead['name'] =  $formPromo;
			$lead['responsible_user_id'] = 13823083; // ID ответсвенного
			$lead['pipeline_id'] = 23076754; // ID воронк
			$lead->addCustomField(305117, [ // ID  поля в которое будт приходить заявки
					[$_POST['name']], // сюда вписать значение из атрибута "name" пример: <input name="phone">
			]);
			$id = $lead->apiAdd();

			$company = $amo->company;
			// Настройка компании
			$company['linked_leads_id'] = [(int)$id];
			// Добавление поля Имя
			$company['name'] = $formText;
			// Добавление поля телефон
			$company['phone'] = $formPhone;
			$company->addCustomField(90897,[
			[$formPhone,'WORK'],
			]);
			$company->addCustomField(90899,[
			[$formEmail,'WORK'],
			]);
			$company->addCustomField(90901, $formInstagram);
			$company->addCustomField(90905, $formCity);
			$company->addCustomField(204907, $formSite);
			$company['responsible_user_id'] = 13823083;
			$company['date_create'] = '0 DAY';

			$companyId = $company->apiAdd();

			$contact = $amo->contact;
			$contact['linked_leads_id'] = [(int)$id];
			$contact['linked_company_id'] = [(int)$companyId];
			// Добавление поля Имя
			$contact['name'] = $formName;
			$contact->addCustomField(204967, [
				["0 DAYS"],
		]);

			// Добавление поля телефон
			$contact['phone'] = $formPhone;
			$contact->addCustomField(90897,[
			[$formPhone,'WORK'],
			]);
			// Добавление поля почта
			$contact->addCustomField(90899, [
				[$formEmail, 'WORK'],
			]);
			// Добавление поля SKYPE
			$contact->addCustomField(90903, [
				[$formMassanger, 'SKYPE'],
			]);
			// Добавление поля Пакет услуг
			$contact->addCustomField(596303, $formPromo);
			// Добавления поля Возраст аккаунта
			$contact->addCustomField(599413, $formOld);
			// Добавления поля География работы
			$contact->addCustomField(599415, $formGeo);
			// Добавления поля Пол аудитории
			$contact->addCustomField(599417, $formGender);
			// Добавления поля Возраст аудитории
			$contact->addCustomField(599441, $ageForm);
			// Добавления поля Интересы аудитории
			$contact->addCustomField(599561, $formIntersting);
			// Добавления поля Конкуренты
			$contact->addCustomField(599423, $formCompetitor);
			// Добавления поля Бюджет
			$contact->addCustomField(599425, $formBudget);
			// Добавления поля Описание
			$contact->addCustomField(599459, $formText);


			$contactId = $contact->apiAdd();

			$task = $amo->task;
			// $task->debug(true); // Режим отладки
			$task['element_id'] = $contactId;
			$task['element_type'] = 1;
			$task['date_create'] = '0 DAY';
			$task['task_type'] = 501964;
			$task['text'] = "Провести консультацию и отправить договор";
			$task['responsible_user_id'] = 13823083;
			$task['complete_till'] = '0 DAY';

			$taskId = $task->apiAdd();

			$link = $amo->links;
    	$link['from'] = 'company';
    	$link['from_id'] = $companyId;
    	$link['to'] = 'contacts';
    	$link['to_id'] = $contactId;
			$link->apiLink();
			// print_r($companyId);
			// print_r($contactId);
		}
		// echo '<pre>';
		// print_r($formAge);
		// print_r($contactId);
		// print_r($companysId);
		// echo '<pre>';
		// print_r($companyId);
		// echo '<pre>';
		// print_r($formMassanger);
		// echo '<pre>';
		// print_r($formPromo);
		// echo '<pre>';
		// print_r($amo->widgets->apiList());
		// echo '<pre>';
		// print_r($amo->account->apiCurrent());
    // echo '</pre>';


} catch (\AmoCRM\Exception $e) {
    printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
}
$subject = 'Форма с сайта';
$emailTo = "turboinsta.com.ua@gmail.com, turboinsta@mail.ua, info@turboinsta.com.ua";
$headers = "From: \"TurboInsta\" <info@turboinsta.com.ua>\r\n";
$headers .= "X-Mailer: PHPMail Tool\r\n";

$body  = "Фамилия и Имя: " . $formName;
$body .= "\nГород проживания: " . $formCity;
$body .= "\nГде Вы нас нашли: " . $formSearch;
$body .= "\nТелефон: " . $formPhone;
$body .= "\nУкажите мессенджер, которым Вы пользуетесь: " . $formMassanger;
$body .= "\nE-mail: " . $formEmail;
$body .= "\nНазвание Вашего аккаунта: " . $formInstagram;
if ($formSite){
	$body .= "\nАдрес Вашего сайта: " . $formSite;
}
$body .= "\nОписание: " . $formText;
$body .= "\nВозраст аккаунта: " . $formOld;
$body .= "\nГеография работы аккаунта: " . $formGeo;
$body .= "\nУкажите какой пакет услуг Вас заинтересовал: " . $formPromo;
$body .= "\nПол Вашей аудитории: " . $formGender;
$body .= "\nОсновной возраст Вашей аудитории: " . $formAge;
$body .= "\nИнтересы Вашей аудитории: " . $formIntersting;
$body .= "\nКонкуренты: " . $formCompetitor;
$body .= "\nРекламный бюджет: " . $formBudget;

mail($emailTo, $subject, $body, $headers);
// Отправка заявки в телеграм
$telegram_text = "*$subject*\r\n\n" . "*Имя*: " . $formName . "\r\n" . "*Номер телефона*: " . $formPhone;
include "send/telegram.php";

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
$day = new DateTime($currentDate->format('Y-m-d')); // 2017-12-05 00:00:00

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
    list($sms_id, $sms_cnt, $cost, $balance) = send_sms($formPhone, "Благодарим Вас за заполненый бриф, в рабочее время наж менеджер с Вами свяжется", 0);
}
?>
	<!-- Style -->
	<link rel="stylesheet" href="css/main.min.css">
	<!-- <link rel="stylesheet" href="css/form.min.css"> -->
	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="114x114" href="img/fav/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/fav/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/fav/favicon-16x16.png">
	<link rel="manifest" href="img/fav/manifest.json">
	<link rel="mask-icon" href="img/fav/safari-pinned-tab.svg" color="#31004a">
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
		ga('send', 'event', 'Оставленная форма', location.pathname);
	}, 15000);
	</script>
</head>

<body>
	<style>
	.btn {
		border: none;
	}

	#step-one.step-one {
		background: -webkit-gradient(linear, left top, right top, from(#4776E6), to(#8E54E9));
		background: -webkit-linear-gradient(left, #4776E6 0, #8E54E9 100%);
		background: -o-linear-gradient(left, #4776E6 0, #8E54E9 100%);
		background: linear-gradient(90deg, #4776E6 0, #8E54E9 100%);
		z-index: 3;
	}
	.step-one {
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	.step-one__advantages {
		z-index: 3;
		margin-bottom: 20px
	}
	.step-one__text {
		margin: 60px 0;
		font-size: 24px;
		color: #fff;
		font-weight: 600;
		display: flex;
		text-align: center;
		line-height: normal;
	}
	.step-two__action{
		margin-top: 50px
	}
	.offer__title {
		font-size: 3rem;
		line-height: normal;
	}

	.youtube {
		z-index: 3;
		margin-top: 15px;
	}

	iframe {
		z-index: 3;
		max-width: 100%;
	}

	.nazad {
		font-size: 2rem;
		display: flex;
		width: max-content;
		align-self: center;
	}

	h3 {
		font-size: 1.8rem;
	}

	.action,
	.action a {
		font-size: 1.6rem;
	}
	@media ( max-width: 645px) {
		.step-one__text{
		font-size: 20px;
		}
	}
	</style>
	<div class="step-one">
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
						<a href="tel:+380931702224" class="header__menu-link"
							onclick="ga( 'send', 'event', 'Прямой набор номера', 'Нажатие номера на сайте');">Тел: +380931702224</a>
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
						<h1 class="offer__title">Комплексное продвижение в социальных сетях.</h1>
						<!-- /.main-title -->
						<h2 class="offer__second title">Мы работаем на качество аудитории!</h2>
						<!-- /.offer__subtitle title -->
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				<div class="step-one__advantages">
					<div class="row d-flex justify-content-center">


							<p class="step-one__text">Благодарим Вас за заполненный БРИФ. В ближайшее время мы отправим  на Вашу почту наш договор для ознакомления, согласно пакету услуг который Вы выбрали, и с Вами свяжется наш менеджер для уточнения вопросов, которые у Вас могли возникнуть.</p>


					</div>
					<!-- /.row -->
					<div class="row d-flex flex-column justify-content-center">

						<!-- /.h2 -->
						<a class="nazad" href="javascript: history.back(-1);"
							style="text-decoration: none; border-bottom: 1px dotted; text-align: center">Вернуться
							назад
						</a>
					</div>
					<!-- /.row -->
				</div>
				<!-- /.step-one__advantages -->
				<div class="step-two__action">
					<div class="row flex-xl-row flex-column justify-content-center">
					<div class="step-two__sale_main">
						<img data-src="img/step-two/sale.svg" alt="Акция" class="lazy">
						<p><span>АКЦИЯ!!!</span> <br>продвигайте больше - платите меньше</p>
					</div>
					<div class="step-two__sale_block">
						<div class="step-two__sale_action">
							<img data-src="img/step-two/10.svg" alt="" class="lazy">
							<p>
								При покупке продвижения<br> 2-х аккаунтов
							</p>
						</div>
						<!-- /.step-two__sale_action -->
						<div class="step-two__sale_action">
							<img data-src="img/step-two/15.svg" alt="" class="lazy">
							<p>
								При покупке продвижения<br> 3-х аккаунтов
							</p>
						</div>
						<!-- /.step-two__sale_action -->
						<div class="step-two__sale_action">
							<img data-src="img/step-two/20.svg" alt="" class="lazy">
							<p>
								При покупке продвижения<br> 4-х и более аккаунтов
							</p>
						</div>
						<!-- /.step-two__sale_action -->
					</div>
					<!-- /.ste-two__sale-block -->
					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /.step-one__block -->
</div>
		<script src="js/form.min.js"></script>
</body>

</html>