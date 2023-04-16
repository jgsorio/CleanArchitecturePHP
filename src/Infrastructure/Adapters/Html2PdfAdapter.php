<?php

namespace Core\Infrastructure\Adapters;

use Core\Application\Contracts\PdfExporter;
use Core\Domain\Entities\Registration;
use Exception;
use HTML2PDF;

final class Html2PdfAdapter implements PdfExporter
{
    public function generate(Registration $registration): string
    {
        $html2pdf = new HTML2PDF('P', 'A4');

        try {
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML("<p>Nome: $registration->name</p><p>CPF: $registration->registrationNumber </p>");

            return $html2pdf->output('', 'S');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
