<?php
include "dbconn.php";
session_start();
// if(empty($_POST['clientcompany'])){
// 	echo 'please '
// }
session_start();
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$contractId = "SELECT * FROM nus_supply_contract WHERE supplierId=".$_POST['supplierid']."";
$contractId = mysqli_query($conn, $contractId);
$singlerow = array();
while ($row = mysqli_fetch_assoc($contractId)) {
	$singlerow[] = $row;
}

$tradedata = array();
$entertrade ="SELECT * FROM enter_trade WHERE tradeId=".$_POST['entertradeId']."";
$resultstrade = $conn->query($entertrade);
if ($resultstrade->num_rows > 0) {
    while($row = $resultstrade->fetch_assoc()) {
        $tradedata[] = $row;
    }
}

$getingclinches = "SELECT * FROM nus_tradeperiods WHERE tradePerId=".$_POST['tranchclick']."";
$getingclinches = mysqli_query($conn, $getingclinches);
$clincherow = array();
while ($rows = mysqli_fetch_assoc($getingclinches)) {
	$clincherow[] = $rows;
}

$tradeper = '';
foreach ($_POST['Tradeperiod'] as $key => $value) {
	$tradeper = $value;
}
$availableclick = 0;
$definedclick = 0;
$updateId = 0;
$clickchange = false;
$clicktradid =0;

// if($tradeper == 'Calendar Yearly'){

// 	$definedclick = $clincherow[0]['clicktracnches'];
// 	$getdata = array();
// 	$getcountofclick = "SELECT clicks,calenderId FROM nus_calenderyear WHERE tradeId='".$_POST['tranchclick']."' AND supplierid='".$_POST['supplierid']."' AND calenderyear='".$_POST['ddlyear']."'";
// 	$result = $conn->query($getcountofclick);

// 	if ($result->num_rows > 0) {
// 	  while($row = $result->fetch_assoc()) {
// 	    $getdata[] = $row['clicks'];
// 	    $updateId = $row['calenderId'];
// 	  }
// 	} 
	

// 	if(count($getdata) == 0){
// 		echo 'test';
// 	}else{
// 		$availableclick = array_sum($getdata);
// 	}
// }
// if($tradeper == 'Calendar Monthly'){
// 	$definedclick = $clincherow[0]['clicktracnches']*12;
// 	$getdata = array();
// 	$getcountofclick = "SELECT clicks,monthId  FROM nus_calendermonth WHERE TradeId='".$_POST['tranchclick']."' AND supplierId='".$_POST['supplierid']."' AND year='".$_POST['ddlyear']."' AND month='".$_POST['month']."'";
// 	$result = $conn->query($getcountofclick);

// 	if ($result->num_rows > 0) {
// 	  while($row = $result->fetch_assoc()) {
// 	    $getdata[] = $row['clicks'];
// 	    $updateId = $row['monthId'];
// 	  }
// 	} 
	
// 	if(count($getdata) == 0){
// 		echo 'test';
// 	}else{
// 		$availableclick = array_sum($getdata);
// 	}
// }
// if($tradeper == 'Calendar Quarterly'){
// 	$quarters = '';
// 	foreach ($_POST['Quarter'] as $key => $value) {
// 		$quarters = $value;
// 	}


// 	if($tradedata[0]['tradevalue']== 'q1'){
// 		$getcountofclick = "SELECT querterid FROM nus_calenderquarter WHERE tradeid='".$_POST['tranchclick']."' AND supplierid='".$_POST['supplierid']."' AND yearoftrade='".$_POST['ddlyear']."' AND quarters='".$_POST['Quarter']."'";
// 	}else{
// 		$getcountofclick = "SELECT querterid FROM nus_calenderquarter WHERE tradeid='".$_POST['tranchclick']."' AND supplierid='".$_POST['supplierid']."' AND yearoftrade='".$_POST['ddlyear']."' AND quarters='".$_POST['Quarter']."'";
// 	}
// 	// if($tradedata[0]['tradevalue']== 'q2'){
		
// 	// }
// 	// if($tradedata[0]['tradevalue']== 'q3'){
// 	// 	$getcountofclick = "SELECT querterid FROM nus_calenderquarter WHERE tradeid='".$_POST['tranchclick']."' AND supplierid='".$_POST['supplierid']."' AND yearoftrade='".$_POST['ddlyear']."' AND quarters='".$_POST['Quarter']."'";
// 	// }
// 	// if($tradedata[0]['tradevalue']== 'q4'){
// 	// 	$getcountofclick = "SELECT querterid FROM nus_calenderquarter WHERE tradeid='".$_POST['tranchclick']."' AND supplierid='".$_POST['supplierid']."' AND yearoftrade='".$_POST['ddlyear']."' AND quarters='".$_POST['Quarter']."'";
// 	// }
// 	$definedclick = $clincherow[0]['clicktracnches']*4;
// 	$getdata = array();
	
// 	$result = $conn->query($getcountofclick);

// 	if ($result->num_rows > 0) {
// 	  while($row = $result->fetch_assoc()) {
// 	    $getdata[] = $row['clicks'];
// 	    $updateId = $row['querterid'];
// 	  }
// 	} 
	
