<?php 
/**
* SUPREME COMPONENTS INTERNATIONAL TECHNICAL TEST
* @author Cahyono <chayo_eno@yahoo.com
*/
include('function.php');
$url = "http://api.arrow.com/itemservice/v3/en/search/list";
$parts = array ( 
    array( 'partNum' => "24AA256-I/MS", 'mfr' => 'MICROCHIP'), 
    array( 'partNum' => 'LT1805CSPBF', 'mfr' => 'Arrows'),
    array( 'partNum' => 'MAX32,32CAE+T', 'mfr' => 'MAXIM'), 
    array( 'partNum' => 'MIC5319-3.3YD5-.TR'), 
    array( 'partNum' => 'SSL1523P/N2112', 'mfr' => 'NXP')
);
$getData = CallAPI($url, $parts);
// $getData = json_decode($getData, true);
print_r($getData);
