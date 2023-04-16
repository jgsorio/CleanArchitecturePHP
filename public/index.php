<?php

require __DIR__ . '/../vendor/autoload.php';

use Core\Application\UseCases\ExportRegistration\ExportRegistration;
use Core\Infrastructure\Adapters\DomPdfAdapter;
use Core\Infrastructure\Adapters\LocalStorageAdapter;
use Core\Infrastructure\Http\Controllers\ExportRegistrationController;
use Core\Infrastructure\Presentation\ExportRegistrationPresentation;
use Core\Infrastructure\Repositories\RegistrationRepository;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

$appConfig = require __DIR__ . '/../config/app.php';

$registrationRepository = new RegistrationRepository(
    new PDO("mysql:host={$appConfig['db']['DB_HOST']};dbname={$appConfig['db']['DB_DATABASE']}",
    $appConfig['db']['DB_USER'],
    $appConfig['db']['DB_PASS'], [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ])
);

$pdfExport = new DomPdfAdapter();
$storage = new LocalStorageAdapter();

$exportRegistrationUseCase = new ExportRegistration($registrationRepository, $pdfExport, $storage);
$request = new Request('GET', 'http://localhost:8000');
$response = new Response();

$exportRegistrationController = new ExportRegistrationController($request, $response, $exportRegistrationUseCase);
$exportRegistrationPresentation = new ExportRegistrationPresentation($exportRegistrationController);
echo $exportRegistrationController->execute($exportRegistrationPresentation)->getBody();
