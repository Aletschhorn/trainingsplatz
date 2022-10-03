<?php
return [
    'frontend' => [
        'trainingsplatz/training-description-template' => [
            'target' => \DW\Trainingsplatz\Middleware\TrainingDescriptionTemplate::class,
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering'
            ]
        ],
    ],
];
?>