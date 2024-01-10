<?php

declare(strict_types=1);

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
#[Constants]
class ErrorCode extends AbstractConstants
{
    /**
     * @Message("Server Error！")
     */
    const SERVER_ERROR = 500;

    /**
     * @Message("params.id_invalid")
     */
    const PARAMS_ID_INVALID = 10001;

    /**
     * @Message("邮件发送失败")
     */
    const MAIL_SEND_FAILED  = 10002;

    /**
     * @Message("邮件发送太频繁")
     */
    const CODE_SENT_FREQUENTLY  = 10003;

    /**
     * @Message("用户已存在")
     */
    const USER_EXISTS  = 10004;

    /**
     * @Message("表单验证错误")
     */
    const FORM_ERROR  = 10005;
}
