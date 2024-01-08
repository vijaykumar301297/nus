<?php

include_once 'security.php';

?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NUS TTS System</title>

    <link rel="icon" href="img/social-square-n-blue.png">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {

            packages: ['corechart']

        });
    </script>

    <link rel="stylesheet" type="text/css" href="css/postgraph.css">

    <style>
        .nusLogo {

            position: absolute;

            left: 5%;

        }



        .container {

            display: flex;

            justify-content: end;

            margin: 20px 10% 40px 0;

        }



        .btnProperties {

            background: #345da6;

            border: none;

            padding: 5px 2%;

            color: white;

            border-radius: 5px;

            margin: 0 5px;

            cursor: pointer;

        }



        table {

            border-collapse: collapse;



        }



        table th {

            text-align: right;

            padding: 5px;

        }



        table td {

            padding: 5px;

        }



        .hrline {

            border-top: 1px solid grey;

        }



        .hrlines {

            border-bottom: 1px solid grey;

        }



        .line {

            border-top: 1px solid grey;

            border-bottom: 1px solid grey;

        }



        .hedgedColor {

            color: #4472c4;

        }



        .hedgedColor {

            color: #4472c4;



        }



        .tradeslines {

            color: #3B516C;

            border-bottom: 1px solid white;

            border-top: 3px solid #E4EBF6;

            height: 50px;

            background: white;

        }



        .heading {

            font-size: 20px;

            margin: 0;

            text-align: left;

            background: #4472c4;

            color: white;

            font-weight: 500;

            padding: 15px 0 15PX 10px;

            border-top: 2px solid #E4EBF6;

        }



        .tradesline {

            color: black;

            height: 50px;

            border-bottom: 3px solid #E4EBF6;

            padding: 5px 0;

        }



        .tableHead {

            background: #F2F2F2;

            /* color:#6E84A3; */

            font-weight: 400;

            border-top: 2px solid #E4EBF6;

        }



        h3 {

            margin-left: 60px;

            /* background:white; */

        }





        /* Print CSS starts */



        @media print {

            .sec1art1Wrapper li span {

                font-size: 6pt;

            }



            .sec1art1Wrapper li h2 {

                font-size: 8pt;

            }



            table tbody tr td {

                font-size: 8pt;

            }



            .hrline {

                border-top: 1px solid grey;

            }



            .hrlines {

                border-bottom: 1px solid grey;

            }



            .line {

                border-top: 1px solid grey;

                border-bottom: 1px solid grey;

            }

        }



        @media print {

            .nusLogo {

                margin: 0 0 100px 0;

            }



            .sec1art1Wrapper li span {

                font-size: 0.6em;

            }



            .sec1art1Wrapper li h2 {

                font-size: 10pt;

            }



            #printbtn {

                display: none;

            }



            #top_x_div {

                margin: 20pt 0 0 0;

            }

        }



        /* Print CSS Ends */
    </style>

</head>



