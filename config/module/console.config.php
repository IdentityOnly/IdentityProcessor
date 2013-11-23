<?php
return array(
    'router' => array(
        'routes' => array(
            'processor-process' => array(
                'options' => array(
                    'route' => 'processor-process',
                    'defaults' => array(
                        'controller' => 'IdentityProcessor\Controller\Processor',
                        'action' => 'process',
                    )
                )
            )
        )
    )
);
