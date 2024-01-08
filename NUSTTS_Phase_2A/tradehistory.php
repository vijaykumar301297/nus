<?php
include_once 'security.php';
?>


<?php
    $index = $row['contractIndexId'];
    $year = $_POST['yearstype'][0];
    $arraytrade=array();
    $sqlQuery11 = "SELECT * FROM enter_trade WHERE supplycontractid = '" . $row['contract_id'] . "'
    AND tradevalue ='$year' AND clientId = '".$_POST['clientsId']."' AND tradeexecuted ='Executed'";
    // echo $sqlQuery11;
    $result = mysqli_query($conn,$sqlQuery11);

   
        // $arraytrade[] = $rowTrade;
        // print_r($arraytrade);
        // $arraytradelength = count($arraytrade[0]);
//    }


?>


<table style="margin-left:60px; font-size:12px; border-top:2px solid #E4EBF6; width:92%;">
<caption class="heading" >Trade History Report</caption>
    <thead class="tableHead" >
        <th style="text-align: center; font-weight:500;">Trade #</th>
        <th style="text-align: center; font-weight:500;">Trade <br>Execution Date</th>
        <th style="text-align: left;font-weight:500;">Trade Period</th>
        <th style="text-align: center;font-weight:500;">Market/Index</th>
        <th style="text-align: center;font-weight:500;">Purchase Type<br>(Percent, Volume, Load)</th>
        <th style="text-align: center;font-weight:500;">MW <br>Purchased</th>
        <th style="text-align: center;font-weight:500;">Aggregate Trade <br>for<br>Trade Period (MWh)</th>
        <th style="text-align: center;font-weight:500;">% Purchased</th>
        <th style="text-align: right;font-weight:500;">Baseload Price<br>/MWh</th>
        <th style="text-align: right;font-weight:500;">Effective Price<br>/MWh</th>
        <th style="text-align: right;font-weight:500;">Effective <br>Traded Value</th>
    </thead>
    <tbody>
        <?php 
        $i=1;
        $totalAgTrade = 0;
        while($rowTrade = mysqli_fetch_assoc($result)) {
        ?>
        <tr class="tradesline" style="background:white;  border-bottom:2px solid #E4EBF6; border-top:2px solid #E4EBF6;  font-weight:300;padding: 5px 0;">
            <td style="text-align: center;"><?php echo $i;?></td>
            <td style="text-align: center;"><?php echo date('d-M-Y', strtotime($rowTrade['tradeDate']));?></td>
            <?php 
                if ($rowTrade['quartval']==""){
                    echo "<td  style='text-align: left;'>";
                    echo $rowTrade['trade'].' - '.$year;
                    echo "</td>";
                }

                else {
                    echo "<td  style='text-align: left;'>";
                    echo $rowTrade['trade'].' - '.$year.' - '.$rowTrade['quartval'];
                    echo "</td>";
                }

            ?>
            <td style="text-align: center;"><?php echo $index;?></td>
            <?php
                if($rowTrade['mw']==0){
                    if ($rowTrade['percentage']=="") {
                        echo "<td  style='text-align: center;'>";
                        // echo number_format($rowTrade['percentage'],2).'%';
                        echo "Volume";
                        echo "</td>";
                    }
                    else{
                        echo "<td  style='text-align: center;'>";
                        // echo number_format($rowTrade['percentage'],2).'%';
                        echo "Percentage";
                        echo "</td>";
                    }
                }
                else {
                    echo "<td style='text-align: center;'>";
                    // echo 'Volume';
                    echo "Load";
                    // echo number_format($rowTrade['percentage'],2).'%';
                    echo "</td>";
                }
            ?>
            
                <?php
                    if($rowTrade['mw']==0){
                        echo "<td style='text-align: center;'>";
                        echo "";
                        echo "</td>";
                    }
                    else{
                        echo "<td style='text-align: center;'>";
                        echo $rowTrade['mw'];
                        echo "</td>";
                    }
                ?>
       
           <?php
                if($rowTrade['percentage'] == "") {
                    echo "<td style='text-align: center;'>";
                    $regex = "/\B(?=(\d{3})+(?!\d))/i";
                    echo  $usdformat = preg_replace($regex, ",", round($rowTrade['tradevolume'],2));
                    echo "</td>";
                } else {
                    $regex = "/\B(?=(\d{3})+(?!\d))/i";
                    echo "<td style='text-align: center;'>";
                    echo  $usdformat = preg_replace($regex, ",", round($rowTrade['tradevolume'],2));
                    echo "</td>";
                }
                
            ?>
            <!-- <td style="text-align: center;"> -->
                <?php
                    if($rowTrade['percentage'] == "") {
                        echo "<td>";
                        echo "";
                        echo "</td>";
                    } else {
                        echo "<td style='text-align: center;'>";
                        echo number_format($rowTrade['percentage'],2).'%';
                        echo "</td>";
                    }
                ?>
            <!-- </td> -->
            <td>
                    <?php
                        $regex = "/\B(?=(\d{3})+(?!\d))/i";
                        // echo $rowTrade['baseload'];
                        echo $usdformat = preg_replace($regex, ",", $rowTrade['baseload'], 2);
                    ?>
                </td>
                <td>
                    <?php
                        // echo $rowTrade['effectiveprice'];
                        $regex = "/\B(?=(\d{3})+(?!\d))/i";
                        echo $usdformat = preg_replace($regex, ",", $rowTrade['effectiveprice'], 2);
                    ?>
                </td>
            
                <?php
                    $res = round($rowTrade['effectiveprice']*$rowTrade['tradevolume']);
                    $total += $res;
                    $regex = "/\B(?=(\d{3})+(?!\d))/i";
                    echo "<td>";
                    echo $usdformat = preg_replace($regex, ",", $res, 2);
                    echo "</td>";
                ?>
            
        </tr>
        <?php
        $i++;
        }
        ?>
      
    
    </tbody>
    
</table>

<br>

