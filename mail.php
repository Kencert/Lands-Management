 <?php 

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer();
//$mail->SMTPDebug = 3;                               // Enable verbose debug output
 $mail->isSMTP();                                      // Set mailer to use SMTP
$mail -> SMTPDebug = 2;
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPSecure = 'tls';

$mail->Username = 'landmanagement001';                 // SMTP username
$mail->Password = 'kencert123';                           // SMTP password
$mail->Port = 587;                                    // TCP port to connect to

$mail->From = ('cheruiyotkenedy@gmail.com');
$mail->FromName = 'Ken Cert';
$mail->addAddress('cheruiyotkenedy@yahoo.com');               // Name is optional

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
$mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent to the recipient';
}
?>