<?php

    include_once("fun.inc.php");

    $paystatus=retInvoiceP("PUH/22/3994","UNIMED SPGS SCHOOL FEE","2022/2023");

    if($paystatus==0){
        echo $paystatus;
    }else{
        print_r($paystatus);
    }
    echo "<br />";

    $amoutPaid=getSumPaid("PUH/22/3994","UNIMED SPGS SCHOOL FEE","2022/2023");

    echo $amoutPaid;

?>