<?php 
require('../../../wp-blog-header.php');
header("HTTP/1.1 200 OK");

$xCurrentIP=$_SERVER['REMOTE_ADDR'];

$xIPArr = unserialize(get_option('xGABIPS'));
$xArrValues = unserialize(get_option('xGABValues'));
$xGABBeers = $xArrValues[1];
$i=0;
$xStatus = 0;
while($xIPArr[$i]) {
    if($xIPArr[$i]==$xCurrentIP) {$xStatus = 1;break;}
    $i++;
}
if($xStatus == 0) {
    $i=1;
    if(sizeof($xIPArr)==3) {
        while($xIPArr[$i]) {
            $xIPArr[$i] = $xIPArr[$i-1];
            $i++;
        }
        $xIPArr[0] = $xCurrentIP;//'add's current ip to list
    }else {
        $xIPArr[] = $xCurrentIP;//'add's current ip to list
    }
    if($xGABBeers=="") {$xGABBeers=0;}
    $xGABBeers++;//add's a beer

    
    $xArrValues[1] = $xGABBeers;
    update_option('xGABValues', serialize($xArrValues));
    update_option("xGABIPS",serialize($xIPArr));

    echo "<b>".$xGABBeers."</b> Beers Received";
}else {
    echo "<b>".$xGABBeers."</b> Beers Received";
    echo "<br/><u>You must wait a while before you can give more beer.</u>";
}
?>