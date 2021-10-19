<?php
include_once("../bd/db.php");

$sql = "SELECT prod_nombre Nombre, prod_stock Cantidad, prod_fechavencimiento Fecha, prod_precio Precio  FROM productos";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
require('../fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
while ($field_info = mysqli_fetch_field($resultset)) {
$pdf->Cell(47,15,$field_info->name,1);
}
while($rows = mysqli_fetch_assoc($resultset)) {
$pdf->SetFont('Arial','',10);
$pdf->Ln();
foreach($rows as $column) {
$pdf->Cell(47,15,$column,1, "", 1);
}
}
$pdf->Output();
?>