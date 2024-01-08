

<?php

include('security.php');

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

    <!-- <link rel="stylesheet" href="css/entertrade.css"> -->

    <!-- <script src="js/jquery.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/functions.js"></script> -->

    <title>NUS TTS System | Generate Report</title>

    <link rel="icon" href="img/social-square-n-blue.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

     <link

      rel="stylesheet"

      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"

    />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  

  

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />



    <script type="text/javascript" src="js/function.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>

        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <link rel="stylesheet" href="css/generatereport.css">

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');


.yearstest p {
    color: #345DA6;
    font-size: 15px;
}
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

  height: 1%;

  padding: 0 0 0 0;

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

  /* margin: 4px; */

  margin: 0 15px 0 2px;

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

  /* padding: 0px 10px; */

  display: block;

  background-color: #fff;

  border-radius:8px; 

  margin: 20px 0px 30px 0;

  /* margin-left: -70px; */



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



.action input:hover +span{

  background-color: #fff;

  color: blue;

  border:1px solid blue;

}

.action input:hover +span{

  background-color: #fff;

  opacity: 1;

  color: #1363F1;

  border: 1px solid #1363F1;

}



.action input:checked + span{

  background-color: #fff;

  opacity: 1;

  color: #1363F1;

  border: 1px solid #1363F1;

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

  /* -webkit-appearance: none; */

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

  height: 50%;

 border-radius: 6px;

}



.input-group-addon {

  text-align: center;

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

  top: 0%;

  width: 50px;

  padding: 10.5px 12px;

  font-size: 14px;

  font-weight: 400;

  line-height: 0.8;

  z-index: 1;

  text-align: center;

  /* color: #555; */

 

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

  /* border-radius: 3px; */

  /* border: 1px solid #1363F1; */

  margin-left:45px ;

}

.baslad input{

  width: 100%;

}

.tradevolume {

  margin:0 0 0 15px;

}

.listingmonthsbas p{

  color: #345DA6;

}

.listingmonthsbas input {

    width: 70%;

}



.form-control {

    background-color: rgb(255, 255, 255);

    cursor: pointer;

    color: #345DA6;

   /* border: 1px solid #1363F1; */
   border: 1.35px solid #1363F1;
   border-radius: 5px !important;

    /* border-radius: 6px 0px 0px 6px; */

}

input {

    padding: 10px 10px;

    /* margin: 2px 10px 3px 8px; */

    width: 245px;

    background-color: rgb(255, 255, 255);

    cursor: pointer;

    color: #345DA6;

    border: 1px solid #1363F1;

    border-radius: 6px;

}

.cons {

    background-color: #fff;

    border-radius: 8px;

    margin: -5px 86px;

    margin-left: -74px;

}



.addclientano {

  border: 5px solid #337ab7;

  border-radius: 5px;

}

.input-group .form-control{

  z-index: unset!important;

  /* padding-left: 60px; */

}

.listingmonthsbas{

  width: 675px;

  margin:20px 0 0 0;

}

.marf{

  padding-top: 8px;

}

.reprttype{

  display: none;

}

.clientwid{

  width: 84%;

}



.copy_values,

effective_values {

  margin:0px 0 0 120px;



}

.month {

  width: 10%;

  margin: 5px 0 0 60px;

}

 .monthData {

  width: 10%;

  margin: 0px 0px 0 55px;

}



.unhedgedEffective {

  position: absolute;

  right: 10%;

  width: 95%;

  top: 5%;

}

.unhedged {

  position: absolute;

  right: 30%;

  width: 95%;

  top: 5%;

}

.badge{

  display: inline-block;

    min-width: 10px;

    padding: 13px 39px;

    font-size: 12px;

    font-weight: 700;

    line-height: 1;

    color: #fff;

    text-align: center;

    white-space: nowrap;

    vertical-align: middle;

    background-color: #3a3faa;

    border-radius: 10px;

}

</style>

