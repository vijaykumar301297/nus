
<?php
include 'dbconn.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/entertrade.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/functions.js"></script> -->
    <title>NUS TTS System | Enter trade</title>
    <link rel="icon" href="img/social-square-n-blue.png">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

.suplycnt{
    margin: 40px 0 0 300px;
}
.row{
  display: flex;
}
.col-md-8{
  width: 55%;
  margin-right: 10px;
}
.col-md-6{
  width: 50%;
}
.col-md-4{
  width: 40%;
}
.creatdate{
      display: flex;
    border: beige;
    padding: 10px;
    margin: 15px 0 15px 10px;
    background-color: rgb(255, 255, 255);
    cursor: pointer;
    color: #345DA6;
    border: 1px solid #1363F1;
    border-radius: 6px;
    width: 668px;
    /* width: 570px; */
    height: 40px;

}
/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}
#nextBtn{
  float: right;
}
/*input[type=range]{
  background: #E3EBF6;
  border: none;
}*/
/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
.cat{
  margin: 4px;
  
 /* overflow: hidden;*/
  float: left;
}

.cat label {
  float: left;
  line-height: 3.0em;
  /* width: 10.0em;  */
  height: 3.0em;
  font-size: 15px !important;
}

.cat label span {
  text-align: center;
  padding: 3px 0;
  display: block;
  background-color: #fff;
  border-radius:6px; 

}

.cat label input {
  position: absolute;
  display: none;
 
}
/* selects all of the text within the input element and changes the color of the text */
/*.cat label input + span{color: #fff;}
*/

/* This will declare how a selected input will look giving generic properties */
.cat input:checked + span {
    color: #ffffff;
    
}

.disabledbutton {
   color: grey;
   border:1px solid grey;
    opacity: 0.5;
}

.cat label span img{
  filter: grayscale(100%);
}
.activebutton{
  color: #1363F1!important;
  border:1px solid #1363F1;
  opacity: 1;
}


label {
  color: #345DA6;
  font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-size: 15px;
  font-weight: 400;
  
    line-height: 152.4%;
    /*display: flex;*/
    margin-bottom: 6px;
    align-items: center;
    letter-spacing: -0.01em;
    padding: 0px!important;
    /*margin: 0 0 -15px 0;*/
}
.catw{
    display: inline-block;
}
.padmd0 h3{
  margin-top: 6px;
  font-size: 26px;
  color: #345DA6;

}
.padmd0 select{
  border:1px solid lightgrey;
  box-shadow: none;
  color: #000;
  height: 38px!important;
  background-color: rgb(255, 255, 255);
    cursor: pointer;
    color: #345DA6;
    border: 1px solid #1363F1;
    border-radius: 6px;
}
.padmd0 h6{
  text-transform: capitalize;
  color: #345DA6;
  font-size: 14px;
  /* letter-spacing: 1px; */
}
.switch {
  display: inline-block;
  height:27px;
  position: relative;
  width: 55px;
  top: 14px;
}

.switch input {
  display:none;
}

.switchs {
  display: inline-block;
  height: 27px;
  position: relative;
  width: 55px;
  top: 14px;
}

.switchs input {
  display:none;
}

.sliders {
  background-color: #ccc;
  bottom: 0;
  cursor: pointer;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  transition: .4s;
}
.tradevolume input{
  width: 70%;
}

.sliders:before {
  background-color: #fff;
  bottom: 4px;
  content: "";
  height: 20px;
  left: 4px;
  position: absolute;
  transition: .4s;
  width: 20px;
}

input:checked + .sliders {
  background-color: #1363F1;
}

input:checked + .sliders:before {
  transform: translateX(26px);
}

.sliders.rounds {
  border-radius: 34px;
}

.sliders.rounds:before {
  border-radius: 50%;
}

.slider {
  background-color: #ccc;
  bottom: 0;
  cursor: pointer;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  transition: .4s;
}

.slider:before {
  background-color: #fff;
  bottom: 4px;
  content: "";
  height: 20px;
  left: 4px;
  position: absolute;
  transition: .4s;
  width: 20px;
}

input:checked + .slider {
  background-color: #1363F1;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.contrac{
    background: white;
    border-radius: 8px;
}
.client{
    position: relative;
}
.searchs{
    position: absolute;
    top: 5px;
    left: 3px;
    width: 10%;
}
.page select{
    font-size: 10px;
    padding: 7px!important;
}
.flitr{
    position: absolute;
    right: 5px;
    top: 5px;
}
.fullwidth{
  width: 100%;
  float: unset!important;
}
.clientbr ul{
    padding-inline-start:0px;
}
.clientbr ul li{
    display: inline;
}
.clientbr ul li a{
    padding: 7px;
    text-decoration: none;
}
.client input[type="text"]{
    padding-left: 25px;
}
.units{
  display: none;
}
.indexcl{
  display: none;
}
.page{
    position: absolute;
    right: 15%;
    top: 5px;
}
.sttab{
  width: 77%;
}
.bfg{
  height: 1px;
  background-color: lightgrey;
}
div label input {margin-right: 100px;}
/*
This following statements selects each category individually that contains an input element that is a checkbox and is checked (or selected) and chabges the background color of the span element.
*/
/* .action input:hover +span{
  background-color: #fff;
  color: blue;
  border:1px solid blue;
  padding: 0px 10px;

} */
.action input:hover +span{
  background-color: #fff;
  opacity: 1;
  color: #1363F1;
  border: 1px solid #1363F1;
  padding: 0px 10px;
}
/* .action input:hover +span img{
  filter: invert(25%) sepia(94%) saturate(3383%) hue-rotate(215deg) brightness(98%) contrast(92%);
} */
.action input:checked + span{
  background-color: #fff;
  opacity: 1;
  color: #1363F1;
  border: 1px solid #1363F1;
  padding: 0px 10px;
}
/* .action input:checked + span img{
  filter: invert(25%) sepia(94%) saturate(3383%) hue-rotate(215deg) brightness(98%) contrast(92%);
} */

