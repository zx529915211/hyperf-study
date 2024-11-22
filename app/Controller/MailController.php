<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\GetCodeForSignUpRequest;
use App\Service\MailService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

#[Controller]
class MailController extends AbstractController
{
    #[Inject]
    protected MailService $mailService;

    #[RequestMapping(path: "getCode",methods: "post")]
    public function getCode(GetCodeForSignUpRequest $getCodeForSignUpRequest)
    {
        $email = $this->request->input('email');
        $this->mailService->getCode($email);
        return $this->response->success();
    }
}