</head>

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

              

             ?>



    <div class="containertrade">

        <form action="postgraphs.php" method="POST" autocomplete="off" onsubmit="return validForm()">

            <div class="header">

            <h2 class="entry">Generate Report</h2>

                <h1 id="trades">New Report</h1>

            </div>

            

              <div class="reportdetails">

                <div class="row">

                  <div class="col-md-12 rpoe">

                    <label class="reportdata">Report Type</label>

                    <select id="reportdatas" name='clientId' onchange="reporttype(this.value)">

                        <option value="">Select Report Type</option>

                        <option value="single">Contract Position Report</option>

                        <!-- <option value="multi">Multi Contract Report</option> -->

                        <!-- <option value="international">International Report</option> -->

                        <option value="tradehistry">Trade History Report</option>

                    </select>

                  </div>

                  <div class="col-md-6 multcon">

                    <div style="display: inline-block;">

                        <div class="cat action">

                         <label>

                            <input type="checkbox" value="electricity" name="commodity[]" class="commodityreport" 

                            ><span class="disabledbutton act"><img src="img/electricity-hover.svg"> Electricity</span>

                         </label>

                      </div>

                      <div class="cat action">

                         <label>

                            <input type="checkbox" value="natural gas"  name="commodity[]" class="commodityreport"

                            ><span class="disabledbutton dis"><img src="img/naturalgas.svg"> Natrual Gas</span>

                         </label> 

                      </div>

                    </div>

                  </div>

                  <div class="col-md-6 reprttype">

                    <label>Report Type</label><br>

                    <div style="display: inline-block;">

                        <div class="cat action">

                         <label>

                            <input type="checkbox" value="electricity" name="commodity[]" class="reporttype" 

                            ><span class="disabledbutton act"style="margin: -6px 85px -41px -77px; !important;">Consumption</span>

                         </label>

                      </div>

                      <div class="cat action">

                         <label>

                            <input type="checkbox" value="natural gas"  name="commodity[]" class="reporttype"

                            ><span class="disabledbutton dis"style="margin: -6px 85px -41px -77px; !important;">Price</span>

                         </label> 

                      </div>

                    </div>

                  </div>

                </div>

            </div>

            <div class="single">

            <div class="contents">

            

                <div class="clientDetails">

                    <label class="clientData">Parent</label>

                        <select  id="client" name="parentid" onchange="parentdetails_GenerateReport(this.value)">

                            <option value="">Select Parent</option>

                                

                   <?php

                    $getparent =array();

                    if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager') {
                      $getparentdetails = "SELECT * FROM parentcompanydata;";
                    } else {
                      $getparentdetails = "SELECT * FROM parentcompanydata WHERE id IN (".$_SESSION['parent'].");";
                    }
                    

                    $results = $conn->query($getparentdetails);

                        if ($results->num_rows > 0) {

                            while($row = $results->fetch_assoc()) {

                                $getparent[] = $row;

                            }

                        }

                       

                      foreach ($getparent as $key => $valueparent) {

                          

                          ?>

                            <option value="<?=$valueparent['parentcompany']?>"><?=$valueparent['parentcompany']?></option>

                            

                        <?php

                        }

                        ?>

                    </select>

                    

                </div>

                <div class="clientDetails">

                    <input type="hidden" class="roletype" value="<?=$_SESSION['role'];?>">
                    <input type="hidden" class="bussinessUnits" value="<?=$_SESSION['client'];?>">

                    <label class="clientData">Client</label>

                      <select  id="client" class="clientcom" onchange="contractTermchange(this.value)" name="clientcompany">

                          <option selected disabled>Select Client</option>

                      </select>

               </div>

            <br>

              <input type="hidden" class="comtype" name="commoditytype">

              <input type="hidden" class="contractid" name="contractIds">
              <input type="hidden" class="clientId" name="clientsId">

               <div class="contractDetails">

                <label class="contractData">Indexed Contract</label>

                    <select id="contract" class="indexcnt" name='contractId' onchange="getyearsIndex(this.value)">

                        <option selected disabled>Select Indexed Contract</option>

                    </select>

                    <!-- <option id= "nusclient" class="clients" onchange="showdiv('parent', this)">NUS Client  </option> -->

               </div>



              <input type="hidden" class="monthsgen" name="allgenmonth">

                      <div class="fixedcontractDetails">

                <label class="fixedcontractData">Fixed Contract</label>

                    <select id="fixedcontract" class="fixcnt" name='contractId' onchange="getfixedreport(this.value)">

                        <option selected disabled>Select Fixed Contract</option>

                    </select>

                    <!-- <option id= "nusclient" class="clients" onchange="showdiv('parent', this)">NUS Client  </option> -->

            </div>

            <div class="yearTradecal">

              <div class="yearstest">

                

              </div>

            </div>

            <div class="listingmonthsbas">

              <div class="row">

                <div class="col-md-4">

                  <p class="monthData">Months</p>

                </div>

                <div class="col-md-4" >

                  <p class="unhedged" >Unhedged baseload price</p>

                  <div id="copy_values" style="display:none;margin: 0px 0px 0px -39px;cursor: pointer; color:#345DA6;" >

                  <!-- <input type="hidden" value="" id="copy_values_hidden"/> -->

                  <br>

                  <br>

                  <a onclick="clicking('basload')" class="base "><span class="badge badge-success">Apply All</span></a>

                  <!-- <a onclick="hiddval('copy_values')"><span class="badge badge-danger">no need</span></a> -->

                  <br>

                  <br>

                </div>

                </div>

               <br>

               <br>

                

                <div class="col-md-4">

                  <p class="unhedgedEffective">Unhedged effective price</p>

                  <div class="col-md-4" id="effective_values" style="display:none;cursor: pointer;">

                 <!--  <input type="hidden" value="" id="effective_values_hidden"/> -->

                 <br>

                  <br>

                   <a onclick="clicking('effective')" class="effect"><span class="badge badge-success">Apply All</span></a>

                   <br>

                  <br>

                   <!-- <a onclick="hiddval('effective_values')"><span class="badge badge-danger">no need</span></a> -->

                </div>

                </div>

                <br>

                <br>



                

              </div>

              <div class="listmnt">

              </div>

            </div>

            <!-- <div class="row"> -->



             <!--  <div class="cat action">

                  <label for="" class= "yearss">Select Calendar Year</label>

                  <select id="ddlYears">

                    <option>Select the Calendar year</option>

                  </select>

              </div> -->

            <!-- </div> -->

            <br>

        </div>

      </div>

      <script type="text/javascript">

        function hiddval(vl){

          $('#'+vl).hide();

        }

      </script>

      <style type="text/css">

        .multse select{

          width: 70%!important;

        }

      </style>

       <div class="reportdetails multi"><br>

                <div class="contractDetails defaultwi">

                <label class="contractData">Country</label><br>

                    <select name='country' class="form-control countries" onchange="getclientfromcountry(this.value)">

                        

                    </select>

                    <!-- <option id= "nusclient" class="clients" onchange="showdiv('parent', this)">NUS Client  </option> -->

                </div><br>

                <div class="row">

                   <div class="col-md-5">

                   </div>

                </div>

                <input type="hidden" class="rowclient" value="0">

                <div class="addedclient">

                  <div class="row">

                    <div class="col-md-5">

                          <select name='clients' class="form-control clients" onchange="getallsupplycontract(this.value)" class="form-control listclients">

                          <option selected disabled>Select Client</option>

                      </select>

                    </div>

                    <div class="col-md-5">

                      <div class="multse">

                        <select id="framework0" name="framework[]" multiple class="form-control">

                         

                       </select>

                      </div>

                    </div>

                  </div>



                </div>

                <div class="addano" class="addclientano">

                  <a onclick="addclient()">Add another client +</a>

                </div><br>

                <div class="yearsact">

                  <label class="reportPeriod">Reports Period</label><br>

                  <?php

                  $currentyear = date('Y',time());

                  $printdata ='<div class="defaultwi" style="display: inline-block;">';

                  for($i=0;$i<3;$i++){

                    $printdata .= '<div class="cat action">

                                 <label>

                                    <input type="checkbox" value="electricity" name="commodity[]" class="yearperiod" 

                                    ><span class="disabledbutton act">'.($currentyear+$i).'</span>

                                 </label>

                              </div>';



                  }

                  $printdata .='</div>';

                  echo $printdata;

                  ?>

                </div>

                

       </div>

        <div class="reportdetails international">

                <div class="contractDetails defaultwi">

                    <div class="row">

                      <div class="col-md-7">

                        <label class="contractData">Parent company</label><br>

                        <select name='parentcompany' class="form-control paret" style="padding: 10px 48px 27px 7px !important;">

                          <option value="">Select an option</option>

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

                          

                          ?>

                            <option value="<?=$valueparent['parentcompany']?>"><?=$valueparent['parentcompany']?></option>

                            

                        <?php

                        }

                        ?>

                        </select>

                      </div>

                      <div class="col-md-5">

                        <label class="contractData">Commodity</label><br>

                        <div style="display: inline-block;">

                            <div class="cat action">

                             <label>

                                <input type="checkbox" value="electricity" name="commodity[]" class="comdityinter" 

                                ><span class="disabledbutton act">Electricity</span>

                             </label>

                          </div>

                          <div class="cat action">

                             <label>

                                <input type="checkbox" value="natural gas"  name="commodity[]" class="comdityinter"

                                ><span class="disabledbutton dis">Natural Gas</span>

                             </label> 

                          </div>

                        </div>

                      </div>

                    </div>

                    <!-- <option id= "nusclient" class="clients" onchange="showdiv('parent', this)">NUS Client  </option> -->

                </div><br>

                <div class="row">

                   <div class="col-md-5">

                     <label class="contractData" >Countries</label><br>

                   </div>

                </div>

                <input type="hidden" class="rowcountries" value="0">

                <div class="addedcountry">

                  <div class="row">

                    <div class="col-md-5">

                        <select name='country0' onchange="getsupplycontractcounty(this.value)" class="form-control listcountries countryval0">

                          <option selected disabled>Select client</option>

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

                          

                          ?>

                            <option value="<?=$valueparent['parentcompany']?>"><?=$valueparent['parentcompany']?></option>

                            

                        <?php

                        }

                        ?>

                      </select>

                    </div>

                    <div class="col-md-5">

                      <div class="multse">

                        <select id="countyr0" multiple class="form-control">

                         

                       </select>

                      </div>

                    </div>

                  </div>



                </div>

                <div class="addano">

                  <a onclick="addcountries()">Add another Country +</a>

                </div><br>

                <div class="yearsact">

                  <label>Reports Period</label><br>

                  <?php

                  $currentyear = date('Y',time());

                  $printdata ='<div class="defaultwi" style="display: inline-block;">';

                  for($i=0;$i<3;$i++){

                    $printdata .= '<div class="cat action">

                                 <label>

                                    <input type="checkbox" value="electricity" name="commodity[]" class="yearperiod" 

                                    ><span class="disabledbutton act">'.($currentyear+$i).'</span>

                                 </label>

                              </div>';



                  }

                  $printdata .='</div>';

                  echo $printdata;

                  ?>

                </div>

        </div>

         <div class="reportdetails tradehistroy">

         <div class="clientDetails">

                    <label class="clientDatas">Parent</label>

                        <select  id="parentT" name="parentid" onchange="parentdetails_GenerateReport(this.value)">

                            <option value="">Select Parent</option>

                                

                   <?php

                    $getparent =array();

                    if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager') {
                      $getparentdetails = "SELECT * FROM parentcompanydata;";
                    } else {
                      $getparentdetails = "SELECT * FROM parentcompanydata WHERE id IN (".$_SESSION['parent'].");";
                    }


                    $results = $conn->query($getparentdetails);

                        if ($results->num_rows > 0) {

                            while($row = $results->fetch_assoc()) {

                                $getparent[] = $row;

                            }

                        }

                       

                      foreach ($getparent as $key => $valueparent) {

                          

                          ?>

                            <option value="<?=$valueparent['parentcompany']?>"><?=$valueparent['parentcompany']?></option>

                            

                        <?php

                        }

                        ?>

                    </select>

                    

                </div>

                <div class="clientDetails">

                    <label class="clientDatas">Client</label>

                      <select  id="clientT" class="clientcom" onchange="contractTermchange(this.value)" name="clientcompany">

                          <option selected disabled>Select Client</option>

                      </select>

               </div>

               <div class="contractDetails">

                <label class="contractDatas">Indexed Contract</label>

                    <select id="contractT" class="indexcnt" name='contractId' onchange="getyearsIndex(this.value)">

                        <option selected disabled>Select Indexed Contract</option>

                    </select>

                    <!-- <option id= "nusclient" class="clients" onchange="showdiv('parent', this)">NUS Client  </option> -->

               </div>

               <div class="yearTradecal">

              <div class="yearstest">

                

              </div>

            </div>

         </div>

         <input type="hidden" class="firstval">

         <input class="generatebtn" type="submit" value="Generate report">

      </div>

           

          </div>

        </div>

      </div>

        </form>

    </div>

