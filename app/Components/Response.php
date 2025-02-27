<?php
declare(strict_types=1);

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
            'code' => 1,
            'data' => $data,
            'msg' => 'Ok',
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