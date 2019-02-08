<?php
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <!-- required="required" meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TurboINSTA - Форма обратной связи</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Style -->
    <link rel="stylesheet" href="css/form.min.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="114x114" href="img/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/fav/favicon-16x16.png">
    <link rel="manifest" href="img/fav/manifest.json">
    <link rel="mask-icon" href="img/fav/safari-pinned-tab.svg" color="#31004a">
    <meta property="og:title" content="TurboINSTA - Продвижение бизнеса в Instagram">
    <meta property="og:site_name" content="Продвижение бизнеса в Instagram">
    <meta property="og:url" content="//turboinsta.com.ua/">
    <meta property="og:description" content="Продвижение бизнеса в Instagram">
    <meta property="og:image" content="//turboinsta.com.ua/img/logo.svg">
    <meta name="google-site-verification" content="DDLHde4_VaME2UwORWTT0WkSSGks4l-e3odO007bJuw" />

    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq)
                return;
            n = f.fbq = function() {
                n.callMethod ?
                    n
                    .callMethod
                    .apply(n, arguments) :
                    n
                    .queue
                    .push(arguments)
            };
            if (!f._fbq)
                f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s
                .parentNode
                .insertBefore(t, s)
        }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1561750800588451');
        fbq('track', 'PageView');
    </script>
    <noscript>
    <img height="1" width="1" src="https://www.facebook.com/tr?id=1561750800588451&ev=PageView&noscript=1" />
  </noscript>
    <!-- End Facebook Pixel Code -->
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                },
                i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m
                .parentNode
                .insertBefore(a, m)
        })(
            window,
            document,
            'script',
            'https://www.google-analytics.com/analytics.js',
            'ga'
        );
        ga('create', 'UA-92168083-1', 'auto');
        setTimeout(function() {
            ga('send', 'event', 'Страница формы', location.pathname);
        }, 15000);
    </script>
</head>

