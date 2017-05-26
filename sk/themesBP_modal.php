<?php  
    if(isset($_POST['url'])) {
        $url = $_POST['url'];
        $annotationURL = 'http://is.stuba.sk'.$url;

        $ch = curl_init($annotationURL);	 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        $returndata = curl_exec($ch);
        curl_close($ch);

        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($returndata);
        $xPath = new DOMXPath($doc);
        $annotation = $xPath->query('//html/body/div/div/div/table[1]/tbody/tr[last()]/td[last()]')[0]->textContent;
        echo $annotation;
    }