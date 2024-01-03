<?php

namespace App\Components\Email;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\ContainerInterface;

class EmailFactory
{

    public function __invoke(ContainerInterface $container, array $params = []): Email|null
    {
        $config = $container->get(ConfigInterface::class);

        $username = $config->get('email.default.mail_smtp_username');
        $password = $config->get('email.default.mail_smtp_password');
        $fromAddress = $config->get('email.default.mail_from_address');
        $fromName = $config->get('email.default.mail_from_name');
        return make(Email::class, [$username, $password, $fromAddress, $fromName]);
    }

}