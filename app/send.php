<?
  $query = $_POST["query"];
	$theme = $query['theme'];
  $body = '';
	$phone = $query['phone'];
	$msg = $query['msg'];
if ($query) {
    $phone = $query['phone'];

	$emailTo = "turboinsta.com.ua@gmail.com, turboinsta@mail.ua, info@turboinsta.com.ua";
	if($query['theme']){
		$theme = $query['theme'];
	}

	$subject = "Order from turboinsta.com.ua. ".$theme;

	$headers  = "From: \"TurboInsta\" <info@turboinsta.com.ua>\r\n";

	$headers .= "X-Mailer: PHPMail Tool\r\n";

	if($query['name']){
  	$body  = "Имя: " . $query['name'];
  }

  $body .= "\nНомер телефона: " . $query['phone'];
	$body .= "\nСообщение: " . $query['msg'];
  mail($emailTo, $subject, $body, $headers);

  // Отправка заявки в телеграм
	$telegram_text = "*$theme*\r\n\n"."*Имя*: " . $query['name']."\r\n"."*Номер телефона*: " .$query['phone']."\r\n"."*Сообщение*: " .$query['msg'];
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
