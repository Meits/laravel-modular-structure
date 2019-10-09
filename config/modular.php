<?php
/**
 * Created by PhpStorm.
 * User: MeitsWorkPc
 * Date: 06.09.2019
 * Time: 22:56
 */

return [
    'path' => base_path() . '/app/Modules',
    'base_namespace' => 'App\Modules',
    'groupWithoutPrefix' => 'Pub',

    /**
     * Modules
     */

    'modules' => [
        'Admin' => [
            'Blog',
		],

        'Pub' => [
            'Blog',
        ]
    ]
];