/*form {
    width: 400px;
    padding: 30px;
    border-radius: 15px;
    margin: 80px 0 0 0;
}*/
.chosen-container-single .chosen-single{
    height: 35px!important;
    padding: 6px 0px 0px 8px!important;
}
.tab {
        display: none;
      }
.widse{
    width:100%;
    margin: auto;
}
      .tab img {
        margin: 3px;
      }
      .padmd0{
   
    position: absolute;
    width: 46%;
    left: 58%;
    top: 5%;
    transform: translate(-50%, 0%);
}
body{
  background: #F9FBFD;
}
input[type=range] {
  -webkit-appearance: none;
  margin: 0px 0;
  width: 100%;
  border: none;
  background: #F9FBFD;
}
input[type=range]:focus {
  outline: none;
}
input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  height: 5px;
  cursor: pointer;
 
  background: #E3EBF6;
  border-radius: 1.3px;
  
}
input[type=range]::-webkit-slider-thumb {
  box-shadow: 1px 1px 1px rgba(0,0,0,0.5);
  border: 3px solid #fff;
  height: 17px;
  width: 17px;
  border-radius: 50%;
  background: #1363F1;
  
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -8px;
}
.allowdvi{
  padding-top: 24px;
}
input[type=range]:focus::-webkit-slider-runnable-track {
  background: #E3EBF6;
}
.diviy p{
  margin-bottom: 0px;
}
input[type=range]::-moz-range-track {
  width: 100%;
  height: 8.4px;
  cursor: pointer;
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  background: #3071a9;
  border-radius: 1.3px;
  border: 0.2px solid #010101;
}
input[type=range]::-moz-range-thumb {
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  border: 1px solid #000000;
  height: 36px;
  width: 16px;
  border-radius: 3px;
  background: #ffffff;
  cursor: pointer;
}
input[type=range]::-ms-track {
  width: 100%;
  height: 8.4px;
  cursor: pointer;
  background: transparent;
  border-color: transparent;
  border-width: 16px 0;
  color: transparent;
}
input[type=range]::-ms-fill-lower {
  background: #2a6495;
  border: 0.2px solid #010101;
  border-radius: 2.6px;
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
}
input[type=range]::-ms-fill-upper {
  background: #3071a9;
  border: 0.2px solid #010101;
  border-radius: 2.6px;
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
}
input[type=range]::-ms-thumb {
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  border: 1px solid #000000;
  height: 36px;
  width: 16px;
  border-radius: 3px;
  background: #ffffff;
  cursor: pointer;
}
input[type=range]:focus::-ms-fill-lower {
  background: #E3EBF6;
}
input[type=range]:focus::-ms-fill-upper {
  background: #E3EBF6;
}

.form-control {
  background-color: rgb(255, 255, 255);
cursor: pointer;
color: #345DA6;
border: 1px solid #1363F1;
border-radius: 6px 0px 0px 6px;
}

.input-group-addon {
 
  background-color: rgb(255, 255, 255);
  cursor: pointer;
  color: #345DA6;
  border: 1px solid #1363F1;
/* border-radius: 6px; */
border-radius: 0 6px 6px 0;

}

#cancelBtn, #prevBtn {
  background-color: rgb(255, 255, 255);
cursor: pointer;
color: #345DA6;
border: 1px solid #1363F1;
border-radius: 6px;
}

.seasonyear {
    display:none;
    margin: 0 0 0 12px;
}
.calendarquater {
    display:none;
    margin: 0 0 0 12px;
}
.calendarmonths{
    display:none;
    margin: 0 0 0 12px;
}

#calenderseason {
    padding: 0 20px;
    
}

#monthyear {
    width: 650px;
    height: 33px;
}

#yearc {
    padding: 0 10px;
}

#quarteryear{
    padding: 0 10px;
}
#monthsyear {
    padding: 0 10px;
}
#checkc{
    margin: 0 0 0 7px;
}
/* #effectiveprices {
    position: absolute;
    bottom: 30%;
} */

#Q1 {
    padding: 0px 16px 0px;
    gap:10px;
}

#Q2{
    padding: 0px 16px 0px;
    gap:10px;
}
#Q3 {
    padding: 0px 16px 0px;
    gap:10px;
}
#Q4 {
    padding: 0px 16px 0px;
    gap:10px;
}

