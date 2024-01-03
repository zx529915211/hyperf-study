<?php

namespace App\Components\Email;

interface EmailInterface
{
    /**
     * Notes:
     * @param $receiver
     * @param $subject
     * @param $body
     * @param array $fileList
     * @return bool
     */
    public function send($receiver, $subject, $body, array $fileList = []): bool;
}