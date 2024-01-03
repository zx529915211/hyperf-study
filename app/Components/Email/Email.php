<?php

namespace App\Components\Email;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Logger\LoggerFactory;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email implements EmailInterface
{
    protected const HOST = 'smtp.qq.com';
    protected const PORT = 465;
    protected PHPMailer $email;

    #[Inject]
    protected LoggerFactory $logger;


    /**
     * @param $username
     * @param $password
     * @param $fromAddress
     * @param $fromName
     * @throws Exception
     */
    public function __construct($username, $password, $fromAddress, $fromName)
    {
        $mail = $this->email = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = self::HOST;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = self::PORT;
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->setFrom($fromAddress, $fromName);
        $mail->addReplyTo($fromAddress);
    }


    /**
     * Notes:
     * @param $receiver
     * @param $subject
     * @param $body
     * @param array $fileList
     * @return true
     */
    public function send($receiver, $subject, $body, array $fileList = []): bool
    {
        $mail = $this->email;
        try {
            $mail->addAddress($receiver);
            foreach ($fileList as $file_data) {
                $mail->addAttachment($file_data['file_url'], $file_data['file_name']);
            }
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
            return true;
        } catch (\Exception $e) {
            $this->logger->get('mail')->error("邮件发送失败：" . $mail->ErrorInfo);
            throw new BusinessException(ErrorCode::MAIL_SEND_FAILED);
        }
    }
}