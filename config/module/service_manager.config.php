<?php
return array(
    'factories' => array(
        'IdentityProcessor\Config\IdentityProcessor' => 'IdentityProcessor\Config\Factory\IdentityProcessor',
        'IdentityProcessor\Service\Cron' => 'IdentityProcessor\Service\Factory\Cron',
    ),
    'invokables' => array(
        'IdentityProcessor\Processor\GitHub' => 'IdentityProcessor\Processor\GitHub',
    )
);
