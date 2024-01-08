<?php



include('dbconn.php');

error_reporting(E_ERROR | E_PARSE);

// echo "<pre>";

// print_r($consumptionpercentage);

// echo "I'm in genPower";



$sqlpowerMw = "SELECT * FROM enter_trade WHERE supplycontractid = '" . $row['contract_id'] . "' 

AND tradevalue = '" . $_POST['yearstype'][0] . "' AND clientId = '".$clientGenerate."' AND tradeexecuted ='Executed';";



$yearSelected = $_POST['yearstype'][0];



$resultpowerMW = mysqli_query($conn, $sqlpowerMw);



$rowcountPMW = mysqli_num_rows($resultpowerMW);



$leapornot = '';



if ((($yearSelected % 4 == 0) && ($yearSelected % 100 != 0)) || ($yearSelected % 400 == 0)) {

    $leapornot = "leap";

} else {

    $leapornot = "notleap";

}



// echo "<pre>";

// echo "Rows = " . $rowcountPMW;



// echo "<pre>";

$hedgedConumptionMW = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);



$newbasePrice = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

$neweffecPrice = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);



$finalBase = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

$finalEffec = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);





while ($rowPW = mysqli_fetch_assoc($resultpowerMW)) {

    // print_r($rowPW);



    // echo $rowPW['trade'];



    $minlimt = 0;

    $maxlimit = 0;



    if ($rowPW['trade'] == "Calendar Yearly") {

        $minlimt = 0;

        $maxlimit = 12;

    } else if ($rowPW['quartval'] == "q1") {

        $minlimt = 0;

        $maxlimit = 3;

    } else if ($rowPW['quartval'] == "q2") {

        $minlimt = 3;

        $maxlimit = 6;

    } else if ($rowPW['quartval'] == "q3") {

        $minlimt = 6;

        $maxlimit = 9;

    } else if ($rowPW['quartval'] == "q4") {

        $minlimt = 9;

        $maxlimit = 12;

    } else {

        switch ($rowPW['quartval']) {

            case 'Jan':

                $minlimt = 0;

                break;

            case 'Feb':

                $minlimt = 1;

                break;

            case 'Mar':

                $minlimt = 2;

                break;

            case 'Apr':

                $minlimt = 3;

                break;

            case 'May':

                $minlimt = 4;

                break;

            case 'Jun':

                $minlimt = 5;

                break;

            case 'July':

                $minlimt = 6;

                break;

            case 'Aug':

                $minlimt = 7;

                break;

            case 'Sep':

                $minlimt = 8;

                break;

            case 'Oct':

                $minlimt = 9;

                break;

            case 'Nov':

                $minlimt = 10;

                break;

            case 'Dec':

                $minlimt = 11;

                break;

        }

        $maxlimit = $minlimt + 1;

    }



    // if ($rowPW['trade'] == "Calendar Yearly") {

    //     $consMW = $rowPW['tradevolume'];

    for ($i = $minlimt; $i < $maxlimit; $i++) {

        switch ($i) {

            case 0:

                $add = 31 * (float)$rowPW['mw'] * 24; //multiplying with 31 days * power MW value from db * 24

                $final = $add + (float)$hedgedConumptionMW[$i];  //adding previous hedgeconsumption value

                array_splice($hedgedConumptionMW, $i, 1, $final);

                $new1 = '';

                $new2 = '';

                if ($newbasePrice[$i] == 0) {

                    array_splice($newbasePrice, $i, 1, $add . "-" . $rowPW['baseload']);

                    array_splice($neweffecPrice, $i, 1, $add . "-" . $rowPW['effectiveprice']);

                } else {

                    $new1 = $add . "-" . $rowPW['baseload'] . "," . $newbasePrice[$i];

                    $new2 = $add . "-" . $rowPW['effectiveprice'] . "," . $neweffecPrice[$i];

                    array_splice($newbasePrice, $i, 1, $new1);

                    array_splice($neweffecPrice, $i, 1, $new2);

                }

                break;

            case 1:

                if ($leapornot == "leap") {

                    $add = 29 * (float)$rowPW['mw'] * 24;

                    $final = $add + (float)$hedgedConumptionMW[$i];

                    array_splice($hedgedConumptionMW, $i, 1, $final);

                    $new1 = '';

                    $new2 = '';

                    if ($newbasePrice[$i] == 0) {

                        array_splice($newbasePrice, $i, 1, $add . "-" . $rowPW['baseload']);

                        array_splice($neweffecPrice, $i, 1, $add . "-" . $rowPW['effectiveprice']);

                    } else {

                        $new1 = $add . "-" . $rowPW['baseload'] . "," . $newbasePrice[$i];

                        $new2 = $add . "-" . $rowPW['effectiveprice'] . "," . $neweffecPrice[$i];

                        array_splice($newbasePrice, $i, 1, $new1);

                        array_splice($neweffecPrice, $i, 1, $new2);

                    }

                } else {

                    $add = 28 * (float)$rowPW['mw'] * 24;

                    $final = $add + (float)$hedgedConumptionMW[$i];

                    array_splice($hedgedConumptionMW, $i, 1, $final);

                    $new1 = '';

                    $new2 = '';

                    if ($newbasePrice[$i] == 0) {

                        array_splice($newbasePrice, $i, 1, $add . "-" . $rowPW['baseload']);

                        array_splice($neweffecPrice, $i, 1, $add . "-" . $rowPW['effectiveprice']);

                    } else {

                        $new1 = $add . "-" . $rowPW['baseload'] . "," . $newbasePrice[$i];

                        $new2 = $add . "-" . $rowPW['effectiveprice'] . "," . $neweffecPrice[$i];

                        array_splice($newbasePrice, $i, 1, $new1);

                        array_splice($neweffecPrice, $i, 1, $new2);

                    }

                }

                break;

            case 2:

                $add = 31 * (float)$rowPW['mw'] * 24;

                $final = $add + (float)$hedgedConumptionMW[$i];

                array_splice($hedgedConumptionMW, $i, 1, $final);

                $new1 = '';

                $new2 = '';

                if ($newbasePrice[$i] == 0) {

                    array_splice($newbasePrice, $i, 1, $add . "-" . $rowPW['baseload']);

                    array_splice($neweffecPrice, $i, 1, $add . "-" . $rowPW['effectiveprice']);

                } else {

                    $new1 = $add . "-" . $rowPW['baseload'] . "," . $newbasePrice[$i];

                    $new2 = $add . "-" . $rowPW['effectiveprice'] . "," . $neweffecPrice[$i];

                    array_splice($newbasePrice, $i, 1, $new1);

                    array_splice($neweffecPrice, $i, 1, $new2);

                }

                break;

            case 3:

                $add = 30 * (float)$rowPW['mw'] * 24;

                $final = $add + (float)$hedgedConumptionMW[$i];

                array_splice($hedgedConumptionMW, $i, 1, $final);

                $new1 = '';

                $new2 = '';

                if ($newbasePrice[$i] == 0) {

                    array_splice($newbasePrice, $i, 1, $add . "-" . $rowPW['baseload']);

                    array_splice($neweffecPrice, $i, 1, $add . "-" . $rowPW['effectiveprice']);

                } else {

                    $new1 = $add . "-" . $rowPW['baseload'] . "," . $newbasePrice[$i];

                    $new2 = $add . "-" . $rowPW['effectiveprice'] . "," . $neweffecPrice[$i];

                    array_splice($newbasePrice, $i, 1, $new1);

                    array_splice($neweffecPrice, $i, 1, $new2);

                }

                break;

            case 4:

                $add = 31 * (float)$rowPW['mw'] * 24;

                $final = $add + (float)$hedgedConumptionMW[$i];

                array_splice($hedgedConumptionMW, $i, 1, $final);

                $new1 = '';

                $new2 = '';

                if ($newbasePrice[$i] == 0) {

                    array_splice($newbasePrice, $i, 1, $add . "-" . $rowPW['baseload']);

                    array_splice($neweffecPrice, $i, 1, $add . "-" . $rowPW['effectiveprice']);

                } else {

                    $new1 = $add . "-" . $rowPW['baseload'] . "," . $newbasePrice[$i];

                    $new2 = $add . "-" . $rowPW['effectiveprice'] . "," . $neweffecPrice[$i];

                    array_splice($newbasePrice, $i, 1, $new1);

                    array_splice($neweffecPrice, $i, 1, $new2);

                }

                break;

            case 5:

                $add = 30 * (float)$rowPW['mw'] * 24;

                $final = $add + (float)$hedgedConumptionMW[$i];

                array_splice($hedgedConumptionMW, $i, 1, $final);

                $new1 = '';

                $new2 = '';

                if ($newbasePrice[$i] == 0) {

                    array_splice($newbasePrice, $i, 1, $add . "-" . $rowPW['baseload']);

                    array_splice($neweffecPrice, $i, 1, $add . "-" . $rowPW['effectiveprice']);

                } else {

                    $new1 = $add . "-" . $rowPW['baseload'] . "," . $newbasePrice[$i];

                    $new2 = $add . "-" . $rowPW['effectiveprice'] . "," . $neweffecPrice[$i];

                    array_splice($newbasePrice, $i, 1, $new1);

                    array_splice($neweffecPrice, $i, 1, $new2);

                }

                break;

            case 6:

                $add = 31 * (float)$rowPW['mw'] * 24;

                $final = $add + (float)$hedgedConumptionMW[$i];

                array_splice($hedgedConumptionMW, $i, 1, $final);

                $new1 = '';

                $new2 = '';

                if ($newbasePrice[$i] == 0) {

                    array_splice($newbasePrice, $i, 1, $add . "-" . $rowPW['baseload']);

                    array_splice($neweffecPrice, $i, 1, $add . "-" . $rowPW['effectiveprice']);

                } else {

                    $new1 = $add . "-" . $rowPW['baseload'] . "," . $newbasePrice[$i];

                    $new2 = $add . "-" . $rowPW['effectiveprice'] . "," . $neweffecPrice[$i];

                    array_splice($newbasePrice, $i, 1, $new1);

                    array_splice($neweffecPrice, $i, 1, $new2);

                }

                break;

            case 7:

                $add = 31 * (float)$rowPW['mw'] * 24;

                $final = $add + (float)$hedgedConumptionMW[$i];

                array_splice($hedgedConumptionMW, $i, 1, $final);

                $new1 = '';

                $new2 = '';

                if ($newbasePrice[$i] == 0) {

                    array_splice($newbasePrice, $i, 1, $add . "-" . $rowPW['baseload']);

                    array_splice($neweffecPrice, $i, 1, $add . "-" . $rowPW['effectiveprice']);

                } else {

                    $new1 = $add . "-" . $rowPW['baseload'] . "," . $newbasePrice[$i];

                    $new2 = $add . "-" . $rowPW['effectiveprice'] . "," . $neweffecPrice[$i];

                    array_splice($newbasePrice, $i, 1, $new1);

                    array_splice($neweffecPrice, $i, 1, $new2);

                }

                break;

            case 8:

                $add = 30 * (float)$rowPW['mw'] * 24;

                $final = $add + (float)$hedgedConumptionMW[$i];

                array_splice($hedgedConumptionMW, $i, 1, $final);

                $new1 = '';

                $new2 = '';

                if ($newbasePrice[$i] == 0) {

                    array_splice($newbasePrice, $i, 1, $add . "-" . $rowPW['baseload']);

                    array_splice($neweffecPrice, $i, 1, $add . "-" . $rowPW['effectiveprice']);

                } else {

                    $new1 = $add . "-" . $rowPW['baseload'] . "," . $newbasePrice[$i];

                    $new2 = $add . "-" . $rowPW['effectiveprice'] . "," . $neweffecPrice[$i];

                    array_splice($newbasePrice, $i, 1, $new1);

                    array_splice($neweffecPrice, $i, 1, $new2);

                }

                break;

            case 9:

                $add = 31 * (float)$rowPW['mw'] * 24;

                $final = $add + (float)$hedgedConumptionMW[$i];

                array_splice($hedgedConumptionMW, $i, 1, $final);

                $new1 = '';

                $new2 = '';

                if ($newbasePrice[$i] == 0) {

                    array_splice($newbasePrice, $i, 1, $add . "-" . $rowPW['baseload']);

                    array_splice($neweffecPrice, $i, 1, $add . "-" . $rowPW['effectiveprice']);

                } else {

                    $new1 = $add . "-" . $rowPW['baseload'] . "," . $newbasePrice[$i];

                    $new2 = $add . "-" . $rowPW['effectiveprice'] . "," . $neweffecPrice[$i];

                    array_splice($newbasePrice, $i, 1, $new1);

                    array_splice($neweffecPrice, $i, 1, $new2);

                }

                break;

            case 10:

                $add = 30 * (float)$rowPW['mw'] * 24;

                $final = $add + (float)$hedgedConumptionMW[$i];

                array_splice($hedgedConumptionMW, $i, 1, $final);

                $new1 = '';

                $new2 = '';

                if ($newbasePrice[$i] == 0) {

                    array_splice($newbasePrice, $i, 1, $add . "-" . $rowPW['baseload']);

                    array_splice($neweffecPrice, $i, 1, $add . "-" . $rowPW['effectiveprice']);

                } else {

                    $new1 = $add . "-" . $rowPW['baseload'] . "," . $newbasePrice[$i];

                    $new2 = $add . "-" . $rowPW['effectiveprice'] . "," . $neweffecPrice[$i];

                    array_splice($newbasePrice, $i, 1, $new1);

                    array_splice($neweffecPrice, $i, 1, $new2);

                }

                break;

            case 11:

                $add = 31 * (float)$rowPW['mw'] * 24;

                $final = $add + (float)$hedgedConumptionMW[$i];

                array_splice($hedgedConumptionMW, $i, 1, $final);

                $new1 = '';

                $new2 = '';

                if ($newbasePrice[$i] == 0) {

                    array_splice($newbasePrice, $i, 1, $add . "-" . $rowPW['baseload']);

                    array_splice($neweffecPrice, $i, 1, $add . "-" . $rowPW['effectiveprice']);

                } else {

                    $new1 = $add . "-" . $rowPW['baseload'] . "," . $newbasePrice[$i];

                    $new2 = $add . "-" . $rowPW['effectiveprice'] . "," . $neweffecPrice[$i];

                    array_splice($newbasePrice, $i, 1, $new1);

                    array_splice($neweffecPrice, $i, 1, $new2);

                }

                break;

        }

    }

    // }

}

