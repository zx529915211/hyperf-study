<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\Amqp\Producer\MailProducer;
use App\Components\Email\EmailInterface;
use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use Hyperf\Amqp\Producer;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Annotation\AutoController;

#[AutoController]
class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    public function info()
    {
//        $id = (int) $this->request->input('id', 0);
//        $a = [];
//        echo $a[1];
//        if ($id < 0) {
//            throw new BusinessException(ErrorCode::PARAMS_ID_INVALID);
//        }
//        return $this->response->success(['info' => 'data info']);
        $result = Db::select('select * from email_code;');
        return $result;
    }

    public function send()
    {
        $startTime = microtime(true);
        $wg = new \Hyperf\Utils\WaitGroup();
        $wg->add(2);
//        $email = di()->get(EmailInterface::class);
        co(function () use ($wg) {
            $email = make(EmailInterface::class);
//            sleep(5);
            $email->send("278299648@qq.com",'test1','hyperf email success');
            $wg->done();
        });
        co(function () use ($wg) {
            $email = make(EmailInterface::class);
            $email->send("278299648@qq.com",'test1','hyperf email success');
            $wg->done();
        });
        $wg->wait();
        $runTime = '耗时: ' . (microtime(true) - $startTime) . ' s';
        return ['time' => date('Y-m-d H:i:s'), 'runtime' => $runTime];
    }

    public function amqpEmail()
    {
        $startTime = microtime(true);

        $mailInfo = [
            'receiver' => '278299648@qq.com',
            'subject' => '邮件测试标题111',
            'body' => '<b style="color: #f00;">邮件测试内容222</b>',
        ];
        $message = new MailProducer($mailInfo);
        $producer = di()->get(Producer::class);
        $producer->produce($message);

        $runTime = '耗时: ' . (microtime(true) - $startTime) . ' s';

        return ['time' => date('Y-m-d H:i:s'), 'runtime' => $runTime];
    }


}