// 	if(count($getdata) == 0){
// 		echo 'test';
// 	}else{
// 		$availableclick = array_sum($getdata);
// 	}
// }
// if($tradeper == 'Season'){
// 	$season = '';
// 	foreach ($_POST['seasonname'] as $key => $value) {
// 		$season = $value;
// 	}
	
// 	$definedclick = $clincherow[0]['clicktracnches']*2;
// 	$getdata = array();
// 	$getcountofclick = "SELECT clicks,seasonId FROM nus_season WHERE tradeId='".$_POST['tranchclick']."' AND supplierId='".$_POST['supplierid']."' AND yeartrade='".$_POST['ddlyear']."' AND season='".$season."'";
// 	$result = $conn->query($getcountofclick);

// 	if ($result->num_rows > 0) {
// 	  while($row = $result->fetch_assoc()) {
// 	    $getdata[] = $row['clicks'];
// 	    $updateId = $row['seasonId'];
// 	  }
// 	} 
	
// 	if(count($getdata) == 0){
// 		echo 'test';
// 	}else{
// 		$availableclick = array_sum($getdata);
// 	}
// }

$totalconsumption = numberreturn($singlerow[0]['totalAnualConsumption']);
$allmonts = explode(',', $singlerow[0]['allmonts']);
$consumptionmonth = explode('|', $singlerow[0]['hedgeconsumption']);
$headconsumption = array();
$currentconsumption = 0;
$firstdate = array();
$lastdate = array();
$yearcount = count($allmonts)/12;
$yearremaining = count($allmonts)%12;
$yearrmai = array();
$year = 1;
for ($k=0; $k < ($yearcount*12); $k++) { 
    if($k%12 == 0){
    $firstdate[] =$allmonts[$k];
    if($k!=0){
        $year = $year+1;
    }
  	}
    if(((12*$year) - $k) == 1){
        $lastdate[] = $allmonts[$k];
    }
}
$periodtime =  array();
$years = array();
for($j=0;$j<count($lastdate);$j++){
    $periodtime[] = $firstdate[$j].','.$lastdate[$j];
    $val = explode('-', $lastdate[$j]);
    $years[] = $val[0];
}
$yearscnt = $_POST['ddlyear'];
$key = array_search($yearscnt, $years);
$period = implode(',', $periodtime);
$tradevalues = '';

if($tradeper == 'Calendar Yearly'){
			
		$periods ='';
		$getcountofclick = "SELECT timeperiod FROM nus_calenderyear WHERE calenderId='".$tradedata[0]['nustradeId']."'";
		$result = $conn->query($getcountofclick);
		$updateId = $tradedata[0]['nustradeId'];
		if ($result->num_rows > 0) {
		  while($row = $result->fetch_assoc()) {
		    $periods = $row['timeperiod'];
		  }
		} 
		
		$explode = explode(',',$period);
		$count = count($explode);
		$varmonths = getMonthsInRange($explode[0],$explode[$count-1]);
		$months = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'];
		$crrc = array();
		$yeacc = array();
		$mnts = array();
		foreach ($varmonths as $key => $valuem) {
			$yeacc[] = $valuem['year'].'-'.$months[$valuem['month']-1];
			
		}
		
		$amt = array();
		$datesranges =explode(',',$periods);
		
		$datesrange =  getMonthsInRange($explode[0],$explode[1]);
		$yearsrange = array();
		
		foreach ($datesrange as $key => $valuesss) {
			$yearsrange[] = $valuesss['year'].'-'.$months[$valuesss['month']-1];
			
		}
		$keyArray = array();
		
		
		$explodesum = 0;
	    $tradol = numberreturn($tradedata[0]['tradevolume'])/12;
	    $tradnew = numberreturn($_POST['tradevolume']);
	    $minus = (float)$tradnew/12;
	    
		foreach ($consumptionmonth as $key => $valuess) {
			$explodeconsum = explode('-', $valuess);
			// print_r($explodeconsum) ;
			$keyval = $explodeconsum[1].'-'.$explodeconsum[0];
			// echo  $valuess;

			if(in_array($keyval, $yeacc)){
				$exl = explode('-', $keyval);
				if(in_array($keyval, $yearsrange)){
					$explodesum = 0;
					if(numberreturn($_POST['tradevolume']) == numberreturn($tradedata[0]['tradevolume'])){
	    				$explodesum = $explodeconsum[2]+0;
	    		
			    	}
			    	if(numberreturn($_POST['tradevolume'])> numberreturn($tradedata[0]['tradevolume'])){
			    		$explodesum = ($explodeconsum[2]-$tradol)+$minus;

			    	}else if(numberreturn($_POST['tradevolume'])< numberreturn($tradedata[0]['tradevolume'])){
			    		$explodesum =($explodeconsum[2]-$tradol)+$minus;
			    	}
					
					$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
				}else{
					$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
				}
			}
			// else{
			// 	$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
			// }
		}
		// print_r($yeacc);
		foreach ($headconsumption as $key => $values) {
			$explodeconsum = explode('-', $values);
			$keyval = $explodeconsum[1].'-'.$explodeconsum[0];
			echo $keyval;
			if(in_array($keyval, $yeacc)){
				if(in_array($keyval, $yearsrange)){
					$crrc[] = $explodeconsum[2];
				}
				// $exl = explode('-', $keyval);
				// echo $key = array_search($keyval, $keys);
				
				// echo  $explodeconsum[2];
			}
			
		}
		// print_r($yeacc);
		$currentconsumption = array_sum($crrc);
	// print_r($headconsumption);
}

