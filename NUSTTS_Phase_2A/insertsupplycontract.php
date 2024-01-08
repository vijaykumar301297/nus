<?php

include "dbconn.php";
// print_r($conn);
// echo "<pre>";
// echo 'First Line';
// echo "<pre>";
// echo $_POST['hedge'];
// die();
// exit();
// echo numberreturn($_POST['commodityprice']);

error_reporting(E_ERROR | E_PARSE);

function numberreturn($value)
{
    $toremovecomma = floatval(preg_replace('/[^\d. ]/', '', $value));
    return $toremovecomma;
}

include "includes/functions.php";
session_start();
// error_reporting(E_ERROR | E_PARSE);
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if ($_GET['type'] == 'adding') {

    if ($_POST['contType'] == 'fixed') {

        $commodityName = '';
        $unit = '';
        foreach ($_POST['commodity'] as $value) {
            $commodityName = $value;
            if ($commodityName == 'natural gas') {
                foreach ($_POST['units'] as $values) {
                    $unit = $values;
                }
            }
        }
        $contracttype = '';
        $contrindex = '';
        foreach ($_POST['contacttype'] as $value) {
            $contracttype = $value;
            if ($contracttype == 'indexed') {
                $contrindex = $_POST['indexed'];
            }
        }

        $startDate = date('Y-m-d', strtotime($_POST['startDate1']));
        $endDate = date('Y-m-d', strtotime($_POST['endDate1']));

        if ($_POST['commodityprice'] == '') {
            $_POST['commodityprice'] = 0;
        }

        $sql = "INSERT INTO nus_supply_contract (parentId, clientId,  commodityName, countryName, commodityUnits, supplyName, contractType, contractIndexId, contractTermfromDate, contractTermtoDate, commodityPrice, totalAnualConsumption, totlconsumption, allmonts, contractpricetype, consumptionmonth,hedgeconsumption) VALUES ('" . $_POST['parent'] . "','" . $_POST['client'] . "', '" . $commodityName . "','" . $_POST['country'] . "' ,'" . $unit . "','" . $_POST['supplr'] . "' ,'" . $contracttype . "', '" . $contrindex . "', '" . $startDate . "', '" . $endDate . "', '" . numberreturn($_POST['commodityprice']) . "', '" . $_POST['totalanualconsumption'] . "', '" . $_POST['totlcnsumtion'] . "', '" . $_POST['allmonths'] . "', '" . $_POST['contractprice'] . "', '" . $_POST['allmonthsdata'] . "', '" . $_POST['hedge'] . "')";

        //echo "SQL Query = ".$sql;
        mysqli_query($conn, $sql);
        // BELOW line Last_id  will work for godaddy 08-June-23
        $last_id = mysqli_insert_id($conn);

        // echo $lastid;
        //$last_id = mysqli_insert_id($sql);//$conn->insert_id; -- *azure CODE BELOW THREE LINE 08-jUNE-23*
        $sqlQueries1 = "SELECT * FROM nus_supply_contract;";
        $resultQueries1 = mysqli_query($conn, $sqlQueries1);
        $rowCountQueries1 = mysqli_num_rows($resultQueries1);

        //echo "Last=".$rowCountQueries1;

        // $last_id = $rowCountQueries1;
        // echo $last_id;
        $functions = new libFunc();
        //echo "<pre>";
        //echo "clientid=".$_POST['client'];
        $getserialno = $functions->getlastserialno($_POST['client']);

        // echo $_POST['client'];
        // echo $getserialno;
        $incserialno = $getserialno + 1;
        //echo "serialinc=".$incserialno;
        $serialno = '';
        if (in_array($incserialno, range(1, 9))) {
            $serialno = '0000' . $incserialno;
        } elseif (in_array($incserialno, range(10, 99))) {
            $serialno = '000' . $incserialno;
        } elseif (in_array($incserialno, range(100, 999))) {
            $serialno = '00' . $incserialno;
        } elseif (in_array($incserialno, range(1000, 9999))) {
            $serialno = '0' . $incserialno;
        } else {
            $serialno = $incserialno;
        }
        //echo "Serial".$serialno;
        $autcm = ($commodityName == 'natural gas') ? 'Gas' : 'Elec';
        $getclientname = explode(' ', $_POST['clientname']);


        $autoId = $getclientname[0] . '-' . $autcm . '-' . $serialno;
        //  echo $autoId;
        $sqls = "UPDATE nus_supply_contract SET `contract_id`='" . $autoId . "' WHERE supplierId =" . $last_id . "";
        $conn->query($sqls);
        $sqlincAutoupdate = "UPDATE clientcompanydata SET serialno='" . $incserialno . "' WHERE id =" . $_POST['client'] . "";
        $conn->query($sqlincAutoupdate);
    } else {
        $commodityName = '';
        $unit = '';
        foreach ($_POST['commodity'] as $value) {
            $commodityName = $value;
            if ($commodityName == 'natural gas') {
                foreach ($_POST['units'] as $values) {
                    $unit = $values;
                }
            }
        }
        $contracttype = '';
        $contrindex = '';
        foreach ($_POST['contacttype'] as $value) {
            $contracttype = $value;
            if ($contracttype == 'indexed') {
                $contrindex = $_POST['indexed'];
            }
        }
        $indexstru = '';
        foreach ($_POST['indexstr'] as $value) {
            $indexstru = $value;
        }
        $startDate = date('Y-m-d', strtotime($_POST['startDate1']));
        $endDate = date('Y-m-d', strtotime($_POST['endDate1']));
        if ($_POST['commodityprice'] == '') {
            $_POST['commodityprice'] = 0;
        }
        $sql = "INSERT INTO nus_supply_contract (parentId, clientId, commodityName, countryName, commodityUnits, supplyName, contractType, contractIndexId, contractTermfromDate, contractTermtoDate, commodityPrice, totalAnualConsumption, indexStructureType, openPrizemechanism, totlconsumption, allmonts, contractpricetype, consumptionmonth,hedgeconsumption,basegenconsumption,effectcon) VALUES ('" . $_POST['parent'] . "', '" . $_POST['client'] . "', '" . $commodityName . "','" . $_POST['country'] . "' ,'" . $unit . "','" . $_POST['supplr'] . "' ,'" . $contracttype . "', '" . $contrindex . "', '" . $startDate . "', '" . $endDate . "', '" . numberreturn($_POST['commodityprice']) . "', '" . $_POST['totalanualconsumption'] . "', '" . $indexstru . "', '" . $_POST['openmech'] . "', '" . $_POST['totlcnsumtion'] . "', '" . $_POST['allmonths'] . "', '" . $_POST['contractprice'] . "', '" . $_POST['allmonthsdata'] . "', '" . $_POST['hedge'] . "','" . $_POST['hedge'] . "', '" . $_POST['hedge'] . "')";
        //$conn->query($sql);

        mysqli_query($conn, $sql);
        $last_id = mysqli_insert_id($conn);

        //echo "SQL Query = ".$sql;
        //echo "<pre>";
        //echo "sql".$sql;
        //print_r($sql);

        $sqlQueries1 = "SELECT * FROM nus_supply_contract;";
        $resultQueries1 = mysqli_query($conn, $sqlQueries1);
        $rowCountQueries1 = mysqli_num_rows($resultQueries1);

        //echo "<pre>";
        //echo "NUMBER OF ROWS = ".$rowCountQueries1;



        //$last_id = $conn->insert_id; //changed on 27 March 2023
        // $last_id = $rowCountQueries1;
        $functions = new libFunc();
        $getserialno = $functions->getlastserialno($_POST['client']);
        //echo "<pre>";
        //echo "Last".$last_id;
        $incserialno = $getserialno + 1;
        $serialno = '';
        if (in_array($incserialno, range(1, 9))) {
            $serialno = '0000' . $incserialno;
        } elseif (in_array($incserialno, range(10, 99))) {
            $serialno = '000' . $incserialno;
        } elseif (in_array($incserialno, range(100, 999))) {
            $serialno = '00' . $incserialno;
        } elseif (in_array($incserialno, range(1000, 9999))) {
            $serialno = '0' . $incserialno;
        } else {
            $serialno = $incserialno;
        }
        // echo "Serial".$serialno;
        $autcm = ($commodityName == 'natural gas') ? 'Gas' : 'Elec';
        $getclientname = explode(' ', $_POST['clientname']);

        $autoId = $getclientname[0] . '-' . $autcm . '-' . $serialno;
        $sqls = "UPDATE nus_supply_contract SET contract_id='" . $autoId . "' WHERE supplierId =" . $last_id . "";
        //echo "<pre>";
        //echo $sqls;

        $conn->query($sqls);
        $sqlincAutoupdate = "UPDATE clientcompanydata SET serialno='" . $incserialno . "' WHERE id =" . $_POST['client'] . "";
        $conn->query($sqlincAutoupdate);
        for ($i = 1; $i < $_POST['rowcount']; $i++) {
            if (isset($_POST['tradsel' . $i]) && $_POST['tradsel' . $i] != '') {

                if (empty($_POST['minsize' . $i])) {
                    $sql = "INSERT INTO nus_tradeperiods (supplierId, periodsId, clicktracnches, clicktranches) VALUES ('" . $last_id . "', '" . $_POST['tradsel' . $i] . "', '" . $_POST['tranche' . $i] . "', '')";
                } else {
                    $sql = "INSERT INTO nus_tradeperiods (supplierId, periodsId, clicktracnches, clicktranches) VALUES ('" . $last_id . "', '" . $_POST['tradsel' . $i] . "', '" . $_POST['tranche' . $i] . "', '" . $_POST['minsize' . $i] . "')";
                }
                $conn->query($sql);
                $last_trade_id = $conn->insert_id;
                $allmonts = explode(',', $_POST['allmonths']);
                //echo "<pre>";
                //print_r($allmonts);
                $firstdate = array();
                $lastdate = array();
                $yearcount = count($allmonts) / 12;
                $yearremaining = count($allmonts) % 12;
                $yearrmai = array();
                $year = 1;
                for ($k = 0; $k < ($yearcount * 12); $k++) {
                    if ($k % 12 == 0) {
                        $firstdate[] = $allmonts[$k];
                        if ($k != 0) {
                            $year = $year + 1;
                        }
                    }
                    if (((12 * $year) - $k) == 1) {
                        $lastdate[] = $allmonts[$k];
                    }
                }

                if ($_POST['tradsel' . $i] == 'Calendar Yearly') {
                    $periodtime =  array();
                    //echo "<pre>";
                    // print_r($periodtime);
                    $years1 = array();
                    $years = array();

                    $countArray = count($allmonts);
                    //echo $countArray;

                    $startDate = $allmonts[0];
                    //echo $startDate;
                    $endDate = $allmonts[$countArray - 1];
                    //echo $endDate;

                    $yearFirst = explode("-", $startDate);
                    // echo $yearFirst[0];
                    array_push($years1, $yearFirst[0]);
                    $yearEnd = explode("-", $endDate);
                    // echo $yearEnd[0];

                    $resYear = $yearEnd[0] - $yearFirst[0];
                    if ($resYear >= 1) {
                        $incrementYear = $yearFirst[0];
                        for ($ii = 0; $ii < $resYear; $ii++) {
                            $incrementYear =  $incrementYear + 1;
                            // echo $incrementYear;
                            if ($incrementYear <= $yearEnd[0]) {
                                array_push($years1, $incrementYear);
                            } else {
                                break;
                            }
                        }
                    }

                    //print_r($years1);

                    $timeperiod = array();
                    $checkyeAR;

                    for ($jj = 0; $jj < count($years1); $jj++) {
                        $count = 0;
                        $flag = 0;
                        for ($ice = 0; $ice < count($allmonts); $ice++) {
                            // echo $array1[$i];
                            $tookValue = explode("-", $allmonts[$ice]);
                            if ($tookValue[0] == $years1[$jj]) {
                                $checkyeAR = $years1[$jj];
                                $count++;
                            } else {
                            }
                        }
                        if ($count == 12) {
                            array_push($years, $checkyeAR);
                            $firstDates = $checkyeAR . "-1-01";
                            $lastDates = $checkyeAR . "-12-01";
                            $finalDate = $firstDates . "," . $lastDates;
                            array_push($timeperiod, $finalDate);
                            // array_push($timeperiod,$lastDate);
                        }
                    }

                    //print_r($timeperiod);


                    // print_r($lastdate); imp
                    // for($j=0;$j<count($lastdate);$j++){
                    //     $periodtime[] = $firstdate[$j].','.$lastdate[$j];
                    //     $val = explode('-', $lastdate[$j]);
                    //     $years[] = $val[0];
                    // }

                    //print_r($years);
                    // print_r($years1);

                    //echo $_POST['tranche1'];
                    // echo $_POST['tranche'];

                    foreach ($years as $key => $value) {
                        $getindex = array_search($value, $years);
                        $sqlinsert = "INSERT INTO nus_calenderyear (calenderyear, clicks, tradeId, supplierid, timeperiod) VALUES 
                        ('" . $value . "',  '" . $_POST['tranche' . $i] . "', '" . $last_trade_id . "', '" . $last_id . "', '" . $timeperiod[$getindex] . "')";
                        $conn->query($sqlinsert);
                    }
                }
                if ($_POST['tradsel' . $i] == 'Calendar Quarterly') {
                    $q1 = ['Jan', 'Feb', 'Mar'];
                    $q2 = ['Apr', 'May', 'Jun'];
                    $q3 = ['July', 'Aug', 'Sep'];
                    $q4 = ['Oct', 'Nov', 'Dec'];

                    $allmonths = array();
                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    $yearsTrade = array();
                    foreach ($allmonts as $key => $values) {
                        $monthsexp = explode('-', $values);
                        $allmonths[] = $months[$monthsexp[1] - 1] . '-' . $monthsexp[0];
                        $yearsTrade[] = $monthsexp[0];
                    }
                    $yars = array_unique($yearsTrade);
                    $q1quat = array();
                    $q2quat = array();
                    $q3quat = array();
                    $q4quat = array();
                    //print_r($yars);
                    foreach ($yars as $key => $yrvalue) {

                        foreach ($allmonths as $key => $mtvalue) {
                            $montva = explode('-', $mtvalue);


                            if (in_array($montva[0], $q1) && $montva[1] == $yrvalue) {
                                array_push($q1quat, $mtvalue);
                            } else if (in_array($montva[0], $q2) && $montva[1] == $yrvalue) {

                                array_push($q2quat, $mtvalue);
                            } else if (in_array($montva[0], $q3) && $montva[1] == $yrvalue) {

                                array_push($q3quat, $mtvalue);
                            } else if (in_array($montva[0], $q4) && $montva[1] == $yrvalue) {

                                array_push($q4quat, $mtvalue);
                            }
                        }

                        if (count($q1quat) != 0) {
                            $qtr = 'q1';
                            $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) VALUES ('" . $qtr . "',  '" . $_POST['tranche' . $i] . "', '" . $last_trade_id . "', '" . $last_id . "', '" . $yrvalue . "')";
                            $conn->query($sqlinsert);
                        }
                        if (count($q2quat) != 0) {

                            $qtr = 'q2';
                            $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) VALUES ('" . $qtr . "',  '" . $_POST['tranche' . $i] . "', '" . $last_trade_id . "', '" . $last_id . "', '" . $yrvalue . "')";
                            $conn->query($sqlinsert);
                        }
                        if (count($q3quat) != 0) {

                            $qtr = 'q3';
                            $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) VALUES ('" . $qtr . "',  '" . $_POST['tranche' . $i] . "', '" . $last_trade_id . "', '" . $last_id . "', '" . $yrvalue . "')";
                            $conn->query($sqlinsert);
                        }
                        if (count($q4quat) != 0) {

                            $qtr = 'q4';
                            $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) VALUES ('" . $qtr . "',  '" . $_POST['tranche' . $i] . "', '" . $last_trade_id . "', '" . $last_id . "', '" . $yrvalue . "')";
                            $conn->query($sqlinsert);
                        }
                        array_splice($q1quat, 0);
                        array_splice($q2quat, 0);
                        array_splice($q3quat, 0);
                        array_splice($q4quat, 0);
                    }
                }
                if ($_POST['tradsel' . $i] == 'Calendar Monthly') {
                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    $allmonths = array();
                    $yearsTrade = array();
                    foreach ($allmonts as $key => $values) {
                        $monthsexp = explode('-', $values);
                        $allmonths[] = $months[$monthsexp[1] - 1] . '-' . $monthsexp[0];
                        $yearsTrade[] = $monthsexp[0];
                    }
                    $yars = array_unique($yearsTrade);
                    foreach ($yars as $key => $yarsvalue) {
                        foreach ($allmonths as $key => $mtvalue) {
                            $montva = explode('-', $mtvalue);
                            if ($montva[1] == $yarsvalue) {
                                $sqlinsert = "INSERT INTO nus_calendermonth (month, clicks, TradeId, supplierId, year) VALUES ('" . $montva[0] . "',  '" . $_POST['tranche' . $i] . "', '" . $last_trade_id . "', '" . $last_id . "', '" . $montva[1] . "')";
                                $conn->query($sqlinsert);
                            }
                        }
                    }
                }
                if ($_POST['tradsel' . $i] == 'Season') {
                    $q1 = ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
                    $q8 = ['Apr', 'May', 'Jun', 'July', 'Aug', 'Sep'];


                    $allmonths = array();
                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    $yearsTrade = array();
                    foreach ($allmonts as $key => $values) {
                        $monthsexp = explode('-', $values);
                        $allmonths[] = $months[$monthsexp[1] - 1] . '-' . $monthsexp[0];
                        $yearsTrade[] = $monthsexp[0];
                    }
                    $years = array();
                    foreach ($allmonths as $key => $mtvalue) {
                        $montyear = explode('-', $mtvalue);
                        // echo  $montyear[0];
                        // echo $montyear;

                        if ($montyear[0] == 'Jan' && in_array($montyear[1], $yearsTrade)) {
                            // echo 'jo';
                            $years[] = $montyear[1];
                        }
                        if ($montyear[0] == 'May' && in_array($montyear[1], $yearsTrade)) {
                            $years[] = $montyear[1];
                        }
                    }

                    $yars = array_unique($years);
                    $q1quat = array();
                    $q2quat = array();

                    // print_r($yars);
                    foreach ($yars as $key => $value) {
                        foreach ($allmonths as $key => $mtvalue) {
                            $montva = explode('-', $mtvalue);


                            if (in_array($montva[0], $q1) && $value == $montva[1]) {
                                array_push($q1quat, $mtvalue);
                            } else if (in_array($montva[0], $q8) && $value == $montva[1]) {

                                array_push($q2quat, $mtvalue);
                            }
                        }

                        if (count($q1quat) != 0) {
                            $qtr = 'oct-mar';
                            $sqlinsert = "INSERT INTO nus_season (season, clicks, tradeId, supplierId, yeartrade) VALUES ('" . $qtr . "',  '" . $_POST['tranche' . $i] . "', '" . $last_trade_id . "', '" . $last_id . "', '" . $value . "')";
                            $conn->query($sqlinsert);
                        }
                        if (count($q2quat) != 0) {
                            $qtr = 'apr-sep';
                            $sqlinsert = "INSERT INTO nus_season (season, clicks, tradeId, supplierId, yeartrade) VALUES ('" . $qtr . "',  '" . $_POST['tranche' . $i] . "', '" . $last_trade_id . "', '" . $last_id . "', '" . $value . "')";
                            $conn->query($sqlinsert);
                        }
                        //print_r($q1quat);
                        //print_r($q2quat);
                        array_splice($q1quat, 0);
                        array_splice($q2quat, 0);
                    }
                }
            }
        }
    }
    $_SESSION['created'] = time();
    header("location:addsupplycontract.php");
} else {

    $nusTradeperiod = array(
        'type' => array(),
        'oldClick' => array()
    ); //added the above array for global call on number of clicks replacement after editing for nus_trade period

    $nuscalYear = array(
        'year' => array(),
        'clicks' => array()
    ); //added the above array for global call on number of clicks replacement after editing for nus_calenderyear


    $nuscalQuarter = array(
        'year' => array(),
        'quarters' => array(),
        'clicks' => array()
    ); //added the above array for global call on number of clicks replacement after editing for nus_calenderquarter

    $nuscalMonth = array(
        'year' => array(),
        'month' => array(),
        'clicks' => array()
    ); //added the above array for global call on number of clicks replacement after editing for nus_calendermonth

    if ($_POST['contType'] == 'fixed') {
        $commodityName = '';
        $unit = '';
        foreach ($_POST['commodity'] as $value) {
            $commodityName = $value;
            if ($commodityName == 'natural gas') {
                foreach ($_POST['units'] as $values) {
                    $unit = $values;
                }
            }
        }
        $contracttype = '';
        $contrindex = '';
        foreach ($_POST['contacttype'] as $value) {
            $contracttype = $value;
            if ($contracttype == 'indexed') {
                $contrindex = $_POST['indexed'];
            }
        }
        // if($_POST['indexstr'] == '') {
        //     $indexstru = '';
        // } else {
        //     $indexstru = '';
        //     foreach($_POST['indexstr'] as $value){
        //         $indexstru =$value;
        //     }
        // }

        $startDate = date('Y-m-d', strtotime($_POST['startDate1']));
        $endDate = date('Y-m-d', strtotime($_POST['endDate1']));
        $getcountofclick = "SELECT contract_id FROM nus_supply_contract WHERE supplierId=" . $_GET['id'] . "";
        $result = $conn->query($getcountofclick);
        $contractId = '';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $contractId =  $row['contract_id'];
            }
        }
        // echo "<pre>";
        // echo "Invfovalue = ".$_POST['infovalue'];
        // echo "<pre>";
        // echo "CLient Value = ".$_POST['client'];

        if ($_POST['infovalue'] != $_POST['client']) {

            $contser = explode('-', $contractId);

            $autcm = ($commodityName == 'natural gas') ? 'Gas' : 'Elec';
            $getclientname = explode(' ', $_POST['clientname']);

            $autoId = $getclientname[0] . '-' . $autcm . '-';
        } else {
            $autoId = $contractId;
        }



        //type here to get the client contract ID details for Moving contracts

        $sqlQueryClient = "SELECT * FROM nus_supply_contract WHERE clientId='" . $_POST['client'] . "'";
        $resQueryClient = mysqli_query($conn, $sqlQueryClient);
        $rowCountClient = mysqli_num_rows($resQueryClient);

        if ($rowCountClient == 0) {
            $sqlUpdateClientData = "UPDATE clientcompanydata SET serialno = 0 WHERE id='" . $_POST['client'] . "';";
            $conn->query($sqlUpdateClientData);

            $functions = new libFunc();
            $getserialno = $functions->getlastserialno($_POST['client']);

            $incserialno = $getserialno + 1;
            $serialno = '';
            if (in_array($incserialno, range(1, 9))) {
                $serialno = '0000' . $incserialno;
            } elseif (in_array($incserialno, range(10, 99))) {
                $serialno = '000' . $incserialno;
            } elseif (in_array($incserialno, range(100, 999))) {
                $serialno = '00' . $incserialno;
            } elseif (in_array($incserialno, range(1000, 9999))) {
                $serialno = '0' . $incserialno;
            } else {
                $serialno = $incserialno;
            }
            $autoId = $autoId . $serialno;
            $res = $getserialno + 1;
            // echo "<pre>";
            // echo $res;
            // echo "</pre>";
            $updateQuery = "UPDATE clientcompanydata SET serialno = $res WHERE id='" . $_POST['client'] . "';";
            $conn->query($updateQuery);
        } else {
            if ($_POST['infovalue'] != $_POST['client']) {

            $functions = new libFunc();
            $getserialno = $functions->getlastserialno($_POST['client']);

            $incserialno = $getserialno + 1;
            $serialno = '';
            if (in_array($incserialno, range(1, 9))) {
                $serialno = '0000' . $incserialno;
            } elseif (in_array($incserialno, range(10, 99))) {
                $serialno = '000' . $incserialno;
            } elseif (in_array($incserialno, range(100, 999))) {
                $serialno = '00' . $incserialno;
            } elseif (in_array($incserialno, range(1000, 9999))) {
                $serialno = '0' . $incserialno;
            } else {
                $serialno = $incserialno;
            }
            $autoId = $autoId . $serialno;
            $res = $getserialno + 1;
            // echo "<pre>";
            // echo $res;
            // echo "</pre>";
            $updateQuery = "UPDATE clientcompanydata SET serialno = $res WHERE id='" . $_POST['client'] . "';";
            $conn->query($updateQuery);
        }
        }

        $sqlupdate = "UPDATE nus_supply_contract SET contract_id='" . $autoId . "',parentId='" . $_POST['parent'] . "',clientId='" . $_POST['client'] . "', commodityName='" . $commodityName . "', countryName='" . $_POST['country'] . "', commodityUnits='" . $unit . "', supplyName='" . $_POST['supplr'] . "', contractType='" . $contracttype . "', contractIndexId='" . $contrindex . "', contractTermfromDate='" . $startDate . "', contractTermtoDate='" . $endDate . "', commodityPrice='" . numberreturn($_POST['commodityprice']) . "', totalAnualConsumption='" . $_POST['totalanualconsumption'] . "', indexStructureType='',  openPrizemechanism='',totlconsumption='" . $_POST['totlcnsumtion'] . "',allmonts='" . $_POST['allmonths'] . "', contractpricetype='" . $_POST['contractprice'] . "',consumptionmonth='" . $_POST['allmonthsdata'] . "', hedgeconsumption ='" . $_POST['hedge'] . "' WHERE supplierId = " . $_GET['id'] . "";
        $conn->query($sqlupdate);

        //after updating if particular client company is empty then below code will be executed

        $select = "SELECT * FROM nus_supply_contract WHERE clientId = '" . $_POST['infovalue'] . "';";
        $resQuerySelect = mysqli_query($conn, $select);
        $rowCountSelect = mysqli_num_rows($resQuerySelect);

        if ($rowCountSelect === 0) {
            $updateQuery = "UPDATE clientcompanydata SET serialno = 0 WHERE id='" . $_POST['infovalue'] . "';";
            $conn->query($updateQuery);
        }
    } else {

        $commodityName = '';
        $unit = '';
        foreach ($_POST['commodity'] as $value) {
            $commodityName = $value;
            if ($commodityName == 'natural gas') {
                foreach ($_POST['units'] as $values) {
                    $unit = $values;
                }
            }
        }
        $contracttype = '';
        $contrindex = '';
        foreach ($_POST['contacttype'] as $value) {
            $contracttype = $value;
            if ($contracttype == 'indexed') {
                $contrindex = $_POST['indexed'];
            }
        }
        $indexstru = '';
        foreach ($_POST['indexstr'] as $value) {
            $indexstru = $value;
        }
        $startDate = date('Y-m-d', strtotime($_POST['startDate1']));
        $endDate = date('Y-m-d', strtotime($_POST['endDate1']));
        $getcountofclick = "SELECT contract_id FROM nus_supply_contract WHERE supplierId=" . $_GET['id'] . "";
        $result = $conn->query($getcountofclick);
        $contractId = '';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $contractId =  $row['contract_id'];
            }
        }

        // echo "<pre>";
        // echo "Invfovalue = ".$_POST['infovalue'];
        // echo "<pre>";
        // echo "CLient Value = ".$_POST['client'];

        if ($_POST['infovalue'] != $_POST['client']) {

            $contser = explode('-', $contractId);

            $autcm = ($commodityName == 'natural gas') ? 'Gas' : 'Elec';
            $getclientname = explode(' ', $_POST['clientname']);

            $autoId = $getclientname[0] . '-' . $autcm . '-';
        } else {
            $autoId = $contractId;
        }


        //type here to get the client contract ID details

        $sqlQueryClient = "SELECT * FROM nus_supply_contract WHERE clientId='" . $_POST['client'] . "'";
        $resQueryClient = mysqli_query($conn, $sqlQueryClient);
        $rowCountClient = mysqli_num_rows($resQueryClient);

        if ($rowCountClient == 0) {
            $sqlUpdateClientData = "UPDATE clientcompanydata SET serialno = 0 WHERE id='" . $_POST['client'] . "';";
            $conn->query($sqlUpdateClientData);

            $functions = new libFunc();
            $getserialno = $functions->getlastserialno($_POST['client']);

            $incserialno = $getserialno + 1;
            $serialno = '';
            if (in_array($incserialno, range(1, 9))) {
                $serialno = '0000' . $incserialno;
            } elseif (in_array($incserialno, range(10, 99))) {
                $serialno = '000' . $incserialno;
            } elseif (in_array($incserialno, range(100, 999))) {
                $serialno = '00' . $incserialno;
            } elseif (in_array($incserialno, range(1000, 9999))) {
                $serialno = '0' . $incserialno;
            } else {
                $serialno = $incserialno;
            }
            $autoId = $autoId . $serialno;
            $res = $getserialno + 1;
            // echo "<pre>";
            // echo $res;
            // echo "</pre>";
            $updateQuery = "UPDATE clientcompanydata SET serialno = $res WHERE id='" . $_POST['client'] . "';";
            $conn->query($updateQuery);
        } else {
            if ($_POST['infovalue'] != $_POST['client']) {

            $functions = new libFunc();
            $getserialno = $functions->getlastserialno($_POST['client']);

            $incserialno = $getserialno + 1;
            $serialno = '';
            if (in_array($incserialno, range(1, 9))) {
                $serialno = '0000' . $incserialno;
            } elseif (in_array($incserialno, range(10, 99))) {
                $serialno = '000' . $incserialno;
            } elseif (in_array($incserialno, range(100, 999))) {
                $serialno = '00' . $incserialno;
            } elseif (in_array($incserialno, range(1000, 9999))) {
                $serialno = '0' . $incserialno;
            } else {
                $serialno = $incserialno;
            }
            $autoId = $autoId . $serialno;
            $res = $getserialno + 1;
            // echo "<pre>";
            // echo $res;
            // echo "</pre>";
            $updateQuery = "UPDATE clientcompanydata SET serialno = $res WHERE id='" . $_POST['client'] . "';";
            $conn->query($updateQuery);
        }
        }

        $sqlupdate = "UPDATE nus_supply_contract SET contract_id='" . $autoId . "',parentId='" . $_POST['parent'] . "',clientId='" . $_POST['client'] . "', commodityName='" . $commodityName . "', countryName='" . $_POST['country'] . "', commodityUnits='" . $unit . "', supplyName='" . $_POST['supplr'] . "', contractType='" . $contracttype . "', contractIndexId='" . $contrindex . "', contractTermfromDate='" . $startDate . "', contractTermtoDate='" . $endDate . "', commodityPrice='" . numberreturn($_POST['commodityprice']) . "', totalAnualConsumption='" . $_POST['totalanualconsumption'] . "', indexStructureType='" . $indexstru . "',  openPrizemechanism='" . $_POST['openmech'] . "',totlconsumption='" . $_POST['totlcnsumtion'] . "',allmonts='" . $_POST['allmonths'] . "', contractpricetype='" . $_POST['contractprice'] . "',consumptionmonth='" . $_POST['allmonthsdata'] . "', hedgeconsumption ='" . $_POST['hedge'] . "' WHERE supplierId = " . $_GET['id'] . "";
        $conn->query($sqlupdate);

        // echo "Info = ".$_POST['infovalue'];
        // echo "Client = ".$_POST['client'];

        if($_POST['infovalue'] != $_POST['client']) {
            $sqlEnterTrade = "SELECT * FROM enter_trade WHERE clientId = " . $_POST['infovalue'] . " AND supplycontractid = '".$contractId."';";
            // echo $sqlEnterTrade;
            $resET = mysqli_query($conn,$sqlEnterTrade);
            // echo "<pre>";
            // print_r($resET);
            $num_rows = mysqli_num_rows($resET);

            // echo "Num rows = ".$num_rows;
            // echo "autoId = ".$autoId;

            if($num_rows >= 1) {
                $updateEntertrade = "UPDATE enter_trade SET clientId = ".$_POST['client'].", supplycontractid = '".$autoId."' WHERE clientId=".$_POST['infovalue']." AND supplycontractid = '".$contractId."';";
                // echo "updateQuery = ".$updateEntertrade;
                $conn->query($updateEntertrade);
            }
        }

        $select = "SELECT * FROM nus_supply_contract WHERE clientId = '" . $_POST['infovalue'] . "';";
        // echo $select;
        $resQuerySelect = mysqli_query($conn, $select);
        $rowCountSelect = mysqli_num_rows($resQuerySelect);

        if ($rowCountSelect === 0) {
            $updateQuery = "UPDATE clientcompanydata SET serialno = 0 WHERE id='" . $_POST['infovalue'] . "';";
            $conn->query($updateQuery);
        }


        // starting to comment since it'll get deleted from " nus_calenderquarter "

        //Select query for nus_TradePeriods to collect year details and clicks details

        $selnusTrade = "SELECT * FROM nus_tradeperiods WHERE supplierId=" . $_GET['id'] . "";
        $resselTrade = mysqli_query($conn, $selnusTrade);
        while ($rowselTrade = mysqli_fetch_assoc($resselTrade)) {
            array_push($nusTradeperiod['type'], $rowselTrade['periodsId']);
            array_push($nusTradeperiod['oldClick'], $rowselTrade['clicktracnches']);
        }

        // echo "<pre>";
        // print_r($nusTradeperiod);

        //calculation for incrementing the number of clciks

        $mathsResYear = 0;
        $mathsResQuarter = 0;
        $mathsResMonth = 0;
        // echo count($nusTradeperiod['type']);
        for ($ti = 0; $ti < count($nusTradeperiod['type']); $ti++) {
            // echo $ti;

            if ($nusTradeperiod['oldClick'][$ti] == $_POST['tranche' . $ti + 1]) {
                // echo $nusTradeperiod['type'][$ti];
            } else {
                // echo $nusTradeperiod['type'][$ti];
                if ($nusTradeperiod['type'][$ti] == 'Calendar Yearly') {
                    $mathsResYear = $_POST['tranche' . $ti + 1] - $nusTradeperiod['oldClick'][$ti]; //calcuate clicks for the calendar year
                    // echo "MathsResYear: $mathsResYear";
                } else if ($nusTradeperiod['type'][$ti] == 'Calendar Monthly') {
                    $mathsResMonth = $_POST['tranche' . $ti + 1] - $nusTradeperiod['oldClick'][$ti]; //calcuate clicks for the calendar Month
                    // echo "MathsResMonth: " . $mathsResMonth;
                } else if ($nusTradeperiod['type'][$ti] == 'Calendar Quarterly') {
                    $mathsResQuarter = $_POST['tranche' . $ti + 1] - $nusTradeperiod['oldClick'][$ti]; //calcuate clicks for the calendar Quarter
                    // echo "Maths quarter:".$mathsResQuarter;
                }
            }
        }

        $delsql = "DELETE FROM nus_tradeperiods WHERE supplierId=" . $_GET['id'] . "";
        $conn->query($delsql);

        //Select query for nus_calenderyear to collect year details and clicks details
        $selnusCal = "SELECT * FROM nus_calenderyear WHERE supplierid=" . $_GET['id'] . "";
        $resselCal = mysqli_query($conn, $selnusCal);
        while ($rowselCal = mysqli_fetch_assoc($resselCal)) {
            array_push($nuscalYear['year'], $rowselCal['calenderyear']);
            array_push($nuscalYear['clicks'], $rowselCal['clicks']);
        }

        $calsql = "DELETE FROM nus_calenderyear WHERE supplierid=" . $_GET['id'] . "";
        $conn->query($calsql);

        //Select query for nus_calenderquarter to collect year details, quarter details and clicks details
        $selnusCalQuarter = "SELECT * FROM nus_calenderquarter WHERE supplierId=" . $_GET['id'] . "";
        $resselCalQuarter = mysqli_query($conn, $selnusCalQuarter);
        while ($rowselCalQuarter = mysqli_fetch_assoc($resselCalQuarter)) {
            array_push($nuscalQuarter['year'], $rowselCalQuarter['yearoftrade']);
            array_push($nuscalQuarter['quarters'], $rowselCalQuarter['quarters']);
            array_push($nuscalQuarter['clicks'], $rowselCalQuarter['clicks']);
        }

        $quartsql = "DELETE FROM nus_calenderquarter WHERE supplierid=" . $_GET['id'] . "";
        $conn->query($quartsql);

        //Select query for nus_calenderquarter to collect year details, month details and clicks details
        $selnusCalMonth = "SELECT * FROM nus_calendermonth WHERE supplierId=" . $_GET['id'] . "";
        $resselCalMonth = mysqli_query($conn, $selnusCalMonth);
        while ($rowselCalMonth = mysqli_fetch_assoc($resselCalMonth)) {
            array_push($nuscalMonth['year'], $rowselCalMonth['year']);
            array_push($nuscalMonth['month'], $rowselCalMonth['month']);
            array_push($nuscalMonth['clicks'], $rowselCalMonth['clicks']);
        }

        $mnthsql = "DELETE FROM nus_calendermonth WHERE supplierId=" . $_GET['id'] . "";
        $conn->query($mnthsql);

        $seasonsql = "DELETE FROM nus_season WHERE supplierId=" . $_GET['id'] . "";
        $conn->query($seasonsql);

        //end

        for ($i = 1; $i < $_POST['rowcount']; $i++) {
            if (isset($_POST['tradsel' . $i]) && $_POST['tradsel' . $i] != '') {

                if (empty($_POST['minsize' . $i])) {
                    $sql = "INSERT INTO nus_tradeperiods (supplierId, periodsId, clicktracnches, clicktranches) VALUES ('" . $_GET['id'] . "', '" . $_POST['tradsel' . $i] . "', '" . $_POST['tranche' . $i] . "', '')";
                } else {
                    $sql = "INSERT INTO nus_tradeperiods (supplierId, periodsId, clicktracnches, clicktranches) VALUES ('" . $_GET['id'] . "', '" . $_POST['tradsel' . $i] . "', '" . $_POST['tranche' . $i] . "', '" . $_POST['minsize' . $i] . "')";
                }
                $conn->query($sql);
                $last_trade_id = $conn->insert_id;
                $allmonts = explode(',', $_POST['allmonths']);
                $firstdate = array();
                $lastdate = array();
                $yearcount = count($allmonts) / 12;
                $yearremaining = count($allmonts) % 12;
                $yearrmai = array();
                $year = 1;
                for ($k = 0; $k < ($yearcount * 12); $k++) {
                    if ($k % 12 == 0) {
                        $firstdate[] = $allmonts[$k];
                        if ($k != 0) {
                            $year = $year + 1;
                        }
                    }
                    if (((12 * $year) - $k) == 1) {
                        $lastdate[] = $allmonts[$k];
                    }
                }



                if ($_POST['tradsel' . $i] == 'Calendar Yearly') {
                    // $periodtime =  array();
                    // $years = array();
                    // //echo "<pre>";
                    // //echo "NOCSM";
                    // //print_r($years);
                    // for ($j = 0; $j < count($lastdate); $j++) {
                    //     $periodtime[] = $firstdate[$j] . ',' . $lastdate[$j];
                    //     $val = explode('-', $lastdate[$j]);
                    //     $years[] = $val[0];
                    // }


                    $periodtime =  array();
                    //echo "<pre>";
                    // print_r($periodtime);
                    $years1 = array();
                    $years = array();

                    $countArray = count($allmonts);
                    //echo $countArray;

                    $startDate = $allmonts[0];
                    //echo $startDate;
                    $endDate = $allmonts[$countArray - 1];
                    //echo $endDate;

                    $yearFirst = explode("-", $startDate);
                    // echo $yearFirst[0];
                    array_push($years1, $yearFirst[0]);
                    $yearEnd = explode("-", $endDate);
                    // echo $yearEnd[0];

                    $resYear = $yearEnd[0] - $yearFirst[0];
                    if ($resYear >= 1) {
                        $incrementYear = $yearFirst[0];
                        for ($ii = 0; $ii < $resYear; $ii++) {
                            $incrementYear =  $incrementYear + 1;
                            // echo $incrementYear;
                            if ($incrementYear <= $yearEnd[0]) {
                                array_push($years1, $incrementYear);
                            } else {
                                break;
                            }
                        }
                    }

                    //print_r($years1);

                    $timeperiod = array();
                    $checkyeAR;

                    for ($jj = 0; $jj < count($years1); $jj++) {
                        $count = 0;
                        $flag = 0;
                        for ($ice = 0; $ice < count($allmonts); $ice++) {
                            // echo $array1[$i];
                            $tookValue = explode("-", $allmonts[$ice]);
                            if ($tookValue[0] == $years1[$jj]) {
                                $checkyeAR = $years1[$jj];
                                $count++;
                            } else {
                            }
                        }
                        if ($count == 12) {
                            array_push($years, $checkyeAR);
                            $firstDates = $checkyeAR . "-1-01";
                            $lastDates = $checkyeAR . "-12-01";
                            $finalDate = $firstDates . "," . $lastDates;
                            // echo $finalDate;
                            array_push($timeperiod, $finalDate);
                            // array_push($timeperiod,$lastDate);
                        }
                    }

                    // print_r($timeperiod);
                    //Updating into database after clicks/enter trade made to particular contract! START
                    $nuscalYearCount = 0;
                    foreach ($years as $key => $value) {
                        $getindex = array_search($value, $years);
                        if (isset($nuscalYear['year'][$nuscalYearCount])) {
                            if ($nuscalYear['clicks'][$nuscalYearCount] < $_POST['tranche' . $i]) {

                                $resYear = $nuscalYear['clicks'][$nuscalYearCount] + $mathsResYear;
                                $sqlinsert = "INSERT INTO nus_calenderyear (calenderyear, clicks, tradeId, supplierid, timeperiod) 
                                VALUES ('" . $value . "',  '" . $resYear . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $timeperiod[$getindex] . "')";
                            } else {
                                $sqlinsert = "INSERT INTO nus_calenderyear (calenderyear, clicks, tradeId, supplierid, timeperiod) 
                                VALUES ('" . $value . "',  '" . $_POST['tranche' . $i] . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $timeperiod[$getindex] . "')";
                            }
                        } else {
                            $sqlinsert = "INSERT INTO nus_calenderyear (calenderyear, clicks, tradeId, supplierid, timeperiod) 
                            VALUES ('" . $value . "',  '" . $_POST['tranche' . $i] . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $timeperiod[$getindex] . "')";
                        }
                        $conn->query($sqlinsert);
                        $nuscalYearCount++;
                    }
                    $nuscalYearCount = 0;
                    //END

                }
                if ($_POST['tradsel' . $i] == 'Calendar Quarterly') {
                    $q1 = ['Jan', 'Feb', 'Mar'];
                    $q2 = ['Apr', 'May', 'Jun'];
                    $q3 = ['July', 'Aug', 'Sep'];
                    $q4 = ['Oct', 'Nov', 'Dec'];

                    $allmonths = array();
                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    $yearsTrade = array();
                    foreach ($allmonts as $key => $values) {
                        $monthsexp = explode('-', $values);
                        $allmonths[] = $months[$monthsexp[1] - 1] . '-' . $monthsexp[0];
                        $yearsTrade[] = $monthsexp[0];
                    }
                    $yars = array_unique($yearsTrade);
                    $q1quat = array();
                    $q2quat = array();
                    $q3quat = array();
                    $q4quat = array();
                    //print_r($yars);

                    $nuscalQuarterCount = 0;

                    foreach ($yars as $key => $yrvalue) {

                        foreach ($allmonths as $key => $mtvalue) {
                            $montva = explode('-', $mtvalue);
                            // print_r($montva);

                            if (in_array($montva[0], $q1) && $montva[1] == $yrvalue) {
                                array_push($q1quat, $mtvalue);
                            } else if (in_array($montva[0], $q2) && $montva[1] == $yrvalue) {

                                array_push($q2quat, $mtvalue);
                            } else if (in_array($montva[0], $q3) && $montva[1] == $yrvalue) {

                                array_push($q3quat, $mtvalue);
                            } else if (in_array($montva[0], $q4) && $montva[1] == $yrvalue) {

                                array_push($q4quat, $mtvalue);
                            }
                        }

                        $clicksSelected = $_POST['tranche' . $i];

                        if (count($q1quat) != 0) {
                            $qtr = 'q1';
                            if (isset($nuscalQuarter['clicks'][$nuscalQuarterCount])) {
                                if ($nuscalQuarter['clicks'][$nuscalQuarterCount] < $clicksSelected) {
                                    $resQ1 = $nuscalQuarter['clicks'][$nuscalQuarterCount] + $mathsResQuarter;
                                    $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) 
                                        VALUES ('" . $qtr . "',  '" . $resQ1 . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $yrvalue . "')";
                                    // echo "One";    
                                } else {
                                    $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) 
                                        VALUES ('" . $qtr . "',  '" . $clicksSelected . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $yrvalue . "')";
                                    // echo "Two";    
                                }
                            } else {
                                $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) 
                                    VALUES ('" . $qtr . "',  '" . $clicksSelected . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $yrvalue . "')";
                                // echo "Three";    
                            }
                            $conn->query($sqlinsert);
                            $nuscalQuarterCount++;
                            // echo "<pre>";
                            // echo "NUS QUARTER COUNT = ".$nuscalQuarterCount;
                            // echo " Array => ".$_POST['tranche'.$i];
                        }
                        if (count($q2quat) != 0) {
                            $qtr = 'q2';
                            if (isset($nuscalQuarter['clicks'][$nuscalQuarterCount])) {
                                if ($nuscalQuarter['clicks'][$nuscalQuarterCount] < $clicksSelected) {
                                    $resQ2 = $nuscalQuarter['clicks'][$nuscalQuarterCount] + $mathsResQuarter;
                                    $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) 
                                        VALUES ('" . $qtr . "',  '" . $resQ2 . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $yrvalue . "')";
                                } else {
                                    $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) 
                                        VALUES ('" . $qtr . "',  '" . $clicksSelected . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $yrvalue . "')";
                                }
                            } else {
                                $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) 
                                    VALUES ('" . $qtr . "',  '" . $clicksSelected . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $yrvalue . "')";
                            }
                            $conn->query($sqlinsert);
                            $nuscalQuarterCount++;
                            // echo "<pre>";
                            // echo "NUS QUARTER COUNT = ".$nuscalQuarterCount;
                            // echo " Array => ".$_POST['tranche'.$i];
                        }
                        if (count($q3quat) != 0) {
                            $qtr = 'q3';
                            if (isset($nuscalQuarter['clicks'][$nuscalQuarterCount])) {
                                if ($nuscalQuarter['clicks'][$nuscalQuarterCount] < $clicksSelected) {
                                    $resQ3 = $nuscalQuarter['clicks'][$nuscalQuarterCount] + $mathsResQuarter;
                                    $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) 
                                        VALUES ('" . $qtr . "',  '" . $resQ3 . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $yrvalue . "')";
                                } else {
                                    $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) 
                                        VALUES ('" . $qtr . "',  '" . $clicksSelected . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $yrvalue . "')";
                                }
                            } else {
                                $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) 
                                    VALUES ('" . $qtr . "',  '" . $clicksSelected . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $yrvalue . "')";
                            }
                            $conn->query($sqlinsert);
                            $nuscalQuarterCount++;
                            // echo "<pre>";
                            // echo "NUS QUARTER COUNT = ".$nuscalQuarterCount;
                            // echo " Array => ".$_POST['tranche'.$i];
                        }
                        if (count($q4quat) != 0) {

                            $qtr = 'q4';
                            if (isset($nuscalQuarter['clicks'][$nuscalQuarterCount])) {
                                if ($nuscalQuarter['clicks'][$nuscalQuarterCount] < $clicksSelected) {
                                    $resQ4 = $nuscalQuarter['clicks'][$nuscalQuarterCount] + $mathsResQuarter;
                                    $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) 
                                        VALUES ('" . $qtr . "',  '" . $resQ4 . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $yrvalue . "')";
                                } else {
                                    $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) 
                                        VALUES ('" . $qtr . "',  '" . $clicksSelected . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $yrvalue . "')";
                                }
                            } else {
                                $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) 
                                    VALUES ('" . $qtr . "',  '" . $clicksSelected . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $yrvalue . "')";
                            }
                            $conn->query($sqlinsert);
                            $nuscalQuarterCount++;
                            // echo "<pre>";
                            // echo "NUS QUARTER COUNT = ".$nuscalQuarterCount;
                            // echo " Array => ".$_POST['tranche'.$i];
                        }
                        array_splice($q1quat, 0);
                        array_splice($q2quat, 0);
                        array_splice($q3quat, 0);
                        array_splice($q4quat, 0);
                    }
                }
                if ($_POST['tradsel' . $i] == 'Calendar Monthly') {
                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    $allmonths = array();
                    $yearsTrade = array();
                    foreach ($allmonts as $key => $values) {
                        $monthsexp = explode('-', $values);
                        $allmonths[] = $months[$monthsexp[1] - 1] . '-' . $monthsexp[0];
                        $yearsTrade[] = $monthsexp[0];
                    }
                    $nuscalMonthCount = 0;
                    $monthClicks = $_POST['tranche' . $i];
                    $yars = array_unique($yearsTrade);
                    foreach ($yars as $key => $yarsvalue) {
                        foreach ($allmonths as $key => $mtvalue) {
                            $montva = explode('-', $mtvalue);
                            if ($montva[1] == $yarsvalue) {
                                if (isset($nuscalMonth['clicks'][$nuscalMonthCount])) {
                                    if ($nuscalMonth['clicks'][$nuscalMonthCount] < $_POST['tranche' . $i]) {
                                        $resM = $nuscalMonth['clicks'][$nuscalMonthCount] + $mathsResMonth;
                                        $sqlinsert = "INSERT INTO nus_calendermonth (month, clicks, TradeId, supplierId, year) 
                                        VALUES ('" . $montva[0] . "',  '" . $resM . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $montva[1] . "')";
                                    } else {
                                        $sqlinsert = "INSERT INTO nus_calendermonth (month, clicks, TradeId, supplierId, year) 
                                        VALUES ('" . $montva[0] . "',  '" . $monthClicks . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $montva[1] . "')";
                                    }
                                } else {
                                    $sqlinsert = "INSERT INTO nus_calendermonth (month, clicks, TradeId, supplierId, year) 
                                    VALUES ('" . $montva[0] . "',  '" . $monthClicks . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $montva[1] . "')";
                                }
                                $conn->query($sqlinsert);
                                $nuscalMonthCount++;
                            }
                        }
                    }
                }
                if ($_POST['tradsel' . $i] == 'Season') {
                    $q1 = ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
                    $q8 = ['Apr', 'May', 'Jun', 'July', 'Aug', 'Sep'];


                    $allmonths = array();
                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    $yearsTrade = array();
                    foreach ($allmonts as $key => $values) {
                        $monthsexp = explode('-', $values);
                        $allmonths[] = $months[$monthsexp[1] - 1] . '-' . $monthsexp[0];
                        $yearsTrade[] = $monthsexp[0];
                        // if(in_array('Mar', $q1)){
                        //     // $yearsTrade[] = $monthsexp[0];
                        //     echo $monthsexp[0];
                        // }


                    }
                    $years = array();
                    foreach ($allmonths as $key => $mtvalue) {
                        $montyear = explode('-', $mtvalue);
                        // echo  $montyear[0];
                        // echo $montyear;

                        if ($montyear[0] == 'Jan' && in_array($montyear[1], $yearsTrade)) {
                            // echo 'jo';
                            $years[] = $montyear[1];
                        }
                        if ($montyear[0] == 'May' && in_array($montyear[1], $yearsTrade)) {
                            $years[] = $montyear[1];
                        }
                    }

                    $yars = array_unique($years);
                    $q1quat = array();
                    $q2quat = array();

                    //print_r($yars);
                    foreach ($yars as $key => $value) {
                        foreach ($allmonths as $key => $mtvalue) {
                            $montva = explode('-', $mtvalue);
                            // print_r($montva);

                            if (in_array($montva[0], $q1) && $value == $montva[1]) {
                                array_push($q1quat, $mtvalue);
                            } else if (in_array($montva[0], $q8) && $value == $montva[1]) {

                                array_push($q2quat, $mtvalue);
                            }
                        }

                        if (count($q1quat) != 0) {
                            $qtr = 'oct-mar';
                            $sqlinsert = "INSERT INTO nus_season (season, clicks, tradeId, supplierId, yeartrade) VALUES ('" . $qtr . "',  '" . $_POST['tranche' . $i] . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $value . "')";
                            $conn->query($sqlinsert);
                        }
                        if (count($q2quat) != 0) {
                            $qtr = 'apr-sep';
                            $sqlinsert = "INSERT INTO nus_season (season, clicks, tradeId, supplierId, yeartrade) VALUES ('" . $qtr . "',  '" . $_POST['tranche' . $i] . "', '" . $last_trade_id . "', '" . $_GET['id'] . "', '" . $value . "')";
                            $conn->query($sqlinsert);
                        }
                        //print_r($q1quat);
                        //print_r($q2quat);
                        array_splice($q1quat, 0);
                        array_splice($q2quat, 0);
                    }
                }
            }
        }
    }

    $startDate = date('Y-m-d', strtotime($_POST['startDate1']));
    $endDate = date('Y-m-d', strtotime($_POST['endDate1']));
    echo "<pre>";
    // print_r($_POST['hedge']);

    // $hedge =  "<script>document.write(localStorage.getItem('hedgedConsumption'));</script>";
    // echo $hedge;

    if ($_POST['contType'] == 'fixed') {
        $sqlupdate = "UPDATE nus_supply_contract SET parentId='" . $_POST['parent'] . "',clientId='" . $_POST['client'] . "', commodityName='" . $commodityName . "', countryName='" . $_POST['country'] . "', commodityUnits='" . $unit . "', supplyName='" . $_POST['supplr'] . "', contractType='" . $contracttype . "', contractIndexId='" . $contrindex . "', contractTermfromDate='" . $startDate . "', contractTermtoDate='" . $endDate . "', commodityPrice='" . numberreturn($_POST['commodityprice']) . "', totalAnualConsumption='" . $_POST['totalanualconsumption'] . "', indexStructureType='',  openPrizemechanism='',totlconsumption='" . $_POST['totlcnsumtion'] . "',allmonts='" . $_POST['allmonths'] . "', contractpricetype='" . $_POST['contractprice'] . "',consumptionmonth='" . $_POST['allmonthsdata'] . "', hedgeconsumption ='" . $_POST['hedge'] . "', basegenconsumption = '" . $_POST['baseconsumption1'] . "', effectcon = '" . $_POST['effectivec1'] . "' WHERE supplierId = " . $_GET['id'] . "";
    } else {
        $indexstru = '';
        foreach ($_POST['indexstr'] as $value) {
            $indexstru = $value;
        }

        $sqlupdate = "UPDATE nus_supply_contract SET parentId='" . $_POST['parent'] . "',clientId='" . $_POST['client'] . "', commodityName='" . $commodityName . "', countryName='" . $_POST['country'] . "', commodityUnits='" . $unit . "', supplyName='" . $_POST['supplr'] . "', contractType='" . $contracttype . "', contractIndexId='" . $contrindex . "', contractTermfromDate='" . $startDate . "', contractTermtoDate='" . $endDate . "', commodityPrice='" . numberreturn($_POST['commodityprice']) . "', totalAnualConsumption='" . $_POST['totalanualconsumption'] . "', indexStructureType='" . $indexstru . "',  openPrizemechanism='" . $_POST['openmech'] . "',totlconsumption='" . $_POST['totlcnsumtion'] . "',allmonts='" . $_POST['allmonths'] . "', contractpricetype='" . $_POST['contractprice'] . "',consumptionmonth='" . $_POST['allmonthsdata'] . "', hedgeconsumption ='" . $_POST['hedge'] . "', basegenconsumption = '" . $_POST['baseconsumption1'] . "', effectcon = '" . $_POST['effectivec1'] . "' WHERE supplierId = " . $_GET['id'] . "";
    }
    // echo "<pre>";
    // print_r($sqlupdate);
    // $conn->query($sqlupdate);


    // echo "<pre>";
    // echo "Jaiho";
    // print_r($conn);
    // $resuiodu = mysqli_query($conn,$sqlupdate);
    // print_r($resuiodu);
    mysqli_query($conn, $sqlupdate);
    // if(){
    //     $delsql = "DELETE FROM nus_tradeperiods WHERE supplierId=".$_GET['id']."";
    //     $conn->query($delsql);
    //     $calsql = "DELETE FROM nus_calenderyear WHERE supplierid=".$_GET['id']."";
    //     $conn->query($calsql);
    //     $quartsql = "DELETE FROM nus_calenderquarter WHERE supplierid=".$_GET['id']."";
    //     $conn->query($quartsql);
    //     $mnthsql = "DELETE FROM nus_calendermonth WHERE supplierId=".$_GET['id']."";
    //     $conn->query($mnthsql);
    //     $seasonsql = "DELETE FROM nus_season WHERE supplierId=".$_GET['id']."";
    //     $conn->query($seasonsql);
    // }
    // for ($i=0; $i < $_POST['rowcount'] ; $i++) {
    //     if(isset($_POST['tradsel'.$i]) && $_POST['tradsel'.$i] != '' ){
    //         $sql = "INSERT INTO nus_tradeperiods (supplierId, periodsId, clicktracnches, clicktranches) VALUES ('".$_GET['id']."', '".$_POST['tradsel'.$i]."', '".$_POST['tranche'.$i]."', '".$_POST['minsize'.$i]."')";
    //         $conn->query($sql);
    //         $last_trade_id = $conn->insert_id;
    //         $allmonts = explode(',', $_POST['allmonths']);
    //         $firstdate = array();
    //         $lastdate = array();
    //         $yearcount = count($allmonts)/12;
    //         $yearremaining = count($allmonts)%12;
    //         $yearrmai = array();
    //         $year = 1;
    //         for ($k=0; $k < ($yearcount*12); $k++) { 
    //             if($k%12 == 0){
    //                 $firstdate[] =$allmonts[$k];
    //                 if($k!=0){
    //                     $year = $year+1;
    //                 }

    //             }
    //             if(((12*$year) - $k) == 1){
    //                 $lastdate[] = $allmonts[$k];
    //             }
    //         }

    //         if($_POST['tradsel'.$i] == 'Calendar Yearly'){
    //             $periodtime =  array();
    //             $years = array();
    //             for($j=0;$j<count($lastdate);$j++){
    //                 $periodtime[] = $firstdate[$j].','.$lastdate[$j];
    //                 $val = explode('-', $lastdate[$j]);
    //                 $years[] = $val[0];
    //             }

    //             foreach ($years as $key => $value) {
    //                 $getindex = array_search($value, $years);
    //                 $sqlinsert = "INSERT INTO nus_calenderyear (calenderyear, clicks, tradeId, supplierid, timeperiod) VALUES ('".$value."',  '".$_POST['tranche'.$i]."', '".$last_trade_id."', '".$_GET['id']."', '".$periodtime[$getindex]."')";
    //                 $conn->query($sqlinsert);
    //             }

    //         }
    //         if($_POST['tradsel'.$i] == 'Calendar Quarterly'){
    //             $q1 = ['Jan','Feb','Mar'];
    //             $q2 = ['Apr','May','Jun'];
    //             $q3 = ['Jul','Aug','Sep'];
    //             $q4 = ['Oct','Nov','Dec'];

    //                 $allmonths = array();
    //                 $months = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'];
    //                 $yearsTrade = array();
    //                 foreach ($allmonts as $key => $values) {
    //                     $monthsexp = explode('-', $values);
    //                     $allmonths[] = $months[$monthsexp[1]-1].'-'.$monthsexp[0];
    //                     $yearsTrade[] = $monthsexp[0];
    //                 }
    //                 $yars = array_unique($yearsTrade);
    //                 $q1quat = array();
    //                 $q2quat = array();
    //                 $q3quat = array(); 
    //                 $q4quat = array();
    //                  print_r($yars);
    //                 foreach ($yars as $key => $yrvalue) {

    //                    foreach ($allmonths as $key => $mtvalue) {
    //                         $montva = explode('-', $mtvalue);
    //                         // print_r($montva);

    //                             if(in_array($montva[0], $q1) && $montva[1] == $yrvalue){
    //                                 array_push($q1quat, $mtvalue);
    //                             }

    //                             else if(in_array($montva[0], $q2) && $montva[1] == $yrvalue){

    //                                      array_push($q2quat, $mtvalue);



    //                             }
    //                             else if(in_array($montva[0], $q3) && $montva[1] == $yrvalue){

    //                                     array_push($q3quat, $mtvalue);


    //                             }
    //                             else if(in_array($montva[0], $q4) && $montva[1] == $yrvalue){

    //                                      array_push($q4quat, $mtvalue);



    //                             }




    //                     }

    //                     if(count($q1quat)!=0){
    //                         $qtr = 'q1';
    //                         $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) VALUES ('".$qtr."',  '".$_POST['tranche'.$i]."', '".$last_trade_id."', '".$_GET['id']."', '".$yrvalue."')";
    //                         $conn->query($sqlinsert);
    //                     }
    //                     if(count($q2quat)!=0){

    //                         $qtr = 'q2';
    //                         $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) VALUES ('".$qtr."',  '".$_POST['tranche'.$i]."', '".$last_trade_id."', '".$_GET['id']."', '".$yrvalue."')";
    //                         $conn->query($sqlinsert);
    //                     }
    //                     if(count($q3quat)!=0){

    //                         $qtr = 'q3';
    //                         $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) VALUES ('".$qtr."',  '".$_POST['tranche'.$i]."', '".$last_trade_id."', '".$_GET['id']."', '".$yrvalue."')";
    //                         $conn->query($sqlinsert);
    //                     }
    //                     if(count($q4quat)!=0){

    //                         $qtr = 'q4';
    //                         $sqlinsert = "INSERT INTO nus_calenderquarter (quarters, clicks, tradeid, supplierid, yearoftrade) VALUES ('".$qtr."',  '".$_POST['tranche'.$i]."', '".$last_trade_id."', '".$_GET['id']."', '".$yrvalue."')";
    //                         $conn->query($sqlinsert);
    //                     }
    //                     array_splice($q1quat, 0);
    //                     array_splice($q2quat, 0);
    //                     array_splice($q3quat, 0);
    //                     array_splice($q4quat, 0);

    //                 }

    //         }
    //         if($_POST['tradsel'.$i] == 'Calendar Monthly'){
    //             $months = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'];
    //             $allmonths = array();
    //             $yearsTrade = array();
    //             foreach ($allmonts as $key => $values) {
    //                     $monthsexp = explode('-', $values);
    //                     $allmonths[] = $months[$monthsexp[1]-1].'-'.$monthsexp[0];
    //                     $yearsTrade[] = $monthsexp[0];
    //             }
    //             $yars = array_unique($yearsTrade);
    //             foreach ($yars as $key => $yarsvalue) {
    //                 foreach ($allmonths as $key => $mtvalue) {
    //                     $montva = explode('-', $mtvalue);
    //                     if($montva[1]== $yarsvalue){
    //                          $sqlinsert = "INSERT INTO nus_calendermonth (month, clicks, TradeId, supplierId, year) VALUES ('".$montva[0]."',  '".$_POST['tranche'.$i]."', '".$last_trade_id."', '".$_GET['id']."', '".$montva[1]."')";
    //                         $conn->query($sqlinsert);
    //                     }
    //                 }

    //             }
    //         }
    //         if($_POST['tradsel'.$i] == 'Season'){
    //             $q1 = ['Oct','Nov','Dec', 'Jan', 'Feb', 'Mar'];
    //             $q8 = ['Apr','May','Jun','Jul','Aug','Sep'];


    //                 $allmonths = array();
    //                 $months = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'];
    //                 $yearsTrade = array();
    //                 foreach ($allmonts as $key => $values) {
    //                     $monthsexp = explode('-', $values);
    //                     $allmonths[] = $months[$monthsexp[1]-1].'-'.$monthsexp[0];
    //                     $yearsTrade [] = $monthsexp[0];
    //                     // if(in_array('Mar', $q1)){
    //                     //     // $yearsTrade[] = $monthsexp[0];
    //                     //     echo $monthsexp[0];
    //                     // }


    //                 }
    //                 $years = array();
    //                 foreach ($allmonths as $key => $mtvalue) {
    //                     $montyear = explode('-', $mtvalue);
    //                     // echo  $montyear[0];
    //                     // echo $montyear;

    //                         if($montyear[0] == 'Jan' && in_array($montyear[1], $yearsTrade)){
    //                             // echo 'jo';
    //                             $years[] = $montyear[1];

    //                         }
    //                         if($montyear[0] == 'May' && in_array($montyear[1], $yearsTrade)){
    //                             $years[] = $montyear[1];


    //                         }

    //                 }

    //                 $yars = array_unique($years);
    //                 $q1quat = array();
    //                 $q2quat = array();

    //                 print_r($yars);
    //                 foreach ($yars as $key => $value) {
    //                    foreach ($allmonths as $key => $mtvalue) {
    //                         $montva = explode('-', $mtvalue);
    //                         // print_r($montva);

    //                             if(in_array($montva[0], $q1) && $value == $montva[1]){
    //                                 array_push($q1quat, $mtvalue);
    //                             }

    //                             else if(in_array($montva[0], $q8) && $value == $montva[1]){

    //                                      array_push($q2quat, $mtvalue);

    //                             }

    //                     }

    //                     if(count($q1quat)!=0){
    //                         $qtr = 'oct-mar';
    //                         $sqlinsert = "INSERT INTO nus_season (season, clicks, tradeId, supplierId, yeartrade) VALUES ('".$qtr."',  '".$_POST['tranche'.$i]."', '".$last_trade_id."', '".$_GET['id']."', '".$value."')";
    //                         $conn->query($sqlinsert);
    //                     }
    //                     if(count($q2quat)!=0){
    //                         $qtr = 'apr-sep';
    //                         $sqlinsert = "INSERT INTO nus_season (season, clicks, tradeId, supplierId, yeartrade) VALUES ('".$qtr."',  '".$_POST['tranche'.$i]."', '".$last_trade_id."', '".$_GET['id']."', '".$value."')";
    //                         $conn->query($sqlinsert);
    //                     }
    //                     print_r($q1quat);
    //                     print_r($q2quat);
    //                     array_splice($q1quat, 0);
    //                     array_splice($q2quat, 0);
    //             }


    //         }
    //     }
    // }
    // }



    // $_SESSION['updated'] = time();
    // header('location: addhome.php');
    //commented header("location:supplycontractpreview.php?id=".$_GET['id']."&type=edit");
    //  header("location:supplycontractpreview.php?info=".$_POST['infovalue']."&id=".$_GET['id']."&type=edit"); //when matters
    echo "<script>alert('Contract has been edited successfully!'); location.href='addhome.php';</script>";
    // header("location:addsupplycontract.php");
    // echo "<pre>";
    // echo $_POST['hedge'];
    // echo "<br>";
    // echo $_POST['effectivec1'];
    // echo "<br>";
    // echo $_POST['baseconsumption1'];
}
