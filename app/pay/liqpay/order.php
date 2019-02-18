
<?php
session_start();
	$query = $_POST["query"];


	$name = $query['name'];
	$phone = $query['phone'];
	$price = $query['price'];
	$theme = $query['theme'];
	$phone = preg_replace('![^0-9]+!','',$phone);
	$price = preg_replace('![^0-9]+!','',$price);
	// print_r($theme);
	// print_r($price);
	$ip = $_SERVER['REMOTE_ADDR'];

	$Nzakaz = rand(10000, 99999);

	$mess  = "Имя: <b>".$name."</b><br />";
	$mess .= "Телефон: <b>".$phone."</b><br />";
	$mess .= "Пакет: <b>".$theme."</b><br />";

	setcookie("name", $name);
	setcookie("phone", $phone);
	setcookie("price", $price);
	setcookie("theme", $theme);
	// mail("info@turboinsta.com.ua", $theme, $mess, "From: Turboinsta.com.ua <info@turboinsta.com.ua>\nContent-Type: text/html;\n charset=utf-8\nX-Priority: 0");

	// echo "<h3>Заявка удачно оформлена.</h3>";
	// echo "<p>Заявке присвоен номер Z".$Nzakaz.". Наш менеджер свяжется с вами в ближайшее время.</p>";

	//подключаем библиотеку liqpay
	require("LiqPay.php");
	//указываем публичный ключ liqpay
	$public_key = 'i1949437773';
	//указываем приватный ключ liqpay
	$private_key = 'aD87zROpMS6rEZi2EVxGFvMjGYRT77WEQunIT8CK';

	//создаем обьект класса LiqPay
	$liqpay = new LiqPay($public_key, $private_key);
	//Обращаемся к методу cnb_form указывая необходимые настройки для создания формы с кнопкой оплатить

	$html = $liqpay->cnb_form(array(
			'version'       => '3',
			'amount'        => $price,
			'currency'      => 'UAH',
			'description'   => 'Оплата услуги '.$theme,
			'order_id'      => $Nzakaz,
			'language'		=> 'ru',
			'type'			=> 'pay',
			'result_url'	=> 'https://turboinsta.com.ua/pay/liqpay/success_payment.php'
			// 'sandbox'		=> 1
	));
	echo $html;



?>