#aprsep {
    padding: 0px 16px 0px;
}

#octmar {
    padding: 0px 16px 0px;

}
/*#effectiveprices {
    margin: 4px 0 10px 120px;

}*/
#baseloadprices {
    margin: 4px  0 10px 0px;
}
.cur {
  position:absolute;
  z-index:1;
}
/*#tradevalue {
  width:74%;
}*/

.input-group-addon {
  position: absolute;
  top: 0;
  padding: 10.5px 12px;
  font-size: 14px;
  font-weight: 400;
  line-height: 1;
  /* color: #555; */
   text-align: center;
  border-radius: 0 6px 6px 0;
  /* background-color: #eee; */
  /* border: 1px solid #ccc; */
  /* border-radius: 4px; */

      /* background-color: rgb(255, 255, 255) !important;
  cursor: pointer !important;
  color: #345DA6 !important;
  border: 1px solid #1363F1 !important; */
}
.input-group {
  position: relative;
  /* display: table; */
  border-collapse: separate;
}
.baslad input{
  width: 100%;
}
.tradevolume {
  margin:0 0 0 15px;
}
    </style>
</head>
<?php
  include 'includes/functions.php';
  $functions = new libFunc();
?>
<body>
        <?php
              if(isset($_SESSION['errorclick'])&&((time() - $_SESSION['errorclick']) < 2)) {
                
                echo '<script> toastr.warning("click not available", "Trade ");</script>';
                if((time() - $_SESSION['errorclick']) > 2){
                    unset($_SESSION['errorclick']);
                }
              } 
               if(isset($_SESSION['errorconsumption'])&&((time() - $_SESSION['errorconsumption']) < 2)) {
                
                echo '<script> toastr.warning("consumption not available", "Trade ");</script>';
                if((time() - $_SESSION['errorconsumption']) > 2){
                    unset($_SESSION['errorconsumption']);
                }
              } 
              if(isset($_SESSION['updatedtrading'])&&((time() - $_SESSION['updatedtrading']) < 2)) {
                  
                  echo '<script> toastr.success("successfully Updated", "Trade data");</script>';
                  if((time() - $_SESSION['updatedtrading']) > 2){
                      unset($_SESSION['updatedtrading']);
                  }
                } 
              
             ?>    
    <div class="containertrade">
        <form action="updateentertrade.php" method="POST" autocomplete="off">
            <div class="header">
                <h2 class="entry">Trade entry</h2>
                <h1 class="trade">Edit trade entry</h1>
            </div>
            <?php
            $tradedata = array();
            $entertrade ="SELECT * FROM enter_trade WHERE tradeId=".$_GET['id']."";
            $resultstrade = $conn->query($entertrade);
            if ($resultstrade->num_rows > 0) {
              while($row = $resultstrade->fetch_assoc()) {
                $tradedata[] = $row;
              }
            }
          
            ?>
            <div class="contents">
                <div class="clientDetails">
                    <label class="clientData">Parent</label>
                        <select  id="client" name="clientcompany" onchange="parentdetails(this.value)">
                            <option selected disabled>Select Parent</option>
                                
                   <?php

                    $getparent =array();
                    $getparentdetails = "SELECT * FROM parentcompanydata";
                    $results = $conn->query($getparentdetails);
                        if ($results->num_rows > 0) {
                            while($row = $results->fetch_assoc()) {
                                $getparent[] = $row;
                            }
                        }
                       
                        foreach ($getparent as $key => $valueparent) {
                          $selected ='';
                          if($valueparent['parentcompany'] == $tradedata[0]['parentId']){
                              $selected = 'selected';
                          }
                          
                          ?>
                            <option value="<?=$valueparent['parentcompany']?>" <?=$selected?>><?=$valueparent['parentcompany']?></option>
                            
                        <?php
                        }
                        ?>
                    </select>
                    
                </div>
                <div class="clientDetails">
                    <label class="clientData">Client</label>
                        <select  id="client" class="clientcom" onchange="clientChange(this.value)" name="clientcompany">
                          <?php
                          $getclient = "SELECT * FROM clientcompanydata WHere state ='Active'";
                          $resultclient = $conn->query($getclient);
                          $clientdata  = array();
                          
                          if ($resultclient->num_rows > 0) {
                            while($row = $resultclient->fetch_assoc()) {
                                $clientdata[] = $row;
                            }
                          }
                          
                          foreach ($clientdata as $key => $valueclient) {
                          $selected ='';

                          if($valueclient['id'] == $tradedata[0]['clientId']){
                              $selected = 'selected';
                          }
                          
                          ?>
                            <option value="<?=$valueclient['id']?>" <?=$selected?>><?=$valueclient['clientcompany']?></option>
                            
                        <?php
                        }
                        ?>
                        </select>
                    
                </div>
            <br>
           
            <input type="hidden" name="supplierid" class="suppId">
            <input type="hidden" class="tradename" name="tradename" value="<?=$tradedata[0]['quartval']?>">
            <input type="hidden" name="entertradeId" value="<?=$_GET['id']?>">
            <!-- <input type="hidden" class="trancheclick" name="trancheclick"> -->
            <input type="hidden" class="tradeid" name="tranchclick" value="<?=$tradedata[0]['tradingId']?>">
            <?php
            echo $tradedata[0]['tradequarvol'];
            ?>
            <input type="hidden" class="totalanual" value="<?=$tradedata[0]['tradequarvol']?>">
            <div class="contractDetails">
                <label class="contractData">Contract</label>
                    <select id="contract" name='clientId' onchange="contractTerm(this.value)">
                        <?php
                          $getcontract = "SELECT * FROM nus_supply_contract";
                          $getcontract = $conn->query($getcontract);
                          $contract  = array();
                          
                          if ($getcontract->num_rows > 0) {
                            while($row = $getcontract->fetch_assoc()) {
                                $contract[] = $row;
                            }
                          }
                          
                          foreach ($contract as $key => $contractdata) {
                          $selected ='';

                          if($contractdata['contract_id'] == $tradedata[0]['supplycontractid']){
                              $selected = 'selected';
                          }
                          
                          ?>
                            <option value="<?=$contractdata['contract_id']?>" <?=$selected?>><?=$contractdata['contract_id']?></option>
                            
                        <?php
                        }
                        ?>
                    </select>
                    <!-- <option id= "nusclient" class="clients" onchange="showdiv('parent', this)">NUS Client  </option> -->
            </div>
            <div class="contractDetails">
                <label class="contractData">Trade execution date</label>
                    <input type="date" name="creationdate" class="creatdate" value="<?=date('Y-m-d',strtotime($tradedata[0]['tradeDate']))?>">
                    <!-- <option id= "nusclient" class="clients" onchange="showdiv('parent', this)">NUS Client  </option> -->
            </div>
            <input type="hidden" class="contractTerm" >
            <div class="headers">
                <div>
                    <span class="tradePeriod">Trade period</span>
                    <span class="year">Year</span>
                </div>
            </div>
            <br>
            <div id = "checkc" style="display: inline-block;">
                        <div class="cat action">
                         <label>
                            <input type="checkbox" value="Calendar Yearly" name="Tradeperiod[]" class="Tradeperiod"  

                            <?php
                            if($tradedata[0]['trade'] == 'Calendar Yearly'){
                              echo 'checked';
                            }else{
                              echo 'disabled';
                            }
                            ?>
                            ><span id = "yearc" class="disabledbutton act">Calendar Year</span>
                         </label>
                      </div>
                      <div class="cat action">
                         <label>
                            <input type="checkbox" value="Calendar Quarterly"  name="Tradeperiod[]" class="Tradeperiod"
                            <?php
                            if($tradedata[0]['trade'] == 'Calendar Quarterly'){
                              echo 'checked';
                            }else{
                              echo 'disabled';
                            }
                            ?>
                            ><span id = "quarteryear" class="disabledbutton dis">Calendar Quarters</span>
                         </label> 
                      </div>
                      <div class="cat action">
                         <label>
                            <input type="checkbox" value="Calendar Monthly"  name="Tradeperiod[]" class="Tradeperiod" 
                            <?php
                            if($tradedata[0]['trade'] == 'Calendar Monthly'){
                              echo 'checked';
                            }else{
                              echo 'disabled';
                            }
                            ?>
                            ><span id="monthsyear" class="disabledbutton dis">Calendar Month</span>
                         </label> 
                      </div>
                      <div class="cat action">
                         <label>
                            <input type="checkbox" value="Season"  name="Tradeperiod[]" class="Tradeperiod"
                            <?php
                            if($tradedata[0]['trade'] == 'Season'){
                              echo 'checked';
                            }else{
                              echo 'disabled';
                            }
                            ?>
                            ><span id = "calenderseason" class="disabledbutton dis">Season</span>
                         </label> 
                      </div>
                      
                     
                      <div class="cat action">
                        <?php
                        // $getyearsdata = $functions->getyears($tradedata[0]['trade'], $tradedata[0]['nustradeId']);
                        ?>
                        <select id="ddlYears" name="ddlyear">
                            <?php
                            $sqlTrade = '';
                            $getyearsTrade = '';
                            $supplierid = $functions->getsuppliedId($tradedata[0]['supplycontractid']);
                            echo  $supplierid;
                            if($tradedata[0]['trade'] == 'Calendar Yearly'){
                              $sqlTrade = "SELECT tradevalue as years FROM enter_trade WHERE tradeId = ".$_GET['id']."";
                              // $getyearsTrade = "SELECT calenderyear as years FROM nus_calenderyear WHERE supplierid=".$supplierid." AND tradeId = ".$tradedata[0]['tradingId']."";
                            }
                            if($tradedata[0]['trade'] == 'Calendar Monthly'){
                              $sqlTrade = "SELECT tradevalue as years FROM enter_trade WHERE tradeId = ".$_GET['id']."";
                            }
                            if($tradedata[0]['trade'] == 'Calendar Quarterly'){
                              $sqlTrade = "SELECT tradevalue as years FROM enter_trade WHERE tradeId = ".$_GET['id']."";
                            }
                            if($tradedata[0]['trade'] == 'Season'){
                              $sqlTrade = "SELECT tradevalue as years FROM enter_trade WHERE tradeId = ".$_GET['id']."";
                            }
                            $contract_qry = mysqli_query($conn, $sqlTrade);
                            $arrayofyear = [];
                            while ($contract_row = mysqli_fetch_assoc($contract_qry)) {
                              $arrayofyear[] = $contract_row['years'];
                            }
                            print_r($arrayofyear);
                            $arryunique = array_unique($arrayofyear);
                            $printdata ='';
                            foreach ($arryunique as $key => $value) {
                              $printdata .='<option value='.$value.'>'.$value.'</option>';
                            }
                             
                            
                            echo $printdata;
                            ?>
                            
                        </select>


                    </div>
                    </div>
                    <div class="dynamiccheckbox">
                        <div class="seasonyear">

                       <label for="">Season</label>
                        <div style="display: inline-block;">
                            <div class="cat action">
                                <label>
                                    <input type="checkbox" value="oct-mar" name="seasonname[]" class="seasonname"  
                                    <?php
                                    if($tradedata[0]['quartval'] == 'oct-mar'){
                                      echo 'checked';
                                    }
                                  ?>
                                    ><span id ="octmar" class="disabledbutton act">Oct-Mar</span>
                                </label>
                            </div>

                            <div class="cat action">
                                <label>
                                    <input type="checkbox" value="apr-sep"  name="seasonname[]" class="seasonname"
                                    <?php
                                    if($tradedata[0]['quartval'] == 'apr-sep'){
                                      echo 'checked';
                                    }
                                  ?>
                                   ><span id = "aprsep" class="disabledbutton dis">Apr-Sep</span>
                                </label> 
                            </div>
                        </div>
                    </div>

                    <div class="calendarquater">

                        <label for="">Quarter</label>
                        <div style="display: inline-block;">
                            <div class="cat action">
                                <label>
                                    <input type="checkbox" value="q1" name="Quarter[]" class="Quarter" 
                                    <?php
                                    if($tradedata[0]['quartval'] == 'q1'){
                                      echo 'checked';
                                    }
                                  ?>><span id = "Q1" class="disabledbutton act">Q1</span>
                                </label>
                            </div>

                            <div class="cat action">
                                <label>
                                    <input type="checkbox" value="q2"  name="Quarter[]" class="Quarter"
                                    <?php
                                    if($tradedata[0]['quartval'] == 'q2'){
                                      echo 'checked';
                                    }?>
                                   ><span id = "Q2" class="disabledbutton dis">Q2</span>
                                </label> 
                            </div>

                            <div class="cat action">
                                <label>
                                    <input type="checkbox" value="q3" name="Quarter[]" class="Quarter" 
                                    <?php
                                    if($tradedata[0]['quartval'] == 'q3'){
                                      echo 'checked';
                                    }?>
                                  ><span id = "Q3"class="disabledbutton act">Q3</span>
                                </label>
                            </div>

                            <div class="cat action">
                                <label>
                                    <input type="checkbox" value="q4"  name="Quarter[]" class="Quarter"
                                     <?php
                                    if($tradedata[0]['quartval'] == 'q4'){
                                      echo 'checked';
                                    }?>
                                     ><span  id = "Q4"class="disabledbutton dis">Q4</span>
                                </label> 
                            </div>
                        </div>
                        </div>

                        <div class="calendarmonths">

                            <label for="">Calandar Month</label>
                            <div style="display: inline-block;">
                            <select id="monthyear" class="form-control" name= "month">

                                   <option value="">Please Select month</option>
                            <?php 
                                $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];                            
                                $monthvalue = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']; 
                                for ($i=0;$i<count($month);$i++) {
                                    $index = array_search($month[$i], $month);
                                    $selected = '';
                                    if($monthvalue[$index] == $tradedata[0]['quartval']){
                                      echo $selected ='selected';
                                    }
                                    ?> 
                                   
                                   <option value="<?=$monthvalue[$index]?>" <?=$selected?>><?=$month[$i]?></option>
                               
                                <?php }
                            ?>
                                 </select>
                            </div>
                        </div>
