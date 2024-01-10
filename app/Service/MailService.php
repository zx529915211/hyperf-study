<?php

namespace App\Service;

use App\Components\Email\EmailInterface;
use App\Constants\ErrorCode;
use App\Dao\EmailCodeDao;
use App\Exception\BusinessException;
use App\Model\EmailCode;
use App\Model\User;
use Carbon\Carbon;
use Hyperf\Di\Annotation\Inject;

class MailService extends Service
{
    #[Inject]
    protected EmailCodeDao $emailCodeDao;

    /**
     * 通过邮件获取验证码
     * @param $email
     * @return mixed
     */
    public function getCode($email)
    {
        $time = Carbon::now()->subMinutes(5)->timestamp;

        $sentNum = $this->emailCodeDao->getEmailCodeNumByTime($email, $time);
        if ($sentNum >= 3) {
            throw new BusinessException(ErrorCode::CODE_SENT_FREQUENTLY);
        }

        // 判断用户是否存在
        $user = User::query()->where(['email' => $email])->first();
        if (!empty($user)) {
            throw new BusinessException(ErrorCode::USER_EXISTS);
        }

        $code = rand(1000, 9999);
        $model = new EmailCode();
        //使用fill方法添加的数据需要在model的fill属性中加入，不然会被过滤
//        $model->fill([
//            'email' => $email,
//            'code' => $code
//        ]);
        //直接赋值属性不受fill属性限制
        $model->email = $email;
        $model->code = $code;
        $model->save();
        co(function () use ($email, $code) {
            $mail = di()->get(EmailInterface::class);
            $mail->send($email, '帐号激活', '您的验证码是： <b style="color: #f00;">' . $code . '</b>');
        });
        return true;
    }
}
