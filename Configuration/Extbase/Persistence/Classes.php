<?php
declare(strict_types=1);

return [
    \In2code\Femanager\Domain\Model\User::class => [
        'subclasses' => [
            \DW\Trainingsplatz\Domain\Model\User::class
        ]
    ],
    \DW\Trainingsplatz\Domain\Model\User::class => [
        'tableName' => 'fe_users',
    ]
];