<body>

    <header>

        <!-- <div class="headerWrapper">

            <img src="img/nus-logo-2020.svg" alt="NUS Logo" class="nusLogo">

            <a href="generatereport.php" class="back" id="printbtn">Back</a>

            <a href="" class="printPDF" id="printbtn" onclick="window.print();" >PDF</a>



     

            <button class="excelBtn" id="printbtn">Export to Excel</button>

        </div> -->







        <!-- <img src="img/nus-logo-2020.svg" alt="NUS Logo" class="nusLogo"> -->

        <div class="container">

            <button class="btnProperties" id="printbtn" onclick="window.history.go(-1);">Back</button>

            <button class="btnProperties" id="printbtn" onclick="window.print();">PDF</button>

        </div>





    </header>

    <?php

    include('dbconn.php');

    error_reporting(E_ERROR | E_PARSE);

    include 'includes/functions.php';

    $functions = new libFunc();

    // echo $_POST['contractId'];


    $clientGenerate = $_POST['clientsId'];

    if (empty($_POST['clientsId'])) {
        $supplier =  $functions->getsuppliedId($_POST['contractIds']);
    } else {
        $supplier =  $functions->getsuppliedIds($_POST['contractIds'], $clientGenerate);
    }

    // $supplier =  $functions->getsuppliedId($_POST['contractIds']);

    // $supplier =  $functions->getsuppliedIds($_POST['contractIds'],$clientGenerate);







    $tradeper = '';

    foreach ($_POST['yearstype'] as $key => $value) {

        $tradeper = $value;
    }



    $contract_query = "SELECT basegenconsumption,effectcon FROM nus_supply_contract WHERE supplierId = '" . $supplier . "'";

    $contract_qry = mysqli_query($conn, $contract_query);

    $consumptions = '';

    $eff = '';

    while ($contract_row = mysqli_fetch_assoc($contract_qry)) {

        $consumptions = $contract_row['basegenconsumption'];

        $eff = $contract_row['effectcon'];
    }

    $toarraycon = explode('|', $consumptions);

    // echo "<pre>";
    // print_r($toarraycon);

    $toeff =  explode('|', $eff);

    // print_r($toeff);

    $alvalues = explode(',', $_POST['allgenmonth']);

    $baseconsu = array();

    $effectcons = array();

    foreach ($toarraycon as $key => $vavalue) {

        $explode = explode('-', $vavalue);

        if (in_array($explode[0], $alvalues) && $explode[1] == $tradeper) {

            if (isset($_POST['basload' . $explode[0] . $explode[1]])) {

                $baseconsu[] = $explode[0] . '-' . $explode[1] . '-' . $_POST['basload' . $explode[0] . $explode[1]];
            }
        } else {

            $baseconsu[] = $explode[0] . '-' . $explode[1] . '-' . $explode[2];
        }
    }

    foreach ($toeff as $key => $valvalue) {

        $explode = explode('-', $valvalue);

        if (in_array($explode[0], $alvalues) && $explode[1] == $tradeper) {



            if (isset($_POST['effective' . $explode[0] . $explode[1]])) {

                $effectcons[] = $explode[0] . '-' . $explode[1] . '-' . $_POST['effective' . $explode[0] . $explode[1]];
            }
        } else {

            $effectcons[] = $explode[0] . '-' . $explode[1] . '-' . $explode[2];
        }
    }

    $sqlTrade = "UPDATE nus_supply_contract SET basegenconsumption ='" . implode('|', $baseconsu) . "', effectcon='" . implode('|', $effectcons) . "' WHERE supplierId=" . $supplier . "";

    // echo "<pre>";
    // echo $sqlTrade;

    // die();

    $conn->query($sqlTrade);







    $sql = "SELECT nus_supply_contract.*, clientcompanydata.* FROM nus_supply_contract 

        INNER JOIN clientcompanydata ON clientcompanydata.id = nus_supply_contract.clientId 

        WHERE supplierId='" . $supplier . "'";


    // echo "<pre>";
    // echo $sql;
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);



    ?>



    <ul>

        <div class="sec1art1Wrapper">

            <!-- <li> -->

            <img src="img/nus-logo-2020.svg" alt="NUS Logo" width="21%" style="margin: 0 0 20px 10px;">

            <!-- </li> -->

            <br>

            <li>

                <span>PARENT NAME</span>

                <h2><?php echo $row['parentcompany']; ?></h2>

            </li>

            <li>

                <span>CLIENT NAME</span>

                <h2><?php echo $row['clientcompany']; ?></h2>

            </li>

            <li>

                <span>CONTRACT SUMMARY REPORT</span>

                <h2><?php echo $row['contract_id']; ?></h2>

            </li>

            <br>

            <li class="supplierClass">

                <span>SUPPLIER</span>

                <h2><?php echo $row['supplyName']; ?></h2>

            </li>

            <?php

            if ($row['contractType'] == 'fixed') {

            ?>

                <li class="electricityClass">

                    <span>COMMODITY</span>

                    <h2><?php echo $row['commodityName']; ?> <span class="spaneleCom"> <?php echo $row['contractType']; ?></span></h2>

                </li>

            <?php

            } else {

            ?>

                <li class="gasClass">

                    <span>COMMODITY</span>

                    <h2><?php echo $row['commodityName']; ?> <span class="spangasCom"> <?php echo $row['contractType']; ?></span></h2>

                </li>

            <?php

            }

            ?>

            </li>

            <li class="reportPeriod">

                <span>REPORT PERIOD</span>

                <h2><?php echo $_POST['yearstype'][0]; ?></h2>

            </li>

            <li class="countryFlag">

                <span>COUNTRY</span>

                <h2><?php echo $row['countryName']; ?></h2>

            </li>

            <li>

                <span>CONTRACT CONSUMPTION (MWH)</span>

                <h2><?php echo $row['totalAnualConsumption']; ?></h2>

            </li>

            <li>

                <span>CURRENCY</span>

                <h2><?php echo $row['contractpricetype']; ?></h2>

            </li>

    </ul>

    <?php

    // echo $_POST['clientId'];



    $consumption = $row['consumptionmonth'];

    if ($row['contractType'] == 'fixed') {

        $hedgedconsumption = $row['consumptionmonth'];

        $price = $row['commodityPrice'];
    } else {

        $hedgedconsumption = $row['hedgeconsumption'];

        $price = 0;
    }

    $comm = array(explode("|", $consumption));

    $comm2 = array(explode("|", $hedgedconsumption));



    $arcount = count($comm);

    $maxcount = count($comm[0]);



    $arcount2 = count($comm2);

    $maxcount2 = count($comm2[0]);



    $consumptionpercentage = array(

        "year" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),

        "month" => array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),

        "consumption" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),

        "price" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)

    );

    $hedgedconsumptionpercentage = array(

        "year" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),

        "month" => array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),

        "consumption" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),

        "price" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)

    );







    function myFunc($r)

    {

        $res = '';

        $comm = explode(",", $r);

        $maxcount = count($comm);

        for ($i = 0; $i < $maxcount; $i++) {

            $res = $res . $comm[$i];
        }

        return $res;
    }



    $monthArray = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];



    // echo $maxcount;

    for ($i = 0; $i < $maxcount; $i++) {

        $conn1 = array(explode("-", $comm[0][$i]));

        if ($_POST['yearstype'][0] == $conn1[0][1]) {



            for ($j = 0; $j < 12; $j++) {

                if ($monthArray[$j] == $conn1[0][0]) {

                    array_splice($consumptionpercentage['year'], $j, 1, $conn1[0][1]);

                    array_splice($consumptionpercentage['month'], $j, 1, $conn1[0][0]);

                    array_splice($consumptionpercentage['consumption'], $j, 1, $conn1[0][2]);

                    array_splice($consumptionpercentage['price'], $j, 1, $price);
                } else {
                }
            }
        } else {

            continue;
        }
    }

    if ($_POST['clientId'] == 'tradehistry') {

        require_once('tradehistory.php');

        die();
    }



    /// code for the power MW reports starts here!



    if ($row['indexStructureType'] == "Power(MW)") {

    ?>

        <div id="container1" style="width: 900px; height: 400px; margin: 0 auto"></div>

    <?php

        require('genpower.php');

        die();
    }



    /// code for the power MW reports ends here!



    // echo "<pre>";

    // print_r($consumptionpercentage['consumption']);



    // echo $conumptionpercentage['consumption'][10];



    // echo "<pre>";

    // print_r($consumptionpercentage);



    for ($i = 0; $i < $maxcount2; $i++) {

        $conn2 = array(explode("-", $comm2[0][$i]));

        if ($_POST['yearstype'][0] == $conn2[0][1]) {

            for ($j = 0; $j < 12; $j++) {

                if ($monthArray[$j] == $conn2[0][0]) {

                    array_splice($hedgedconsumptionpercentage['year'], $j, 1, $conn2[0][1]);

                    array_splice($hedgedconsumptionpercentage['month'], $j, 1, $conn2[0][0]);

                    array_splice($hedgedconsumptionpercentage['consumption'], $j, 1, $conn2[0][2]);

                    array_splice($hedgedconsumptionpercentage['price'], $j, 1, $price);
                } else {
                    // echo "Fallen Angel";
                }
            }
        } else {

            continue;
        }
    }



    $maxcountOpen = count($consumptionpercentage['consumption']);

    // echo $maxcountOpen;



    $openconsumption = array(

        "openconsumpt" => array()

    );



    for ($i = 0; $i < $maxcountOpen; $i++) {

        $sub = (float)$consumptionpercentage["consumption"][$i] - (float)$hedgedconsumptionpercentage["consumption"][$i];

        array_push($openconsumption["openconsumpt"], $sub);
    }



    $percenthedged = array(

        "hedgedperc" => array()

    );



    for ($i = 0; $i < $maxcountOpen; $i++) {

        if ($hedgedconsumptionpercentage["consumption"][$i] == 0 || $consumptionpercentage["consumption"][$i] == 0) {
            $calculate = 0;
        } else if (is_nan((float)$calculate)) {

            $calculate = 0;
        } else {
            $calculate = (float)$hedgedconsumptionpercentage["consumption"][$i] / (float)$consumptionpercentage["consumption"][$i] * 100.00;
        }

        array_push($percenthedged['hedgedperc'], $calculate);
    }



    $percentopen = array(

        "openpercent" => array()

    );



    for ($i = 0; $i < $maxcountOpen; $i++) {

        $calculate = (float) 100 - $percenthedged['hedgedperc'][$i];

        array_push($percentopen['openpercent'], $calculate);
    }

    // echo $row['contractType'];

    // $_SESSION['contract'] = $row['contractType'];



    // echo "<pre>";
    // print_r($hedgedconsumptionpercentage);
    // print_r($consumptionpercentage);



    ?>



    <?php

    if ($row['contractType'] == 'indexed') {

        $contType = $row['contract_id'];

        $sql1 = "SELECT * FROM enter_trade WHERE supplycontractid='$contType' AND tradeexecuted ='Executed' AND clientId = '" . $_POST['clientsId'] . "';";

        $result1 = mysqli_query($conn, $sql1);

        $row1 = mysqli_fetch_assoc($result1);

        //print_r($row1);



        $gen_baseprice = $row['basegenconsumption'];

        $comm3 = array(explode("|", $gen_baseprice));



        $maxcount3 = count($comm3[0]);



        $baseprice = array(

            "month" => array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),

            "year" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),

            "price" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)

        );



        for ($i = 0; $i < $maxcount3; $i++) {

            $conn3 = array(explode("-", $comm3[0][$i]));



            //echo $_POST['yearstype'][0];



            // if ($_POST['yearstype'][0] === $conn3[0][1]) {

            //     //echo "yes";

            //     array_push($baseprice['year'], $conn3[0][1]);

            //     array_push($baseprice['month'], $conn3[0][0]);

            //     array_push($baseprice['price'], $conn3[0][2]);

            // } 

            // print_r($baseprice['price']);

            if ($_POST['yearstype'][0] == $conn3[0][1]) {

                for ($j = 0; $j < 12; $j++) {

                    if ($monthArray[$j] == $conn3[0][0]) {

                        // echo $monthArray[$j];



                        array_splice($baseprice['year'], $j, 1, $conn3[0][1]);

                        array_splice($baseprice['month'], $j, 1, $conn3[0][0]);

                        array_splice($baseprice['price'], $j, 1, $conn3[0][2]);
                    } else {
                    }
                }
            } else {

                continue;
            }
        }

        // echo "<pre>";

        // print_r($conn3);



        $gen_effecprice = $row['effectcon'];

        $comm4 = array(explode("|", $gen_effecprice));



        $maxcount4 = count($comm4[0]);

        // echo "<pre>";
        // print_r($gen_effecprice);



        $effecprice = array(

            "month" => array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),

            "year" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),

            "price" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)

        );



        for ($i = 0; $i < $maxcount4; $i++) {

            $conn4 = array(explode("-", $comm4[0][$i]));

            if ($_POST['yearstype'][0] == $conn4[0][1]) {

                for ($j = 0; $j < 12; $j++) {

                    if ($monthArray[$j] == $conn4[0][0]) {

                        array_splice($effecprice['year'], $j, 1, $conn4[0][1]);

                        array_splice($effecprice['month'], $j, 1, $conn4[0][0]);

                        array_splice($effecprice['price'], $j, 1, $conn4[0][2]);
                    } else {
                    }
                }
            } else {

                continue;
            }
        }





        $wapbaseload_price = array(

            "wapbasePrice" => array()

        );



        $waphedged_price = array(

            "waphedgedPrice" => array()

        );



        for ($i = 0; $i < $maxcount4; $i++) {

            array_push($wapbaseload_price['wapbasePrice'], $row1['baseload']);
        }



        for ($i = 0; $i < $maxcount4; $i++) {

            array_push($waphedged_price['waphedgedPrice'], $row1['effectiveprice']);
        }





        $tradeconsumption = array(

            'consumption' => array(),

            'baseprice' => array(),

            'effecprice' => array()

        );



        $newconsumption = array(

            'consumption' => array(),

            'baseprice' => array(),

            'effecprice' => array()

        );



        $finalconsumption = array(

            'consumption' => array(),

            'baseprice' => array(),

            'effecprice' => array()

        );



        $yearChoosen = $_POST['yearstype'][0];

        //echo $yearChoosen;



        // echo $contType.$yearChoosen;

        $sql1 = "SELECT * FROM enter_trade WHERE supplycontractid='$contType' AND tradevalue='$yearChoosen' AND tradeexecuted ='Executed' AND clientId = '" . $_POST['clientsId'] . "';";

        $result1 = mysqli_query($conn, $sql1);

        // print_r($result1);

        // $row1 = mysqli_fetch_assoc($result1);

        // echo "<pre>";

        // print_r($row1);



        $array1 = array(

            // 'consumption'=>array(0,0,0,0,0,0,0,0,0,0,0,0),

            'baseprice' => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),

            'effecprice' => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)

        );



        $newbasePrice = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        $neweffecPrice = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);



        $calendar = array();

        $basprice = array();

        $effective = array();

        $perc = array();







        $result2 = mysqli_query($conn, $sql1);

        while ($row2 = mysqli_fetch_assoc(($result2))) {

            if ($row2['trade'] == "Calendar Quarterly") {

                array_push($calendar, $row2['quartval']);
            } else if ($row2['trade'] == "Calendar Yearly") {

                array_push($calendar, $row2['trade']);
            } else if ($row2['trade'] == "Calendar Monthly") {

                array_push($calendar, $row2['quartval']);
            }

            // $pp = intval($row2['percentage']);

            if (empty($row2['percentage'])) {
                $mw = 'MWH';
                array_push($perc, $row2['tradevolume'] . $mw);
                // echo "<pre>";
                // echo "Here I am";

            } else {

                array_push($perc, $row2['percentage']);
            }



            // $bp = intval($row2['baseload']);

            array_push($basprice, $row2['baseload']);

            // print_r($row2['baseload']);

            // $ep = intval($row2['effectiveprice']);

            array_push($effective, $row2['effectiveprice']);
        }


        // echo "<pre>";
        // print_r($perc);
        // echo "<br>";



        // print_r($basprice);

        $checkcount = count($calendar);

        $checkbase = count($basprice);

        // print_r($calendar);



        for ($qua = 0; $qua < $checkcount; $qua++) {



            if ($calendar[$qua] == "q1") {

                for ($i = 0; $i < 3; $i++) {

                    $new1 = '';

                    if ($array1['baseprice'][$i] != '') {

                        $new1 = "," . $array1['baseprice'][$i];
                    }

                    $new2 = '';

                    if ($array1['effecprice'][$i] != '') {

                        $new2 = "," . $array1['effecprice'][$i];
                    }

                    $consumption1 = $consumptionpercentage['consumption'][$i];

                    $percentage1 = $perc[$qua];

                    // echo "<pre>";
                    // echo "percentage = " . $percentage1;

                    $checkRes = str_contains($percentage1, 'MWH');
                    // echo $checkRes;

                    // if ($percentage1 > 100) {

                    //     $percentage1 = $percentage1 / 3;

                    //     // echo $percentage1;

                    // }

                    if ($checkRes == 1) {
                        // echo "Luffy";
                        $percentage1 = str_replace('MWH', '', $percentage1);
                        $percentage1 = $percentage1 / 3;
                        // echo "percent value = " . $percentage1;
                    }

                    $baseprice1 = $basprice[$qua];

                    $effectiveprice1 = $effective[$qua];

                    //echo $new;
                    if ($checkRes == 1) {
                        $mw = 'MWH';
                        array_splice($array1['baseprice'], $i, 1, "$consumption1-$percentage1$mw-$baseprice1$new1");

                        array_splice($array1['effecprice'], $i, 1, "$consumption1-$percentage1$mw-$effectiveprice1$new2");
                    } else {
                        array_splice($array1['baseprice'], $i, 1, "$consumption1-$percentage1-$baseprice1$new1");

                        array_splice($array1['effecprice'], $i, 1, "$consumption1-$percentage1-$effectiveprice1$new2");
                    }
                }

                // echo "<pre>";

                // print_r($array1);
            } else if ($calendar[$qua] == "q2") {

                for ($i = 3; $i < 6; $i++) {

                    $new1 = '';

                    if ($array1['baseprice'][$i] != '') {

                        $new1 = "," . $array1['baseprice'][$i];
                    }

                    $new2 = '';

                    if ($array1['effecprice'][$i] != '') {

                        $new2 = "," . $array1['effecprice'][$i];
                    }

                    $consumption1 = $consumptionpercentage['consumption'][$i];

                    $percentage1 = $perc[$qua];

                    $checkRes = str_contains($percentage1, 'MWH');

                    if ($checkRes == 1) {
                        // echo "Luffy";
                        $percentage1 = str_replace('MWH', '', $percentage1);
                        $percentage1 = $percentage1 / 3;
                        // echo "percent value = " . $percentage1;
                    }

                    // if ($percentage1 > 100) {

                    //     $percentage1 = $percentage1 / 3;
                    // }

                    $baseprice1 = $basprice[$qua];

                    $effectiveprice1 = $effective[$qua];

                    //echo $new;

                    if ($checkRes == 1) {

                        $mw = 'MWH';
                        array_splice($array1['baseprice'], $i, 1, "$consumption1-$percentage1$mw-$baseprice1$new1");
                        array_splice($array1['effecprice'], $i, 1, "$consumption1-$percentage1$mw-$effectiveprice1$new2");
                    } else {
                        array_splice($array1['baseprice'], $i, 1, "$consumption1-$percentage1-$baseprice1$new1");
                        array_splice($array1['effecprice'], $i, 1, "$consumption1-$percentage1-$effectiveprice1$new2");
                    }
                }
            } else if ($calendar[$qua] == "q3") {

                for ($i = 6; $i < 9; $i++) {

                    $new1 = '';

                    if ($array1['baseprice'][$i] != '') {

                        $new1 = "," . $array1['baseprice'][$i];
                    }

                    $new2 = '';

                    if ($array1['effecprice'][$i] != '') {

                        $new2 = "," . $array1['effecprice'][$i];
                    }

                    $consumption1 = $consumptionpercentage['consumption'][$i];

                    $percentage1 = $perc[$qua];

                    $checkRes = str_contains($percentage1, 'MWH');

                    if ($checkRes == 1) {
                        // echo "Luffy";
                        $percentage1 = str_replace('MWH', '', $percentage1);
                        $percentage1 = $percentage1 / 3;
                        // echo "percent value = " . $percentage1;
                    }

                    // if ($percentage1 > 100) {

                    //     $percentage1 = $percentage1 / 3;
                    // }

                    $baseprice1 = $basprice[$qua];

                    $effectiveprice1 = $effective[$qua];

                    //echo $new;

                    if ($checkRes == 1) {
                        $mw = 'MWH';
                        array_splice($array1['baseprice'], $i, 1, "$consumption1-$percentage1$mw-$baseprice1$new1");
                        array_splice($array1['effecprice'], $i, 1, "$consumption1-$percentage1$mw-$effectiveprice1$new2");
                    } else {
                        array_splice($array1['baseprice'], $i, 1, "$consumption1-$percentage1-$baseprice1$new1");
                        array_splice($array1['effecprice'], $i, 1, "$consumption1-$percentage1-$effectiveprice1$new2");
                    }
                }
            } else if ($calendar[$qua] == "q4") {

                for ($i = 9; $i < 12; $i++) {

                    $new1 = '';

                    if ($array1['baseprice'][$i] != '') {

                        $new1 = "," . $array1['baseprice'][$i];
                    }

                    $new2 = '';

                    if ($array1['effecprice'][$i] != '') {

                        $new2 = "," . $array1['effecprice'][$i];
                    }

                    $consumption1 = $consumptionpercentage['consumption'][$i];

                    $percentage1 = $perc[$qua];

                    $checkRes = str_contains($percentage1, 'MWH');

                    if ($checkRes == 1) {
                        // echo "Luffy";
                        $percentage1 = str_replace('MWH', '', $percentage1);
                        $percentage1 = $percentage1 / 3;
                        // echo "percent value = " . $percentage1;
                    }

                    // if ($percentage1 > 100) {

                    //     $percentage1 = $percentage1 / 3;
                    // }

                    $baseprice1 = $basprice[$qua];

                    $effectiveprice1 = $effective[$qua];

                    //echo $new;
                    if ($checkRes == 1) {
                        $mw = 'MWH';
                        array_splice($array1['baseprice'], $i, 1, "$consumption1-$percentage1$mw-$baseprice1$new1");
                        array_splice($array1['effecprice'], $i, 1, "$consumption1-$percentage1$mw-$effectiveprice1$new2");
                    } else {
                        array_splice($array1['baseprice'], $i, 1, "$consumption1-$percentage1-$baseprice1$new1");
                        array_splice($array1['effecprice'], $i, 1, "$consumption1-$percentage1-$effectiveprice1$new2");
                    }
                }
            } else if ($calendar[$qua] == "Calendar Yearly") {

                for ($i = 0; $i < 12; $i++) {

                    $new1 = '';

                    if ($array1['baseprice'][$i] != '') {

                        $new1 = "," . $array1['baseprice'][$i];
                    }

                    // echo "<pre>";
                    // echo "Check = ".$new1;

                    $new2 = '';

                    if ($array1['effecprice'][$i] != '') {

                        $new2 = "," . $array1['effecprice'][$i];
                    }

                    $consumption1 = $consumptionpercentage['consumption'][$i];

                    $percentage1 = $perc[$qua];

                    // if ($percentage1 > 100) {

                    //     $percentage1 = $percentage1 / 12;
                    // }

                    $checkRes = str_contains($percentage1, 'MWH');

                    if ($checkRes == 1) {
                        // echo "Luffy";
                        $percentage1 = str_replace('MWH', '', $percentage1);
                        $percentage1 = $percentage1 / 12;
                        // echo "percent value = " . $percentage1;
                    }

                    $baseprice1 = $basprice[$qua];

                    $effectiveprice1 = $effective[$qua];

                    //echo $new;

                    if ($checkRes == 1) {
                        $mw = 'MWH';
                        array_splice($array1['baseprice'], $i, 1, "$consumption1-$percentage1$mw-$baseprice1$new1");

                        array_splice($array1['effecprice'], $i, 1, "$consumption1-$percentage1$mw-$effectiveprice1$new2");
                    } else {
                        array_splice($array1['baseprice'], $i, 1, "$consumption1-$percentage1-$baseprice1$new1");
                        array_splice($array1['effecprice'], $i, 1, "$consumption1-$percentage1-$effectiveprice1$new2");
                    }

                    // echo "<pre>";
                    // print_r($array1['baseprice']);
                    // echo "<pre>";
                    // print_r($array1['effecprice']);

                }
            } else {

                // echo "<pre>";
                // echo "It's a month selection";



                switch ($calendar[$qua]) {



                    case 'Jan':

                        $month = 0;

                        break;

                    case 'Feb':

                        $month = 1;

                        break;

                    case 'Mar':

                        $month = 2;

                        break;

                    case 'Apr':

                        $month = 3;

                        break;

                    case 'May':

                        $month = 4;

                        break;

                    case 'Jun':

                        $month = 5;

                        break;

                    case 'July':

                        $month = 6; //echo "<pre>"; echo "It's july";

                        break;

                    case 'Aug':

                        $month = 7;

                        break;

                    case 'Sep':

                        $month = 8;

                        break;

                    case 'Oct':

                        $month = 9;

                        break;

                    case 'Nov':

                        $month = 10;

                        break;

                    default:

                        $month = 11;

                        break;
                }

                $consumption1 = $consumptionpercentage['consumption'][$month];

                $percentage1 = $perc[$qua];

                $checkRes = str_contains($percentage1, 'MWH');

                if ($checkRes == 1) {
                    // echo "Luffy";
                    $percentage1 = str_replace('MWH', '', $percentage1);
                    $percentage1 = $percentage1;
                    // echo "percent value = " . $percentage1;
                }

                $baseprice1 = $basprice[$qua];

                $effectiveprice1 = $effective[$qua];



                $new1 = '';

                if ($array1['baseprice'][$month] != '') {

                    $new1 = "," . $array1['baseprice'][$month];
                }

                $new2 = '';

                if ($array1['effecprice'][$month] != '') {

                    $new2 = "," . $array1['effecprice'][$month];
                }


                if ($checkRes == 1) {
                    $mw = 'MWH';
                    array_splice($array1['baseprice'], $month, 1, "$consumption1-$percentage1$mw-$baseprice1$new1");

                    array_splice($array1['effecprice'], $month, 1, "$consumption1-$percentage1$mw-$effectiveprice1$new2");
                } else {
                    array_splice($array1['baseprice'], $month, 1, "$consumption1-$percentage1-$baseprice1$new1");

                    array_splice($array1['effecprice'], $month, 1, "$consumption1-$percentage1-$effectiveprice1$new2");
                }



                // echo "<pre>";
                // print_r($array1['baseprice']);

                // echo "<pre>";
                // print_r($array1['effecprice']);

            }
        }



        for ($j = 0; $j < 12; $j++) {

            $newarr = explode(",", $array1['baseprice'][$j]);

            if (count($newarr) > 1) {

                $res11 = 0;

                $res12 = 0;

                for ($w = 0; $w < count($newarr); $w++) {

                    $old = explode("-", $newarr[$w]);
                    // echo "<pre>";
                    // print_r($old);

                    if ($old[1] >= 100) {
                        // echo "<pre>";
                        // echo "You are here " . $j;
                        $calcOld = 0;
                        if ($old[0] == 0) {
                            $calcOld = 0;
                        } else {
                            $calcOld = $old[1] / $old[0];
                        }

                        $res11 = $res11 + ($old[0] * ($calcOld) * $old[2]);

                        $res12 = $res12 + ($old[0] * $calcOld);
                    } else {
                        // echo "<pre>";
                        // echo "Not here " . $j;

                        $res11 = $res11 + ($old[0] * $old[1] / 100 * $old[2]);

                        $res12 = $res12 + ($old[0] * $old[1] / 100);
                    }

                    //    $res11 = $res11 + ($old[0]*$old[1]/100*$old[2]);

                    //    $res12 = $res12 + ($old[0]*$old[1]/100);

                }

                if ($res12 === 0) {
                    $final = 0;
                    // echo "You came here";
                } else {
                    $final = $res11 / $res12;
                }



                // echo $final;

                array_splice($newbasePrice, $j, 1, round($final, 2));

                // echo "<pre>";
                // print_r($newbasePrice);

            } else {

                if ($array1['baseprice'][$j] == '') {

                    continue;
                }

                $newcal = explode("-", $array1['baseprice'][$j]);

                $calcNewCal = 0;

                if ($newcal[0] == 0) {
                    $calcNewCal = 0;
                } else {
                    $calcNewCal = $newcal[1] / $newcal[0];
                }

                if ($newcal[1] >= 100) {

                    $res1 = $newcal[0] * (($calcNewCal) * $newcal[2]);

                    $res2 = $newcal[0] * $calcNewCal;
                } else {

                    $res1 = $newcal[0] * $newcal[1] / 100 * $newcal[2];

                    $res2 = $newcal[0] * $newcal[1] / 100;
                }



                //  $res1 = $newcal[0]*$newcal[1]/100*$newcal[2];

                //  $res2 = $newcal[0]*$newcal[1]/100;

                if ($res1 == 0 || $res2 == 0) {
                    $final = 0;
                } else {
                    $final = $res1 / $res2;
                }


                // $final = $res1 / $res2;

                // print_r($newcal);

                //echo $final;



                if (is_nan($final)) {

                    $final = 0;
                }



                array_splice($newbasePrice, $j, 1, round($final, 2));

                // echo "<pre>";
                // print_r($newbasePrice);

            }
        }



        for ($j = 0; $j < 12; $j++) {

            $newarr = explode(",", $array1['effecprice'][$j]);

            if (count($newarr) > 1) {

                $res11 = 0;

                $res12 = 0;

                for ($w = 0; $w < count($newarr); $w++) {

                    $old = explode("-", $newarr[$w]);



                    if ($old[1] >= 100) {

                        $calcVal = 0;
                        if ($old[0] == 0) {
                            $calcVal = 0;
                        } else {
                            $calcVal = $old[1] / $old[0];
                        }

                        $res11 = $res11 + ($old[0] * ($calcVal) * $old[2]);

                        $res12 = $res12 + ($old[0] * $calcVal);
                    } else {

                        $res11 = $res11 + ($old[0] * $old[1] / 100 * $old[2]);

                        $res12 = $res12 + ($old[0] * $old[1] / 100);
                    }



                    //    $res11 = $res11 + ($old[0]*$old[1]/100*$old[2]);

                    //    $res12 = $res12 + ($old[0]*$old[1]/100);

                }

                if ($res12 === 0) {
                    $final = 0;
                } else {
                    $final = $res11 / $res12;
                }



                // echo $final;

                array_splice($neweffecPrice, $j, 1, round($final, 2));

                // echo "<pre>";
                // print_r($neweffecPrice);

            } else {

                if ($array1['effecprice'][$j] == '') {

                    continue;
                }

                $newcal = explode("-", $array1['effecprice'][$j]);



                if ($newcal[1] >= 100) {

                    $calVal = 0;

                    if ($newcal[0] == 0) {
                        $calVal = 0;
                    } else {
                        $calVal = $newcal[1] / $newcal[0];
                    }

                    $res1 = $newcal[0] * (($calVal) * $newcal[2]);

                    $res2 = $newcal[0] * $calVal;
                } else {

                    $res1 = $newcal[0] * $newcal[1] / 100 * $newcal[2];

                    $res2 = $newcal[0] * $newcal[1] / 100;
                }





                //  $res1 = $newcal[0]*$newcal[1]/100*$newcal[2];

                //  $res2 = $newcal[0]*$newcal[1]/100;

                if ($res1 == 0 || $res2 == 0) {
                    $final = 0;
                } else {
                    $final = $res1 / $res2;
                }

                // $final = $res1 / $res2;

                // print_r($newcal);

                //echo $final;



                if (is_nan($final)) {

                    $final = 0;
                }



                array_splice($neweffecPrice, $j, 1, round($final, 2));

                // echo "<pre>";
                // print_r($neweffecPrice);

            }
        }



        for ($jj = 0; $jj < 12; $jj++) {

            array_splice($array1['baseprice'], $jj, 1, $newbasePrice[$jj]);

            array_splice($array1['effecprice'], $jj, 1, $neweffecPrice[$jj]);
        }

        // echo "<pre>";
        // print_r($array1['baseprice']);








        // for($i=0; $i<$checkcount; $i++) {

        //     if($calendar[$i] == "Calendar Yearly") {

        //         // echo "Yearly";

        //       for($j=0;$j<count($consumptionpercentage['consumption']);$j++ ) {

        //         if($array1['baseprice'][$j] == 0) {

        //             // echo "<pre>";

        //             // echo $consumptionpercentage['consumption'][$j];

        //           $consPercent = $consumptionpercentage['consumption'][$j]*($perc[$i]/100);

        //           $res1 = ($consPercent * $basprice[$i])/$consPercent;

        //           $res2 = ($consPercent * $effective[$i])/$consPercent;

        //           array_splice($array1['baseprice'],$j,1,$res1);

        //           array_splice($array1['effecprice'],$j,1,$res2);

        //         }

        //         else {

        //             // echo "Yes";'

        //             $constConsumption1 = 0;

        //             $constConsumption2 = 0;

        //             $constConsumption3 = 0;

        //             $constConsumption4 = 0;

        //             $ressq11=0;

        //             $ressq12=0;

        //             $ressq21=0;

        //             $ressq22=0;

        //             $ressq31=0;

        //             $ressq32=0;

        //             $ressq41=0;

        //             $ressq42=0;

        //             $flagq1=0;

        //             $flagq2=0;

        //             $flagq3=0;

        //             $flagq4=0;

        //             $consPercent = $consumptionpercentage['consumption'][$j]*($perc[$i]/100);

        //             $consPercent1 = $consumptionpercentage['consumption'][$j]*($perc[$i-1]/100);



        //             // echo $consPercent;

        //             // echo $consPercent1;



        //             $counteCount = $i;



        //             for(; $counteCount>=0; $counteCount--) {



        //               // $constConsumption = 0;



        //               if($calendar[$counteCount] == "q1" || $calendar[$counteCount] == "Calendar Yearly") {

        //                 $checking = $consumptionpercentage['consumption'][$j]*($perc[$counteCount]/100);

        //                 $constConsumption1 = $constConsumption1 + $checking;



        //                 // echo $constConsumption."\n";

        //                 // echo $array1['consumption'][$j];



        //                 $ressq11 = $ressq11 + ($checking*$basprice[$counteCount]);

        //                 $ressq12 = $ressq12 + ($checking*$effective[$counteCount]);

        //                 $flagq1=1;

        //               }



        //                if($calendar[$counteCount] == "q2" || $calendar[$counteCount] == "Calendar Yearly") {

        //                 $checking = $consumptionpercentage['consumption'][$j]*($perc[$counteCount]/100);

        //                 $constConsumption2 = $constConsumption2 + $checking;



        //                 // echo $constConsumption."\n";

        //                 // echo $array1['consumption'][$j];



        //                 $ressq21 = $ressq21 + ($checking*$basprice[$counteCount]);

        //                 $ressq22 = $ressq22 + ($checking*$effective[$counteCount]);

        //                 $flagq2=1;

        //               }



        //                if($calendar[$counteCount] == "q3" || $calendar[$counteCount] == "Calendar Yearly") {

        //                 $checking =$consumptionpercentage['consumption'][$j]*($perc[$counteCount]/100);

        //                 $constConsumption3 = $constConsumption3 + $checking;



        //                 // echo $constConsumption."\n";

        //                 // echo $array1['consumption'][$j];



        //                 $ressq31 = $ressq31 + ($checking*$basprice[$counteCount]);

        //                 $ressq32 = $ressq32 + ($checking*$effective[$counteCount]);

        //                 $flagq3=1;

        //               }

        //               if ($calendar[$counteCount] == "q4" || $calendar[$counteCount] == "Calendar Yearly") {

        //                 $checking = $consumptionpercentage['consumption'][$j]*($perc[$counteCount]/100);

        //                 $constConsumption4 = $constConsumption4 + $checking;



        //                 // echo $constConsumption."\n";

        //                 // echo $array1['consumption'][$j];



        //                 $ressq41 = $ressq41 + ($checking*$basprice[$counteCount]);

        //                 $ressq42 = $ressq42 + ($checking*$effective[$counteCount]); 

        //                 $flagq4=1;

        //               }



        //             }

        //             // echo "Ress1 = ".$ress1."\n";

        //             // echo "Ress2 = ".$ress2."\n";

        //             if($flagq1) {

        //                 for($wq=0; $wq<3; $wq++) {

        //                   $res1 = (($consPercent*$basprice[$i])+($consPercent1*$basprice[$i-1]))/(($consPercent)+($consPercent1));

        //                   $res2 = (($consPercent*$effective[$i])+($consPercent1*$effective[$i-1]))/(($consPercent)+($consPercent1));

        //                   array_splice($array1['baseprice'],$wq,1,round($ressq11/$constConsumption1,2));

        //                   array_splice($array1['effecprice'],$wq,1,round($ressq12/$constConsumption1,2));

        //                 }

        //             }



        //             if($flagq2) {

        //                 for($wq=3; $wq<6; $wq++) {

        //                   $res1 = (($consPercent*$basprice[$i])+($consPercent1*$basprice[$i-1]))/(($consPercent)+($consPercent1));

        //                   $res2 = (($consPercent*$effective[$i])+($consPercent1*$effective[$i-1]))/(($consPercent)+($consPercent1));

        //                   array_splice($array1['baseprice'],$wq,1,round($ressq21/$constConsumption2,2));

        //                   array_splice($array1['effecprice'],$wq,1,round($ressq22/$constConsumption2,2));

        //                 }

        //             }



        //             if($flagq3) {

        //                 for($wq=6; $wq<9; $wq++) {

        //                   $res1 = (($consPercent*$basprice[$i])+($consPercent1*$basprice[$i-1]))/(($consPercent)+($consPercent1));

        //                   $res2 = (($consPercent*$effective[$i])+($consPercent1*$effective[$i-1]))/(($consPercent)+($consPercent1));

        //                   array_splice($array1['baseprice'],$wq,1,round($ressq31/$constConsumption3,2));

        //                   array_splice($array1['effecprice'],$wq,1,round($ressq32/$constConsumption3,2));

        //                 }

        //             }



        //             if($flagq4) {

        //                 for($wq=9; $wq<12; $wq++) {

        //                   $res1 = (($consPercent*$basprice[$i])+($consPercent1*$basprice[$i-1]))/(($consPercent)+($consPercent1));

        //                   $res2 = (($consPercent*$effective[$i])+($consPercent1*$effective[$i-1]))/(($consPercent)+($consPercent1));

        //                   array_splice($array1['baseprice'],$wq,1,round($ressq41/$constConsumption4,2));

        //                   array_splice($array1['effecprice'],$wq,1,round($ressq42/$constConsumption4,2));

        //                 }

        //             }



        //           }

        //         }

        //       }

        //      else if($calendar[$i] == "q1") {

        //         // echo "q1";

        //       $constConsumption = 0;

        //       $ress1=0;

        //       $ress2=0;

        //       $flag=0;

        //       for($j=0; $j<3; $j++) {

        //         if($array1['baseprice'][$j] == 0) {

        //           $consPercent = $consumptionpercentage['consumption'][$j]*($perc[$i]/100);

        //           $res1 = ($consPercent * $basprice[$i])/$consPercent;

        //           $res2 = ($consPercent * $effective[$i])/$consPercent;

        //           array_splice($array1['baseprice'],$j,1,$res1);

        //           array_splice($array1['effecprice'],$j,1,$res2);

        //           $flag=1;

        //         } else {

        //           $consPercent = $consumptionpercentage['consumption'][$j]*($perc[$i]/100);

        //           $consPercent1 = $consumptionpercentage['consumption'][$j]*($perc[$i-1]/100);



        //           $counteCount = $i;



        //           for(; $counteCount>=0; $counteCount--) {



        //             if($calendar[$counteCount] == "q1" || $calendar[$counteCount] == "Calendar Yearly") {

        //                 $checking = $consumptionpercentage['consumption'][$j]*($perc[$counteCount]/100);

        //                 $constConsumption = $constConsumption + $checking;    

        //                 $ress1 = $ress1 + ($checking*$basprice[$counteCount]);

        //                 $ress2 = $ress2 + ($checking*$effective[$counteCount]); 

        //             }



        //           }

        //           $res1 = (($consPercent*$basprice[$i])+($consPercent1*$basprice[$i-1]))/(($consPercent)+($consPercent1));

        //           $res2 = (($consPercent*$effective[$i])+($consPercent1*$effective[$i-1]))/(($consPercent)+($consPercent1));

        //         }

        //       }

        //       if(!$flag) {

        //          for($q=0; $q<3; $q++) {

        //           array_splice($array1['baseprice'],$q,1,round($ress1/$constConsumption,2));

        //           array_splice($array1['effecprice'],$q,1,round($ress2/$constConsumption,2));

        //         } 

        //       }

        //     }



        //     else if($calendar[$i] == "q2") {

        //         // echo "q2";

        //       $constConsumption = 0;

        //       $ress1=0;

        //       $ress2=0;

        //       $flag=0;

        //       for($j=3; $j<6; $j++) {

        //         if($array1['baseprice'][$j] == 0) {

        //           $consPercent = $consumptionpercentage['consumption'][$j]*($perc[$i]/100);

        //           $res1 = ($consPercent * $basprice[$i])/$consPercent;

        //           $res2 = ($consPercent * $effective[$i])/$consPercent;

        //           array_splice($array1['baseprice'],$j,1,$res1);

        //           array_splice($array1['effecprice'],$j,1,$res2);

        //           $flag=1;

        //         } else {

        //           $counteCount = $i;



        //           for(; $counteCount>=0; $counteCount--) {

        //             if($calendar[$counteCount] == "q2" || $calendar[$counteCount] == "Calendar Yearly") {

        //             $checking = $consumptionpercentage['consumption'][$j]*($perc[$counteCount]/100);

        //             $constConsumption = $constConsumption + $checking;



        //             $ress1 = $ress1 + ($checking*$basprice[$counteCount]);

        //             $ress2 = $ress2 + ($checking*$effective[$counteCount]);

        //             }



        //           }

        //           $res1 = (($consPercent*$basprice[$i])+($consPercent1*$basprice[$i-1]))/(($consPercent)+($consPercent1));

        //           $res2 = (($consPercent*$effective[$i])+($consPercent1*$effective[$i-1]))/(($consPercent)+($consPercent1));

        //         }

        //       }

        //       if(!$flag) {

        //         for($q=3; $q<6; $q++) {

        //           array_splice($array1['baseprice'],$q,1,round($ress1/$constConsumption,2));

        //           array_splice($array1['effecprice'],$q,1,round($ress2/$constConsumption,2));

        //         } 

        //       }

        //     }



        //     else if($calendar[$i] == "q3") {

        //       $constConsumption = 0;

        //       $ress1=0;

        //       $ress2=0;

        //       $flag=0;

        //       for($j=6; $j<9; $j++) {

        //         if($array1['baseprice'][$j] == 0) {

        //           $consPercent = $consumptionpercentage['consumption'][$j]*($perc[$i]/100);

        //           $res1 = ($consPercent * $basprice[$i])/$consPercent;

        //           $res2 = ($consPercent * $effective[$i])/$consPercent;

        //           array_splice($array1['baseprice'],$j,1,$res1);

        //           array_splice($array1['effecprice'],$j,1,$res2);

        //           $flag=1;

        //         } else {

        //           $counteCount = $i;



        //           for(; $counteCount>=0; $counteCount--) {

        //             if($calendar[$counteCount] == "q3" || $calendar[$counteCount] == "Calendar Yearly") {

        //                 $checking = $consumptionpercentage['consumption'][$j]*($perc[$counteCount]/100);

        //                 $constConsumption = $constConsumption + $checking;

        //                 $ress1 = $ress1 + ($checking*$basprice[$counteCount]);

        //                 $ress2 = $ress2 + ($checking*$effective[$counteCount]);

        //             }



        //           }

        //           $res1 = (($consPercent*$basprice[$i])+($consPercent1*$basprice[$i-1]))/(($consPercent)+($consPercent1));

        //           $res2 = (($consPercent*$effective[$i])+($consPercent1*$effective[$i-1]))/(($consPercent)+($consPercent1));



        //         }

        //       }

        //       if(!$flag) {

        //         for($q=6; $q<9; $q++) {

        //           array_splice($array1['baseprice'],$q,1,round($ress1/$constConsumption,2));

        //           array_splice($array1['effecprice'],$q,1,round($ress2/$constConsumption,2));

        //         } 

        //       }

        //     }

        //     else if($calendar[$i] == "q4") {

        //       $constConsumption = 0;

        //       $ress1=0;

        //       $ress2=0;

        //       $flag=0;

        //       for($j=9; $j<12; $j++) {

        //         if($array1['baseprice'][$j] == 0) {

        //           $consPercent = $consumptionpercentage['consumption'][$j]*($perc[$i]/100);

        //           $res1 = ($consPercent * $basprice[$i])/$consPercent;

        //           $res2 = ($consPercent * $effective[$i])/$consPercent;

        //           array_splice($array1['baseprice'],$j,1,$res1);

        //           array_splice($array1['effecprice'],$j,1,$res2);

        //           $flag=1;

        //         } else {



        //           $counteCount = $i;



        //           for(; $counteCount>=0; $counteCount--) {

        //             if($calendar[$counteCount] == "q4" || $calendar[$counteCount] == "Calendar Yearly") {

        //             $checking = $consumptionpercentage['consumption'][$j]*($perc[$counteCount]/100);

        //             $constConsumption = $constConsumption + $checking;



        //             $ress1 = $ress1 + ($checking*$basprice[$counteCount]);

        //             $ress2 = $ress2 + ($checking*$effective[$counteCount]);

        //             }



        //           }

        //           $res1 = (($consPercent*$basprice[$i])+($consPercent1*$basprice[$i-1]))/(($consPercent)+($consPercent1));

        //           $res2 = (($consPercent*$effective[$i])+($consPercent1*$effective[$i-1]))/(($consPercent)+($consPercent1));



        //         }

        //       }

        //       if(!$flag) {

        //         for($q=9; $q<12; $q++) {

        //           array_splice($array1['baseprice'],$q,1,round($ress1/$constConsumption,2));

        //           array_splice($array1['effecprice'],$q,1,round($ress2/$constConsumption,2));

        //         } 

        //       }

        //     }

        //   }



        // echo "<pre>";

        //   print_r($array1);



        // if ($_POST['clientId'] == 'tradehistry') {

        //     require_once('tradehistory.php');

        //     die();

        // }





        // echo "<pre>";

        // print_r($array1);





    ?>

        <!-- <h1>Hi Indexed</h1> -->

        <div id="container" style="width: 900px; height: 400px; margin: 0 auto"></div>

        <table cellspacing="9">

            <thead>

                <th></th>

                <?php

                $countMonth = count($consumptionpercentage['month']);

                for ($i = 0; $i < $countMonth; $i++) {

                    echo "<th>";

                    echo $consumptionpercentage['month'][$i];

                    echo "</th>";
                }

                ?>

                <th>Total</th>

            </thead>

            <tbody>

                <tr class="hrline">

                    <td>Est. Consumption (MWh)</td>

                    <?php

                    $totalConsmpt = 0;

                    $countMonth = count($consumptionpercentage['month']);

                    for ($i = 0; $i < $countMonth; $i++) {

                        echo "<td>";

                        $consumption = $consumptionpercentage['consumption'][$i];

                        $totalConsmpt += $consumption;

                        $regex = "/\B(?=(\d{3})+(?!\d))/i";

                        echo $usdformat = preg_replace($regex, ",", round($consumption, 2));

                        echo "</td>";
                    }

                    echo "<td>";

                    $regex = "/\B(?=(\d{3})+(?!\d))/i";

                    echo $usdformat = preg_replace($regex, ",", round($totalConsmpt, 2));

                    echo "</td>";

                    ?>

                </tr>

                <tr>

                    <td>Hedged Consumption (MWh)</td>

                    <?php

                    $countCons = count($hedgedconsumptionpercentage['consumption']);


                    for ($i = 0; $i < $countCons; $i++) {

                        echo "<td>";

                        $consumption = (float)$hedgedconsumptionpercentage['consumption'][$i];
                        // echo "Consumption = ".$consumption;

                        $regex = "/\B(?=(\d{3})+(?!\d))/i";

                        echo $usdformat = preg_replace($regex, ",", round($consumption, 2));

                        echo "</td>";
                    }

                    ?>

                    <?php

                    $countCons = count($hedgedconsumptionpercentage['consumption']);
                    // echo "countcons = ".$countCons;
                    $addHedgedConsmpt = 0;

                    for ($i = 0; $i < $countCons; $i++) {

                        $addHedgedConsmpt += (float)$hedgedconsumptionpercentage['consumption'][$i];
                    }

                    echo "<td>";

                    $regex = "/\B(?=(\d{3})+(?!\d))/i";

                    echo $usdformat = preg_replace($regex, ",", round($addHedgedConsmpt, 2));

                    echo "</td>";

                    ?>

                </tr>

                <tr>

                    <td>Open Consumption (MWh)</td>

                    <?php

                    $countCons = count($openconsumption['openconsumpt']);

                    for ($i = 0; $i < $countCons; $i++) {

                        echo "<td>";

                        $regex = "/\B(?=(\d{3})+(?!\d))/i";

                        $cons = $openconsumption['openconsumpt'][$i];

                        echo $usdformat = preg_replace($regex, ",", round($cons, 2));

                        echo "</td>";
                    }

                    ?>

                    <?php

                    $countCons = count($openconsumption['openconsumpt']);

                    $addOpenConsmt = 0;

                    for ($i = 0; $i < $countCons; $i++) {

                        $addOpenConsmt += $openconsumption['openconsumpt'][$i];
                    }

                    echo "<td>";

                    $regex = "/\B(?=(\d{3})+(?!\d))/i";

                    echo $usdformat = preg_replace($regex, ",", round($addOpenConsmt, 2));

                    echo "</td>";

                    ?>

                </tr>

                <tr>

                    <td>% Hedged</td>

                    <?php

                    $countCons = count($percenthedged['hedgedperc']);

                    for ($i = 0; $i < $countCons; $i++) {

                        echo "<td>";

                        echo number_format($percenthedged['hedgedperc'][$i], 2) . "%";

                        echo "</td>";
                    }

                    ?>



                    <?php

                    // $countCons = count($percenthedged['hedgedperc']);

                    // $total = 0;

                    // for ($i = 0; $i < $countCons; $i++) {

                    //     $total += $percenthedged['hedgedperc'][$i];

                    // }

                    echo "<td>";

                    // echo $totalConsmpt;

                    // echo $addHedgedConsmpt;

                    if ($totalConsmpt === 0) {
                        $resPercent = 0;
                    } else {
                        $resPercent = ($addHedgedConsmpt / $totalConsmpt) * 100;
                    }

                    echo number_format($resPercent, 2) . "%";

                    echo "</td>";

                    ?>

                </tr>

                <tr style="border-bottom: 1px solid gray;">

                    <td>% Open</td>

                    <?php

                    $countCons = count($percentopen['openpercent']);

                    for ($i = 0; $i < $countCons; $i++) {

                        echo "<td>";

                        echo number_format($percentopen['openpercent'][$i], 2) . "%";

                        echo "</td>";
                    }

                    ?>

                    <?php

                    // $countCons = count($percentopen['openpercent']);

                    // $total = 0;

                    // for ($i = 0; $i < $countCons; $i++) {

                    //     $total += $percentopen['openpercent'][$i];

                    // }

                    echo "<td>";

                    echo number_format(100 - $resPercent, 2) . "%";

                    echo "</td>";

                    ?>

                </tr>

                <tr>

                    <td>Hedged Baseload WAP (per MWh)</td>



                    <?php

                    // echo "<pre>";

                    // print_r($array1);



                    $countBase = count($array1['baseprice']);

                    $total = 0;

                    if ($countBase == 0) {

                        for ($i = 0; $i < $countMonth; $i++) {

                            echo "<td>";

                            $basePrices = (float)$array1['baseprice'][$i];

                            if (is_nan($basePrices)) {

                                $basePrices = 0;
                            }

                            echo number_format($basePrices, 2);

                            echo "</td>";
                        }

                        // echo "Total = ".$total;

                        echo "<td>";

                        $resVal = (float)$total / 12;

                        if (is_nan((float)$resVal)) {

                            $resVal = 0;
                        }

                        echo number_format($resVal, 2);

                        echo "</td>";
                    } else {

                        for ($i = 0; $i < 12; $i++) {

                            $basePrices = $array1['baseprice'][$i];

                            if (is_nan((float)$basePrices)) {

                                $basePrices = 0;
                            }

                            $total += ((float)$basePrices * (float)$hedgedconsumptionpercentage['consumption'][$i]);

                            echo "<td>";

                            echo number_format($basePrices, 2);

                            echo "</td>";

                            // echo $total;

                        }

                        // echo "Total = ".$total;

                        echo "<td>";


                        if ($total == 0 || $addHedgedConsmpt == 0) {
                            $resVal = 0;
                        } else {
                            $resVal = $total / $addHedgedConsmpt;
                            $resVal = number_format($resVal, 2);
                        }

                        // echo $addHedgedConsmpt;

                        if (is_nan((float)$resVal)) {

                            $resVal = 0;
                        }

                        echo $resVal;

                        echo "</td>";
                    }

                    ?>

                </tr>

                <tr>

                    <td>Hedged Effective WAP (per MWh)</td>

                    <?php

                    $countBase = count($array1['effecprice']);

                    // print_r($countBase);

                    // echo "<pre>";

                    // print_r($array1);

                    $total = 0;

                    if ($countBase == 0) {

                        for ($i = 0; $i < $countMonth; $i++) {

                            echo "<td>";

                            $effecPrices = $array1['effecprice'][$i];

                            if (is_nan((float)$effecPrices)) {

                                $effecPrices = 0;
                            }

                            echo number_format($effecPrices, 2);

                            echo "</td>";
                        }

                        echo "<td>";

                        $resVal = (float)$total / 12;

                        if (is_nan((float)$resVal)) {

                            $resVal = 0;
                        }

                        echo number_format($resVal, 2);

                        echo "</td>";
                    } else {

                        for ($i = 0; $i < 12; $i++) {

                            $effecPrices = $array1['effecprice'][$i];

                            if (is_nan($effecPrices)) {

                                $effecPrices = 0;
                            }

                            $total += $effecPrices;

                            echo "<td>";

                            echo number_format($effecPrices, 2);

                            echo "</td>";
                        }

                        // echo "<td>";

                        // echo number_format($total / 12, 2);

                        // echo "</td>";



                        $counthedgedEffecPrice = count($baseprice['price']);



                        $total = 0;



                        for ($i = 0; $i < $counthedgedEffecPrice; $i++) {

                            $effecPrices = $array1['effecprice'][$i];

                            if (is_nan((float)$effecPrices)) {

                                $effecPrices = 0;
                            }

                            $hedgedPrice = ((float)$effecPrices * (float)$hedgedconsumptionpercentage['consumption'][$i]);

                            $total += $hedgedPrice;
                        }

                        echo "<td>";
                        if ($total == 0 || $addHedgedConsmpt == 0) {
                            $resVal = 0;
                        } else {
                            $resVal = $total / $addHedgedConsmpt;
                            $resVal = number_format($resVal, 2);
                        }
                        // $resVal = $total / $addHedgedConsmpt;

                        // echo $addHedgedConsmpt;

                        if (!is_nan((float)$resVal)) {

                            echo $resVal;
                        } else {
                            $resVal = 0;
                            echo $resVal;
                        }



                        echo "</td>";
                    }

                    ?>

                </tr>

                <tr>

                    <td>Unhedged Baseload Price (per MWh)</td>

                    <?php

                    $countBaseprice = count($baseprice['price']);

                    $total = 0;

                    for ($i = 0; $i < $countBaseprice; $i++) {

                        echo "<td>";

                        $basePriceNumber = floatval(preg_replace('/[^\d.]/', '', $baseprice['price'][$i]));
                        echo number_format($basePriceNumber, 2);

                        echo "</td>";

                        $total += ((float)$basePriceNumber * (float)$openconsumption['openconsumpt'][$i]);
                    }

                    // print_r($baseprice['price']);

                    echo "<td>";
                    if ($total == 0 || $addOpenConsmt == 0) {
                        $newResult1 = 0;
                    } else {
                        $newResult1 = $total / $addOpenConsmt;
                        $newResult1 = number_format($newResult1,2);
                    }

                    echo $newResult1;

                    echo "</td>";

                    ?>

                </tr>

                <tr>

                    <td>Unhedged Effective Price (per MWh)</td>

                    <?php

                    // echo "<pre>";
                    // print_r($effecprice['price']);

                    $countEffecprice = count($effecprice['price']);

                    $total = 0;

                    for ($i = 0; $i < $countEffecprice; $i++) {

                       echo "<td>";

                        $effecPriceNumber = floatval(preg_replace('/[^\d.]/', '', $effecprice['price'][$i]));
                        echo number_format($effecPriceNumber, 2);

                        echo "</td>";

                        $total += ((float)$effecPriceNumber * (float)$openconsumption['openconsumpt'][$i]);
                    }

                    echo "<td>";

                    if ($total == 0 || $addOpenConsmt == 0) {
                        $newResult2 = 0;
                    } else {
                        $newResult2 = $total / $addOpenConsmt;
                        $newResult2 = number_format($newResult2, 2);
                    }

                    // echo $total;

                    echo $newResult2;

                    echo "</td>";

                    ?>

                </tr>

                <tr>

                    <td class='hrlines'>Port Effective Price (Hedged + Unhedged)</td>

                    <?php



                    $porteffcPrice = array(

                        "price" => array()

                    );



                    $countPortEffecPrice = count($array1['baseprice']);



                    $total = 0;


                    // echo "<pre>";
                    // print_r($array1['effecprice']);
                    // print_r($hedgedconsumptionpercentage['consumption']);
                    // print_r($effecprice['price']);
                    // print_r($openconsumption['openconsumpt']);
                    // print_r($consumptionpercentage['consumption']);



                    
                   

                    for ($i = 0; $i < $countPortEffecPrice; $i++) {

                        // $finalValuCheck = 0;

                        echo "<td class='hrlines'>";

                        if ($consumptionpercentage['consumption'][$i] == 0) {
                            $newefPrice = 0;
                        } else {
                            $resCheck1 = (float)$array1['effecprice'][$i] * (float)$hedgedconsumptionpercentage['consumption'][$i];
                            $effecPriceNumber = floatval(preg_replace('/[^\d.]/', '', $effecprice['price'][$i]));
                            $resCheck2 = (float)$effecPriceNumber * (float)$openconsumption['openconsumpt'][$i];
                            $finalValueCheck = ($resCheck1 + $resCheck2) / (float)$consumptionpercentage['consumption'][$i];
                            // echo "Final value = " . number_format($finalValueCheck,2);
                            // $newefPrice = ((((float)$array1['effecprice'][$i] * (float)$hedgedconsumptionpercentage['consumption'][$i]) + ((float)$effecprice['price'][$i] * (float)$openconsumption['openconsumpt'][$i])) / (float)$consumptionpercentage['consumption'][$i]);
                            // echo "Newprice = ".$newPrice;

                            $ress = floatval(preg_replace('/[^\d.]/', '', number_format($finalValueCheck,2)));
                            // echo "Ress = ".$ress;

                            $newefPrice = $ress;

                        }
                        // echo $finalValueCheck;

                        // echo "New price=".$newefPrice;

                        if (is_nan((float)$newefPrice)) {

                            $newefPrice = 0;
                        }
                        // echo $newefPrice; floatval(preg_replace('/[^\d.]/', '', $var));
                        // $newValEf = $newefPrice;
                        // echo "val=".$newValEf;
                        $portefPrice = number_format($newefPrice, 2);

                        array_push($porteffcPrice['price'], $portefPrice);

                        if (is_nan((float)$portefPrice)) {

                            $portefPrice = 0;
                        }

                        echo $portefPrice;

                        echo "</td>";

                        $porteffectivePrice = floatval(preg_replace('/[^\d.]/', '', $porteffcPrice['price'][$i]));
                        $estPortCost = ($consumptionpercentage['consumption'][$i] * $porteffectivePrice);

                        // $regex = "/\B(?=(\d{3})+(?!\d))/i";

                        // echo $usdformat = preg_replace($regex, ",", round($estPortCost));

                        $total += $estPortCost;
                        

                        // echo "</td>";

                        // $total += $portefPrice;

                    }
                    // echo "Todatl = ".$total;

                    echo "<td class='hrlines'>";
                    if ($total == 0 || $totalConsmpt == 0) {
                        $result = 0;
                    } else {
                        $result = $total / $totalConsmpt;
                        $result = number_format($result, 2);
                    }

                    echo $result;
                    // echo "Result = ".$result;

                    echo "</td>";

                    ?>

                </tr>

                <tr class="hedgedColor">

                    <td>Hedged Effective Commodity Cost</td>

                    <?php



                    $hedgedeffcPrice = array(

                        "price" => array()

                    );



                    $counthedgedEffecPrice = count($baseprice['price']);



                    $total = 0;



                    for ($i = 0; $i < $counthedgedEffecPrice; $i++) {

                        echo "<td>";

                        //$portefPrice = number_format(((($waphedged_price['waphedgedPrice'][$i]*$hedgedconsumptionpercentage['consumption'][$i])+($effecprice['price'][$i]*$openconsumption['openconsumpt'][$i]))/1000),2);

                        $effecPricess = $array1['effecprice'][$i];

                        if (is_nan($effecPricess)) {

                            $effecPricess = 0;
                        }

                        $hedgedPrice = ((float)$effecPricess * (float)$hedgedconsumptionpercentage['consumption'][$i]);

                        array_push($hedgedeffcPrice['price'], round($hedgedPrice));

                        $regex = "/\B(?=(\d{3})+(?!\d))/i";

                        echo $usdformat = preg_replace($regex, ",", round($hedgedPrice));

                        //echo $hedgedPrice;

                        $total += $hedgedPrice;

                        echo "</td>";
                    }

                    echo "<td>";

                    $res = round($total);

                    $regex = "/\B(?=(\d{3})+(?!\d))/i";

                    echo $usdformat = preg_replace($regex, ",", $res);

                    echo "</td>";



                    ?>

                </tr>

                <tr class="hedgedColor">

                    <td>Unhedged Effective Commodity Cost (VaR)</td>

                    <?php

                    $unhedgedEfecCost = array(

                        "price" => array()

                    );



                    $counthedgedEffecPrice = count($baseprice['price']);



                    $total = 0;



                    for ($i = 0; $i < $counthedgedEffecPrice; $i++) {

                        echo "<td>";

                        //$portefPrice = number_format(((($waphedged_price['waphedgedPrice'][$i]*$hedgedconsumptionpercentage['consumption'][$i])+($effecprice['price'][$i]*$openconsumption['openconsumpt'][$i]))/1000),2);

                        $effecPricePP=floatval(preg_replace('/[^\d.]/', '', $effecprice['price'][$i]));
                        $unhedgedPrice = ((float)$effecPricePP * (float)$openconsumption['openconsumpt'][$i]);

                        array_push($unhedgedEfecCost['price'], round($unhedgedPrice));

                        $regex = "/\B(?=(\d{3})+(?!\d))/i";

                        echo $usdformat = preg_replace($regex, ",", round($unhedgedPrice));

                        //echo $hedgedPrice;

                        $total += $unhedgedPrice;

                        echo "</td>";
                    }

                    echo "<td>";

                    $res = round($total);

                    $regex = "/\B(?=(\d{3})+(?!\d))/i";

                    echo $usdformat = preg_replace($regex, ",", $res);

                    echo "</td>";

                    ?>

                </tr>

                <tr class="hrlines hedgedColor">

                    <td class="border">Est. Portfolio Commodity Cost</td>

                    <?php



                    $counthedgedEffecPrice = count($baseprice['price']);



                    $total = 0;

                    // echo "<pre>";
                    // print_r($porteffcPrice['price']);

                    // echo "<pre>";
                    // print_r($effecprice['price']);

                    for ($i = 0; $i < $counthedgedEffecPrice; $i++) {

                        
                        // echo "<pre>";
                        // echo "Checkm = ".round($checm);

                        echo "<td>";
                        $effecPricess = $array1['effecprice'][$i];
                        // $porteffectivePrice = floatval(preg_replace('/[^\d.]/', '', $effecprice['price'][$i]));

                        $effecPricePP=floatval(preg_replace('/[^\d.]/', '', $effecprice['price'][$i]));
                        $checm = $effecPricess * (float)$hedgedconsumptionpercentage['consumption'][$i] + (float)$effecPricePP * (float)$openconsumption['openconsumpt'][$i];

                        // $estPortCost = ($consumptionpercentage['consumption'][$i] * $porteffectivePrice);

                        $regex = "/\B(?=(\d{3})+(?!\d))/i";

                        echo $usdformat = preg_replace($regex, ",", round($checm));

                        $total += $checm;

                        echo "</td>";
                    }

                    echo "<td>";

                    $res = round($total);

                    $regex = "/\B(?=(\d{3})+(?!\d))/i";

                    echo $usdformat = preg_replace($regex, ",", $res);

                    echo "</td>";

                    ?>

                </tr>

            </tbody>

        </table>

    <?php

    } else {

    ?>

        <!-- <h1>Hi Fixed</h1> -->

        <!-- <div id="top_x_div" style="width: 900px; height: 500px;"></div> -->

        <div id="top_x_div1" style="width: 900px; height: 500px;"></div>

        <table>

            <thead>

                <th></th>

                <?php

                $countMonth = count($consumptionpercentage['month']);

                for ($i = 0; $i < $countMonth; $i++) {

                    echo "<th>";

                    echo $consumptionpercentage['month'][$i];

                    echo "</th>";
                }

                ?>

                <th>Total</th>

            </thead>

            <tbody>

                <tr class="hrline">

                    <td>Est Consumption (MWh)</td>

                    <?php

                    $countMonth = count($consumptionpercentage['month']);

                    $totalEst = 0;

                    for ($i = 0; $i < $countMonth; $i++) {

                        echo "<td>";

                        $consumption = $consumptionpercentage['consumption'][$i];

                        $totalEst += $consumption;

                        //  round($consumption, 2);

                        $regex = "/\B(?=(\d{3})+(?!\d))/i";

                        echo $usdformat = preg_replace($regex, ",", round($consumption, 2));

                        echo "</td>";
                    }

                    ?>

                    <?php

                    $regex = "/\B(?=(\d{3})+(?!\d))/i";

                    $usdformat = preg_replace($regex, ",", round($totalEst, 2));

                    echo "<td>$usdformat</td>"

                    // echo number_format($consumptionpercentage['consumption'][0] * 12);

                    ?>

                </tr>

                <tr>

                    <td>Hedged Consumption (MWh)</td>

                    <?php

                    $countCons = count($hedgedconsumptionpercentage['consumption']);

                    for ($i = 0; $i < $countCons; $i++) {

                        echo "<td>";

                        $consumption = $hedgedconsumptionpercentage['consumption'][$i];

                        $regex = "/\B(?=(\d{3})+(?!\d))/i";

                        echo $usdformat = preg_replace($regex, ",", round($consumption, 2));

                        echo "</td>";
                    }

                    ?>

                    <?php

                    $countCons = count($hedgedconsumptionpercentage['consumption']);

                    $add = 0;

                    for ($i = 0; $i < $countCons; $i++) {

                        $add += $hedgedconsumptionpercentage['consumption'][$i];
                    }

                    echo "<td>";

                    $regex = "/\B(?=(\d{3})+(?!\d))/i";

                    $usdformat = preg_replace($regex, ",", $add);

                    echo $usdformat;

                    echo "</td>";

                    ?>



                </tr>

                <tr>

                    <td>Open Consumption (MWh)</td>

                    <?php

                    $countCons = count($openconsumption['openconsumpt']);

                    for ($i = 0; $i < $countCons; $i++) {

                        echo "<td>";

                        $regex = "/\B(?=(\d{3})+(?!\d))/i";

                        $cons = $openconsumption['openconsumpt'][$i];

                        echo $usdformat = preg_replace($regex, ",", $cons);

                        echo "</td>";
                    }

                    ?>

                    <?php

                    $countCons = count($openconsumption['openconsumpt']);

                    $add = 0;

                    for ($i = 0; $i < $countCons; $i++) {

                        $add += $openconsumption['openconsumpt'][$i];
                    }

                    echo "<td>";

                    $regex = "/\B(?=(\d{3})+(?!\d))/i";

                    echo $usdformat = preg_replace($regex, ",", $add);

                    echo "</td>";

                    ?>

                </tr>

                <tr>

                    <td>% Hedged</td>

                    <?php

                    $countCons = count($percenthedged['hedgedperc']);

                    for ($i = 0; $i < $countCons; $i++) {

                        echo "<td>";

                        echo number_format($percenthedged['hedgedperc'][$i], 2) . "%";

                        echo "</td>";
                    }

                    ?>



                    <?php

                    $countCons = count($percenthedged['hedgedperc']);

                    $total = 0;

                    for ($i = 0; $i < $countCons; $i++) {

                        $total += $percenthedged['hedgedperc'][$i];
                    }

                    echo "<td>";

                    echo number_format($total / $countCons, 2) . "%";

                    echo "</td>";

                    ?>

                </tr>

                <tr class="hrlines">

                    <td>% Open</td>

                    <?php

                    $countCons = count($percentopen['openpercent']);

                    for ($i = 0; $i < $countCons; $i++) {

                        echo "<td>";

                        echo number_format($percentopen['openpercent'][$i], 2) . "%";

                        echo "</td>";
                    }

                    ?>

                    <?php

                    $countCons = count($percentopen['openpercent']);

                    $total = 0;

                    for ($i = 0; $i < $countCons; $i++) {

                        $total += $percentopen['openpercent'][$i];
                    }

                    echo "<td>";

                    echo number_format($total / 12, 2) . "%";

                    echo "</td>";

                    ?>

                </tr>

                <tr>

                    <td>Fixed Commodity Price<br>(per MWh)</td>

                    <?php

                    $countCons = count($consumptionpercentage['price']);

                    $total = 0;

                    for ($i = 0; $i < $countCons; $i++) {

                        echo "<td>";

                        $total += $consumptionpercentage['price'][$i];

                        echo $consumptionpercentage['price'][$i];

                        echo "</td>";
                    }

                    ?>

                    <?php

                    $res = number_format($total / $countCons, 2);

                    echo "<td>$res</td>";

                    ?>

                </tr>

                <tr>

                    <td>Port Effective Price<br>(Hedged + Unhedged)</td>

                    <?php

                    $countCons = count($consumptionpercentage['price']);

                    $total = 0;

                    for ($i = 0; $i < $countCons; $i++) {

                        echo "<td>";

                        $total += $consumptionpercentage['price'][$i];

                        echo $consumptionpercentage['price'][$i];

                        echo "</td>";
                    }

                    ?>

                    <?php

                    $res = number_format($total / $countCons, 2);

                    echo "<td>$res</td>";

                    ?>

                </tr>

                <tr class="line hedgedColor">

                    <td>Est.Total Commodity Cost</td>

                    <?php

                    $total = 0;

                    $countCons = count($consumptionpercentage['price']);

                    for ($i = 0; $i < $countCons; $i++) {

                        echo "<td>";

                        $add = ($consumptionpercentage['price'][$i] * $consumptionpercentage['consumption'][$i]);

                        $total += $add;

                        $regex = "/\B(?=(\d{3})+(?!\d))/i";

                        echo $usdformat = preg_replace($regex, ",", $add);

                        echo "</td>";
                    }

                    ?>

                    <?php

                    // $totalConsumption = myFunc(number_format(($consumptionpercentage['consumption'][0]*12)));

                    // $totalAmount = $consumptionpercentage['price'][0]*12;

                    // $finalAmount = $totalAmount * $totalConsumption;

                    $regex = "/\B(?=(\d{3})+(?!\d))/i";

                    $usdformat = preg_replace($regex, ",", $total);

                    echo "<td>$usdformat</td>";

                    //echo $finalAmount;

                    ?>

                </tr>

            </tbody>

        </table>

    <?php

    }

    ?>



