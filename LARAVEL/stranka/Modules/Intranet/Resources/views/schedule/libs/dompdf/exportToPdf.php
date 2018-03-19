
<?php
/**
 * Created by PhpStorm.
 * User: Patrik
 * Date: 9.12.2014
 * Time: 10:39
 */
//set_include_path(get_include_path() . PATH_SEPARATOR . "/path/to/dompdf");
require_once("dompdf_config.inc.php");



$html2 = file_get_contents('http://vmxgobona.fei.stuba.sk/priklad1/index.php?action=export');
//echo $html2;
$html2 = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $html2);





header('content-type: text/html; charset=utf-8');

$dompdf = new DOMPDF();
$dompdf->load_html($html2);
$dompdf->render();
$dompdf->stream("obsadenie_kina.pdf");

?>