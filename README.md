# leomail
Отправка формы с вложениями (PHPMailer + AJAX)

1. Скачиваем в папку phpmailer последнюю версию PHPMailer https://github.com/PHPMailer/PHPMailer. Нужно только содержимое папки "src".
2. В файле send.php настраиваем переменные по образцу:

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

3. Наслаждаемся результатом!

P.S. Скрипт сам подхватит любые данные из полей любой формы и отправит их на почту в виде красивой таблицы.
