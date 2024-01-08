
<?php

use function PHPSTORM_META\type;

include 'dbconn.php';

$id = $_POST['tradeId'];
$year = $_POST['tradevalue'];
$nustradeid = $_POST['nustradeId'];
$Calendarvalue = $_POST['calendaryear'];
$tradeid = $_POST['tradingId'];
$tradevolume = $_POST['tradevolume'];
$user =  $_POST['user'];
$state = "Cancelled";
$date = $_POST['datevalue'];
$description = $_POST['description'];
$quaterly = $_POST['quartval'];
$supplyId = $_POST['supplyId'];

$entertrade = "SELECT * FROM enter_trade WHERE tradeId='" . $id . "';";
$traderes =  mysqli_query($conn, $entertrade);
$row = mysqli_fetch_assoc($traderes);

// Calendar yearly starts 
if ($Calendarvalue === 'Calendar Yearly') {

    if ($row['percentage'] != "" || $row['mwh'] != "") {

        // Checking the clicks while creating 
        $sqlclicks = "SELECT * FROM nus_tradeperiods WHERE supplierId = $supplyId AND periodsId = '" . $Calendarvalue . "';";
        $resultclicks =  mysqli_query($conn, $sqlclicks);
        $rows = mysqli_fetch_assoc($resultclicks);
        $clicktracnches = $rows['clicktracnches'];

        // Checking the How many used clicks
        $sql = "SELECT * FROM nus_calenderyear WHERE supplierid = $supplyId AND calenderyear= '" . $year . "';";
        $result =  mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $clicks = $row['clicks'];
        $clickscount =  $clicks + 1;

        if ($clicktracnches == $clicks) {

            echo "<script>
                    alert('Limit of the Trade clicks has already been reached; canceling is not possible.'); 
                   window.history.go(-2); 
                </script>";
        } else {

            $sqlupdate = "UPDATE nus_calenderyear nc, enter_trade e 
                                    SET nc.clicks ='" . $clickscount . "', e.tradeexecuted = '" . $state . "'
                                    WHERE nc.calenderId = '" . $row['calenderId'] . "' AND e.nustradeId = '" . $nustradeid . "' 
                                    AND e.tradeId = '" . $id . "' AND e.tradevolume = '" . $tradevolume . "';";

            $conn->query($sqlupdate);
        }

        // Fetching the supply contract data by using supplyID
        $sql1 = "SELECT * FROM nus_supply_contract where supplierId  = '" . $supplyId . "';";

        $supplyres =  mysqli_query($conn, $sql1);
        $rowconsumption = mysqli_fetch_assoc($supplyres);

        // Fetching the trade details by providing the trade id number

        $entertrade = "SELECT * FROM enter_trade WHERE tradeId='" . $id . "';";
        $traderes =  mysqli_query($conn, $entertrade);

        $row = mysqli_fetch_assoc($traderes);
        $percentage = $row['percentage'];

        $mwh = $row['mwh'];
        $m = str_replace(',', '', $mwh);

        $mwhvalue =  intval($m) / 12;
        if ($mwhvalue == 0) {
            $mwhvalue = '';
        }
        $mwval = 0;
        $mwvals = 0;

        if ($row['mw'] != "0.00") {
            $mw = $row['tradevolume'];
            $mw_val = $row['mw'];
            $mwvals = intval($mw_val);
            $mwval = intval($mw);
        } else {
            $mwval = "";
        }


        // Consumption 
        $consuptionvaluepermonth = array(

            "year" => array(),

            "month" => array(),

            "consumption" => array(),

        );

        // Hedged

        $hedgedconsumption = array(

            "year" => array(),

            "month" => array(),

            "consumption" => array(),

        );

        // open
        $openconsumption = array(

            "year" => array(),

            "month" => array(),

            "consumption" => array(),

        );

        $consumptionvalue = array(explode('|', $rowconsumption['consumptionmonth']));

        $hedgedconsumptionvalue = array(explode('|', $rowconsumption['hedgeconsumption']));

        $openconsumptionvalue = array(explode('|', $rowconsumption['openconsumption']));

        // consumption

        for ($i = 0; $i < count($consumptionvalue[0]); $i++) {

            $conn1 = array(explode("-", $consumptionvalue[0][$i]));

            array_splice($consuptionvaluepermonth['year'], $i, 1, $conn1[0][1]);

            array_splice($consuptionvaluepermonth['month'], $i, 1, $conn1[0][0]);

            array_splice($consuptionvaluepermonth['consumption'], $i, 1, $conn1[0][2]);
        }

        // hedged

        for ($i = 0; $i < count($hedgedconsumptionvalue[0]); $i++) {

            $conn2 = array(explode("-", $hedgedconsumptionvalue[0][$i]));

            array_splice($hedgedconsumption['year'], $i, 1, $conn2[0][1]);

            array_splice($hedgedconsumption['month'], $i, 1, $conn2[0][0]);

            array_splice($hedgedconsumption['consumption'], $i, 1, $conn2[0][2]);
        }

        //Open

        for ($i = 0; $i < count($openconsumptionvalue[0]); $i++) {

            $conn3 = array(explode("-", $openconsumptionvalue[0][$i]));

            array_splice($openconsumption['year'], $i, 1, $conn3[0][1]);

            array_splice($openconsumption['month'], $i, 1, $conn3[0][0]);

            array_splice($openconsumption['consumption'], $i, 1, $conn3[0][2]);
        }

        // Percentage ok

        if ($percentage != "") {

            //hedged

            for ($i = 0; $i < count($hedgedconsumption['consumption']); $i++) {

                if ($hedgedconsumption['year'][$i] == $year) {

                    $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - ((float)($consuptionvaluepermonth['consumption'][$i] * $percentage) / 100);
                } else {

                    $hedgedconsumption['consumption'][$i] = $hedgedconsumption['consumption'][$i];
                }
            }

            //Open consumption

            for ($i = 0; $i < count($openconsumption['consumption']); $i++) {

                if ($openconsumption['year'][$i] == $year) {

                    $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] + ((float)($consuptionvaluepermonth['consumption'][$i] * $percentage) / 100);
                } else {

                    $openconsumption['consumption'][$i] = $openconsumption['consumption'][$i];
                }
            }

            // Hedged

            $hedged = array();
            $hedgedval = array();

            for ($i = 0; $i < count($hedgedconsumption['consumption']); $i++) {

                $hedged[] = ($hedgedconsumption['month'][$i] . '-' . $hedgedconsumption['year'][$i] . '-' . $hedgedconsumption['consumption'][$i]);
            }

            $hedgedval = implode('|', $hedged);

            // Open

            $open = array();
            $openval = array();

            for ($i = 0; $i < count($openconsumption['consumption']); $i++) {

                $open[] = ($openconsumption['month'][$i] . '-' . $openconsumption['year'][$i] . '-' . $openconsumption['consumption'][$i]);
            }

            $openval = implode('|', $open);

            // Update query
            $updateconsumption = "UPDATE nus_supply_contract SET hedgeconsumption ='" . $hedgedval . "', openconsumption ='" . $openval . "'  WHERE supplierId=" . $supplyId . "";
            $conn->query($updateconsumption);
        }

        // MWH

        else if ($mwhvalue != "") {

            for ($i = 0; $i < count($hedgedconsumption['consumption']); $i++) {

                if ($hedgedconsumption['year'][$i] == $year) {

                    $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]) - $mwhvalue;
                } else {

                    $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]);
                }
            }

            // consumption

            for ($i = 0; $i < count($openconsumption['consumption']); $i++) {

                if ($openconsumption['year'][$i] == $year) {

                    $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]) + $mwhvalue;
                } else {

                    $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]);
                }
            }

            // Hedged

            $hedged = array();
            $hedgedval = array();

            for ($i = 0; $i < count($hedgedconsumption['consumption']); $i++) {

                $hedged[] = ($hedgedconsumption['month'][$i] . '-' . $hedgedconsumption['year'][$i] . '-' . $hedgedconsumption['consumption'][$i]);
            }

            $hedgedval = implode('|', $hedged);

            // Open

            $open = array();
            $openval = array();

            for ($i = 0; $i < count($openconsumption['consumption']); $i++) {

                $open[] = ($openconsumption['month'][$i] . '-' . $openconsumption['year'][$i] . '-' . $openconsumption['consumption'][$i]);
            }

            $openval = implode('|', $open);

            // Update query

            $updateconsumption = "UPDATE nus_supply_contract SET hedgeconsumption ='" . $hedgedval . "', openconsumption ='" . $openval . "'  WHERE supplierId=" . $supplyId . "";
            $conn->query($updateconsumption);
        }
    }

    // MW

    else {

        $sqlclicks = "SELECT * FROM nus_tradeperiods WHERE supplierId = $supplyId AND periodsId = '" . $Calendarvalue . "';";
        $resultclicks =  mysqli_query($conn, $sqlclicks);
        $rows = mysqli_fetch_assoc($resultclicks);
        $clicktracnches = $rows['clicktracnches'];

        // Checking the How many used clicks
        $sql = "SELECT * FROM nus_calenderyear WHERE supplierid = $supplyId AND calenderyear= '" . $year . "';";
        $result =  mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $clicks = $row['clicks'];
        $clickscount =  $clicks + 1;

        if ($clicktracnches == $clicks) {

            echo "<script>
                    alert('Limit of the Trade clicks has already been reached; canceling is not possible.'); 
                   window.history.go(-2); 
                </script>";
        } else {

            $sqlupdate = "UPDATE nus_calenderyear nc, enter_trade e 
                                    SET nc.clicks ='" . $clickscount . "', e.tradeexecuted = '" . $state . "'
                                    WHERE nc.calenderId = '" . $row['calenderId'] . "' AND e.nustradeId = '" . $nustradeid . "' 
                                    AND e.tradeId = '" . $id . "' AND e.tradevolume = '" . $tradevolume . "';";

            $conn->query($sqlupdate);
        }
    }

    // echo "<pre>";
    // print_r($hedgedconsumption);
    //mw end
}



