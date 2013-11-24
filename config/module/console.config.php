<?php
return array(
    'router' => array(
        'routes' => array(
            'process' => array(
                'options' => array(
                    'route' => 'process [--verbose] [--dry-run] [cron|received-emails]:job',
                    'defaults' => array(
                        'controller' => 'IdentityProcessor\Controller\Processor',
                        'action' => 'process',
                        'job' => 'cron',
                        'verbose' => false,
                        'dry-run' => false,
                    )
                )
            ),
        )
    )
);