if($tradeper == 'Calendar Monthly'){

	if($_POST['month'] == $tradedata[0]['quartval']){

		// $getcountofclick = "SELECT month,year  FROM nus_calendermonth WHERE monthId='".$tradedata[0]['nustradeId']."'";

		// $result = $conn->query($getcountofclick);
		// $month ='';
		// $year = '';
		// if ($result->num_rows > 0) {
		//   while($row = $result->fetch_assoc()) {
		//     $month = $row['month'];
		//     $year = $row['year'];
		//   }
		// } 
		$month = $tradedata[0]['quartval'];
		$year = $tradedata[0]['tradevalue'];
		$tradevalues = $_POST['month'];
		$updateId =$tradedata[0]['nustradeId'];
		$tradol = numberreturn($tradedata[0]['tradevolume']);
	    $tradnew = numberreturn($_POST['tradevolume']);
	    $minus = (float)$tradnew;
		$yeacc = array();
		$crrc = array();

		foreach ($consumptionmonth as $key => $valuess) {
				$explodeconsum = explode('-', $valuess);
				
				if($year == $explodeconsum[1] && $month == $explodeconsum[0]){
					$yeacc[] = $explodeconsum[1].'-'.$explodeconsum[0];
					$explodesum = 0;
					if(numberreturn($_POST['tradevolume']) == numberreturn($tradedata[0]['tradevolume'])){
	    				$explodesum = $explodeconsum[2]+0;
	    			
			    	}
			    	if(numberreturn($_POST['tradevolume'])> numberreturn($tradedata[0]['tradevolume'])){
			    		$explodesum = ($explodeconsum[2]-$tradol)+$minus;

			    	}else if(numberreturn($_POST['tradevolume'])< numberreturn($tradedata[0]['tradevolume'])){
			    		$explodesum =($explodeconsum[2]-$tradol)+$minus;
			    	}
					$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round($explodesum,2);
				}else{
					$yeacc[] = $explodeconsum[1].'-'.$explodeconsum[0];
					$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
				}
				
				
		}
		// print_r($yeacc);
		foreach ($headconsumption as $key => $values) {
			$explodeconsum = explode('-', $values);
			$keyval = $explodeconsum[1].'-'.$explodeconsum[0];
			if(in_array($keyval, $yeacc)){
				$exl = explode('-', $keyval);
				$crrc[] = $explodeconsum[2];
			}
			
		}
		$tradevalues = $_POST['month'];
		
		// $currentconsumption = array_sum($crrc);
		print_r($headconsumption);
	}
	else{
		// echo 'hai';
		$explode = explode(',', $period);
		$varmonths = getMonthsInRange($explode[0],$explode[1]);
		$months = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'];
		$crrc = array();
		$yeacc = array();
		$mnts = array();
		foreach ($varmonths as $key => $valuem) {
			$yeacc[] = $valuem['year'].'-'.$months[$valuem['month']-1];
			
		}
		
		$getcountofclick = "SELECT month, year, monthId  FROM nus_calendermonth WHERE TradeId='".$_POST['tranchclick']."' AND supplierId='".$_POST['supplierid']."' AND year='".$_POST['ddlyear']."' AND month='".$_POST['month']."'";
		$result = $conn->query($getcountofclick);
		$month ='';
		$year = '';
		$monthid = '';
		if ($result->num_rows > 0) {
		  while($row = $result->fetch_assoc()) {
		    $month =  $row['month'];
		    $year = $row['year'];
		    $monthid = $row['monthId'];
		  }
		} 
		$updateId = $monthid;
		echo $monthid;
		// print_r($month);
		$explodesum = numberreturn($_POST['tradevolume']);
		$periodsum = $explodesum;
		$forminus = numberreturn($tradedata[0]['tradevolume']);
		$tradol = numberreturn($tradedata[0]['tradevolume']);
	    $tradnew = numberreturn($_POST['tradevolume']);
	    $minus = (float)$tradnew;
		foreach ($consumptionmonth as $key => $valuess) {
				$explodeconsum = explode('-', $valuess);
				$keyval = $explodeconsum[1].'-'.$explodeconsum[0];
				$explodesum = 0;
					$keyval = explode('-', $keyval);
					if($year == $explodeconsum[1] && $explodeconsum[0] ==$_POST['month']){
						$explodesum =round(($explodeconsum[2]+$periodsum));
						// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
					}else{
						if($explodeconsum[0]== $tradedata[0]['quartval']){
							$explodesum =round(($explodeconsum[2]-$periodsum),2);
							// if($_POST['ddlyear']== $explodeconsum[1]){
								
							// }else{
							// 	$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							// }

						}
					}
					$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
						// if($tradedata[0]['quartval'] == )
						
						// echo $_POST['month'];
						// $explodesum = 0;
						// if(numberreturn($_POST['tradevolume']) == numberreturn($tradedata[0]['tradevolume'])){
						// 	echo $explodeconsum[2];
	    				// 	$explodesum = round($explodeconsum[2]+0,2);
	    		
				    	// }
				    	// if(numberreturn($_POST['tradevolume'])> numberreturn($tradedata[0]['tradevolume'])){
				    	// 	$explodesum = round(($explodeconsum[2]-$tradol)+$minus,2);


				    	// }else if(numberreturn($_POST['tradevolume'])< numberreturn($tradedata[0]['tradevolume'])){
				    	// 	$explodesum =round(($explodeconsum[2]-$tradol)+$minus,2);
				    		
				    	// }
						// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round($explodesum,2);
					// }
					// else{
						// if($explodeconsum[1] == $year && $explodeconsum[0] == $tradedata[0]['tradevalue']){
						// 	echo  $explodeconsum[2]-$forminus;
						// 	$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.($explodeconsum[2]-$forminus);
						// }else{
						// 	$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
						// }
						
					// }
				
				
				
		}
		print_r($headconsumption);
		
	}
	
}

