<?php

namespace Core\Infrastructure\Adapters;

use Core\Application\Contracts\PdfExporter;
use Core\Domain\Entities\Registration;
use Dompdf\Dompdf;
use Exception;

class DomPdfAdapter implements PdfExporter
{
    public function generate(Registration $registration): string
    {
        try {
            $domPdf = new Dompdf();
            $html = "<p>Nome: $registration->name</p></p>CPF: $registration->registrationNumber </p>";
            $domPdf->loadHtml($html);
            $domPdf->setPaper('A4', 'landscape');
            $domPdf->render();
            return $domPdf->output();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}