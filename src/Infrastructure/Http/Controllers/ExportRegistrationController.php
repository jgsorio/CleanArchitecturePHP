<?php

namespace Core\Infrastructure\Http\Controllers;

use Core\Application\UseCases\ExportRegistration\DTO\InputBoundary;
use Core\Application\UseCases\ExportRegistration\ExportRegistration;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class ExportRegistrationController
{
    public function __construct(
        public RequestInterface $request,
        public ResponseInterface $response,
        protected ExportRegistration $useCase 
    ){}

    public function execute(Presentation $presentation): Response
    {
        $inputBoundary = new InputBoundary('01234567890', 'teste2.pdf', __DIR__ . '/../../../../storage');
        $output = $this->useCase->handle($inputBoundary);

        $this->response->getBody()->write($presentation->output([
            'fullFileName' => $output->fullFileName
        ]));
        
        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