</body>

<script>
    google.charts.load('current', {

        'packages': ['bar']

    });

    google.charts.setOnLoadCallback(drawStuff);



    function drawStuff() {

        var data = new google.visualization.arrayToDataTable([

            ['Month', 'MWh'],

            ["<?php echo $consumptionpercentage['month'][0]; ?>", "<?php echo $consumptionpercentage['consumption'][0] ?>"],

            ["<?php echo $consumptionpercentage['month'][1]; ?>", "<?php echo $consumptionpercentage['consumption'][1] ?>"],

            ["<?php echo $consumptionpercentage['month'][2]; ?>", "<?php echo $consumptionpercentage['consumption'][2] ?>"],

            ["<?php echo $consumptionpercentage['month'][3]; ?>", "<?php echo $consumptionpercentage['consumption'][3] ?>"],

            ["<?php echo $consumptionpercentage['month'][4]; ?>", "<?php echo $consumptionpercentage['consumption'][4] ?>"],

            ["<?php echo $consumptionpercentage['month'][5]; ?>", "<?php echo $consumptionpercentage['consumption'][5] ?>"],

            ["<?php echo $consumptionpercentage['month'][6]; ?>", "<?php echo $consumptionpercentage['consumption'][6] ?>"],

            ["<?php echo $consumptionpercentage['month'][7]; ?>", "<?php echo $consumptionpercentage['consumption'][7] ?>"],

            ["<?php echo $consumptionpercentage['month'][8]; ?>", "<?php echo $consumptionpercentage['consumption'][8] ?>"],

            ["<?php echo $consumptionpercentage['month'][9]; ?>", "<?php echo $consumptionpercentage['consumption'][9] ?>"],

            ["<?php echo $consumptionpercentage['month'][10]; ?>", "<?php echo $consumptionpercentage['consumption'][10] ?>"],

            ["<?php echo $consumptionpercentage['month'][11]; ?>", "<?php echo $consumptionpercentage['consumption'][11] ?>"]

        ]);



        var options = {

            title: 'Hedged Position Chart',

            width: 900,

            legend: {

                position: 'none'

            },

            chart: {

                title: 'Hedged Consumption Chart',

                subtitle: 'consumption in MWh'

            },

            bars: 'vertical', // Required for Material Bar Charts.

            axes: {

                x: {

                    0: {

                        side: 'bottom',

                        label: 'Months'

                    } // Top x-axis.

                },

                y: {

                    0: {

                        side: 'top',

                        label: 'Total Consumption (MWh)'

                    }

                }



            },

            bar: {

                groupWidth: "90%"

            }

        };



        var chart = new google.charts.Bar(document.getElementById('top_x_div'));

        chart.draw(data, options);

    };
