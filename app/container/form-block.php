<?php
?>
<div class="form-block" id="form-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <h2 class="form-block__title title">Хотите связаться?</h2>
                    <!-- /.form-block__title title -->
                </div>
                <!-- /.col-xl-12 -->
                <div class="col-xl-12">
                    <h3 class="form-block__subtitle subtitle">Оставьте Ваши контактные данные и менеджер свяжется с Вами <br>в течение 15 минут для обсуждений деталей сотрудничества</p>
                        <!-- /.form-block__subtitle -->
                </div>
                <!-- /.col-xl-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form method="POST" action="">
                    <input type="text" name="name" class="form-block__input" placeholder="Ваше имя" required="required">
                    <input type="tel" name="phone" class="form-block__input" placeholder="Номер телефона" required="required">
                    <input style="display:none;" type="text" name="theme">

                    <button class="form-block__btn" type="submit" onclick="ga( 'send', 'event', 'Данные с подвала сайта', 'Нажатие кнопки Связаться с подвала');">Связаться</button>
                </form>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>