for ($j = 0; $j < 12; $j++) {

    $newarr = explode(",", $newbasePrice[$j]);

    // print_r($newarr);

    if (count($newarr) > 1) {

        $res11 = 0;

        $res22 = 0;

        for ($w = 0; $w < count($newarr); $w++) {

            $old = explode("-", $newarr[$w]);

            $res11 += (float)$old[0] * (float)$old[1];

            $res22 += (float)$old[0];

            // print_r($old);

        }

        $final = number_format($res11 / $res22, 2);

        // echo $final."\n";

        array_splice($finalBase, $j, 1, $final);

    } else {

        if ($newbasePrice[$j] == 0) {

            continue;

        }

        $old = explode("-", $newbasePrice[$j]);

        $final = number_format($old[1], 2);

        // echo $final."\n";

        array_splice($finalBase, $j, 1, $final);

    }

}



for ($j = 0; $j < 12; $j++) {

    $newarr = explode(",", $neweffecPrice[$j]);

    // print_r($newarr);

    if (count($newarr) > 1) {

        $res11 = 0;

        $res22 = 0;

        for ($w = 0; $w < count($newarr); $w++) {

            $old = explode("-", $newarr[$w]);

            $res11 += (float)$old[0] * (float)$old[1];

            $res22 += (float)$old[0];

            // print_r($old);

        }

        $final = number_format($res11 / $res22, 2);

        // echo $final."\n";

        array_splice($finalEffec, $j, 1, $final);

    } else {

        if ($newbasePrice[$j] == 0) {

            continue;

        }

        $old = explode("-", $neweffecPrice[$j]);

        $final = number_format($old[1], 2);

        // echo $final."\n";

        array_splice($finalEffec, $j, 1, $final);

    }

}