// Calendar yearly ends

// calender Quaterly starts 

else if ($Calendarvalue === 'Calendar Quarterly') {

    if ($row['percentage'] != "" || $row['mwh'] != "") {

        // Checking the clicks while creating 
        $sqlclicks = "SELECT * FROM nus_tradeperiods WHERE supplierId = $supplyId AND periodsId = '" . $Calendarvalue . "';";
        $resultclicks =  mysqli_query($conn, $sqlclicks);
        $rows = mysqli_fetch_assoc($resultclicks);
        $clicktracnches = $rows['clicktracnches'];

        // Checking the How many used clicks
        $sql = "SELECT * FROM nus_calenderquarter WHERE quarters  = '" . $quaterly . "' AND yearoftrade= '" . $year . "' AND supplierid=$supplyId;";
        $result =  mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $clicks = $row['clicks'];
        $clickscount =  $clicks + 1;

        if ($clicktracnches == $clicks) {

            echo "<script>
                    alert('Limit of the Trade clicks has already been reached; canceling is not possible.'); 
                   window.history.go(-2); 
                </script>";
        } else {

            $sqlupdate = "UPDATE nus_calenderquarter nc, enter_trade e 
                                    SET nc.clicks ='" . $clickscount . "', e.tradeexecuted = '" . $state . "'
                                    WHERE nc.querterid = '" . $row['querterid'] . "' AND e.nustradeId = '" . $nustradeid . "' 
                                    AND e.tradeId = '" . $id . "' AND e.tradevolume = '" . $tradevolume . "';";
            // // echo $sqlupdate;

            $conn->query($sqlupdate);
        }

        // Fetching the supply contract data by using supplyID
        $sql1 = "SELECT * FROM nus_supply_contract where supplierId  = '" . $supplyId . "';";

        $supplyres =  mysqli_query($conn, $sql1);
        $rowconsumption = mysqli_fetch_assoc($supplyres);

        // Fetching the trade details by providing the trade id number

        $entertrade = "SELECT * FROM enter_trade WHERE tradeId='" . $id . "';";
        $traderes =  mysqli_query($conn, $entertrade);

        $row = mysqli_fetch_assoc($traderes);
        $percentage = $row['percentage'];

        $mwh = $row['mwh'];
        $m = str_replace(',', '', $mwh);

        $mwhvalue =  intval($m) / 3;

        if ($mwhvalue == 0) {
            $mwhvalue = '';
        }

        // Consumption 
        $consuptionvaluepermonth = array(

            "year" => array(),

            "month" => array(),

            "consumption" => array(),

        );

        // Hedged

        $hedgedconsumption = array(

            "year" => array(),

            "month" => array(),

            "consumption" => array(),

        );

        // open
        $openconsumption = array(

            "year" => array(),

            "month" => array(),

            "consumption" => array(),

        );

        $consumptionvalue = array(explode('|', $rowconsumption['consumptionmonth']));

        $hedgedconsumptionvalue = array(explode('|', $rowconsumption['hedgeconsumption']));

        $openconsumptionvalue = array(explode('|', $rowconsumption['openconsumption']));

        // echo "<pre>";
        // print_r($hedgedconsumptionvalue);

        // consumption

        for ($i = 0; $i < count($consumptionvalue[0]); $i++) {

            $conn1 = array(explode("-", $consumptionvalue[0][$i]));

            array_splice($consuptionvaluepermonth['year'], $i, 1, $conn1[0][1]);

            array_splice($consuptionvaluepermonth['month'], $i, 1, $conn1[0][0]);

            array_splice($consuptionvaluepermonth['consumption'], $i, 1, $conn1[0][2]);
        }

        // hedged
        for ($i = 0; $i < count($hedgedconsumptionvalue[0]); $i++) {

            $conn2 = array(explode("-", $hedgedconsumptionvalue[0][$i]));

            array_splice($hedgedconsumption['year'], $i, 1, $conn2[0][1]);

            array_splice($hedgedconsumption['month'], $i, 1, $conn2[0][0]);

            array_splice($hedgedconsumption['consumption'], $i, 1, $conn2[0][2]);
        }

        //Open

        for ($i = 0; $i < count($openconsumptionvalue[0]); $i++) {

            $conn3 = array(explode("-", $openconsumptionvalue[0][$i]));

            array_splice($openconsumption['year'], $i, 1, $conn3[0][1]);

            array_splice($openconsumption['month'], $i, 1, $conn3[0][0]);

            array_splice($openconsumption['consumption'], $i, 1, $conn3[0][2]);
        }

        // echo "<pre>";
        // echo "Quarters";
        // print_r($hedgedconsumption['consumption']);

        if ($percentage != "") {



            for ($i = 0; $i < count($hedgedconsumption['consumption']); $i++) {

                if ($hedgedconsumption['year'][$i] == $year) {
                    

                    if ($quaterly === 'q1') {

                        switch ($hedgedconsumption['month'][$i]) {
                            case 'Jan':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Feb':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Mar':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                        }
                    } else if ($quaterly === 'q2') {

                        switch ($hedgedconsumption['month'][$i]) {
                            case 'Apr':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'May':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Jun':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                        }
                    } else if ($quaterly === 'q3') {

                        switch ($hedgedconsumption['month'][$i]) {
                            case 'July':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Aug':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Sep':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                        }
                    } else if ($quaterly === 'q4') {

                        switch ($hedgedconsumption['month'][$i]) {
                            case 'Oct':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Nov':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Dec':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                        }
                    }
                } else {

                    $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]);
                }
            }

            // echo "<pre>";
            // print_r($hedgedconsumption);


            for ($i = 0; $i < count($openconsumption['consumption']); $i++) {
               

                if ($openconsumption['year'][$i] == $year) {

                    if ($quaterly === 'q1') {
                        switch ($openconsumption['month'][$i]) {
                            case 'Jan':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Feb':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Mar':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                        }
                    } else if ($quaterly === 'q2') {

                        switch ($openconsumption['month'][$i]) {
                            case 'Apr':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'May':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Jun':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                        }
                    } else if ($quaterly === 'q3') {

                        switch ($openconsumption['month'][$i]) {
                            case 'July':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Aug':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Sep':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                        }
                    } else if ($quaterly === 'q4') {

                        switch ($openconsumption['month'][$i]) {
                            case 'Oct':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Nov':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                            case 'Dec':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                                break;
                        }
                    }
                } else {

                    $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]);
                }
            }

            $hedged = array();
            $hedgedval = array();

            for ($i = 0; $i < count($hedgedconsumption['consumption']); $i++) {

                $hedged[] = ($hedgedconsumption['month'][$i] . '-' . $hedgedconsumption['year'][$i] . '-' . $hedgedconsumption['consumption'][$i]);
            }

            $hedgedval = implode('|', $hedged);
           

            // Open

            $open = array();
            $openval = array();

            for ($i = 0; $i < count($openconsumption['consumption']); $i++) {

                $open[] = ($openconsumption['month'][$i] . '-' . $openconsumption['year'][$i] . '-' . $openconsumption['consumption'][$i]);
            }

            $openval = implode('|', $open);

            // Update query
            $updateconsumption = "UPDATE nus_supply_contract SET hedgeconsumption ='" . $hedgedval . "', openconsumption ='" . $openval . "' WHERE supplierId=" . $supplyId . "";
            $conn->query($updateconsumption);
        }

        // MWH for quaterly

        if ($mwhvalue != "") {

            for ($i = 0; $i < count($hedgedconsumption['consumption']); $i++) {

                if ($hedgedconsumption['year'][$i] == $year) {

                    if ($quaterly === 'q1') {

                        switch ($hedgedconsumption['month'][$i]) {
                            case 'Jan':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]) - $mwhvalue;
                                break;
                            case 'Feb':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]) - $mwhvalue;
                                break;
                            case 'Mar':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]) - $mwhvalue;
                                break;
                        }
                    } else if ($quaterly === 'q2') {

                        switch ($hedgedconsumption['month'][$i]) {
                            case 'Apr':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]) - $mwhvalue;
                                break;
                            case 'May':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]) - $mwhvalue;
                                break;
                            case 'Jun':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]) - $mwhvalue;
                                break;
                        }
                    } else if ($quaterly === 'q3') {

                        switch ($hedgedconsumption['month'][$i]) {
                            case 'July':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]) - $mwhvalue;
                                break;
                            case 'Aug':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]) - $mwhvalue;
                                break;
                            case 'Sep':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]) - $mwhvalue;
                                break;
                        }
                    } else if ($quaterly === 'q4') {

                        switch ($hedgedconsumption['month'][$i]) {
                            case 'Oct':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]) - $mwhvalue;
                                break;
                            case 'Nov':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]) - $mwhvalue;
                                break;
                            case 'Dec':
                                $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]) - $mwhvalue;
                                break;
                        }
                    }
                } else {

                    $hedgedconsumption['consumption'][$i] = intval($hedgedconsumption['consumption'][$i]);
                }
            }


            for ($i = 0; $i < count($openconsumption['consumption']); $i++) {

                if ($openconsumption['year'][$i] == $year) {

                    if ($quaterly === 'q1') {

                        switch ($openconsumption['month'][$i]) {
                            case 'Jan':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]) + $mwhvalue;
                                break;
                            case 'Feb':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]) + $mwhvalue;
                                break;
                            case 'Mar':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]) + $mwhvalue;
                                break;
                        }
                    } else if ($quaterly === 'q2') {

                        switch ($openconsumption['month'][$i]) {
                            case 'Apr':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]) + $mwhvalue;
                                break;
                            case 'May':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]) + $mwhvalue;
                                break;
                            case 'Jun':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]) + $mwhvalue;
                                break;
                        }
                    } else if ($quaterly === 'q3') {

                        switch ($openconsumption['month'][$i]) {
                            case 'July':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]) + $mwhvalue;
                                break;
                            case 'Aug':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]) + $mwhvalue;
                                break;
                            case 'Sep':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]) + $mwhvalue;
                                break;
                        }
                    } else if ($quaterly === 'q4') {

                        switch ($openconsumption['month'][$i]) {
                            case 'Oct':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]) + $mwhvalue;
                                break;
                            case 'Nov':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]) + $mwhvalue;
                                break;
                            case 'Dec':
                                $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]) + $mwhvalue;
                                break;
                        }
                    }
                } else {

                    $openconsumption['consumption'][$i] = intval($openconsumption['consumption'][$i]);
                }
            }

            $hedged = array();
            $hedgedval = array();

            for ($i = 0; $i < count($hedgedconsumption['consumption']); $i++) {

                $hedged[] = ($hedgedconsumption['month'][$i] . '-' . $hedgedconsumption['year'][$i] . '-' . $hedgedconsumption['consumption'][$i]);
            }

            $hedgedval = implode('|', $hedged);


            // Open

            $open = array();
            $openval = array();

            for ($i = 0; $i < count($openconsumption['consumption']); $i++) {

                $open[] = ($openconsumption['month'][$i] . '-' . $openconsumption['year'][$i] . '-' . $openconsumption['consumption'][$i]);
            }

            $openval = implode('|', $open);

            // Update query
            $updateconsumption = "UPDATE nus_supply_contract SET hedgeconsumption ='" . $hedgedval . "', openconsumption ='" . $openval . "' WHERE supplierId=" . $supplyId . "";
            $conn->query($updateconsumption);
        }
    }

    // mw starts

    else {

        $sqlclicks = "SELECT * FROM nus_tradeperiods WHERE tradePerId = '" . $tradeid . "';";
        $resultclicks =  mysqli_query($conn, $sqlclicks);
        $rows = mysqli_fetch_assoc($resultclicks);
        $clicktracnches = $rows['clicktracnches'];

        // Checking the How many used clicks
        $sql = "SELECT * FROM nus_calenderquarter WHERE querterid  = '" . $nustradeid . "' AND yearoftrade= '" . $year . "';";
        $result =  mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $clicks = $row['clicks'];
        $clickscount =  $clicks + 1;

        if ($clicktracnches == $clicks) {

            echo "<script>
                        alert('Limit of the Trade clicks has already been reached; canceling is not possible.'); 
                       window.history.go(-2); 
                    </script>";
        } else {

            $sqlupdate = "UPDATE nus_calenderquarter nc, enter_trade e 
                                        SET nc.clicks ='" . $clickscount . "', e.tradeexecuted = '" . $state . "'
                                        WHERE nc.querterid = '" . $nustradeid . "' AND e.nustradeId = '" . $nustradeid . "' 
                                        AND e.tradeId = '" . $id . "' AND e.tradevolume = '" . $tradevolume . "';";

            $conn->query($sqlupdate);
        }
    }
    // mw end 

}

