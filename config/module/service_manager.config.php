<?php
return array(
    'factories' => array(
        'IdentityProcessor\Config\IdentityProcessor' => 'IdentityProcessor\Config\Factory\IdentityProcessor',
        'IdentityProcessor\Service\Cron' => 'IdentityProcessor\Service\Factory\Cron',
        'IdentityProcessor\CQRS\ProcessReceivedEmails' => 'IdentityProcessor\CQRS\Factory\ProcessReceivedEmails',
    ),
    'invokables' => array(
        'IdentityProcessor\Service\Processor' => 'IdentityProcessor\Service\Processor',
        'IdentityProcessor\Processor\GitHub' => 'IdentityProcessor\Processor\GitHub',
    )
);
