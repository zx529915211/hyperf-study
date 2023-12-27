<?php

declare(strict_types=1);
/**
 * 错误日志记录
 */
namespace App\Listener;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Framework\Event\BootApplication;
use Hyperf\Logger\LoggerFactory;

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
        //错误记录日志，dev环境下直接输出到命令行，线上环境记录到runtime/logs目录下
        set_error_handler(static function ($level, $message, $file = '', $line = 0): bool {
            $outputLogger = env("APP_ENV",'dev') == 'dev'
                ? make(StdoutLoggerInterface::class)
                : make(LoggerFactory::class)->get('log','default');
            $logFormat = sprintf("[level]:%s---[file]:%s---[line]:%s---[message]:%s",$level,$file,$line,$message);
            $outputLogger->error($logFormat);
            return true;
        });
    }
}
