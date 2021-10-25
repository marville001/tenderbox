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
    $this->Cell(80,10,'Closed Tenders',1,0,'C');
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

session_start();
$org_id = $_SESSION['org_id'];
$result = $conn->query("select * from tender where org_id = '$org_id' ");
    $pdf = new PDF('P', 'mm', 'A4');
    //header
    

    $pdf->AddPage();
    //foter page
    $pdf->Ln();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',5);
    $pdf->Cell(10, 8, "#", 1);
    $pdf->Cell(30, 8, "Tender Name", 1);
    $pdf->Cell(30, 8, "Tender No", 1);
    $pdf->Cell(15, 8, "Period", 1);
    $pdf->Cell(15, 8, "sector", 1);
    $pdf->Cell(15, 8, "Open Date", 1);
    $pdf->Cell(15, 8, "Close Date", 1);
    $pdf->Cell(15, 8, "Min Budget", 1);
    $pdf->Cell(15, 8, "Max Budget", 1);

    $count = 0;
    while($row = mysqli_fetch_assoc($result) and $count<10){
        $d1 = strtotime($row['closedate']);
        $d = strtotime(date("Y-m-d"));
        $diff =  $d1 - ($d);
        if($diff < 0){
            $count ++;
            $pdf->Ln();
            $pdf->Cell(10, 8, $count, 1);
            $pdf->Cell(30, 8, $row["tendername"], 1);
            $pdf->Cell(30, 8, $row["tenderno"], 1);
            $pdf->Cell(15, 8, $row["period"]." months", 1);
            $pdf->Cell(15, 8, $row["sector"], 1);
            $pdf->Cell(15, 8, $row["opendate"], 1);
            $pdf->Cell(15, 8, $row["closedate"], 1);
            $pdf->Cell(15, 8, $row["minbudget"], 1);
            $pdf->Cell(15, 8, $row["maxbudget"], 1);
        }
        // }        
        
    }
$pdf->Output();

// }
?>