<body>
    <section class="form">
        <header class="form__header">
            <img src="img/logo.svg" alt="Logotype" class="form__header-img">
        </header>
        <!-- /.form__header -->
        <div class="form__body">
            <h1>Форма для работы с нами</h1>
            <h4 class="form__subtitle">Все пункты обязательны для заполнения (где не знаете, что ответить, можете поставить прочерк)
            </h4>
            <span class="danger">* Обязательно</span>
            <!-- /.danger -->
            <form action="" method="POST" id="myForm">
                <div class="form__flag-block">
                    <div class="form__flag">
                        <p>
                            Контактные данные
                        </p>
                    </div>
                    <div class="form__flag_triangle">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 10 10" preserveAspectRatio="none">
                                      <polygon points="0,0 10,0 0,10">

                                      </polygon>
                                    </svg>
                    </div>
                    <!-- /.form__flag -->
                </div>
                <!-- /.form__flag-block -->
                <label for="" class="block">
          <h3>
            1) Фамилия и Имя <sup class="danger">*</sup>
          </h3>
          <h4>Представьтесь пожалуйста, напишите Ваши фамилию и имя.</h4>
          <input type="text" placeholder="Мой ответ" required="required" name="formName">
        </label>
                <label for="" class="block">
          <h3>
            2) Город проживания <sup class="danger">*</sup>
          </h3>
          <h4>Укажите город, в котором Вы на данный момент проживаете.</h4>
          <input type="text" placeholder="Мой ответ" required="required" name="formCity">
        </label>
                <label for="" class="block">
          <h3>
            3) Где Вы нас нашли <sup class="danger">*</sup>
          </h3>
          <h4>Укажите пожайлуйста, из какого источника Вы узнали о нашем сайте.</h4>
          <div class="input-body">
            <div class="input-body__contain">
              <input type="radio" name="formSearch" id="formSearch1" value="Google">
              <label for="formSearch1">Google</label>
                <!-- /.input-body__contain -->
        </div>
        <div class="input-body__contain">
            <input type="radio" name="formSearch" id="formSearch2" value="Instagram">
            <label for="formSearch2">Instagram</label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="radio" name="formSearch" id="formSearch3" value="Посоветовали Знакомые">
            <label for="formSearch3">Посоветовали Знакомые</label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="radio" name="formSearch" id="formSearch4" value="Facebook">
            <label for="formSearch4">Facebook</label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="radio" name="formSearch" id="formSearch5" value="Yandex">
            <label for="formSearch5">Yandex</label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="radio" name="formSearch" id="formSearch6" value="Другое">
            <label for="formSearch6">Другое</label>
        </div>
        <!-- /.input-body__contain -->

        </div>
        <!-- /.input-body -->
        </label>
        <label for="" class="block">
          <h3>
            4) Телефон <sup class="danger">*</sup>
          </h3>
          <h4>Напишите Ваш контактный номер телефона, по которому с Вами будут связываться наши сотрудники в случае необходимости. Желательно заполнять в формате: 063 012-34-56</h4>
          <input type="tel" placeholder="Мой ответ" required="required" name="formPhone">
        </label>
        <label for="" class="block">
          <h3>
            5) Укажите мессенджер, которым Вы пользуетесь <sup class="danger">*</sup>
          </h3>
          <h4>Выберите один основной мессенджер, по которому Вам будет более удобно общаться с нашими специалистами, помимо Вашего телефона и e-mail.</h4>
          <div class="input-body">
          <div class="input-body__contain"><input type="radio" name="formMassanger" id="formMassanger1" value="Viber"><label for="formMassanger1">Viber</label></div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain"><input type="radio" name="formMassanger" id="formMassanger2" value="WhatsApp"><label for="formMassanger2">WhatsApp</label></div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain"><input type="radio" name="formMassanger" id="formMassanger3" value="Telegram"><label for="formMassanger3">Telegram</label></div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain"><input type="radio" name="formMassanger" id="formMassanger4" value="Facebook Messenger"><label for="formMassanger4">Facebook Messenger</label></div>
        <!-- /.input-body__contain -->
        </div>
        <!-- /.input-body -->
        </label>
        <label for="" class="block">
          <h3>
            6) E-mail <sup class="danger">*</sup>
          </h3>
          <h4>Напишите адрес Вашей электронной почты, которой вы постоянно пользуетесь!</h4>
          <input type="email" placeholder="Мой ответ" required="required" name="formEmail">
        </label>
        <div class="form__flag-block">
            <div class="form__flag">
                <p>
                    Информация о Вашем аккаунте в Instagram
                </p>
            </div>
            <div class="form__flag_triangle">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 10 10" preserveAspectRatio="none">
                              <polygon points="0,0 10,0 0,10">

                              </polygon>
                            </svg>
            </div>
            <!-- /.form__flag -->
        </div>
        <!-- /.form__flag-block -->
        <label for="" class="block">
            <h3>
                7) Название Вашего аккаунта <sup class="danger">*</sup>
            </h3>
            <h4>Напишите ссылку на Вашу страницу в Instagram, с которой мы будем работать.</h4>
            <input type="text" placeholder="Мой ответ" required="required" name="formInstagram">
          </label>
        <label for="" class="block">
              <h3>
                  8) Адрес Вашего сайта
              </h3>
              <h4>Если у Вас есть сайт, укажите его адрес.</h4>
              <input type="url" placeholder="Мой ответ" name="formSite">
            </label>
        <label for="" class="block">
                <h3>
                    9) Описание <sup class="danger">*</sup>
                </h3>
                <h4>Раскрыто напишите описание Вашей деятельности, чем занимается Ваша компания?</h4>
                <input type="text" placeholder="Мой ответ" required="required" name="formText">
              </label>
        <label for="" class="block">
                <h3>
                    10) Возраст аккаунта <sup class="danger">*</sup>
                </h3>
                <h4>Укажите примерно сколько времени существует Ваша страница (примерную дату регистрации Вашего аккаунта)
                  </h4>
                <input type="text" placeholder="Мой ответ" required="required" name="formOld">
              </label>
        <label for="" class="block">
                <h3>
                    11) География работы аккаунта <sup class="danger">*</sup>
                </h3>
                <h4>Укажите с какой территорией Вы работаете, это может быть - Ваш город, область, вся Украина, страны СНГ или любая страна Мира.
                  </h4>
                <input type="text" placeholder="Мой ответ" required="required" name="formGeo">
              </label>
        <label for="" class="block">
                  <h3>
                      12) Укажите какой пакет услуг Вас заинтересовал <sup class="danger">*</sup>
                  </h3>
                  <h4>Выберете один из вариантов ответа.</h4>
                  <div class="input-body">
                    <div class="input-body__contain">
                      <input type="radio" name="formPromo" id="formPromo1" value="TURBO 3 месяца">
                      <label for="formPromo1">TURBO 3 месяца</label>
        <!-- /.input-body__contain -->
        </div>
        <div class="input-body__contain">
            <input type="radio" name="formPromo" id="formPromo2" value="TURBO 2 месяца">
            <label for="formPromo2">TURBO 2 месяца</label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="radio" name="formPromo" id="formPromo3" value="TURBO 1 месяц">
            <label for="formPromo3">TURBO 1 месяц</label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="radio" name="formPromo" id="formPromo4" value="TARGET">
            <label for="formPromo4">TARGET</label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="radio" name="formPromo" id="formPromo5" value="Дополнительные услуги">
            <label for="formPromo5">Дополнительные услуги</label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="radio" name="formPromo" id="formPromo6" value="Бизнес в интернете с нуля">
            <label for="formPromo6">Бизнес в интернете с нуля</label>
        </div>
        <!-- /.input-body__contain -->

        </div>
        <!-- /.input-body -->
        </label>
        <div class="form__flag-block">
            <div class="form__flag">
                <p>
                    Информация о Вашей целевой аудитории
                </p>
            </div>
            <div class="form__flag_triangle">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 10 10" preserveAspectRatio="none">
                              <polygon points="0,0 10,0 0,10">

                              </polygon>
                            </svg>
            </div>
            <!-- /.form__flag -->
        </div>
        <!-- /.form__flag-block -->
        <label for="" class="block">
            <h3>
                13) Пол Вашей аудитории <sup class="danger">*</sup>
            </h3>
            <h4>Выберете один из вариантов ответа.</h4>
            <div class="input-body">
              <div class="input-body__contain">
                <input type="radio" name="formGender" id="formGender1" value="Женщины">
                <label for="formGender1">Женщины</label>
        <!-- /.input-body__contain -->
        </div>
        <div class="input-body__contain">
            <input type="radio" name="formGender" id="formGender2" value="Мужчины">
            <label for="formGender2">Мужчины</label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="radio" name="formGender" id="formGender3" value="50 на 50">
            <label for="formGender3">50 на 50</label>
        </div>
        <!-- /.input-body__contain -->
        </div>
        </label>
        <label for="" class="block">
            <h3>
                14) Основной возраст Вашей аудитории <sup class="danger">*</sup>
            </h3>
            <h4>Вы можете выбрать несколько вариантов ответа.
              </h4>
              <div class="input-body">
                  <div class="input-body__contain">
                    <input type="checkbox" name="formAge[]" id="formAge1" value="до 18">
                    <label for="formAge1">до 18</label>
        <!-- /.input-body__contain -->
        </div>
        <div class="input-body__contain">
            <input type="checkbox" name="formAge[]" id="formAge2" value="18-24">
            <label for="formAge2">18-24</label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="checkbox" name="formAge[]" id="formAge3" value="24-30">
            <label for="formAge3">24-30
              </label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="checkbox" name="formAge[]" id="formAge4" value="30-36">
            <label for="formAge4">30-36
              </label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="checkbox" name="formAge[]" id="formAge5" value="36-42">
            <label for="formAge5">36-42
              </label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="checkbox" name="formAge[]" id="formAge6" value="42-48">
            <label for="formAge6">42-48
              </label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="checkbox" name="formAge[]" id="formAge7" value="от 48">
            <label for="formAge7">от 48
              </label>
        </div>
        <!-- /.input-body__contain -->
        </div>
        </label>
        <label for="" class="block">
            <h3>
                15) Интересы Вашей аудитории <sup class="danger">*</sup>
            </h3>
            <h4>Опишите интересы Вашей целевой аудитории (чем увлекаются, какие заведения посещают, на какие аккаунты могут быть подписаны и т.д.).</h4>
            <input type="text" placeholder="Мой ответ" required="required" name="formIntersting">
          </label>
        <label for="" class="block">
            <h3>
                16) Конкуренты <sup class="danger">*</sup>
            </h3>
            <h4>Укажите ссылки на Ваших конкурентов в Instagram (если таковые имеются)</h4>
            <input type="text" placeholder="Мой ответ" required="required" name="formCompetitor">
          </label>
        <label for="" class="block">
              <h3>
                  17) Рекламный бюджет <sup class="danger">*</sup>
              </h3>
              <h4>Укажите сумму рекламного бюджета, который Вы готовы тратить на рекламу в сутки</h4>
              <div class="input-body">
                <div class="input-body__contain">
                  <input type="radio" name="formBudget" id="formBudget1" value="1-3$">
                  <label for="formBudget1">1-3$</label>
        <!-- /.input-body__contain -->
        </div>
        <div class="input-body__contain">
            <input type="radio" name="formBudget" id="formBudget2" value="3-5$">
            <label for="formBudget2">3-5$</label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="radio" name="formBudget" id="formBudget3" value="5-10$">
            <label for="formBudget3">5-10$</label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="radio" name="formBudget" id="formBudget4" value="от 10$">
            <label for="formBudget4">от 10$</label>
        </div>
        <!-- /.input-body__contain -->
        <div class="input-body__contain">
            <input type="radio" name="formBudget" id="formBudget5" value="Без рекламы">
            <label for="formBudget5">Без рекламы</label>
        </div>
        <!-- /.input-body__contain -->
        </div>
        </label>
        <button type="submit">Отправить
          </button>



        </form>
        </div>
    </section>
    <!-- /.form -->
    <script src="js/form.min.js"></script>
</body>

</html>