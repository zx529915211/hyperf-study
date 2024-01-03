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
     * @Message("mail send fail")
     */
    const MAIL_SEND_FAILED  = 10002;
}
