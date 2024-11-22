<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

#[Controller]
class UserController extends AbstractController
{
    #[RequestMapping(path: "signup",methods: "post")]
    public function signup()
    {

    }
}
