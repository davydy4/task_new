<?php

return array(
    'task/([0-9]+)' => 'task/view/$1',
    'task/edit/([0-9]+)' => 'task/edit/$1',
    'task/add' => 'task/add',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    '^p([0-9]+$)' => 'task/index/$1',
    '^$' => 'task/index',
);
