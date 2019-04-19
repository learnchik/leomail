<?php

  // Подключаем PHP MAILER
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require_once('phpmailer/Exception.php');
  require_once('phpmailer/PHPMailer.php');
  require_once('phpmailer/SMTP.php');

  // Переменные
  $form_subject = htmlspecialchars(strip_tags(trim($_POST['form_subject'])));

  // Разбираем все непустые поля формы (кроме form_subject) на Ключ - Значение и заносим в таблицу
  $c = true;
  foreach ( $_POST as $key => $value ) {
    if ( $value != "" && $key != "form_subject" ) {
      $message .= "
      " . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
        <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
        <td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
      </tr>
      ";
    }
  }
  $message = "<table style='width: 100%;'>$message</table>";

  // Правим кодировку
  function adopt($text) {
    return '=?UTF-8?B?'.Base64_encode($text).'?=';
  }

  $form_subject = adopt($form_subject);

  /* Настройки некоторых почтовых сервисов

  // Яндекс
  $mail->Host = 'ssl://smtp.yandex.ru';
  $mail->Port = 465;
  $mail->Username = 'Логин';
  $mail->Password = 'Пароль';

  // Mail.RU
  $mail->Host = 'ssl://smtp.mail.ru';
  $mail->Port = 465;
  $mail->Username = 'Логин';
  $mail->Password = 'Пароль';

  // GMail
  $mail->Host = 'ssl://smtp.gmail.com';
  $mail->Port = 465;
  $mail->Username = 'Логин';
  $mail->Password = 'Пароль';

  Если возникает ошибка при отправки почты, то нужно отключить двухфакторную авторизацию и разблокировать «ненадежные приложения» в настройках конфиденциальности аккаунта https://myaccount.google.com/security?pli=1

  // Рамблер
  $mail->Host = 'ssl://smtp.rambler.ru';
  $mail->Port = 465;
  $mail->Username = 'Логин';
  $mail->Password = 'Пароль';

  // iCloud
  $mail->Host = 'ssl://smtp.mail.me.com';
  $mail->Port = 587;
  $mail->Username = 'Логин';
  $mail->Password = 'Пароль';

  // Мастерхост
  $mail->Host = 'ssl://smtp.masterhost.ru';
  $mail->Port = 465;
  $mail->Username = 'Логин';
  $mail->Password = 'Пароль';

  // Timeweb
  $mail->Host = 'ssl://smtp.timeweb.ru';
  $mail->Port = 465;
  $mail->Username = 'Логин';
  $mail->Password = 'Пароль';

  // Хостинг Центр (hc.ru)
  Доступ к сторонним почтовым серверам по SMTP-портам (25, 465, 587) ограничен, разрешена отправка не более 300 сообщений в сутки.
  $mail->Host = 'smtp.домен.ru';
  $mail->SMTPSecure = 'TLS';
  $mail->Port = 25;
  $mail->Username = 'Логин';
  $mail->Password = 'Пароль';

  // REG.RU
  Имя сервера можно узнать в разделе «Информация о включенных сервисах и паролях доступа»
  $mail->Host = 'ssl://serverXXX.hosting.reg.ru';
  $mail->Port = 465;
  $mail->Username = 'Логин';
  $mail->Password = 'Пароль';

  // ДЖИНО
  В разделе «Услуги» нужно включить опцию «SMTP-сервер»
  $mail->Host = 'ssl://smtp.jino.ru';
  $mail->Port = 465;
  $mail->Username = 'Логин';
  $mail->Password = 'Пароль';

  // nic.ru
  В настройках веб-сервера необходимо включить PHP расширение «openssl»
  $mail->Host = 'ssl://mail.nic.ru';
  $mail->Port = 465;
  $mail->Username = 'Логин';
  $mail->Password = 'Пароль';

  // beget.com
  $mail->Host = 'ssl://smtp.beget.com';
  $mail->Port = 465;
  $mail->Username = 'Логин';
  $mail->Password = 'Пароль';

  Выбирайте подходящие и вставляйте в соответствующие переменные ниже */

  // Настройки
  $mail = new PHPMailer;
  $mail->isSMTP(); 
  $mail->Host = 'smtp.yandex.ru'; 
  $mail->SMTPAuth = true;
  $mail->Username = 'login'; // Ваш логин. Именно логин, без @yandex.ru
  $mail->Password = 'parol'; // Ваш пароль
  $mail->SMTPSecure = 'ssl'; 
  $mail->Port = 465;
  $mail->CharSet = 'utf-8';
  $mail->setFrom('order@yandex.ru', 'KARRIWEB'); // Ваш Email и Имя отправителя
  $mail->addAddress('zakaz@yandex.ru'); // Email получателя
  // $mail->addAddress('example@gmail.com'); // Еще один email, если нужно.

  // Письмо
  $mail->isHTML(true); 
  $mail->Subject = "$form_subject - KARRIWEB"; // Заголовок письма
  $mail->Body = $message; // Текст письма

  # Проверяем, прикреплен ли файл
  if(isset($_FILES['userfile'])) { 
    if($_FILES['userfile']['error'] == 0){ 
      $mail->AddAttachment($_FILES['userfile']['tmp_name'], $_FILES['userfile']['name']); 
    } 
  } 

  // Результат
  if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
    echo 'ok';
  }
?>
