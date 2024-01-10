<?php
declare(strict_types=1);
namespace App\Service;

use Hyperf\Contract\ContainerInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Logger\LoggerFactory;
use Psr\Log\LoggerInterface;

abstract class Service
{
    #[Inject]
    protected ContainerInterface $container;

    protected LoggerInterface|LoggerFactory $logger;

    public function __construct()
    {
        $this->logger = $this->container->get(LoggerFactory::class)->get('service');
    }
}