<br>
<!-- <br> -->
                        <!-- <div class="baseload">
                            <label for="baseLoad" class= "loadprice">Base load price</label>
                            <br>
                            <input type="text" placeholder="0.00">

                            <label for="effectiveprice" class="effectiveprice">Effective price</label>
                            <br>
                            <input type="text" placeholder="0.00"> 
                        </div> -->

                        <!-- <div>
                          <label for="tradevolume">Trade Volume</label>
                                               
                          <input type="text" name="" id="tradevalue" placeholder="Enter Fixed Consumption"><img class="cur" src="img/form-addon.svg">

                        </div> -->
                        <div class="row">
                          <div class="col-md-8">
                            <h3 style="margin-left: 10px; color:#345DA6">Aggregate Trade volume for the trade period</h3>
                            <br>
                            <div class="row">
                              <div class="col-md-6">
                             <div class="tradevolume">
                              <input type="hidden" class="percentagecal" name="percentagecal">
                              <input type="hidden" class="clicktriches" name="clicktriches">
                                
                                <div class="input-group">
                                    <input class="form-control left-border-none mwhtrade" id="tradevalue"  onkeypress="return CheckNumerics()" onkeyup="FormatCurrencys(this)" type="text" placeholder="0.00" name="mwh" value ="<?=$tradedata[0]['mwh']?>" <?=($tradedata[0]['mwh'] == '')?'readonly':''?>>
                                    <span class="input-group-addon transparent">
                                  MWh</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                             <div class="tradevolume">
                              <input type="hidden" class="clicktriches" name="clicktriches">
                                <div class="input-group">
                                    <input class="form-control left-border-none mwhpercentage" id="tradevalue"  placeholder="0%" type="text" name="percentage" value ="<?=$tradedata[0]['percentage']?>" <?=($tradedata[0]['percentage'] == '')?'readonly':''?> >
                                    <span class="input-group-addon transparent">
                                  %</span>
                            </div>
                          </div>
                        </div>

                            </div>
                            <div class="row baslad" style="padding-top: 10px;">
                              <div class="col-md-6">
                                
                      <div id = "baseloadprices" class="cat action">
                            <label for="baseLoad" class= "loadprice">Base load price</label>
                            <br>
                            <input class ="loadprice" type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="<?=$tradedata[0]['baseload']?>" placeholder="0.00" name="baseload">
                      </div>
                              </div>
                              <div class="col-md-6">
                                <div id ="effectiveprices" class="cat action">
                            <label for="effectiveprice" class="effectiveprice">Effective price</label>
                            <br>
                            <input class ="effectiveprice" type="text" onkeypress="return CheckNumeric()" value="<?=$tradedata[0]['effectiveprice']?>" onkeyup="FormatCurrency(this)" placeholder="0.00" name="effectiveprice"> 
                          </div>
                      
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <input type="hidden" class="tradename" name="tradename">
                     
                            <h3 style="color:#345DA6">Est.percentage Volume</h3>
                           <br>
                            <input type="hidden" class="clicktriches" name="clicktriches">
                                
                                <div class="input-group">
                                    <input class="form-control left-border-none tradevol"  type="text" value="<?=$tradedata[0]['tradevolume']?>" placeholder="0.00" name="tradevolume" readonly style="background: #f5f2f2!important" >
                                    <span class="input-group-addon transparent">
                                  MWh</span>
                            </div>
                          </div>
                         
                        </div>
                          
                        
                          
                      
                      </div>
                      
                        
                        
                      
                     
                        <!-- <div class="effectiveprice">
                            <label for="effectiveprice" class="effectiveprice">Effective price</label>
                            <br>
                            <input type="text" placeholder="0.00"> 
                        </div> -->
                    <br>
                    <br>
                            <button class="enterTradebtn">Update trade</button>
                    </div>
                    </div>
                </div>
        </form>
    </div>