if($tradeper == 'Calendar Quarterly'){

		$quarters = '';
		foreach ($_POST['Quarter'] as $key => $value) {
			$quarters = $value;
		}
		if($tradedata[0]['quartval'] == $quarters){
			$q1 = ['Jan','Feb','Mar'];
	    	$q2 = ['Apr','May','Jun'];
	    	$q3 = ['July','Aug','Sep'];
	    	$q4 = ['Oct','Nov','Dec'];
	    	$quartyar = 0;
	    	$getcountofclick = "SELECT tradevalue  FROM enter_trade WHERE tradeId ='".$tradedata[0]['tradeId']."'";
			$result = $conn->query($getcountofclick);
			$yeacc = array();
			$quartyar = 0;
			if ($result->num_rows > 0) {
			  while($row = $result->fetch_assoc()) {
			    $quartyar = $row['tradevalue'];
			    // $yeacc[] = $row['yearoftrade'].'-'.$months[$row['month']-1];
			  }
			} 
			echo $quartyar;
			$tradevalues = $quarters;
		    $updateId = $tradedata[0]['nustradeId'];
	    	
			// echo $explodesum;
		    $tradol = numberreturn($tradedata[0]['tradevolume'])/3;
	    	$tradnew = numberreturn($_POST['tradevolume']);
	    	$minus = (float)$tradnew/3;
	    	foreach ($consumptionmonth as $key => $valuess) {
				$explodeconsum = explode('-', $valuess);
				// $crrc[] = $explodeconsum[2];
				if($tradedata[0]['quartval'] == 'q1'){
					if($quartyar == $explodeconsum[1] && in_array($explodeconsum[0], $q1)){
						$explodesum = 0;
						if(numberreturn($_POST['tradevolume']) == numberreturn($tradedata[0]['tradevolume'])){
	    					$explodesum = round($explodeconsum[2]+0,2);
	    		
				    	}
				    	if(numberreturn($_POST['tradevolume'])> numberreturn($tradedata[0]['tradevolume'])){
				    		$explodesum = round(($explodeconsum[2]-$tradol)+$minus,2);


				    	}else if(numberreturn($_POST['tradevolume'])< numberreturn($tradedata[0]['tradevolume'])){
				    		$explodesum =round(($explodeconsum[2]-$tradol)+$minus,2);
				    		
				    	}
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
					}else{
						
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
						
					}
				}
				if($tradedata[0]['quartval'] == 'q2'){
					if($quartyar == $explodeconsum[1] && in_array($explodeconsum[0], $q2)){
						$explodesum = 0;
						if(numberreturn($_POST['tradevolume']) == numberreturn($tradedata[0]['tradevolume'])){
	    					$explodesum = round($explodeconsum[2]+0,2);
	    		
				    	}
				    	if(numberreturn($_POST['tradevolume'])> numberreturn($tradedata[0]['tradevolume'])){
				    		$explodesum = round(($explodeconsum[2]-$tradol)+$minus,2);


				    	}else if(numberreturn($_POST['tradevolume'])< numberreturn($tradedata[0]['tradevolume'])){
				    		$explodesum =round(($explodeconsum[2]-$tradol)+$minus,2);
				    		
				    	}
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
					}
					else{
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
					}
				}
				if($tradedata[0]['quartval'] == 'q3'){
					if($quartyar == $explodeconsum[1] && in_array($explodeconsum[0], $q3)){
						echo numberreturn($tradedata[0]['tradevolume']);
						$explodesum = 0;
						if(numberreturn($_POST['tradevolume']) == numberreturn($tradedata[0]['tradevolume'])){
	    					$explodesum = round($explodeconsum[2]+0,2);
	    		
				    	}
				    	if(numberreturn($_POST['tradevolume'])> numberreturn($tradedata[0]['tradevolume'])){
				    		$explodesum = round(($explodeconsum[2]-$tradol)+$minus,2);


				    	}else if(numberreturn($_POST['tradevolume'])< numberreturn($tradedata[0]['tradevolume'])){
				    		$explodesum =round(($explodeconsum[2]-$tradol)+$minus,2);
				    		
				    	}
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
					}
					else{

						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
					}
				}
				if($tradedata[0]['quartval'] == 'q4'){
					
					if($quartyar == $explodeconsum[1] && in_array($explodeconsum[0], $q4)){
					
						$explodesum = 0;
						if(numberreturn($_POST['tradevolume']) == numberreturn($tradedata[0]['tradevolume'])){
	    					$explodesum = round($explodeconsum[2]+0,2);
	    		
				    	}
				    	if(numberreturn($_POST['tradevolume'])> numberreturn($tradedata[0]['tradevolume'])){
				    		$explodesum = round(($explodeconsum[2]-$tradol)+$minus,2);


				    	}else if(numberreturn($_POST['tradevolume'])< numberreturn($tradedata[0]['tradevolume'])){
				    		$explodesum =round(($explodeconsum[2]-$tradol)+$minus,2);
				    		
				    	}
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
					}
					else{
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
					}
				}
				
			}
			$crrc = array();
			foreach ($headconsumption as $key => $values) {
				$explodeconsum = explode('-', $values);
				$keyval = $explodeconsum[1].'-'.$explodeconsum[0];
			
				if($explodeconsum[1]== $quartyar){
					// $exl = explode('-', $keyval);
					$crrc[] = $explodeconsum[2];
				}
			
			}
			$currentconsumption = array_sum($crrc);

		}else{

			$quarters = '';
			foreach ($_POST['Quarter'] as $key => $value) {
				$quarters = $value;
			}
			$q1 = ['Jan','Feb','Mar'];
	    	$q2 = ['Apr','May','Jun'];
	    	$q3 = ['July','Aug','Sep'];
	    	$q4 = ['Oct','Nov','Dec'];
	    	$quartyar = 0;
	    	$getcountofclick = "SELECT yearoftrade,querterid  FROM nus_calenderquarter WHERE quarters ='".$quarters."' AND tradeid=".$_POST['tranchclick']." AND supplierid=".$_POST['supplierid']." AND yearoftrade =".$_POST['ddlyear']."";
			$result = $conn->query($getcountofclick);
			$quartid = '';
			$quartyar = 0;
			if ($result->num_rows > 0) {
			  while($row = $result->fetch_assoc()) {
			    $quartyar = $row['yearoftrade'];
			    $quartid=$row['querterid'];
			  }
			} 

		    $updateId = $quartid;
		    $tradevalues = $quarters;
	    	// $explodesum = 0;
	    	// $tradol = numberreturn($_POST['tradevolume']);
	    	// if(numberreturn($_POST['tradevolume'])> numberreturn($tradedata[0]['tradevolume']) || numberreturn($_POST['tradevolume'])< numberreturn($tradedata[0]['tradevolume'])){
	    	// 	$tradv = numberreturn($_POST['tradevolume']);
	    	// 	$minus = (float)$tradv/3;
	    	// 	$explodesum = numberreturn($tradedata[0]['tradevolume']) - $minus;

	    	// }else if(numberreturn($_POST['tradevolume']) == numberreturn($tradedata[0]['tradevolume'])){
	    	// 	$explodesum = 0;
	    		
	    	// }
			$explodesum = numberreturn($_POST['tradevolume']);
			$periodsum = (float)$explodesum/3;
			$forminus = (float)numberreturn($tradedata[0]['tradevolume'])/3;
			

	    	foreach ($consumptionmonth as $key => $valuess) {
				$explodeconsum = explode('-', $valuess);
				$crrc[] = $explodeconsum[2];
				if($quarters == 'q1'){
					$explodesum = 0;
					if($quartyar == $explodeconsum[1] && in_array($explodeconsum[0], $q1)){
						$explodesum =round(($explodeconsum[2]+$periodsum));
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
						// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.;
					}else{
						
						if($tradedata[0]['quartval']== 'q3'){
							if(in_array($explodeconsum[0], $q3) && $quartyar == $explodeconsum[1]){
								
								$explodesum =round(($explodeconsum[2]-$periodsum),2);
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
								// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]-$periodsum)+$forminus,2);
							}else{
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}
							

						} if($tradedata[0]['quartval'] == 'q4'){
							if(in_array($explodeconsum[0], $q4) && $quartyar == $explodeconsum[1]){
								
								$explodesum =round(($explodeconsum[2]-$periodsum),2);
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
								// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]-$periodsum)+$forminus,2);
							}else{
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}

						} 
						if($tradedata[0]['quartval'] == 'q2'){
							if(in_array($explodeconsum[0], $q2) && $quartyar == $explodeconsum[1]){
								
								$explodesum =round(($explodeconsum[2]-$periodsum),2);
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
								// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]-$periodsum)+$forminus,2);
							}else{
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}

						}
						
					}
				}
				if($quarters == 'q2'){
					$explodesum = 0;
					if($quartyar == $explodeconsum[1] && in_array($explodeconsum[0], $q2)){
						$explodesum =round(($explodeconsum[2]+$periodsum));
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
						// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.;
					}
					else{
						if($tradedata[0]['quartval']== 'q3'){
							
							if(in_array($explodeconsum[0], $q3) && $quartyar == $explodeconsum[1]){
								
								$explodesum =round(($explodeconsum[2]-$periodsum),2);
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
								// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]-$periodsum)+$forminus,2);
							}else{
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}
							

						}if($tradedata[0]['quartval'] == 'q4'){
							if(in_array($explodeconsum[0], $q4) && $quartyar == $explodeconsum[1]){
								
								$explodesum =round(($explodeconsum[2]-$periodsum),2);
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
								// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]-$periodsum)+$forminus,2);
							}else{
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}
							

						} 
						if($tradedata[0]['quartval'] == 'q1'){
							if(in_array($explodeconsum[0], $q1) && $quartyar == $explodeconsum[1]){
								
								$explodesum =round(($explodeconsum[2]-$periodsum),2);
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
								// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]-$periodsum)+$forminus,2);
							}else{
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}
							// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];

						}
						
					}
				}
				if($quarters == 'q3'){
					
					if($quartyar == $explodeconsum[1] && in_array($explodeconsum[0], $q3)){

						$explodesum =round(($explodeconsum[2]+$periodsum));
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
					}
					else{
						// echo $quarters;
						if($tradedata[0]['quartval']== 'q1'){
							if(in_array($explodeconsum[0], $q1) && $quartyar == $explodeconsum[1]){
								
								$explodesum =round(($explodeconsum[2]-$periodsum),2);
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
								// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]-$periodsum)+$forminus,2);
							}else{
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}
						} if($tradedata[0]['quartval'] == 'q4'){
							if(in_array($explodeconsum[0], $q4) && $quartyar == $explodeconsum[1]){
								
								$explodesum =round(($explodeconsum[2]-$periodsum),2);
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
								// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]-$periodsum)+$forminus,2);
							}else{
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}

						} 
						if($tradedata[0]['quartval'] == 'q2'){
							if(in_array($explodeconsum[0], $q2) && $quartyar == $explodeconsum[1]){
								
								$explodesum =round(($explodeconsum[2]-$periodsum),2);
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
								// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]-$periodsum)+$forminus,2);
							}else{
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}

						}
						
					}
				}
				if($quarters == 'q4'){
					
					if($quartyar == $explodeconsum[1] && in_array($explodeconsum[0], $q4)){
						
						$explodesum =round(($explodeconsum[2]+$periodsum));
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
					}
					else{
						if($tradedata[0]['quartval']== 'q3'){
							if(in_array($explodeconsum[0], $q3) && $quartyar == $explodeconsum[1]){
								
								$explodesum =round(($explodeconsum[2]-$periodsum),2);
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
								// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]-$periodsum)+$forminus,2);
							}else{
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}
						} if($tradedata[0]['quartval'] == 'q2'){
							if(in_array($explodeconsum[0], $q2) && $quartyar == $explodeconsum[1]){
								
								$explodesum =round(($explodeconsum[2]-$periodsum),2);
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
								// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]-$periodsum)+$forminus,2);
							}else{
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}

						} 
						if($tradedata[0]['quartval'] == 'q1'){
							if(in_array($explodeconsum[0], $q1) && $quartyar == $explodeconsum[1]){
								
								$explodesum =round(($explodeconsum[2]-$periodsum),2);
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
								// $headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]-$periodsum)+$forminus,2);
							}else{
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}

						}



					}
				}
				
			}
		foreach ($headconsumption as $key => $values) {
			$explodeconsum = explode('-', $values);
			$keyval = $explodeconsum[1].'-'.$explodeconsum[0];
			
			if($explodeconsum[1]== $quartyar){
					// $exl = explode('-', $keyval);
					$crrc[] = $explodeconsum[2];
				}
			
		}
		// print_r($crrc);
		$currentconsumption = array_sum($crrc);
		}
	}


