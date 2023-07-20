<?php 

require('TCPDF/quotation.php');

$pdf = new PDF_Invoice(PDF_PAGE_ORIENTATION, PDF_UNIT, "letter", $unicode, $format, false);

// convert TTF font to TCPDF format and store it on the fonts folder
$fontname = TCPDF_FONTS::addTTFfont('TCPDF/fonts/calibri/Calibri.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont($fontname, '', 14, '', false);