// echo "<pre>";

// print_r($hedgedConumptionMW);

// print_r($newbasePrice);

// print_r($neweffecPrice);

// print_r($finalBase);

// print_r($finalEffec);



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



// echo "<pre>";

// print_r($baseprice['price']);

// print_r($effecprice['price']);

?>





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

                $consumption = (float)$consumptionpercentage['consumption'][$i];

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

            $countCons = count($hedgedConumptionMW);

            $totalHed = 0;

            for ($i = 0; $i < $countCons; $i++) {

                echo "<td>";

                $consumption = (float)$hedgedConumptionMW[$i];

                $totalHed += $consumption;

                $regex = "/\B(?=(\d{3})+(?!\d))/i";

                echo $usdformat = preg_replace($regex, ",", round($consumption, 2));

                echo "</td>";

            }

            echo "<td>";

            $regex = "/\B(?=(\d{3})+(?!\d))/i";

            echo $usdformat = preg_replace($regex, ",", round($totalHed, 2));

            echo "</td>";

            ?>

        </tr>

        <tr>

            <td>Open Consumption (MWh)</td>

            <?php

            $countCons = count($hedgedConumptionMW);

            $totalOpen = 0;

            for ($i = 0; $i < $countCons; $i++) {

                echo "<td>";

                $consumption = (float)$consumptionpercentage['consumption'][$i] - (float)$hedgedConumptionMW[$i];

                $totalOpen += $consumption;

                $regex = "/\B(?=(\d{3})+(?!\d))/i";

                echo $usdformat = preg_replace($regex, ",", round($consumption, 2));

                echo "</td>";

            }

            echo "<td>";

            $regex = "/\B(?=(\d{3})+(?!\d))/i";

            echo $usdformat = preg_replace($regex, ",", round($totalOpen, 2));

            echo "</td>";

            ?>

        </tr>

        <tr>

            <td>% Hedged</td>

            <?php

            $countCons = count($hedgedConumptionMW);

            $totalOpen = 0;

            for ($i = 0; $i < $countCons; $i++) {

                echo "<td>";
                if(($consumptionpercentage['consumption'][$i])==0) {
                    $percHed = 0;
                }
                else {
                    $percHed = ((float)$hedgedConumptionMW[$i] / (float)$consumptionpercentage['consumption'][$i]) * 100;
                }
                
                echo number_format($percHed, 2) . "%";

                echo "</td>";

            }

            echo "<td>";

            if ($totalConsmpt==0){
                $newHedPer =0;
            }
            else {
                $newHedPer = ($totalHed / $totalConsmpt) * 100;
            }
            echo number_format($newHedPer, 2) . "%";

            echo "</td>";

            ?>

        </tr>

        <tr style="border-bottom: 1px solid gray;">

            <td>% Open</td>

            <?php

            $countCons = count($hedgedConumptionMW);

            $totalOpen = 0;

            for ($i = 0; $i < $countCons; $i++) {

                $consumption = (float)$consumptionpercentage['consumption'][$i] - (float)$hedgedConumptionMW[$i];

                echo "<td>";
                if (($consumptionpercentage['consumption'][$i])==0) {
                    $percOpen=0;
                }
                else {
                    $percOpen = ((float)$consumption / (float)$consumptionpercentage['consumption'][$i]) * 100;
                }
                echo number_format($percOpen, 2) . "%";

                $totalOpen += $consumption;

            }

            echo "<td>";

            echo number_format(100 - $newHedPer, 2) . "%";

            echo "</td>";

            ?>

        </tr>

        <tr>

            <td>Hedged Baseload WAP (per MWh)</td>

            <?php

            // echo "<pre>";
            // print_r($finalBase);

            for ($i = 0; $i < 12; $i++) {

                echo "<td>";

                $val = floatval(preg_replace('/[^\d.]/', '', $finalBase[$i]));
                // echo "Val = ".$val;
                echo number_format($val, 2);

                echo "</td>";

            }

            $resSum = 0;

            for ($i = 0; $i < 12; $i++) {

                $val = floatval(preg_replace('/[^\d.]/', '', $finalBase[$i]));
                $resSum += $hedgedConumptionMW[$i] * $val;

            }

            if ($resSum == 0) {

                $finalRes = 0;

                echo "<td>";

                echo number_format($finalRes, 2);

                echo "</td>";

            } else {

                echo "<td>";

                $finalRes = (float)$resSum / (float)$totalHed;
                $finalRes = number_format($finalRes, 2);

                echo $finalRes;

                echo "</td>";

            }



            ?>

        </tr>

        <tr>

            <td>Hedged Effective WAP (per MWh)</td>

            <?php

            $heCC = 0;

            for ($i = 0; $i < 12; $i++) {

                echo "<td>";

                $val = floatval(preg_replace('/[^\d.]/', '', $finalEffec[$i]));

                echo number_format($val, 2);

                $heCC += round($val * (float)$hedgedConumptionMW[$i]);

                echo "</td>";

            }

            if ($heCC == 0) {

                $finalRes = 0;

                echo "<td>";

                echo number_format($finalRes, 2);

                echo "</td>";

            } else {

                echo "<td>";

                $final = $heCC / $totalHed;

                $final = number_format($final, 2);

                echo $final;

                echo "</td>";

            }

            ?>

        </tr>

        <tr>

            <td>Unhedged Baseload Price (per MWh)</td>

            <?php

            $resBP = 0;

            for ($i = 0; $i < 12; $i++) {

                echo "<td>";

                $basePriceGenP = floatval(preg_replace('/[^\d.]/', '', $baseprice['price'][$i]));
                echo number_format($basePriceGenP, 2);

                echo "</td>";

                $resBP += (float)$basePriceGenP * ((float)$consumptionpercentage['consumption'][$i] - (float)$hedgedConumptionMW[$i]);

                // echo $resBP."i=".$i;

            }

            echo "<td>";

            // echo $totalOpen;

            // echo $resBP;

            $finalBP = number_format($resBP / $totalOpen, 2);

            echo $finalBP;

            echo "</td>";

            ?>

        </tr>

        <tr>

            <td>Unhedged Effective Price (per MWh)</td>

            <?php

            $resEP = 0;

            for ($i = 0; $i < 12; $i++) {

                echo "<td>";

                $effecPriceGenP = floatval(preg_replace('/[^\d.]/', '', $effecprice['price'][$i]));
                echo number_format($effecPriceGenP, 2);

                echo "</td>";

                $resEP += (float)$effecPriceGenP * ((float)$consumptionpercentage['consumption'][$i] - (float)$hedgedConumptionMW[$i]);

            }

            echo "<td>";

            // echo $totalOpen;

            // echo $resBP;

            $finalEP = number_format($resEP / $totalOpen, 2);

            echo $finalEP;

            echo "</td>";

            ?>

        </tr>

        <tr>

            <td class="hrlines">Port Effective Price (Hedged + Unhedged)</td>

            <?php

            for ($i = 0; $i < 12; $i++) {
                if (($consumptionpercentage['consumption'][$i])==0) {
                    $results=0;
                }

                else {
                    $effecPriceGenP = floatval(preg_replace('/[^\d.]/', '', $effecprice['price'][$i]));
                    $results = (((float)$finalEffec[$i] * (float)$hedgedConumptionMW[$i]) + ((float)$effecPriceGenP * ((float)$consumptionpercentage['consumption'][$i] - (float)$hedgedConumptionMW[$i]))) / (float)$consumptionpercentage['consumption'][$i];

                }

                // echo $hedgedConumptionMW[$i];

                echo "<td class='hrlines'>";

                echo number_format($results, 2);

                $effecPriceGenP = floatval(preg_replace('/[^\d.]/', '', $effecprice['price'][$i]));
                $ueCC = round((float)$effecPriceGenP * ((float)$consumptionpercentage['consumption'][$i] - (float)$hedgedConumptionMW[$i]));

                $heCC = round((float)$finalEffec[$i] * (float)$hedgedConumptionMW[$i]);

                $resC = $ueCC + $heCC;

                $totalEstpc += $resC;

                echo "</td>";

            }

            echo "<td class='hrlines'>";

            $totalEst = array_sum($consumptionpercentage['consumption']);

            $finalRes = number_format($totalEstpc / $totalEst, 2);

            echo $finalRes;

            echo "</td>";

            ?>

        </tr>

        <tr class="hedgedColor">

            <td>Hedged Effective Commodity Cost</td>

            <?php

            $totalHecc = 0;

            for ($i = 0; $i < 12; $i++) {

                echo "<td>";

                $regex = "/\B(?=(\d{3})+(?!\d))/i";

                $val = floatval(preg_replace('/[^\d.]/', '', $finalEffec[$i]));
                $heCC = round((float)$val * (float)$hedgedConumptionMW[$i]);

                $totalHecc += $heCC;

                $usdformat = preg_replace($regex, ",", $heCC);

                echo $usdformat;

                echo "</td>";

            }

            echo "<td>";

            $regex = "/\B(?=(\d{3})+(?!\d))/i";

            $usdformat = preg_replace($regex, ",", $totalHecc);

            echo $usdformat;

            echo "</td>";

            ?>

        </tr>

        <tr class="hedgedColor">

            <td>Unhedged Effective Commodity Cost (VaR)</td>

            <?php

            $totalUecc = 0;

            // echo "<pre>";
            // print_r($hedgedConumptionMW);

            for ($i = 0; $i < 12; $i++) {

                echo "<td>";

                $regex = "/\B(?=(\d{3})+(?!\d))/i";

                $effecPriceGenP = floatval(preg_replace('/[^\d.]/', '', $effecprice['price'][$i]));
                $ueCC = round((float)$effecPriceGenP * ((float)$consumptionpercentage['consumption'][$i] - (float)$hedgedConumptionMW[$i]));

                $totalUecc += $ueCC;

                $usdformat = preg_replace($regex, ",", $ueCC);
                echo $usdformat;

                echo "</td>";

            }

            echo "<td>";

            $regex = "/\B(?=(\d{3})+(?!\d))/i";

            $usdformat = preg_replace($regex, ",", $totalUecc);

            echo $usdformat;

            echo "</td>"

            ?>

        </tr>

        <tr class="hrlines hedgedColor">

            <td class="border">Est. Total Commodity Cost</td>

            <?php

            $totalEstpc = 0;

            for ($i = 0; $i < 12; $i++) {

                echo "<td>";

                $regex = "/\B(?=(\d{3})+(?!\d))/i";

                $effecPriceGenP = floatval(preg_replace('/[^\d.]/', '', $effecprice['price'][$i]));
                $ueCC = round((float)$effecPriceGenP * ((float)$consumptionpercentage['consumption'][$i] - (float)$hedgedConumptionMW[$i]));

                
                $val = floatval(preg_replace('/[^\d.]/', '', $finalEffec[$i]));
                $heCC = round((float)$val * (float)$hedgedConumptionMW[$i]);

                $resC = $ueCC + $heCC;

                $totalEstpc += $resC;

                $usdformat = preg_replace($regex, ",", $resC);

                echo $usdformat;

                echo "</td>";

            }

            echo "<td>";

            $regex = "/\B(?=(\d{3})+(?!\d))/i";

            $usdformat = preg_replace($regex, ",", $totalEstpc);

            echo $usdformat;

            echo "</td>"

            ?>

        </tr>

    </tbody>