if($tradeper == 'Season'){
	$quarters = '';
		foreach ($_POST['seasonname'] as $key => $value) {
			$quarters = $value;
		}
	if($quarters == $tradedata[0]['quartval']){
		$getcountofclick = "SELECT quartval, tradevalue FROM enter_trade WHERE tradeId='".$tradedata[0]['tradeId']."'";
		$result = $conn->query($getcountofclick);
		$quart ='';
		$year = 0;
		if ($result->num_rows > 0) {
		  while($row = $result->fetch_assoc()) {
		    $quart = $row['quartval'];
		    $year = $row['tradevalue'];
		  }
		} 

		$updateId = $tradedata[0]['tradeId'];
		$q1 = ['Oct','Nov','Dec'];
		$q2 = ['Jan', 'Feb', 'Mar'];
        $q8 = ['Apr','May','Jun','Jul','Aug','Sep'];
        $tradevalues = $quarters;
		$tradol = numberreturn($tradedata[0]['tradevolume'])/6;
	    $tradnew = numberreturn($_POST['tradevolume']);
	    $minus = (float)$tradnew/6;
		$crrc = array();
		$yeacc = array();
		foreach ($consumptionmonth as $key => $valuess) {
				$explodeconsum = explode('-', $valuess);
				$crrc[] = $explodeconsum[2];
				if($quart == 'apr-sep'){
					if($year == $explodeconsum[1] && in_array($explodeconsum[0], $q1)){
						$yeacc[] = $explodeconsum[1].'-'.$explodeconsum[0];
						$explodesum = 0;
						if(numberreturn($_POST['tradevolume']) == numberreturn($tradedata[0]['tradevolume'])){
	    					$explodesum = round($explodeconsum[2]+0,2);
	    		
				    	}
				    	if(numberreturn($_POST['tradevolume'])> numberreturn($tradedata[0]['tradevolume'])){
				    		$explodesum = round(($explodeconsum[2]-$tradol)+$minus,2);


				    	}else if(numberreturn($_POST['tradevolume'])< numberreturn($tradedata[0]['tradevolume'])){
				    		$explodesum =round(($explodeconsum[2]-$tradol)+$minus,2);
				    		
				    	}

						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;

					}else{
					
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
					}
				}
				if($quart == 'oct-mar'){
					if((((in_array($explodeconsum[0], $q1))) && $year-1 ==$explodeconsum[1] ) || (((in_array($explodeconsum[0], $q2))) && $year ==$explodeconsum[1] )){
						$yeacc[] = $explodeconsum[1].'-'.$explodeconsum[0];
						$explodesum = 0;
						if(numberreturn($_POST['tradevolume']) == numberreturn($tradedata[0]['tradevolume'])){
	    					$explodesum = round($explodeconsum[2]+0,2);
	    		
				    	}
				    	if(numberreturn($_POST['tradevolume'])> numberreturn($tradedata[0]['tradevolume'])){
				    		$explodesum = round(($explodeconsum[2]-$tradol)+$minus,2);


				    	}else if(numberreturn($_POST['tradevolume'])< numberreturn($tradedata[0]['tradevolume'])){
				    		$explodesum =round(($explodeconsum[2]-$tradol)+$minus,2);
				    		
				    	}
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodesum;
					}
					else{
						
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
					}
				}
				
		}
		
			foreach ($headconsumption as $key => $values) {
			$explodeconsum = explode('-', $values);
			$keyval = $explodeconsum[1].'-'.$explodeconsum[0];
			// echo $keyval;
			if(in_array($keyval, $yeacc)){
				$exl = explode('-', $keyval);
				$crrc[] = $explodeconsum[2];
			}
			
		}
		$currentconsumption = array_sum($crrc);
		print_r($headconsumption);
	}else{
		
		
		$quarters = '';
		foreach ($_POST['seasonname'] as $key => $value) {
			$quarters = $value;
		}
		
		$getcountofclick = "SELECT season,seasonId, yeartrade  FROM nus_season WHERE tradeId='".$_POST['tranchclick']."' AND supplierId='".$_POST['supplierid']."' AND yeartrade='".$_POST['ddlyear']."' AND season='".$quarters."'";
		$result = $conn->query($getcountofclick);
		$quart ='';
		$year = '';
		$searid = '';
		if ($result->num_rows > 0) {
		  while($row = $result->fetch_assoc()) {
		    $quart = $row['season'];
		    $year = $row['yeartrade'];
		    $searid = $row['seasonId'];
		  }
		} 
		echo $year;
		$updateId  = $searid;
		$tradevalues = $quarters;
		$q1 = ['Oct','Nov','Dec'];
		$q2 = ['Jan', 'Feb', 'Mar'];
        $q8 = ['Apr','May','Jun','July','Aug','Sep'];

		$explodesum = numberreturn($_POST['tradevolume']);
		$periodsum = (float)$explodesum/6;
		$forminus = (float)numberreturn($tradedata[0]['tradevolume'])/6;
		$crrc = array();
		foreach ($consumptionmonth as $key => $valuess) {
				$explodeconsum = explode('-', $valuess);
				$keyval = $explodeconsum[1].'-'.$explodeconsum[0];
				$crrc[] = $explodeconsum[2];
				if($quart == 'apr-sep'){
					
					if($year == $explodeconsum[1] && in_array($explodeconsum[0], $q8)){
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]+$periodsum));
						$yeacc[] = $explodeconsum[1].'-'.$explodeconsum[0];
					}else{
						if($tradedata[0]['tradevalue'] == 'oct-mar'){
							if((($year == $explodeconsum[1] && (in_array($explodeconsum[0], $q2)))  ) || (((in_array($explodeconsum[0], $q1))) && $year-1 ==$explodeconsum[1])){
								
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]-$forminus),2);
								$yeacc[] = $explodeconsum[1].'-'.$explodeconsum[0];
							}else{
								$yeacc[] = $explodeconsum[1].'-'.$explodeconsum[0];
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}
						}
						
					}
				}
				if($quart == 'oct-mar'){
					
					if((($year == $explodeconsum[1] && (in_array($explodeconsum[0], $q2))) && $year-1 ==$explodeconsum[1] ) || (($year == $explodeconsum[1] && (in_array($explodeconsum[0], $q1))) && $year ==$explodeconsum[1])){
						$yeacc[] = $explodeconsum[1].'-'.$explodeconsum[0];
						$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round(($explodeconsum[2]+$periodsum));
					}
					else{
						if($tradedata[0]['tradevalue'] == 'apr-sep'){
							if((in_array($explodeconsum[0], $q8)) && $year ==$explodeconsum[1]){
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.round($explodeconsum[2]-$forminus,2);
								$yeacc[] = $explodeconsum[1].'-'.$explodeconsum[0];
							}else{
								$yeacc[] = $explodeconsum[1].'-'.$explodeconsum[0];
								$headconsumption[] = $explodeconsum[0].'-'.$explodeconsum[1].'-'.$explodeconsum[2];
							}
						}
						
					}
				}
				
			}
			// print_r($yeacc);
		
		$currentconsumption = array_sum($crrc);

}
}
print_r($headconsumption);
// echo $currentconsumption;
	if($currentconsumption>$totalconsumption){
		$_SESSION['errorconsumption'] = time();
		 header("location:editentertrade.php?id=".$_POST['entertradeId']);
		die();
	}
	else{

		$getheadge = array();
		$pricedata = array();
		foreach ($headconsumption as $key => $valueheadge) {
			$divar = explode('-', $valueheadge);
			$getheadge[] = $divar[0].'-'.$divar[1];
			$pricedata[] = $divar[2];
		}
		$consumptionallmonths = explode('|', $singlerow[0]['consumptionmonth']);
		$openconsuption = array();
		foreach ($consumptionallmonths as $key => $openvalue) {

			$getarray = explode('-', $openvalue);
			$opnkal =$getarray[0].'-'.$getarray[1];
			$getconval = array_search($opnkal, $getheadge);
			$headval = $headconsumption[$getconval];
			$getprice = $pricedata[$getconval];
		
			$getminusval = numberreturn($getarray[2])-$getprice;
			$openconsuption[] = $getarray[0].'-'.$getarray[1].'-'.$getminusval;
		}

		$updateconsumption = "UPDATE nus_supply_contract SET hedgeconsumption ='".implode('|', $headconsumption)."',openconsumption='".implode('|', $openconsuption)."'  WHERE supplierId=".$_POST['supplierid']."";
		$conn->query($updateconsumption);

		$sqlTrade = "UPDATE enter_trade SET tradevolume ='".$_POST['tradevolume']."', mwh='".$_POST['mwh']."', nustradeId= '".$updateId."', percentage='".$_POST['percentage']."', tradingId='".$_POST['tranchclick']."',tradevalue='".$_POST['ddlyear']."',effectiveprice ='".$_POST['effectiveprice']."',baseload='".$_POST['baseload']."', trade='".$tradeper."',tradeDate='".$_POST['creationdate']."' WHERE tradeId=".$_POST['entertradeId']."";
	    $conn->query($sqlTrade);
	    $_SESSION['updatedtrading'] = time();
	    header("location:editentertrade.php?id=".$_POST['entertradeId']);
	}



