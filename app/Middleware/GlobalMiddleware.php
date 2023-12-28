<?php

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\Contract\TranslatorInterface;
use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GlobalMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    #[Inject]
    protected TranslatorInterface $translator;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        //根据请求头的lang动态设置语言
        if ($lang = $request->getHeaderLine('lang')) {
            $this->translator->setLocale($lang);
        }
        return $handler->handle($request);
    }
}