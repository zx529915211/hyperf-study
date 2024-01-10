<?php
declare(strict_types=1);

namespace App\Dao;

use App\Model\EmailCode;

class EmailCodeDao extends BaseDao
{
    /**
     * Notes:查询时间内某邮箱的已发送邮件数量
     * @param $email
     * @param $time
     * @return int
     */
    public function getEmailCodeNumByTime($email, $time): int
    {
        // 限制频率 5分钟3次
        return EmailCode::query()
            ->where('email', $email)
            ->where('create_time', '>', $time)
            ->count();
    }
}