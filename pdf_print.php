<?php

require_once "./core/Init.php";
include './functions/Sanitize.php';
require ("./TCPDF-main/TCPDF-main/tcpdf.php");
spl_autoload_register(
    function ($class) { 
        require_once __DIR__ . '/classes/' . ucfirst(strtolower($class)) . '.php';
    } 
);

$pdf = new Pdf('p', 'mm', 'Legal', true, 'UTF-8', false, true);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CoffeeCode Inc.');
$pdf->SetTitle('CoffeeCode');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData("", "", "".' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);


$pdf->AddPage();

// output the HTML content
$pdf->writeHTML($pdf->Main(), true, 0, true, 0);


// Close and output PDF document
$pdf->Output($pdf->pdfFileName(), 'i');