</body>





<script type="text/javascript">



function validForm(){

    if($('#reportdatas').val() ==''){

      alert('Please select the report type');

      return false;

    }



    if($('#reportdatas').val() == "tradehistry") {

      // console.log("Hello");

      

      if($('#parentT').val() == '') {

        alert('Please select parent!');

        return false;

      }



      if($('#clientT').val() == '') {

        alert('Please select client!');

        return false;

      }



      if($('#contractT').val() == '') {

        alert('Please select contract!');

        return false;

      }
      
      
      var checkClass = [];

        $.each($(".contactType:checked"), function() {
    
          checkClass.push($(this).attr('class'));
    
        });



        if (checkClass.length == 0) {
    
          alert('Please select the year');
    
          return false;

        }


      return true;

    }



    if($('#clients').val() !== '') {

      console.log('Immmm');

      console.log($('#clients').val());

    }



    if($('#clientC').val() !== '') {

      console.log('Immmm');

      console.log($('#clientC').val());

    }



    if ($('#client').val()=='') {

      alert('Please select the parent');    

      return false;

    }

    if($('.clientcom').val()==''){

      alert('Please select the client');

      return false;

    }

    if($('.indexcnt').val() == ''&& $('.fixcnt').val()==''){

      alert('Please select the contract');

      return false;

    }

    // var columnepmpty=[];

    // $('.contactType').each(function(){

    //   if($(this).val() =='' || $(this).val() ==undefined){

    //     columnepmpty.push(1);

    //   }

    // })

    // if(($('.contactType').val()=='')){

    //      alert('please select required fields');

    //     return false;

    //   }



    var checkClass = [];

    $.each($(".contactType:checked"), function() {

      checkClass.push($(this).attr('class'));

    });



    if (checkClass.length == 0) {

      alert('Please select the year');

      return false;

    }

    if($('.indexcnt').val()!=''){

      var checkemptybaseloasd = [];

      $('.basload').each(function(){

        if($(this).val() ==''){

          checkemptybaseloasd.push(1);

        }

      });

      $('.effective').each(function(){

        if($(this).val()==''){

          checkemptybaseloasd.push(1);

        }

      })

    }

    if (checkemptybaseloasd.length>0) {

      alert('Please enter the value');

      return false;

    }

    // if(columnepmpty.length>0){

    //   alert('please select required fields');

    //   return false;

    // }

    return true;

  }



  function FormatCurrency(ctrl) {

   

                     var num = ctrl.value;

                    // if(num){

                      // $("#copy_values").css("display", "none");

                      // $("#effective_values").css("display", "none");

                     // console.log($(ctrl).attr('class'));

                      if($(ctrl).hasClass("basloadlstrike")){

                        $('#copy_values').show();

                        $('#effective_values').hide();

                        $('.firstval').val(num);

                        // $("#copy_values").css("display", "block");

                      //   // $("#effective_values").css("display", "none");

                      //   // $("#copy_values_hidden").val(num);

                      }

                      else if($(ctrl).hasClass("effectivelstrike")){

                        $('#effective_values').show();

                         $('#copy_values').hide();

                         $('.firstval').val(num);

                      }

                    //     $("#effective_values").css("display", "block");

                    //     // $("#copy_values").css("display", "none");

                    //     // $("#effective_values_hidden").val(num);

                    //   }else{

                    //     $("#copy_values").css("display", "none");

                    //     $("#effective_values").css("display", "none");

                    //     $('.basload').each(function() {

                    //       $(this).val("");

                    //     });

                    //   }

                    // }else{

                    //   $("#copy_values").css("display", "none");

                    //   $("#effective_values").css("display", "none");

                    // } 

                    

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

   

   function clicking(val){

    var firstvl =$('.firstval').val();

      $('.'+val).each(function() {

        $(this).val(firstvl);

      });

   }

    // $('#copy_values').click(function(e) {  

    //    var copy_basevalues = $("#copy_values_hidden").val();

      

      

    // });

    // $('#effective_values').click(function(e) {  

    //    var copy_basevalues = $("#effective_values_hidden").val();

      

    //   $('.effective').each(function() {

    //     $(this).val(copy_basevalues);

    //   });

    // });

    function CheckNumeric() {

      return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;

    }



    function getfixedreport(cntId){

      $('.listingmonthsbas').hide();

      $(".indexcnt").prop("selectedIndex", 0);

      // $(".indexcnt").val($(".indexcnt option:first").val()).change();

      $('.comtype').val('fixed');

      // $('.contractid').val(cntId);

      var cid = $('.fixcnt').val();
      var clientid = $('.clientcom').val();

      $('.clientId').val(clientid);
      $('.contractid').val(cid);

       $.ajax({

            url: 'ajax/getallyear.php',

            type: "POST",

            data: {

                'cId': cid,
                'clientid': clientid,

            },

            success: function(result) {

               $('.yearTradecal').show();

             $('.yearstest').html(result);

              $('input[type="checkbox"].contactType').on('change', function() {

                  $('input[type="checkbox"].contactType').not(this).prop('checked', false);

                });

            }

        })

    }

    $('input[type="checkbox"].yearperiod').on('change', function() {

      $('input[type="checkbox"].yearperiod').not(this).prop('checked', false);

    });

    $('input[type="checkbox"].reporttype').on('change', function() {

      $('input[type="checkbox"].reporttype').not(this).prop('checked', false);

    });

     $('input[type="checkbox"].comdityinter').on('change', function() {

      var parentname = $('.paret').val();

      $.ajax({

            url: 'ajax/getcountries.php',

            type: "POST",

            data: {

                'commdoity': $(this).val(),

                'parentcompany':parentname

            },

            success: function(result) {

              $('.listcountries').html(result);

            }

        })

      $('input[type="checkbox"].comdityinter').not(this).prop('checked', false);

    });

    function getyearsIndex(cntId){

      $(".fixcnt").prop("selectedIndex", 0);

      // $(".fixcnt").val($(".fixcnt option:first").val()).change();

      $('.comtype').val('Index');

      $('.contractid').val(cntId);
      var out = $('.contractid').val(cntId);
      console.log("Contract Id => "+out);
      if(document.getElementById('reportdatas').value=='tradehistry') {
          var clients =  document.getElementById('contractT').value;
          var clientcom = document.getElementById('clientT').value;
          document.querySelector('.clientId').value = clientcom;
      }
      else {
        var styling = document.querySelector('.yearstest');
        styling.style.marginTop = "10px";
        styling.style.marginRight = "0px";
        styling.style.marginBottom = "30px";
        styling.style.marginLeft = "12px";
        var clients = document.querySelector('.indexcnt').value;
        var clientcom = document.querySelector('.clientcom').value;
        document.querySelector('.clientId').value = clientcom;
      }
    //   var clients = document.querySelector('.indexcnt').value;
    //   var clientcom = document.querySelector('.clientcom').value;
    //   document.querySelector('.clientId').value = clientcom;
      console.log("Client Company => "+clientcom);
      console.log("Clients = > "+clients);

        $.ajax({

            url: 'ajax/getallyear.php',

            type: "POST",

            data: {

                'cId': clients,
                'clientid':clientcom

            },

            success: function(result) {

              $('.yearTradecal').show();

              $('.yearstest').html(result);

              $('input[type="checkbox"].contactType').on('change', function() {

                  $('input[type="checkbox"].contactType').not(this).prop('checked', false);

                  var selectedyear = $(this).val();
                //   console.log("Selected Year = ".selectedyear);
                //   alert('Hi');

                  var contractid = $('.indexcnt').val();

                 

                  $.ajax({

                    url: 'ajax/getbaseprices.php',

                    type: "POST",

                    data: {

                        'contract': contractid,
                        'clientid':clientcom,
                        'yearselected':selectedyear

                    },

                    success: function(result) {

                      $('.listingmonthsbas').show();

                      var obj = JSON.parse(result);

                      $('.listmnt').html(obj.rowval);

                      $('.monthsgen').val(obj.months);

                    }

                })

              });client



            }

        })

    }

         

  



   

    function contractTerm(contract){

        $.ajax({

            url: 'ajax/contractdata.php',

            type: "POST",

            data: {

                contractId: contract

            },

            success: function(result) {

             

              var obj = JSON.parse(result);

              console.log(obj);

              var clicktranchobj = JSON.parse(obj.contractTrade);

              console.log(clicktranchobj);

              $('.suppId').val(obj.supId);

              var yearbasis = [];

              var trichclick = [];

              var tranchid = [];

              // $('.jsonfile').val(JSON.stringify(obj));

              clicktranchobj.forEach(function(clicktranchobj) {

                yearbasis.push(clicktranchobj.periodsId);

                trichclick.push(clicktranchobj.clicktracnches);

                tranchid.push(clicktranchobj.tradePerId);

              });

              var contractterm = obj.contractterm;

              var dates = contractterm.split(",");

              var fromdate = new Date(dates[0]);

              var todate = new Date(dates[1]);

              first = fromdate.getFullYear();

              second = todate.getFullYear();

              arr = Array();

              for(i = first; i <= second; i++) arr.push(i);

              var months=0;

              months = (todate.getFullYear() - fromdate.getFullYear()) * 12;

              months -= fromdate.getMonth();

              months += todate.getMonth();

           

              var monthsdata = months+1;

              var printdata = '';

                printdata +='<option >Select the Year</option>';

              for(i=0;i<arr.length;i++){

               

                printdata +='<option value="'+arr[i]+'">'+arr[i]+'</option>';

              }

              $('#ddlYears').html(printdata);

              

              

            }

        })

    }

 



</script>



<script type="text/javascript">

         

    



    function contractTerm(fixedcontract){

        $.ajax({

            url: 'ajax/contractTerm.php',

            type: "POST",

            data: {

                contractId: fixedcontract

            },

            success: function(result) {

             

              var obj = JSON.parse(result);

              console.log(obj);

              var clicktranchobj = JSON.parse(obj.contractTrade);

              console.log(clicktranchobj);

              $('.suppId').val(obj.supId);

              var yearbasis = [];

              var trichclick = [];

              var tranchid = [];

              // $('.jsonfile').val(JSON.stringify(obj));

              clicktranchobj.forEach(function(clicktranchobj) {

                yearbasis.push(clicktranchobj.periodsId);

                trichclick.push(clicktranchobj.clicktracnches);

                tranchid.push(clicktranchobj.tradePerId);

              });

              var contractterm = obj.contractterm;

              var dates = contractterm.split(",");

              var fromdate = new Date(dates[0]);

              var todate = new Date(dates[1]);

              first = fromdate.getFullYear();

              second = todate.getFullYear();

              arr = Array();

              for(i = first; i <= second; i++) arr.push(i);

              var months=0;

              months = (todate.getFullYear() - fromdate.getFullYear()) * 12;

              months -= fromdate.getMonth();

              months += todate.getMonth();

           

              var monthsdata = months+1;

              var printdata = '';

                printdata +='<option >Select the Year</option>';

              for(i=0;i<arr.length;i++){

               

                printdata +='<option value="'+arr[i]+'">'+arr[i]+'</option>';

              }

              $('#ddlYears').html(printdata);

              

              

            }

        })

    }

  

 

$('input[type="checkbox"].commodityreport').on('change', function() {

  var commodityname = $(this).val();

  $.ajax({

      type:'POST',

      url: 'js/callbacks/getcomdetails.php',

      data:{

        'commodityname':commodityname,

        'type':'commidity'

      

      },

      success: function(data){

        $('.countries').html(data);

      }

    });



  $('input[type="checkbox"].commodityreport').not(this).prop('checked', false);



});



</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>



</html>