// if($tradeper == 'Calendar Yearly'){

// }
// echo $tradeper;
// $incraseclick = $clincherow[0]['availableclick']+1;
// $tradeperiod = $clincherow[0]['periodsId'];

// $gettingrade = "SELECT tradevolume FROM enter_trade WHERE supplycontractid='".$singlerow[0]['contract_id']."'";
// $gettingrade = mysqli_query($conn, $gettingrade);
// $tradevol = array();
// while ($rowss = mysqli_fetch_assoc($gettingrade)) {
// 	$tradevol[] = numberreturn($rowss['tradevolume']);
// }
// $sumvaluetrade = array_sum($tradevol);
// $trancheclick = $_POST['trancheclick'];
// $avaliableclick = $checkedclick - $trancheclick;
// $totalconsumption = numberreturn($singlerow[0]['totalAnualConsumption']);
// $consumptionrate = numberreturn($singlerow[0]['totlconsumption']);
// $givevalue = numberreturn($_POST['tradevolume']);
// $sumconsumption = $sumvaluetrade + $consumptionrate+$givevalue;
// $availableconsumption = $totalconsumption - $sumconsumption;

// if($totalconsumption <= $sumconsumption){
// 	echo 'You have only '.$availableconsumption.'consumption';
// 	echo 'you can\'t add more trade';
	
