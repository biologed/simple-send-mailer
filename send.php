<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

if (!empty($_POST["from"]) &&
    !empty($_POST["to"]) &&
    !empty($_POST["weight"]) &&
    !empty($_POST["volume"]) &&
    !empty($_POST["phone"]))
{
  $phone = preg_replace('/[^0-9]+/','',$_POST["phone"]); //удаляем все кроме цифр
  $phone_error = array("11111111","22222222","33333333","44444444",
                       "55555555","66666666","77777777","88888888",
                       "99999999","00000000");

  foreach ($phone_error as $url) {
    if (strpos($phone, $url) !== false) {
        $result =  "Введен некорректный номер телефона";
        echo json_encode($result); //отправляем пользователю сообщение об ошибке
        return true;
    }
  }
  if(strlen($phone)<11) {
      $result =  "Введен некорректный номер телефона";
      echo json_encode($result); //отправляем пользователю сообщение об ошибке
      return true;
  }

  $mail = new PHPMailer(true);
  $mail->SMTPDebug = 2;
  $mail->addAddress('example@mail.com');
  $mail->isSendmail();
  $mail->setFrom('example@mail.com', 'Перевозка грузов по всей России');
  $mail->isHTML(true);
  $mail->Subject = 'Заявка с сайта';
  $mail->Body = '<html>
  <head>
  <title>Перевозка грузов по всей России</title>
  </head>
  <body>
  <p>Откуда: '.$_POST['from'].'</p>
  <p>Куда: '.$_POST['to'].'</p>
  <p>Вес: '.$_POST['weight'].'</p>
  <p>Объем: '.$_POST['volume'].'</p>
  <p>Телефон: '.$_POST['phone'].'</p>
  </body>
  </html>';
  $mail->send();

  $result = true;
  echo json_encode($result); //отправляем пользователю сообщение об успешной отправке заявки
} else {
   $result = "Заполните все поля";
   echo json_encode($result); //отправляем пользователю сообщение об ошибке
}

?>