</script>

<script>
    function drawChart() {

        // Define the chart to be drawn.

        var data = google.visualization.arrayToDataTable([

            ['Month', 'Hedged Consumption', {

                role: "style"

            }, 'Open Consumption', {

                role: "style"

            }],

            ["Jan", <?php echo $hedgedconsumptionpercentage['consumption'][0]; ?>, "#4472c4", <?php echo $openconsumption['openconsumpt'][0]; ?>, "#BCBCBC"],

            ["Feb", <?php echo $hedgedconsumptionpercentage['consumption'][1]; ?>, "#4472c4", <?php echo $openconsumption['openconsumpt'][1]; ?>, "#BCBCBC"],

            ["Mar", <?php echo $hedgedconsumptionpercentage['consumption'][2]; ?>, "#4472c4", <?php echo $openconsumption['openconsumpt'][2]; ?>, "#BCBCBC"],

            ["Apr", <?php echo $hedgedconsumptionpercentage['consumption'][3]; ?>, "#4472c4", <?php echo $openconsumption['openconsumpt'][3]; ?>, "#BCBCBC"],

            ["May", <?php echo $hedgedconsumptionpercentage['consumption'][4]; ?>, "#4472c4", <?php echo $openconsumption['openconsumpt'][4]; ?>, "#BCBCBC"],

            ["Jun", <?php echo $hedgedconsumptionpercentage['consumption'][5]; ?>, "#4472c4", <?php echo $openconsumption['openconsumpt'][5]; ?>, "#BCBCBC"],

            ["Jul", <?php echo $hedgedconsumptionpercentage['consumption'][6]; ?>, "#4472c4", <?php echo $openconsumption['openconsumpt'][6]; ?>, "#BCBCBC"],

            ["Aug", <?php echo $hedgedconsumptionpercentage['consumption'][7]; ?>, "#4472c4", <?php echo $openconsumption['openconsumpt'][7]; ?>, "#BCBCBC"],

            ["Sep", <?php echo $hedgedconsumptionpercentage['consumption'][8]; ?>, "#4472c4", <?php echo $openconsumption['openconsumpt'][8]; ?>, "#BCBCBC"],

            ["Oct", <?php echo $hedgedconsumptionpercentage['consumption'][9]; ?>, "#4472c4", <?php echo $openconsumption['openconsumpt'][9]; ?>, "#BCBCBC"],

            ["Nov", <?php echo $hedgedconsumptionpercentage['consumption'][10]; ?>, "#4472c4", <?php echo $openconsumption['openconsumpt'][10]; ?>, "#BCBCBC"],

            ["Dec", <?php echo $hedgedconsumptionpercentage['consumption'][11]; ?>, "#4472c4", <?php echo $openconsumption['openconsumpt'][11]; ?>, "#BCBCBC"]

        ]);



        var options = {

            title: 'Hedged Consumption Chart (Consumption in MWh)',

            subtitle: 'Consumption in MWh',

            isStacked: true,

            legend: {

                position: 'bottom'

            },

            colors: ['#4472c4', '#bcbcbc'],

        };



        // Instantiate and draw the chart.

        var chart = new google.visualization.ColumnChart(document.getElementById('container'));

        chart.draw(data, options);

        // console.log('Intel inside');

    }

    google.charts.setOnLoadCallback(drawChart);
