<?php

namespace App\Components;


use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

class Response
{

    #[Inject]
    protected ContainerInterface $container;

    #[Inject]
    protected ResponseInterface $response;


    public function success($data = [])
    {
        return $this->response->json([
            'code' => 0,
            'data' => $data,
        ]);
    }

    public function fail($code, $message = '')
    {
        return $this->response->json([
            'code' => $code,
            'message' => $message,
        ]);
    }
}