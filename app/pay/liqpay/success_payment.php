
<?php
session_start();
// include "order.php";
$name = $_COOKIE['name'];
$phone = $_COOKIE['phone'];
$price = $_COOKIE['price'];
$theme = $_COOKIE['theme'];
$header = $_COOKIE['theme'];
$header = 'Оплата услуги ' . $theme;
$mess = "Имя: <b>" . $name . "</b><br />";
$mess .= "Телефон: <b>" . $phone . "</b><br />";
$mess .= "Пакет: <b>" . $theme . "</b><br />";
if ($name) {
    mail("info@turboinsta.com.ua", $header, $mess, "From: Turboinsta.com.ua <info@turboinsta.com.ua>\nContent-Type: text/html;\n charset=utf-8\nX-Priority: 0");

    $telegram_text = "*$header*\r\n\n" . "*Имя*: " . $name . "\r\n" . "*Номер телефона*: " . $phone;
    include "../../send/telegram.php";
}
?>
<!DOCTYPE html>
<html>
<head>
		<title>Успешно проведенная оплата</title>
		 <!-- Favicon -->
		 <link rel="stylesheet" href="../../css/main.min.css">
		<link rel="apple-touch-icon" sizes="114x114" href="../../img/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../img/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../img/fav/favicon-16x16.png">
    <link rel="manifest" href="../../img/fav/manifest.json">
		<link rel="mask-icon" href="../../img/fav/safari-pinned-tab.svg" color="#31004a">
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
            ga('send', 'event', 'Произведенная оплата', location.pathname);
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
		text-align: center;
		line-height: 38px;
	}
	.step-one__text a {
    font-weight: 300;
    position: relative;
    display: inline
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
									<img src="../img/logo.svg" alt="">
								</div>
								<p class="header__logo-about">Профессиональная настройка
                                <br> таргетированной рекламы
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


							<p class="step-one__text">Спасибо что выбрали нас! <br>Убедительная просьба, для скорейшего подтверждения Вашей оплаты, позвоните нам по номеру: <br><a href="tel:+380931702224">+38 (093) 170 22 24</a> и мы сразу приступим к работе.</p>


					</div>
					<!-- /.row -->
					<div class="row d-flex flex-column justify-content-center">

						<!-- /.h2 -->
						<a class="nazad" href="../../index.php"
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
						<img data-src="../../img/step-two/sale.svg" alt="Акция" class="lazy">
						<p><span>АКЦИЯ!!!</span> <br>продвигайте больше - платите меньше</p>
					</div>
					<div class="step-two__sale_block">
						<div class="step-two__sale_action">
							<img data-src="../../img/step-two/10.svg" alt="" class="lazy">
							<p>
								При покупке продвижения<br> 2-х аккаунтов
							</p>
						</div>
						<!-- /.step-two__sale_action -->
						<div class="step-two__sale_action">
							<img data-src="../../img/step-two/15.svg" alt="" class="lazy">
							<p>
								При покупке продвижения<br> 3-х аккаунтов
							</p>
						</div>
						<!-- /.step-two__sale_action -->
						<div class="step-two__sale_action">
							<img data-src="../../img/step-two/20.svg" alt="" class="lazy">
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

<script src="../../js/index.min.js"></script>
</body>
</html>
