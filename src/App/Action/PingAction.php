<?php

namespace App\Action;

use Events\Common\Exception\ForbiddenException;
use Events\Common\Exception\NotFoundException;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PingAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        throw new NotFoundException('werwer');
        return new JsonResponse(['ack' => time()]);
    }
}
