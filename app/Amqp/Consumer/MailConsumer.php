<?php

declare(strict_types=1);

namespace App\Amqp\Consumer;

use App\Components\Email\EmailInterface;
use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use PhpAmqpLib\Message\AMQPMessage;

#[Consumer(exchange: 'mail', routingKey: 'mail', queue: 'mail', name: "MailConsumer", nums: 1)]
class MailConsumer extends ConsumerMessage
{
    public function consumeMessage($data, AMQPMessage $message): string
    {
        $mail = di()->get(EmailInterface::class);
        $mail->send($data['receiver'], $data['subject'], $data['body']);
        return Result::ACK;
    }
}
