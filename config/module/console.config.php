<?php
return array(
    'router' => array(
        'routes' => array(
            'process' => array(
                'options' => array(
                    'route' => 'process [cron|received-emails]:job',
                    'defaults' => array(
                        'controller' => 'IdentityProcessor\Controller\Processor',
                        'action' => 'process',
                        'job' => 'cron'
                    )
                )
            )
        )
    )
);
