<?php
//include connection file 
include "../../includes/config.php";
include "../functions_.php";
include_once('../libs/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    // $this->Image('../images/logo.png',10,-1,70);
    $this->SetFont('Arial','B',13);
    // // Move to the right
    // $this->Cell(80);
    // Title
    $this->Cell(80,10,'Passed bids',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
    $bidsres = getBids();
    $pdf = new PDF('P', 'mm', 'A4');
    //header
    

    $pdf->AddPage();
    //foter page
    $pdf->Ln();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',5);
    $pdf->Cell(10, 8, "#", 1);
    $pdf->Cell(40, 8, "Supplier Name", 1);
    $pdf->Cell(40, 8, "Supplier Email", 1);
    $pdf->Cell(40, 8, "Bidded Amount", 1);
    $pdf->Cell(40, 8, "Score", 1);

    $count = 0;
    foreach($bidsres as $row) {
        // $total = getAssessmentResult($row["uniqueid"]);
        // $cassess = getCAssessmentScore($row["uniqueid"]);
        // $sassess = getSAssessmentScore($row["uniqueid"]);
        
        $count += 1;

        $pdf->Ln();
        $pdf->Cell(10, 8, $count, 1);
        $pdf->Cell(40, 8, $row["suppliername"], 1);
        $pdf->Cell(40, 8, $row["supplieremail"], 1);
        $pdf->Cell(40, 8, $row["amount"], 1);
        $pdf->Cell(40, 8, $row["score"]."%", 1);
        // $pdf->Cell(25, 8, $sassess." / 30", 1);
        // $pdf->Cell(25, 8, $cassess." / 40", 1);
        // $pdf->Cell(25, 8, number_format((float)$total, 2,'.', '')."%", 1);
    }
$pdf->Output();

// }
?>