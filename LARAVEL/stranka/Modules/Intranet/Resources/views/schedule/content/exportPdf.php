<?php
if (isset($_POST['tabulka'])) {
    
    
    $now= date("j.m. Y - H:i:s", time());
    $html =
    '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head><body><h2>Rozvrh</h2>';
    $html.=utf8_decode($_POST['tabulka']);
    //$html.=html_entity_decode($_POST['tabulka']);
    $html.='<br><br><span>čas generovania pdf  : '.$now.' </span></body></html>';
    
    include('../libs/MPDF57/mpdf.php');

    $mpdf = new mPDF('UTF-8', 'A4-L');

    $stylesheet = file_get_contents('../css/pdfTable.css');
    $mpdf->WriteHTML($stylesheet,1);
    $mpdf->WriteHTML($html,2);

    //$mpdf->Output('rozvrh'.date("ymj_Hi",time()).'.pdf','I');
    $mpdf->Output('rozvrh'.date("ymj_Hi",time()).'.pdf','D');



    exit;


}
?>