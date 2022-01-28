<?php
require $_SERVER['DOCUMENT_ROOT'].'/sistema/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    $content = "<page><h1>Huevazos</h1><p>Lorem huevipsumajdyvajhdsadjad</p></page>";
    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->writeHTML($content);
    $html2pdf->output('example01.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