</body>
<script type="text/javascript">
     
  
  

</script>
<script type="text/javascript">
  $('.mwhpercentage').on('keyup', function(){
    var val = $(this).val();
    var consumpt = $('.totalanual').val();
    var percentage = ((val/ 100) * consumpt).toFixed(2);
    $('.tradevol').val(percentage);
    console.log("Hey boy");
  })
  

         function FormatCurrencys(ctrl) {
                    alert("Hello");
                    console.log("Event Keys = "+ctrl.value);
                    var num = ctrl.value;
                    var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
                    if(str.indexOf(".") > 0) {
                      parts = str.split(".");
                      str = parts[0];
                    }
                    str = str.split("").reverse();
                    for(var j = 0, len = str.length; j < len; j++) {
                      if(str[j] != ",") {
                        output.push(str[j]);
                        if(i%3 == 0 && j < (len - 1)) {
                          output.push(",");
                        }
                        i++;
                      }
                    }
                    formatted = output.reverse().join("");
                    var number = formatted + ((parts) ? "." + parts[1].substr(0, 2) : "");
                    ctrl.value=number;
                    $('.tradevol').val(number);
                    console.log("Event Keys = "+ctrl.value);
                }

                function CheckNumerics() {
                    console.log("Event pressed"+event.keyCode);
                    return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;
                }
                function FormatCurrency(ctrl) {
                     var num = ctrl.value;
                    var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
                    if(str.indexOf(".") > 0) {
                      parts = str.split(".");
                      str = parts[0];
                    }
                    str = str.split("").reverse();
                    for(var j = 0, len = str.length; j < len; j++) {
                      if(str[j] != ",") {
                        output.push(str[j]);
                        if(i%3 == 0 && j < (len - 1)) {
                          output.push(",");
                        }
                        i++;
                      }
                    }
                    formatted = output.reverse().join("");
                    var number = formatted + ((parts) ? "." + parts[1].substr(0, 2) : "");
                    ctrl.value=number;
                    
                }

                function CheckNumeric() {
                    return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;
                }
                </script>
