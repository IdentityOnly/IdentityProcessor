<?php
return array(
    'received-emails' => array(
        'command' => 'php public/index.php process received-emails',
        'schedule' => '* * * * *',
    ),
);
