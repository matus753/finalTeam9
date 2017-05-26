<?php
require_once '../config.php';
require_once 'functions.php';
require_once  '../../mpdf/mpdf.php';

$m = date('m');
$y = date('Y');
$id = 1;

if(isset($_POST['month']) && isset($_POST['year'])&& isset($_POST['id'])){
    $m  = htmlspecialchars($_POST['month']);
    $y  = htmlspecialchars($_POST['year']);
    $id  = $_POST['id'];
}

$file = 'osobnaDochadzka.pdf';

$mpdf = new mPDF('utf-8', 'A4');

$mpdf -> SetDisplayMode('fullpage');
$stylesheet = file_get_contents('../css/intranet.css');
$stylesheet .= file_get_contents('../css/bootstrap.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf -> WriteHTML(build_month($m, $y,$id, true),2);
$mpdf -> Output($file,'F');// this generates the pdf

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
ob_clean();
flush();
readfile($file);
exit;