</table>



<script>

    function drawChart() {

        // Define the chart to be drawn.

        var data = google.visualization.arrayToDataTable([

            ['Month', 'Hedged Consumption', {

                role: "style"

            }, 'Open Consumption', {

                role: "style"

            }],

            ["Jan", <?php echo $hedgedConumptionMW[0]; ?>, "#4472c4", <?php echo $consumptionpercentage['consumption'][0] - $hedgedConumptionMW[0]; ?>, "#BCBCBC"],

            ["Feb", <?php echo $hedgedConumptionMW[1]; ?>, "#4472c4", <?php echo $consumptionpercentage['consumption'][1] - $hedgedConumptionMW[1];  ?>, "#BCBCBC"],

            ["Mar", <?php echo $hedgedConumptionMW[2]; ?>, "#4472c4", <?php echo $consumptionpercentage['consumption'][2] - $hedgedConumptionMW[2];  ?>, "#BCBCBC"],

            ["Apr", <?php echo $hedgedConumptionMW[3]; ?>, "#4472c4", <?php echo $consumptionpercentage['consumption'][3] - $hedgedConumptionMW[3];  ?>, "#BCBCBC"],

            ["May", <?php echo $hedgedConumptionMW[4]; ?>, "#4472c4", <?php echo $consumptionpercentage['consumption'][4] - $hedgedConumptionMW[4];  ?>, "#BCBCBC"],

            ["Jun", <?php echo $hedgedConumptionMW[5]; ?>, "#4472c4", <?php echo $consumptionpercentage['consumption'][5] - $hedgedConumptionMW[5];  ?>, "#BCBCBC"],

            ["Jul", <?php echo $hedgedConumptionMW[6]; ?>, "#4472c4", <?php echo $consumptionpercentage['consumption'][6] - $hedgedConumptionMW[6];  ?>, "#BCBCBC"],

            ["Aug", <?php echo $hedgedConumptionMW[7]; ?>, "#4472c4", <?php echo $consumptionpercentage['consumption'][7] - $hedgedConumptionMW[7];  ?>, "#BCBCBC"],

            ["Sep", <?php echo $hedgedConumptionMW[8]; ?>, "#4472c4", <?php echo $consumptionpercentage['consumption'][8] - $hedgedConumptionMW[8];  ?>, "#BCBCBC"],

            ["Oct", <?php echo $hedgedConumptionMW[9]; ?>, "#4472c4", <?php echo $consumptionpercentage['consumption'][9] - $hedgedConumptionMW[9];  ?>, "#BCBCBC"],

            ["Nov", <?php echo $hedgedConumptionMW[10]; ?>, "#4472c4", <?php echo $consumptionpercentage['consumption'][10] - $hedgedConumptionMW[10];  ?>, "#BCBCBC"],

            ["Dec", <?php echo $hedgedConumptionMW[11]; ?>, "#4472c4", <?php echo $consumptionpercentage['consumption'][11] - $hedgedConumptionMW[11];  ?>, "#BCBCBC"]

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

        var chart = new google.visualization.ColumnChart(document.getElementById('container1'));

        chart.draw(data, options);

        // console.log('Intel inside');

    }

    google.charts.setOnLoadCallback(drawChart);

</script>