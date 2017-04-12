<?php

/**
 * @var \SleepingOwl\Admin\Contracts\Navigation\NavigationInterface $navigation
 * @see http://sleepingowladmin.ru/docs/menu_configuration
 */

AdminNavigation::setFromArray([
    [
        'title' => 'Permissions',
        'icon' => 'fa fa-group',
        'pages' => [
            [
                'title' => 'Users',
                'url' => ''
       ],
       [
           'title' => 'Roles',
           'url' => ''
       ],
     ]
   ],
   (new \SleepingOwl\Admin\Navigation\Page(\App\Model\Sentence::class))
       ->setIcon('fa fa-newspaper-o')

       ->setPriority(0)
]);