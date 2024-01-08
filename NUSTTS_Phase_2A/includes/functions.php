<?php 
require_once('./dbconn.php');
class libFunc
{	

	public static function getclientname($clintId){
		global $conn;
		$countryName ='';
		$getUserRole = "SELECT clientcompany FROM clientcompanydata WHERE id=".$clintId."";
        $result = $conn->query($getUserRole);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               $countryName = $row['clientcompany'];
            }
        }
		return $countryName;
	}
	public static function getclientdata($clinetid){
		global $conn;
		$getdatas = "SELECT nc.clientcompany, ncs.countryName FROM clientcompanydata nc LEFT JOIN nus_countries ncs ON ncs.countryId=nc.country WHERE nc.id=".$clinetid."";
		$result = $conn->query($getdatas);
		$clientname = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			    $clientname[] = $row;
			    
			}
		}
		return $clientname;
	}
	public static function getparentname($clientId){
		global $conn;
		$getdatas = "SELECT parentcompany  FROM clientcompanydata WHERE id=".$clientId."";
		$result = $conn->query($getdatas);
		$parentname = '';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			   $parentname = $row['parentcompany'];
			}
		}
		return $parentname;
	}
	public static function getcountclient($parentname){
		global $conn;
		$getdatas = "SELECT COUNT(clientcompany) as counts FROM clientcompanydata WHERE parentcompany='".$parentname."'";
		$result = $conn->query($getdatas);
		$parentname = 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			   $parentname = $row['counts'];
			}
		}
		return $parentname;
	}
	public static function getsuppliedId($contract){
		global $conn;
		$getdatas = "SELECT supplierId FROM nus_supply_contract WHERE contract_id='".$contract."'";
		$result = $conn->query($getdatas);
		$parentname = 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			   $parentname = $row['supplierId'];
			}
		}
		return $parentname;
	}
	
		public static function getsuppliedIds($contract,$clientId){
		global $conn;
		$getdatas = "SELECT supplierId FROM nus_supply_contract WHERE contract_id='".$contract."' AND clientId='".$clientId."'";
		$result = $conn->query($getdatas);
		$parentname = 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			   $parentname = $row['supplierId'];
			}
		}
		return $parentname;
	}
	
	public static function getyears($tradename, $tradeId){
		global $conn;
		$getyearsTrade = '';
		if($tradename == 'Calendar Yearly'){
            $getyearsTrade = "SELECT calenderyear as years FROM nus_calenderyear WHERE calenderId = ".$tradeId."";
        }
        if($tradename == 'Calendar Monthly'){
            $getyearsTrade = "SELECT year as years FROM nus_calendermonth WHERE monthId = ".$tradeId."";
        }
        if($tradename == 'Calendar Quarterly'){
            $getyearsTrade = "SELECT yearoftrade as years FROM nus_calenderquarter WHERE querterid = '".$tradeId."'";
        }
        if($tradename == 'Season'){
            $getyearsTrade = "SELECT yeartrade as years FROM nus_season WHERE seasonId = ".$tradeId."";
        }
        $result = $conn->query($getyearsTrade);
        $arrayofyear = 0;
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			   $arrayofyear = $row['years'];
			}
		}
        return $arrayofyear;
	}
	public static function getlastserialno($clientid){
		global $conn;
		$getdatas = "SELECT serialno FROM clientcompanydata WHERE id='".$clientid."'";
		$result = $conn->query($getdatas);
		$parentname = 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			   $parentname = $row['serialno'];
			}
		}
		return $parentname;
	}
	
}


?>

