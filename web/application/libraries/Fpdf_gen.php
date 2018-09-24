<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Name:  FPDF
* 
* Author: Jd Fiscus
* 	 	  jdfiscus@gmail.com
*         @iamfiscus
*          
*
* Origin API Class: http://www.fpdf.org/
* 
* Location: http://github.com/iamfiscus/Codeigniter-FPDF/
*          
* Created:  06.22.2010 
* 
* Description:  This is a Codeigniter library which allows you to generate a PDF with the FPDF library
* 
*/

class Fpdf_gen {
	
	public $pdf;

	public function __construct() {
		
		
		
		//============================================================+
		// File name   : example_018.php
		// Begin       : 2008-03-06
		// Last Update : 2013-05-14
		//
		// Description : Example 018 for TCPDF class
		//               RTL document with Persian language
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
		 * @abstract TCPDF - Example: RTL document with Persian language
		 * @author Nicola Asuni
		 * @since 2008-03-06
		 */

		// Include the main TCPDF library (search for installation path).
		require_once APPPATH.'third_party/TCPDF/tcpdf.php';

		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
		// remove default header/footer
		$pdf->setPrintHeader(false); 
		$pdf->setPrintFooter(false);
		// set default header data
		// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);

		// // set header and footer fonts
		// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// // set default monospaced font
		// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// // set margins
		// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// // set auto page breaks
		// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// // set image scale factor
		// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language dependent data:
		$lg = Array();
		$lg['a_meta_charset'] = 'UTF-8'; 
		$lg['a_meta_language'] = 'fa';
		$lg['w_page'] = 'page';

		// set some language-dependent strings (optional)
		$pdf->setLanguageArray($lg);  

		// add a page
		$pdf->AddPage();  
		
		$this->pdf = $pdf;
		//============================================================+
		// END OF FILE
		//============================================================+ 
		
	}

	public function getPdf()
	{
		return $this->pdf;
	}
	
}