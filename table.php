<?php 
/**
* SUPREME COMPONENTS INTERNATIONAL TECHNICAL TEST
* @author Cahyono <chayo_eno@yahoo.com
*/ ?>
<style type="text/css">
    table {
        width:100%;
        border-collapse:collapse;
    }
    th,td {
        border:1px solid #000;
        padding:4px 2px;
    }
</style>
<title>SCI TECHNICAL TEST</title>
<?php
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
$getData = json_decode($getData, true);

$data = $getData['itemserviceresult']['data'];
$resultList = $data[0]['resultList'];
$partsRequested = $data[0]['partsRequested'];
$partsFound = $data[0]['partsFound'];
$partsNotFound = $data[0]['partsNotFound'];
$partsError = $data[0]['partsError'];
// print_r($data);
echo "<h4>Search Part Result</h4>";
echo "Parts Requested: ".$partsRequested." | "."Parts Found: ".$partsFound." | "."Parts Error: ".$partsError."<br />";
echo "<table>
        <tr><th>Part No</th><th>Manufacture</th><th>Description</th><th>Sources</th></tr>";

foreach ($resultList as $r => $rs) {
    // print_r($rs['PartList']);
    if(isset($rs['PartList'][0]['partNum'])) {
        $mfr = $rs['PartList'][0]['manufacturer'];
        $sources = $rs['PartList'][0]['InvOrg']['sources'];
        $sourceView = "";
        $stsAvailability = "";
        foreach ($sources as $source) {
            $sourceName = $source['displayName'];
            $sourceParts = $source['sourceParts'];
            foreach ($sourceParts as $sourcePart) {
                $stock = isset($sourcePart['Availability'][0]['fohQty']) ? $sourcePart['Availability'][0]['fohQty'] : 0;
                $stsAvailability = ($sourcePart['inStock']=="1") ? "In Stock (Qty: ".$stock.")" : "Out Of Stock";
            }
            $sourceView .= "<b>".$sourceName."</b><br />".$stsAvailability."<br />";
        }
        echo "<tr><td>".$rs['PartList'][0]['partNum']."</td>
        <td>".$mfr['mfrName']."</td><td>".$rs['PartList'][0]['desc']."</td><td>".$sourceView."</td></tr>";
    }
}
echo "</table>";