<?php

return [
    'dependencies' => [
        'invokables' => [
            'Zend\Expressive\FinalHandler' => Common\Action\ErrorHandlerMiddleware::class,
        ],
    ],

    'logged-exceptions' => [
        Common\Exception\BadRequestException::class,
        Common\Exception\NotFoundException::class,
        Common\Exception\ConflictException::class,
        Common\Exception\RuntimeException::class,
    ]
];