// Calendar quaterly ends 

// Calendar month starts

else {

    if ($row['percentage'] != "" || $row['mwh'] != "") {

        // Checking the clicks while creating 
        $sqlclicks = "SELECT * FROM nus_tradeperiods WHERE supplierId = '" . $supplyId . "' AND periodsId = '" . $Calendarvalue . "';";
        $resultclicks =  mysqli_query($conn, $sqlclicks);
        $rows = mysqli_fetch_assoc($resultclicks);

        // echo "<pre>";
        // print_r($rows);

        $clicktracnches = $rows['clicktracnches'];

        // Checking the How many used clicks
        $sql = "SELECT * FROM nus_calendermonth WHERE supplierId=$supplyId AND year = $year AND month = '" . $quaterly . "';";
        $result =  mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        // echo "<pre>";
        // print_r($row);

        $clicks = (int)$row['clicks'];
        $clickscount =  $clicks + 1;

        // echo gettype($clicks);

        if ($clicktracnches == $clicks) {

            echo "<script>
                    alert('Limit of the Trade clicks has already been reached; canceling is not possible.'); 
                   window.history.go(-2); 
                </script>";
        } else {

            $sqlupdate = "UPDATE nus_calendermonth nc, enter_trade e 
                                    SET nc.clicks ='" . $clickscount . "', e.tradeexecuted = '" . $state . "'
                                    WHERE nc.monthId  = '" . $row['monthId'] . "' AND e.nustradeId = '" . $nustradeid . "' 
                                    AND e.tradeId = '" . $id . "' AND e.tradevolume = '" . $tradevolume . "';";

            // // echo $sqlupdate;

            $conn->query($sqlupdate);
        }

        // Fetching the supply contract data by using supplyID
        $sql1 = "SELECT * FROM nus_supply_contract where supplierId  = '" . $supplyId . "';";

        $supplyres =  mysqli_query($conn, $sql1);
        $rowconsumption = mysqli_fetch_assoc($supplyres);

        // Fetching the trade details by providing the trade id number

        $entertrade = "SELECT * FROM enter_trade WHERE tradeId='" . $id . "';";
        $traderes =  mysqli_query($conn, $entertrade);

        $row = mysqli_fetch_assoc($traderes);
        $percentage = $row['percentage'];

        $mwh = $row['mwh'];
        $m = str_replace(',', '', $mwh);

        $mwhvalue =  intval($m);
        if ($mwhvalue == 0) {
            $mwhvalue = '';
        }

        // Consumption 

        $consuptionvaluepermonth = array(

            "year" => array(),

            "month" => array(),

            "consumption" => array(),

        );

        // Hedged

        $hedgedconsumption = array(

            "year" => array(),

            "month" => array(),

            "consumption" => array(),

        );

        // open

        $openconsumption = array(

            "year" => array(),

            "month" => array(),

            "consumption" => array(),

        );

        $consumptionvalue = array(explode('|', $rowconsumption['consumptionmonth']));

        $hedgedconsumptionvalue = array(explode('|', $rowconsumption['hedgeconsumption']));

        $openconsumptionvalue = array(explode('|', $rowconsumption['openconsumption']));

        // consumption

        for ($i = 0; $i < count($consumptionvalue[0]); $i++) {

            $conn1 = array(explode("-", $consumptionvalue[0][$i]));

            array_splice($consuptionvaluepermonth['year'], $i, 1, $conn1[0][1]);

            array_splice($consuptionvaluepermonth['month'], $i, 1, $conn1[0][0]);

            array_splice($consuptionvaluepermonth['consumption'], $i, 1, $conn1[0][2]);
        }

        // hedged

        for ($i = 0; $i < count($hedgedconsumptionvalue[0]); $i++) {

            $conn2 = array(explode("-", $hedgedconsumptionvalue[0][$i]));

            array_splice($hedgedconsumption['year'], $i, 1, $conn2[0][1]);

            array_splice($hedgedconsumption['month'], $i, 1, $conn2[0][0]);

            array_splice($hedgedconsumption['consumption'], $i, 1, $conn2[0][2]);
        }

        //Open

        for ($i = 0; $i < count($openconsumptionvalue[0]); $i++) {

            $conn3 = array(explode("-", $openconsumptionvalue[0][$i]));

            array_splice($openconsumption['year'], $i, 1, $conn3[0][1]);

            array_splice($openconsumption['month'], $i, 1, $conn3[0][0]);

            array_splice($openconsumption['consumption'], $i, 1, $conn3[0][2]);
        }

        if ($percentage != "") {

            for ($i = 0; $i < count($hedgedconsumption['consumption']); $i++) {

                if ($hedgedconsumption['year'][$i] == $year && $hedgedconsumption['month'][$i]==$quaterly) {
                    
                    switch ($quaterly) {
                        
                        case 'Jan':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Feb':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Mar':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Apr':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'May':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Jun':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'July':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Aug':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Sep':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Oct':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Nov':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Dec':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] = (float)$hedgedconsumption['consumption'][$i] - (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                    }
     
                } else {

                    $hedgedconsumption['consumption'][$i] =  $hedgedconsumption['consumption'][$i];
                }

            }

            for ($i = 0; $i < count($openconsumption['consumption']); $i++) {

                if ($openconsumption['year'][$i] == $year && $hedgedconsumption['month'][$i]==$quaterly) {

                    switch ($quaterly) {
                        case 'Jan':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] + (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Feb':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] + (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Mar':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] + (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Apr':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] + (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'May':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] + (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Jun':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] + (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'July':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] + (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Aug':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] + (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Sep':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] + (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Oct':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] + (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Nov':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] + (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                        case 'Dec':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] = (float)$openconsumption['consumption'][$i] + (((float)$consuptionvaluepermonth['consumption'][$i] * (float)$percentage) / 100);
                            break;
                    }
             
                } else {

                    $openconsumption['consumption'][$i] =  $openconsumption['consumption'][$i];
                }
            }



            $hedged = array();
            $hedgedval = array();

            for ($i = 0; $i < count($hedgedconsumption['consumption']); $i++) {

                $hedged[] = ($hedgedconsumption['month'][$i] . '-' . $hedgedconsumption['year'][$i] . '-' . $hedgedconsumption['consumption'][$i]);
            }

            $hedgedval = implode('|', $hedged);
           
            // Open

            $open = array();
            $openval = array();

            for ($i = 0; $i < count($openconsumption['consumption']); $i++) {

                $open[] = ($openconsumption['month'][$i] . '-' . $openconsumption['year'][$i] . '-' . $openconsumption['consumption'][$i]);
            }

            $openval = implode('|', $open);
           ;

            // Update query

            $updateconsumption = "UPDATE nus_supply_contract SET hedgeconsumption ='" . $hedgedval . "', openconsumption ='" . $openval . "' WHERE supplierId=" . $supplyId . "";
            $conn->query($updateconsumption);
        }

        if ($mwhvalue != "") {

            for ($i = 0; $i < count($hedgedconsumption['consumption']); $i++) {

                if ($hedgedconsumption['year'][$i] == $year && $hedgedconsumption['month'][$i]==$quaterly) {
                    switch ($quaterly) {
                        case 'Jan':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] =  (float)$hedgedconsumption['consumption'][$i] - ($mwhvalue);
                            break;
                        case 'Feb':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] =  (float)$hedgedconsumption['consumption'][$i] - ($mwhvalue);
                            break;
                        case 'Mar':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] =  (float)$hedgedconsumption['consumption'][$i] - ($mwhvalue);
                            break;
                        case 'Apr':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] =  (float)$hedgedconsumption['consumption'][$i] - ($mwhvalue);
                            break;
                        case 'May':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] =  (float)$hedgedconsumption['consumption'][$i] - ($mwhvalue);
                            break;
                        case 'Jun':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] =  (float)$hedgedconsumption['consumption'][$i] - ($mwhvalue);
                            break;
                        case 'July':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] =  (float)$hedgedconsumption['consumption'][$i] - ($mwhvalue);
                            break;
                        case 'Aug':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] =  (float)$hedgedconsumption['consumption'][$i] - ($mwhvalue);
                            break;
                        case 'Sep':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] =   (float)$hedgedconsumption['consumption'][$i] - ($mwhvalue);
                            break;
                        case 'Oct':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] =  (float)$hedgedconsumption['consumption'][$i] - ($mwhvalue);
                            break;
                        case 'Nov':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] =  (float)$hedgedconsumption['consumption'][$i] - ($mwhvalue);
                            break;
                        case 'Dec':
                            $hedgedconsumption['consumption'][$i] == 0 ? $hedgedconsumption['consumption'][$i] = 0 : $hedgedconsumption['consumption'][$i] =  (float)$hedgedconsumption['consumption'][$i] - ($mwhvalue);
                            break;
                    }
                } else {

                    $hedgedconsumption['consumption'][$i] =  $hedgedconsumption['consumption'][$i];
                }
            }

            for ($i = 0; $i < count($openconsumption['consumption']); $i++) {

                if ($openconsumption['year'][$i] == $year && $hedgedconsumption['month'][$i]==$quaterly) {
                    switch ($quaterly) {
                        case 'Jan':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] =  (float)$openconsumption['consumption'][$i] + ($mwhvalue);
                            break;
                        case 'Feb':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] =  (float)$openconsumption['consumption'][$i] + ($mwhvalue);
                            break;
                        case 'Mar':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] =  (float)$openconsumption['consumption'][$i] + ($mwhvalue);
                            break;
                        case 'Apr':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] =  (float)$openconsumption['consumption'][$i] + ($mwhvalue);
                            break;
                        case 'May':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] =  (float)$openconsumption['consumption'][$i] + ($mwhvalue);
                            break;
                        case 'Jun':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] =  (float)$openconsumption['consumption'][$i] + ($mwhvalue);
                            break;
                        case 'July':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] =  (float)$openconsumption['consumption'][$i] + ($mwhvalue);
                            break;
                        case 'Aug':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] =  (float)$openconsumption['consumption'][$i] + ($mwhvalue);
                            break;
                        case 'Sep':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] =  (float)$openconsumption['consumption'][$i] + ($mwhvalue);
                            break;
                        case 'Oct':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] =  (float)$openconsumption['consumption'][$i] + ($mwhvalue);
                            break;
                        case 'Nov':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] =  (float)$openconsumption['consumption'][$i] + ($mwhvalue);
                            break;
                        case 'Dec':
                            $openconsumption['consumption'][$i] == 0 ? $openconsumption['consumption'][$i] = 0 : $openconsumption['consumption'][$i] =  (float)$openconsumption['consumption'][$i] + ($mwhvalue);
                            break;
                    }
                } else {

                    $openconsumption['consumption'][$i] =  $openconsumption['consumption'][$i];
                }
            }

            $hedged = array();
            $hedgedval = array();

            for ($i = 0; $i < count($hedgedconsumption['consumption']); $i++) {

                $hedged[] = ($hedgedconsumption['month'][$i] . '-' . $hedgedconsumption['year'][$i] . '-' . $hedgedconsumption['consumption'][$i]);
            }

            $hedgedval = implode('|', $hedged);

            // Open

            $open = array();
            $openval = array();

            for ($i = 0; $i < count($openconsumption['consumption']); $i++) {

                $open[] = ($openconsumption['month'][$i] . '-' . $openconsumption['year'][$i] . '-' . $openconsumption['consumption'][$i]);
            }

            $openval = implode('|', $open);

            // Update query
            $updateconsumption = "UPDATE nus_supply_contract SET hedgeconsumption ='" . $hedgedval . "', openconsumption ='" . $openval . "' WHERE supplierId=" . $supplyId . "";
            $conn->query($updateconsumption);
        }
    }

    //mw  

    else {

        $sqlclicks = "SELECT * FROM nus_tradeperiods WHERE tradePerId = '" . $tradeid . "';";
        $resultclicks =  mysqli_query($conn, $sqlclicks);
        $rows = mysqli_fetch_assoc($resultclicks);
        $clicktracnches = $rows['clicktracnches'];

        // Checking the How many used clicks
        $sql = "SELECT * FROM nus_calendermonth WHERE monthId  = '" . $nustradeid . "' AND year = '" . $year . "';";
        $result =  mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $clicks = $row['clicks'];
        $clickscount =  $clicks + 1;

        if ($clicktracnches == $clicks) {

            echo "<script>
                    alert('Limit of the Trade clicks has already been reached; canceling is not possible.'); 
                   window.history.go(-2); 
                </script>";
        } else {

            $sqlupdate = "UPDATE nus_calendermonth nc, enter_trade e 
                                SET nc.clicks ='" . $clickscount . "', e.tradeexecuted = '" . $state . "'
                                WHERE nc.monthId  = '" . $nustradeid . "' AND e.nustradeId = '" . $nustradeid . "' 
                                AND e.tradeId = '" . $id . "' AND e.tradevolume = '" . $tradevolume . "';";

            $conn->query($sqlupdate);
        }
    }
}

// Calendar month end

//inserting the details of the user 

$sqlinsert = "INSERT INTO nus_tradeexecuted_state (trade_id, state, user, datevalue, description)
                    VALUES('" . $id . "', '" . $state . "', '" . $user . "', '" . $date . "','" . $description . "')";

$conn->query($sqlinsert);

// echo "<pre>";
// print_r($hedgedval);

echo "<script>
                alert('Trade has been Cancelled successfully !'); 
               window.history.go(-2);
            </script>";

// end 

?>