<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {	
function __construct( $data, $orientation, $unit, $format ) {
 parent::__construct( $orientation, $unit, $format, true, 'UTF-8', false );
 $this->invoiceData = $data;
 # Set the page margins: 72pt on each side, 36pt on top/bottom.
 $this->SetMargins( 72, 36, 72, true );
 $this->SetAutoPageBreak( true, 36 );
 # Set document meta-information
 $this->SetCreator( PDF_CREATOR );
 $this->SetAuthor( 'Chris Herborth (chrish@pobox.com)' );
 $this->SetTitle( 'Invoice for ' . $this->invoiceData['user'] );
 $this->SetSubject( "A simple invoice example for 'Creating PDFs on
the fly with TCPDF' on IBM's developerWorks" );
 $this->SetKeywords( 'PHP, sample, invoice, PDF, TCPDF' );
 //set image scale factor
 $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
 //set some language-dependent strings
 global $l;
 $this->setLanguageArray($l);
}
public function Header() {
 global $webcolor;
 # The image is this much larger than the company name text.
 $bigFont = 14;
 $imageScale = ( 128.0 / 26.0 ) * $bigFont;
 $smallFont = ( 16.0 / 26.0 ) * $bigFont;
 $this->ImagePngAlpha('Azuresol_OnyxTree-S.png', 72, 36, 128, 128,
$imageScale, $imageScale, 'PNG', null, 'T', false, 72, 'L' );
$imageScale, 'PNG', null, 'T', false, 72, 'L' );
 $this->SetFont('times', 'b', $bigFont );
 $this->Cell( 0, 0, 'South Seas Pacifica', 0, 1 );
 $this->SetFont('times', 'i', $smallFont );
 $this->Cell( $imageScale );
 $this->Cell( 0, 0, '', 0, 1 );
 $this->Cell( $imageScale );
 $this->Cell( 0, 0, '31337 Docks Avenue,', 0, 1 );
 $this->Cell( $imageScale );
 $this->Cell( 0, 0, 'Toronto, Ontario', 0, 1 );
 $this->SetY( 1.5 * 72, true );
 $this->SetLineStyle( array( 'width' => 2, 'color' =>
array( $webcolor['black'] ) ) );
 $this->Line( 72, 36 + $imageScale, $this->getPageWidth() - 72, 36
+ $imageScale );
}
	
public function CreateInvoice() {
 $this->AddPage();
 $this->SetFont( 'helvetica', '', 11 );
 $this->SetY( 144, true );
 # Table parameters
 #
 # Column size, wide (description) column, table indent, row height.
 $col = 72;
 $wideCol = 3 * $col;
 $indent = ( $this->getPageWidth() - 2 * 72 - $wideCol - 3 * $col ) / 2;
 $line = 18;
 # Table header
 $this->SetFont( '', 'b' );
 $this->Cell( $indent );
 $this->Cell( $wideCol, $line, 'Item', 1, 0, 'L' );
 $this->Cell( $col, $line, 'Quantity', 1, 0, 'R' );
 $this->Cell( $col, $line, 'Price', 1, 0, 'R' );
 $this->Cell( $col, $line, 'Cost', 1, 0, 'R' );
 $this->Ln();
 # Table content rows
 $this->SetFont( '', '' );
 foreach( $this->invoiceData['items'] as $item ) {
      $this->Cell( $indent );
 $this->Cell( $wideCol, $line, $item[0], 1, 0, 'L' );
 $this->Cell( $col, $line, $item[1], 1, 0, 'R' );
 $this->Cell( $col, $line, $item[2], 1, 0, 'R' );
 $this->Cell( $col, $line, $item[3], 1, 0, 'R' );
 $this->Ln();
 }
 # Table Total row
 $this->SetFont( '', 'b' );
 $this->Cell( $indent );
 $this->Cell( $wideCol + $col * 2, $line, 'Total:', 1, 0, 'R' );
 $this->SetFont( '', '' );
 $this->Cell( $col, $line, $this->invoiceData['total'], 1, 0, 'R' );
}
}