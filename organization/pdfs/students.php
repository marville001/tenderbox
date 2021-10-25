<?php
//include connection file 
include "../includes/config.php";
include_once('../libs/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../images/logo.png',10,-1,70);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'Students',1,0,'C');
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
    $result = mysqli_query($conn, "SELECT * FROM students") or die("database error:". mysqli_error($conn));

    $pdf = new PDF('P', 'mm', 'A4');
    //header
    

    $pdf->AddPage();
    //foter page
    $pdf->Ln();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',5);
    $pdf->Cell(10, 8, "Serial", 1);
    $pdf->Cell(25, 8, "Firstname", 1);
    $pdf->Cell(25, 8, "Lastname", 1);
    $pdf->Cell(25, 8, "Reg. No.", 1);
    $pdf->Cell(25, 8, "Course", 1);
    $pdf->Cell(25, 8, "Year", 1);

    $count = 0;
    foreach($result as $row) {
        $count += 1;              

        $pdf->Ln();
        $pdf->Cell(10, 8, $count, 1);
        $pdf->Cell(25, 8, $row["fname"], 1);
        $pdf->Cell(25, 8, $row["lname"], 1);
        $pdf->Cell(25, 8, $row["regno"], 1);
        $pdf->Cell(25, 8, $row["course"], 1);
        $pdf->Cell(25, 8, $row["year"], 1);
    }
$pdf->Output();

// }
?>