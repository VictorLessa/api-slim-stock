<?php
/*
 * This file is part of the Slim API skeleton package
 *
 * Copyright (c) 2016-2017 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   https://github.com/tuupola/slim-api-skeleton
 *
 */
use Skeleton\Infrastructure\Slim\Handler\ApiErrorHandler;
use Skeleton\Infrastructure\Slim\Handler\NotFoundHandler;

$c = $app->getContainer();
$c['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        return $response->withJson(['Status' => 'Error', 'Message' => $exception->getMessage(), 'Code' => $exception->getCode()], $exception->getCode())
            ->withHeader('Content-Type', 'application/json');
    };
};