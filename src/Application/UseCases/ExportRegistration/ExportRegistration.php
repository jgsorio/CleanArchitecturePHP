<?php

namespace Core\Application\UseCases\ExportRegistration;

use Core\Application\Contracts\PdfExporter;
use Core\Application\Contracts\Storage;
use Core\Application\UseCases\ExportRegistration\DTO\InputBoundary;
use Core\Application\UseCases\ExportRegistration\DTO\OutputBoundary;
use Core\Domain\Repositories\LoadRegistrationRepository;
use Core\Domain\ValueObjects\RegistrationNumber;

final class ExportRegistration
{
    public function __construct(
        protected LoadRegistrationRepository $repository,
        protected PdfExporter $pdfExporter,
        protected Storage $storage
    ){}

    public function handle(InputBoundary $input): OutputBoundary
    {
        $registrationNumber = new RegistrationNumber($input->registrationNumber);
        $registration = $this->repository->loadByRegistrationNumber($registrationNumber);

        $fileContent = $this->pdfExporter->generate($registration);
        $this->storage->store($input->fileName, $input->path, $fileContent);

        return new OutputBoundary(fullFileName: $input->path . DIRECTORY_SEPARATOR . $input->fileName);
    }
}
