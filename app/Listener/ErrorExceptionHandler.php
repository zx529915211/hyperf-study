<?php

declare(strict_types=1);
/**
 * 错误日志记录
 */
namespace App\Listener;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Framework\Event\BootApplication;

class ErrorExceptionHandler implements ListenerInterface
{
    public function listen(): array
    {
        return [
            BootApplication::class,
        ];
    }

    public function process(object $event)
    {
        set_error_handler(static function ($level, $message, $file = '', $line = 0): bool {
            $logger = make(StdoutLoggerInterface::class);
            $logFormat = sprintf("[level]:%s---[file]:%s---[line]:%s---[message]:%s",$level,$file,$line,$message);
            $logger->error($logFormat);
            return true;
        });
    }
}