// 	die();
// }else if ($trancheclick  <= $checkedclick) {
// 	echo 'You have only '.$avaliableclick.'clicks';
// 	echo 'you can\'t add more trade';
// 	die();
// }else{

// 	$tradva = '';
// 	foreach ($_POST['Tradeperiod'] as $period){ 
//     	$tradva =$period;
// 	}
	
//     $sqlavil = "UPDATE nus_tradeperiods SET transperiodclick ='".$courrentdata."' WHERE tradePerId=".$_POST['tranchclick']."";
//     $conn->query($sqlavil);
//     $sql = "INSERT INTO enter_trade (clientId, supplycontractid, tradevolume, baseload, effectiveprice, trade, tradevalue, tradingId) VALUES ('".$singlerow[0]['clientId']."', '".$singlerow[0]['contract_id']."','".$_POST['tradevolume']."', '".$_POST['baseload']."', '".$_POST['effectiveprice']."','".$tradva."', '".$_POST['tradename']."', '".$_POST['tranchclick']."')";
//     $conn->query($sql);

// }

function numberreturn($value){
	$toremovecomma = intval(preg_replace('/[^\d. ]/', '', $value));
	return $toremovecomma;
}

function getMonthsInRange($startDate, $endDate)
{
    $months = array();

    while (strtotime($startDate) <= strtotime($endDate)) {
        $months[] = array(
            'year' => date('Y', strtotime($startDate)),
            'month' => date('m', strtotime($startDate)),
        );

        // Set date to 1 so that new month is returned as the month changes.
        $startDate = date('01 M Y', strtotime($startDate . '+ 1 month'));
    }

    return $months;
}
?>