<script>
    $('.Tradeperiod').each(function() {
        $(this).on('change',function() {
            if($(this).prop('checked',true)) {
                if($(this).val()=='Calendar Yearly') {
                  $('.year').css('display','inline');
                    $('#ddlYears').css('display','block');
                }
                // else{
                //   $('.year').css('display','none');
                //   $('#ddlYears').css('display','none');
                // }
                if($(this).val()=='Season') {
                    $('.seasonyear').css('display','block');
                }
                else{
                    $('.seasonyear').css('display','none');
                }
                if($(this).val()=='Calendar Quarterly') {
                  
                    $('.calendarquater').css('display','block');
                }
                else{
                    $('.calendarquater').css('display','none');
                }
                if($(this).val()=='Calendar Monthly') {
                    $('.calendarmonths').css('display','block');
                }
                else{
                    $('.calendarmonths').css('display','none');
                }
            }
            
        })
    })

    function clientChange(val){
        $.ajax({
            url: 'ajax/contract.php',
            type: "POST",
            data: {
                country_data: val
            },
            success: function(result) {
              

                $('#contract').html(result);

                // console.log(result);
            }
        })
    }
    function contractTerm(contract, contractid){
      console.log(contractid);
       
        $.ajax({
            url: 'ajax/contractTerm.php',
            type: "POST",
            data: {
                contractId: contract
            },
            success: function(result) {

              $('.year').css('display','inline');
             $('#ddlYears').css('display','block');
              var obj = JSON.parse(result);
              console.log(obj);
              var clicktranchobj = JSON.parse(obj.contractTrade);
              console.log(clicktranchobj);
              $('.suppId').val(obj.supId);
              // $('.totalanual').val(obj.consummptionamt);
              var yearbasis = [];
              var trichclick = [];
              var tranchid = [];
              var clicktranch = [];
              // $('.jsonfile').val(JSON.stringify(obj));
              clicktranchobj.forEach(function(clicktranchobj) {
                yearbasis.push(clicktranchobj.periodsId);
                trichclick.push(clicktranchobj.clicktracnches);
                tranchid.push(clicktranchobj.tradePerId);
                clicktranch.push(clicktranchobj.clicktranches);
              });
              console.log(contractid);
              console.log($('.tradename').val());
              $('.Tradeperiod').each(function() {
                  // $(this).trigger('change');
                  
                  $(this).on('change',function(){
                    if(yearbasis.includes($(this).val())){
                      
                      var keyval = yearbasis.indexOf($(this).val());
                      
                      $('.trancheclick').val(trichclick[keyval]);
                      $('.tradeid').val(tranchid[keyval]);
                      $('.percentagecal').val(clicktranch[keyval]);
                      if(clicktranch[keyval] == '% consumption'){
                          $('.mwhtrade').prop('readonly', true);
                          $('.mwhtrade').css({'background':'#f5f2f2'});
                          $('.mwhpercentage').prop('readonly', false);
                          $('.mwhpercentage').css('background','#fff');
                      }
                      if(clicktranch[keyval] == '#MWhs'){
                         $('.mwhtrade').prop('readonly', false);
                         $('.mwhtrade').css('background','#fff');
                         $('.mwhpercentage').css('background','#f5f2f2');
                          $('.mwhpercentage').prop('readonly', true);
                      }
                      $(this).prop('checked',true);

                      if($(this).is(':checked')){

                        if($(this).val() == 'Calendar Yearly'){
                          
                          $.ajax({
                              url: 'js/callbacks/getyears.php',
                              type: "POST",
                              data: {
                                  'type': 'Calendar Yearly',
                                  'suplierid':obj.supId,
                                  'tranchid':tranchid[keyval]
                              },
                              success: function(result) {
                                
                                // $('#ddlYears').html(result);

                                  console.log(result);
                              }
                          })
                         
                          $('#ddlYears').on('change',function(){
                            $('.tradename').val($(this).val());
                            
                          })
                        }
                        if($(this).val() == 'Calendar Monthly'){
                         
                          $.ajax({
                              url: 'js/callbacks/getyears.php',
                              type: "POST",
                              data: {
                                  'type': 'Calendar Monthly',
                                  'suplierid':obj.supId,
                                  'tranchid':tranchid[keyval]
                              },
                              success: function(result) {
                                
                                $('#ddlYears').html(result);

                                  console.log(result);
                              }
                          })
                          $('#monthyear').on('change',function(){
                            $('.tradename').val($(this).val());
                              $.ajax({
                                  url: 'js/callbacks/getconsumptions.php',
                                  type: "POST",
                                  data: {
                                    'type':'Calendar Monthly',
                                    'suplierid':obj.supId,
                                    'year': $('#ddlYears').val(),
                                    'quarterval':$(this).val(),
                                  },
                                  success: function(result) {
                                     $('.totalanual').val(result);
                                     $('.quaranual').val(result);   
                                  }
                                })
                          })
                          
                        }
                        if($(this).val() == 'Calendar Quarterly'){

                          $.ajax({
                              url: 'js/callbacks/getyears.php',
                              type: "POST",
                              data: {
                                  'type': 'Calendar Quarterly',
                                  'suplierid':obj.supId,
                                  'tranchid':tranchid[keyval]
                              },
                              success: function(result) {
                                
                                $('#ddlYears').html(result);

                                  console.log(result);
                              }
                          })
                          $('.tradename').val($('.Quarter:checked').val());

                          $('.Quarter').each(function(){
                            $(this).on('change',function(){
                                $.ajax({
                                      url: 'js/callbacks/getconsumptions.php',
                                      type: "POST",
                                      data: {
                                          'type':'Calendar Quarterly',
                                          'suplierid':obj.supId,
                                          'year': $('#ddlYears').val(),
                                          'quarterval':$(this).val(),
                                          
                                      },
                                      success: function(result) {
                                         $('.quaranual').val(result); 
                                        $('.totalanual').val(result);
                                        
                                      }
                                  })
                              // if(yearbasis.includes($(this).val())){
                                
                              // }
                              
                              // $('.tradename').val($(this).val());
                            })
                          })
                          
                        }
                        if($(this).val() == 'Season'){
                          $.ajax({
                              url: 'js/callbacks/getyears.php',
                              type: "POST",
                              data: {
                                  'type': 'Season',
                                  'suplierid':obj.supId,
                                  'tranchid':tranchid[keyval]
                              },
                              success: function(result) {
                                
                                $('#ddlYears').html(result);

                                  console.log(result);
                              }
                          })
                          $('.tradename').val($('.seasonname:checked').val());
                          $('.seasonname').each(function(){
                            $(this).on('change',function(){
                              $.ajax({
                                  url: 'js/callbacks/getconsumptions.php',
                                  type: "POST",
                                  data: {
                                    'type':'Season',
                                    'suplierid':obj.supId,
                                    'year': $('#ddlYears').val(),
                                    'quarterval':$(this).val(),
                                  },
                                  success: function(result) {
                                     $('.quaranual').val(result);
                                     $('.totalanual').val(result); 
                                  }
                                })
                              $('.tradename').val($(this).val());
                            })
                          })
                         
                        }
                      }
                      
                      
                      // $(this).prop("disabled", false);
                     
                    }else{
                     
                      alert('This Trade Periods not selected ');
                      $(this).prop('checked',false);
                      var notchecked = ($(this).not(":checked").val());
                      if(notchecked == 'Calendar Monthly'){
                        $('.calendarmonths').css('display','none');
                      }
                      // if(notchecked == 'Calendar Yearly'){
                      //   $('#ddlYears').css('display','none');
                      // }
                      if(notchecked == 'Season'){
                         $('.seasonyear').css('display','none');
                      }
                      if(notchecked == 'Calendar Quarterly'){
                         $('.calendarquater').css('display','none');
                      }
                      
                    }
              })
                  
               
              });
              // var contractterm = obj.contractterm;
              // var dates = contractterm.split(",");
              // var fromdate = new Date(dates[0]);
              // var todate = new Date(dates[1]);
              // first = fromdate.getFullYear();
              // second = todate.getFullYear();
              // arr = Array();
              // for(i = first; i <= second; i++) arr.push(i);
              // var months=0;
              // months = (todate.getFullYear() - fromdate.getFullYear()) * 12;
              // months -= fromdate.getMonth();
              // months += todate.getMonth();
           
              // var monthsdata = months+1;
              // var printdata = '';
              //   printdata +='<option >Select the Year</option>';
              // for(i=0;i<arr.length;i++){
               
              //   printdata +='<option value="'+arr[i]+'">'+arr[i]+'</option>';
              // }
              // $('#ddlYears').html(printdata);
              
              
            }
        })
    }
    $('input[type="checkbox"].Tradeperiod').on('change', function() {
   $('input[type="checkbox"].Tradeperiod').not(this).prop('checked', false);
   

});