</script>

<script>
    function drawChart() {

        var data = google.visualization.arrayToDataTable([

            ['Month', 'Hedged Consumption', {

                role: "style"

            }],

            ["Jan", <?php echo $consumptionpercentage['consumption'][0] ?>, "#4472c4"],

            ["Feb", <?php echo $consumptionpercentage['consumption'][1] ?>, "#4472c4"],

            ["Mar", <?php echo $consumptionpercentage['consumption'][2] ?>, "#4472c4"],

            ["Apr", <?php echo $consumptionpercentage['consumption'][3] ?>, "#4472c4"],

            ["May", <?php echo $consumptionpercentage['consumption'][4] ?>, "#4472c4"],

            ["Jun", <?php echo $consumptionpercentage['consumption'][5] ?>, "#4472c4"],

            ["Jul", <?php echo $consumptionpercentage['consumption'][6] ?>, "#4472c4"],

            ["Aug", <?php echo $consumptionpercentage['consumption'][7] ?>, "#4472c4"],

            ["Sep", <?php echo $consumptionpercentage['consumption'][8] ?>, "#4472c4"],

            ["Oct", <?php echo $consumptionpercentage['consumption'][9] ?>, "#4472c4"],

            ["Nov", <?php echo $consumptionpercentage['consumption'][10] ?>, "#4472c4"],

            ["Dec", <?php echo $consumptionpercentage['consumption'][11] ?>, "#4472c4"],

        ]);





        var options = {

            title: 'Hedged Consumption Chart (Consumption in MWh)',

            subtitle: 'Consumption in MWh',

            isStacked: true,

            legend: {

                position: 'bottom'

            }

        };





        // Instantiate and draw the chart.

        var chart = new google.visualization.ColumnChart(document.getElementById('top_x_div1'));

        chart.draw(data, options);

        // console.log('Intel inside');

    }

    google.charts.setOnLoadCallback(drawChart);
</script>



</html>