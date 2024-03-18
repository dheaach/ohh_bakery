<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// Class untuk membuat laporan

class Test extends CI_Controller{

    function __construct(){
        parent::__construct();
    }

    /**
    * Fungsi untuk menampilkan menu laporan penerima bantuan
    * @param none
    * @return void
    **/
    function penerima_bantuan(){
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hello World!');
        $pdf->Output();
    }
}