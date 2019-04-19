# leomail
<h2>Отправка формы с вложениями (PHPMailer + AJAX)</h2>

<p>1. Скачиваем в папку phpmailer последнюю версию PHPMailer https://github.com/PHPMailer/PHPMailer. Нужно только содержимое папки "src".</p>
<p>2. В файле send.php настраиваем переменные по образцу:</p>

<p>// Настройки<br>
$mail = new PHPMailer;<br>
$mail->isSMTP();<br>
$mail->Host = 'smtp.yandex.ru';<br>
$mail->SMTPAuth = true;<br>
$mail->Username = 'login'; // Ваш логин. Именно логин, без @yandex.ru<br>
$mail->Password = 'parol'; // Ваш пароль<br>
$mail->SMTPSecure = 'ssl';<br>
$mail->Port = 465;<br>
$mail->CharSet = 'utf-8';<br>
$mail->setFrom('order@yandex.ru', 'KARRIWEB'); // Ваш Email и Имя отправителя<br>
$mail->addAddress('zakaz@yandex.ru'); // Email получателя<br>
// $mail->addAddress('example@gmail.com'); // Еще один email, если нужно.</p>

<p>// Письмо<br>
$mail->isHTML(true);<br>
$mail->Subject = "$form_subject - KARRIWEB"; // Заголовок письма<br>
$mail->Body = $message; // Текст письма</p>

<p>3. Наслаждаемся результатом!</p>

<p>P.S. Скрипт сам подхватит любые данные из полей любой формы и отправит их на почту в виде красивой таблицы.</p>
