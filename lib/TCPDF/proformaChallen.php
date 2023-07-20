<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+


/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

//$company_name=$_SESSION["user"][0]['CompanyName'];

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {	
	

	//Page header
	 function Header() {	
		// Arial bold 15
        $this->SetFont('helvetica','',9);
        // Logo
        //commented by me $this->Cell(55,10,$this->Image('themes/AdminLTE/kosh-logo.png',10,10,65),0,0);
        $this->Cell(55,10,$this->Image('themes/AdminLTE/mfg-logo.jpeg',10,10,65),0,0);
        //$this->SetFont('helvetica', 'I', 10);
        //  $this->Ln(1);
        // $this->Cell(0, 0, 'Product Company - ABC test company,Phone : +91 1122 3344 55, TIC :TESTTEST', 0, 0, 'C');
        // $this->Ln();
        // $this->Cell(0,0,'www.clientsite.com - T : +91 1 123 45 64 - E : info@clientsite.com', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        // Line break
        // $this->Ln(1);        
        // $this->Cell(294, 15, 'No.20,3rd Cross Street', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // $this->Ln(5);        
        // $this->Cell(300, 0, 'Jawahar Nagar-Pudhucherry', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        //  $this->Ln(6);        
        // $this->Cell(300, 0, 'Ph:+91 9894923333', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        //  $this->Ln(6);        
        // $this->Cell(300, 0, 'E-mail:sreenidhientps@gmail.com', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // $this->Ln(20);
        
            // $this->Ln(1);
            // $this->Cell(0, 30, '    No.20,3rd Cross Street', 0, false, 'R', 0, '', 0, false, 'M', 'M');
            // $this->Ln(4);
            // $this->Cell(0, 30, 'Jawahar Nagar,Pudhucherry 605 005', 0, false, 'R', 0, '', 0, false, 'M', 'M');
            // $this->Ln(4);
            // $this->Cell(0, 30, 'Ph:+91 98949 23333', 0, false, 'R', 0, '', 0, false, 'M', 'M');
            // $this->Ln(4);
            // $this->Cell(0, 30, 'Tel:+91 413 450 4333', 0, false, 'R', 0, '', 0, false, 'M', 'M');
            // $this->Ln(4);
            // $this->Cell(0, 30, 'E-mail:sreenidhientps@gmail.com', 0, false, 'R', 0, '', 0, false, 'M', 'M');
            // $this->Ln(10);
            // $this->Cell(0, 30, '', 0, false, 'R', 0, '', 0, false, 'M', 'M');
            
        // $this->Cell(70,20,'',1,0,'C');
        // $this->SetFont('Times','B',11);
//         //$this->Cell(25,10,'Doc. Code',1,0);
 //        $this->Cell(55, 10, 'Doc. Code', 1, 0, 'L', 0, '', 0);
//         $this->SetFont('Times','',11);
//         $this->Cell(39,10,'TC / QAD / F / 06',1,0);
//         $this->Cell(0,10,'',0,1);
//         $this->Cell(125,10,'',0,0);
//         $this->SetFont('Times','B',11);
//         //$this->Cell(25,10,'Date',1,0);
//         $this->Cell(25, 10, 'Date', 1, 0, 'L', 0, '', 0);
//         $this->SetFont('Times','',11);
// 		$this->Cell(39,10,'21.01.2015',1,0);
//         $this->Ln(20);
	}
	


	// Page footer
	 function Footer() {
		// Position at 15 mm from bottom
		
// $tbl = <<<EOD
// <footer >
// <img src="themes/AdminLTE/s15.jpg" alt="banner" class="" style="width: 660px; height:35px;">
// </footer>
// EOD;

// $this->writeHTMLCell(0, 0, '', '', $tbl, 0, 1, 0, true, '', true);
        
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		// $this->Ln(1);
        //     $this->Cell(0, 30, 'This is a Computer Generated Document', 0, false, 'R', 0, '', 0, false, 'M', 'M');

		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		
	}
	
	// public functions
public function sizeOfText( $texte, $largeur )
{
	$index    = 0;
	$nb_lines = 0;
	$loop     = TRUE;
	while ( $loop )
	{
		$pos = strpos($texte, "\n");
		if (!$pos)
		{
			$loop  = FALSE;
			$ligne = $texte;
		}
		else
		{
			$ligne  = substr( $texte, $index, $pos);
			$texte = substr( $texte, $pos+1 );
		}
		$length = floor( $this->GetStringWidth( $ligne ) );
		$res = 1 + floor( $length / $largeur) ;
		$nb_lines += $res;
	}
	return $nb_lines;
}


}

