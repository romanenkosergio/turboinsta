<?php
?>
    <div class="pop pop-callback pop-blur" id="pop-callback">
        <div class="pop-content">
            <div class="pop-close" pop=''>&#10006;</div>
            <h2>Связаться с нами</h2>
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Ваше имя" required="required">
                <input type="tel" name="phone" placeholder="Ваш номер телефона" required="required">
                <input style="display:none;" type="text" name="theme">
                <input style="display:none;" type="text" name="price">
                <textarea name="msg" id="msg" cols="10" class="textarea" maxlength="350" rows="4" placeholder="Ваше сообщение..."></textarea>
                <button type="submit">Отправить</button>
            </form>
        </div>
        <div class="pop-handler-close" pop=''></div>
    </div>
    <div class="pop pop-callback pop-blur" id="pop-pay">
        <div class="pop-content">
            <div class="pop-close" pop=''>&#10006;</div>
            <h2>Связаться с нами</h2>
            <form method="POST" action="" id="form-pay">
                <input type="text" name="name" placeholder="Ваше имя" required="required">
                <input type="tel" name="phone" placeholder="Ваш номер телефона" required="required">
                <input style="display:none;" type="text" name="theme">
                <input style="display:none;" type="text" name="price">

                <select size="1" name="promo" id="promo" required="require">
					<option disabled selected>Выберите пакет услуг</option>
					<option value="TURBO 3 месяца" data-price="5 990">TURBO 3 месяца</option>
					<option value="TURBO 2 месяца" data-price="4 700">TURBO 2 месяца</option>
					<option value="TURBO 1 месяц" data-price="3 000">TURBO 1 месяц</option>
					<option value="TARGET" data-price="2 700">TARGET</option>
					<option value="Продвижение на 3 месяца" data-price="2 500">Продвижение на 3 месяца</option>
					<option value="Продвижение на 1 месяц" data-price="1 200">Продвижение на 1 месяц</option>
				</select>

                <button type="submit" id="order_payment">Оплатить</button>
            </form>
            <div id='form_responce' style='display:none;'>

            </div>
        </div>
        <div class="pop-handler-close" pop=''></div>
    </div>
    <div class="pop" id="video-pop">
        <div class="pop-content">
            <div class="pop-close" pop=''>&#10006;</div>
            <iframe src="" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="pop-handler-close" pop=''></div>
    </div>
    <div class="pop" id="privat-pop">
        <div class="pop-content">
            <div class="pop-close" pop=''>&#10006;</div>
            <h2>Оплата услуги продвижения</h2>
            <br>
            <p style="text-align:center;">Убедительная просьба, сразу после оплаты, с целью её скорейшего подтверждения, перезвоните в отдел продаж по номеру: +38 (093) 170-22-24
                <br> или закажите звонок:
            </p>
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Ваше имя" required="required">
                <input type="tel" name="phone" placeholder="Номер телефона" required="required">
                <input style="display:none;" type="text" name="theme">
                <!-- <p>
                    <small>Ваши данные не передаются третьим лицам.</small>
                </p> -->
                <button type="submit">Свяжитесь со мной</button>
            </form>
        </div>
        <div class="pop-handler-close" pop=''></div>
    </div>