$('input[type="checkbox"].seasonname').on('change', function() {
    $('input[type="checkbox"].seasonname').not(this).prop('checked',false);
    
});

$('input[type="checkbox"].Quarter').on('change', function() {
    $('input[type="checkbox"].Quarter').not(this).prop('checked',false);
    
});
$(document).ready(function(){
   contractTerm(<?="'".$tradedata[0]['supplycontractid']."'"?>,<?= "'".$tradedata[0]['trade']."'"?>)
   var triggerval = <?php echo "'".$tradedata[0]['trade']."'"?>;
    $('.Tradeperiod:checked').val(triggerval).trigger('change');
  })

</script>


<script type="text/javascript">
  function parentdetails(parentId){
  $.ajax({
      type:'POST',
      url: 'js/callbacks/parentdetails.php',
      data:{
        'parentId':parentId
      
      },
      success: function(data){
        $('.clientcom').html(data);
      }
    });
}
    // window.onload = function () {
    //     //Reference the DropDownList.
    //     var ddlYears = document.getElementById("ddlYears");
 
    //     //Determine the Current Year.
    //     var currentYear = (new Date()).getFullYear();
    //     currentYear += 30;
 
    //     //Loop and add the Year values to DropDownList.
    //     for (var i = 1950; i <= currentYear; i++) {
    //         var option = document.createElement("OPTION");
    //         option.innerHTML = i;
    //         option.value = i;
    //         ddlYears.appendChild(option);
    //     }
    // }
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</html>