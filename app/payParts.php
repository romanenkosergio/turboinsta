<?php

require __DIR__ . '/vendor/autoload.php';

use PayParts\PayParts;
session_start();
$params = require_once('params.php');
$query = $_POST['query'];
$name = $query['name'];
$price = $query['price'];
$part = $query['part'];

$host=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];

$ProductsList = array(
    array('name' => $name,
        'count' => 1,
        'price' => $price)
);


$options = array(
    // 'ResponseUrl' => $host.'/response.php',          //URL, на который Банк отправит результат сделки (НЕ ОБЯЗАТЕЛЬНО)
    // 'RedirectUrl' => $host.'/redirect.php',          //URL, на который Банк сделает редирект клиента (НЕ ОБЯЗАТЕЛЬНО)
    'PartsCount' => $part,                               //Количество частей на которые делится сумма транзакции ( >1)
    'Prefix' => '',                                  //параметр не обязательный если Prefix указан с пустотой или не указа вовсе префикс будет ORDER
    'OrderID' => '',                                 //если OrderID задан с пустотой или не укан вовсе OrderID сгенерится автоматически
    'merchantType' => 'II',                          //II - Мгновенная рассрочка; PP - Оплата частями
    'Currency' => '',                                //можна указать другую валюту 980 – Украинская гривна; 840 – Доллар США; 643 – Российский рубль. Значения в соответствии с ISO
    'ProductsList' => $ProductsList                 //Список продуктов, каждый продукт содержит поля: name - Наименование товара price - Цена за еденицу товара (Пример: 100.00) count - Количество товаров данного вида
    // 'recipientId' => ''                              //Идентификатор получателя, по умолчанию берется основной получатель. Установка основного получателя происходит в профиле магазина.
);

$pp = new PayParts($params['StoreId'], $params['Password']);

$pp->setOptions($options);

$send = $pp->create('pay');//hold //pay

$_SESSION['OrderID'] = $pp->getLOG()['OrderID'];
// var_dump($pp->getLOG());
$form = ('https://payparts2.privatbank.ua/ipp/v2/payment?token='.$send['token']);

setcookie("url", $form);
?>