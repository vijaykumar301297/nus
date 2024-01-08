



<?php 



error_reporting(E_ALL);

ini_set('display_errors', '1');



require_once('common_files/header.php');



if($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'NUS Manager' && $_SESSION['role'] != 'NUS User') {

  //echo 'You have no acesss to view the page';

  echo "<script>alert('You have no access to view this page!');window.location.href='index.php';</script>";

  die();

}





?>



<style type="text/css">



@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');



.suplycnt{

    margin: 40px 0 0 300px;

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

  width: 9.0em; 

  height: 3.0em;

  font-size: 13px!important;

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

      /* font-family: 'Segoe UI'; */

    font-style: normal;

    font-weight: 500;

    font-size: 15px;

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

    /* border:1px solid lightgrey; */

    box-shadow: none;

    color: #345DA6;

    height: 34px !important;

    background-color: rgb(255, 255, 255);

    cursor: pointer;

    /* color: #345DA6; */

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



.deleteIcon {

  margin: 0 0 0 -75%;

  background: white;

  padding: 7px 9px;

  border: 1.5px solid #345DA6;

  border-radius: 50%;

  cursor: pointer;

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

.action input:hover +span img{

  filter: invert(25%) sepia(94%) saturate(3383%) hue-rotate(215deg) brightness(98%) contrast(92%);

}

.action input:checked + span{

  background-color: #fff;

  opacity: 1;

  color: #1363F1;

  border: 1px solid #1363F1;

}

.action input:checked + span img{

  filter: invert(25%) sepia(94%) saturate(3383%) hue-rotate(215deg) brightness(98%) contrast(92%);

}



/*form {

    width: 400px;

    padding: 30px;

    border-radius: 15px;

    margin: 80px 0 0 0;

}*/



.form-control {

  background-color: rgb(255, 255, 255);

  cursor: pointer;

  color: #345DA6;

  border: 1px solid #1363F1;

  border-radius: 6px;

  margin: 0 0 0 0.3px;

}



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



.naturalGass {

  display: none;

}





input[type=range]:focus::-ms-fill-lower {

  background: #E3EBF6;

}

input[type=range]:focus::-ms-fill-upper {

  background: #E3EBF6;

}

input[type='range'],

input[type='range']::-webkit-slider-runnable-track,

input[type='range']::-webkit-slider-thumb {

  -webkit-appearance: none;

}



input[type='range']::-webkit-slider-runnable-track {

  height: 3px;

  background: linear-gradient(to right, #293043, #293043), #D7D7D7;

  background-size: var(--background-size, 0%) 100%;

  background-repeat: no-repeat;

  border-radius: 5px;



}



input[type='range']::-webkit-slider-thumb {

  width: 15px;

  height: 15px;

  cursor: pointer;

  background: #293043;

  border: solid white 1px;

  border-radius: 50%;

  margin-top: -6px;

  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);

}



.hideonmw{

  display: none;

}



/** FF*/



input[type="range"]::-moz-range-progress {

  background-color: #293043;

  border-radius: 5px;

}



input[type="range"]::-moz-range-track {

  background-color: #293043;

  border-radius: 5px;

  border:none;

  box-shadow:none;

}



input[type="range"]::-moz-range-thumb {

  width: 15px;

  height: 15px;

  cursor: pointer;

  background: #293043;

  border: solid white 1px;

  border-radius: 50%;

  margin-top: -6px;

  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);

}



</style>

<body>



    <div class="main">

        <div class="menu">



            <?php

                include('sidebar.php');

            ?>

        </div>

    <div>

     <div class="contentMove">



        <div class="suplycnt">

            

            <div class="padmd0">

              <?php

              if(isset($_SESSION['created'])&&((time() - $_SESSION['created']) < 2)) {

                

                echo '<script> toastr.success("successfully Created", "New Supply contract ");</script>';

                if((time() - $_SESSION['created']) > 2){

                    unset($_SESSION['created']);

                }

              } 

              

             ?>                

                

              <form id="regForm" action="insertsupplycontract.php?type=adding" method="POST">

                <!-- for contract details-->

              <div class="tab" id="contract">

                <h6>New Supply Contract</h6>

                <h3>Contract Details</h3>

                <hr class="bfg">

                <input type="hidden" class="edittab" value="normal">

                <label>Parent</label>

                <select class="chosen-select form-control parent" name="parent" onchange="getparentdetails(this.value)">

                  <option value="">Please Select</option>

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

                </select><br>

                <label>Client</label>

                <select class="chosen-select form-control clint" name="client" onchange="getclientdetails(this.value)">

                 <option value="">Please Select client</option>

                </select>

                <input type="hidden" class="country" name="country" >

                <input type="hidden" class="yearmonths" name="yearval" >

                <input type="hidden" class="clientname" name="clientname" ><br>

                <div class="row">

                  <div class="col-md-6">

                    <label>Commodity</label><br>

                    

                    <div style="display: inline-block;">

                        <div class="cat action">

                         <label>

                            <input type="checkbox" value="electricity" name="commodity[]" class="commodity" 

                            checked><span class="disabledbutton act"><img src="img/electricity-hover.svg">Electricity</span>

                         </label>

                      </div>

                      <div class="cat action">

                         <label>

                            <input type="checkbox" value="natural gas"  name="commodity[]" class="commodity"

                            ><span class="disabledbutton dis"><img src="img/naturalgas.svg"> Natural Gas</span>

                         </label> 

                      </div>

                    </div>

                  </div>                  

                  

                  <div class="col-md-6 units" >

                    <label>units</label><br>

                    <div class="natru" style="display: inline-block;">

                      <div class="cat action">

                        <label>

                            <input type="checkbox" value="MWh" name="units[]" class="unit" 

                             checked

                            ><span class="disabledbutton dis">MWh</span>

                             

                        </label>

                      </div>

                      <!-- <div class="cat action">

                         <label>

                            <input type="checkbox" value="Therms" name="units[]" class="unit" 

                            

                            ><span class="disabledbutton dis">Therms</span>

                         </label>

                      </div> -->

                    </div>

                  </div>

                

                </div>

                <div><br>

                  <label>Supplier</label>

                  <input type="text" class="form-control supplr" name="supplr" required="true">

                  

                </div><br>

                <div>

                  <input type="hidden" name="allmonthsdata" class="contracttermdata">

                  <input type="hidden" name="hedge" class="hedge">

                  <label>Contract Commodity Currency</label>

                  <select class="form-control contractprice" name="contractprice">

                    <?php

                      include "dbconn.php";  // Using database connection file here

                        $countrycurrencies = mysqli_query($conn, "SELECT currencies From nus_currencies");  

                        while($currencies = mysqli_fetch_array($countrycurrencies))



                        {

                            echo "<option value='". $currencies['currencies'] ."'>" .$currencies['currencies'] ."</option>";  

                        }

                        ?>

                  </select>

                </div><br>

                <div class="row">

                  <div class="col-md-6">

                    <label>Contact Type</label><br>

                    <div style="display: inline-block;">

                        <div class="cat action">

                         <label>

                            <input type="checkbox" value="fixed" name="contacttype[]" class="contactType" 

                             checked><span class="disabledbutton dis">Fixed</span>

                         </label>

                      </div>

                      <div class="cat action">

                         <label>

                            <input type="checkbox" class="contactType" name="contacttype[]" value="indexed" 

                            

                            ><span class="disabledbutton dis">Indexed</span>

                         </label>

                      </div>

                    </div>

                  </div>

                  <input type="hidden" class="cttype" name="contType">

                  <div class="col-md-6 indexcl">

                    <label>Index</label><br>

                    <div class="indxt">

                     

                    </div>

                  </div>

                </div>

                <hr class="bfg">

              </div>

              <!-- for Length and consumption-->

              <div class="tab" id="length">

                  <h6>New Supply Contract</h6>

                <h3 class="dynamictext">Length and Consumption</h3>

                <hr>

                <label>Contract Term (DD/MMM/YYYY)</label>

                <div class="input-group input-daterange">

                  <input id="startDate1" name="startDate1" type="text"

                    class="form-control startdate" onchange="calcualteMonthYr(this.value,$('.endate').val())" readonly="readonly" > <span

                    class="input-group-addon">

                    <!--  <span

                    class="glyphicon glyphicon-calendar"></span> -->

                  </span> <span class="input-group-addon">to</span> <input id="endDate1"

                    name="endDate1" type="text" class="form-control endate" readonly="readonly" onchange="calcualteMonthYr($('.startdate').val(), this.value)">

                  <span class="input-group-addon">

                    <!-- <span

                    class="glyphicon glyphicon-calendar">

                      

                    </span> -->

                  </span>

                </div><br>

                

                <div class="compr">

                  <label>Commodity Price (per MWh)</label>

                  <input type="hidden" class="countmonths">

                  <input type="hidden" class="allmonths" name="allmonths">

                  

                  <!-- <div class="input-group"> -->

                      <input class="form-control left-border-none comdyprice" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" placeholder="0.00" type="text" class="commodityprice" name="commodityprice" >



                      <!-- <span class="input-group-addon transparent">

                      MWh</span> -->

                      

                  <!-- </div> -->

                </div>

                <script type="text/javascript">

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

                    ctrl.value = number;

                    // //Check if arrow keys are pressed - we want to allow navigation around textbox using arrow keys

                    // if (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40 || event.keyCode == 8 || event.keyCode == 46) {

                    //     return;

                    // }



                    // var val = ctrl.value;



                    // val = val.replace(/,/g, '');

                    // val = val.replace(/\.00/g, '');

                    // val = val.replace(/\./g, '');

                    // var test = val;

                    // ctrl.value = "";

                    // val += '';

                    // x = val.split('.');

                    // x1 = x[0];

                    // x2 = x.length > 1 ? '.' + x[1] : '';

                    var summ = 0;

                    

                        

                    var count =[];

                    var totalmonths =12;

                    if($(ctrl).hasClass('peryr')){

                      let classlist = $(ctrl).attr('class');

                      classlist = classlist.split(' ');

                      var testnu = parseInt(num);

                      // console.log(testnu);

                      $('.sliderrange'+classlist[3]).val(number).trigger("input");

                      

                      

                      $('.peryr').each(function(){

                        console.log($(this).val());

                        // if($(this).val() !=''){

                          var toNumber = $(this).val();

                          toNumber = toNumber.replace(/,/g, '');

                          count.push('yes');

                          summ +=parseFloat(toNumber);



                        // }

                       

                      })

                      // summ +=parseFloat(num);

                      

                    }

                     totalmonths = totalmonths - (count.length);

                      console.log(totalmonths);

                    var consumption = $('.totalanualconsumption').val()

                        consumption = consumption.replace(/,/g, '');

                        consumption  = parseFloat(consumption);

                        var peramt = parseFloat(consumption)/12;

                        var datamt = totalmonths * peramt;

                    

                    var sumdata = summ +datamt;

                    console.log(consumption);

                    if(sumdata>consumption){

                      $('.monthsallow').val('no');

                       $('.errormax').html('maximum consumption');

                    }

                    else{

                       $('.monthsallow').val('yes');

                      $('.errormax').html('');

                    }

                    

                    $('.anuTolal').html(formated(summ));

                    // var rgx = /(\d+)(\d{3})/;



                    // while (rgx.test(x1)) {

                    //     x1 = x1.replace(rgx, '$1' + ',' + '$2');

                    // }



                    

                }

                function formated(val){

                   var num = val;

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

                    var number = formatted + ((parts) ? "." + parts[1].substr(0, 2) : ".00");

                    return number;

                }

                function CheckNumeric() {

                    return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;

                }

                </script>

                <br>

                <div class="row">

                  <div class="col-md-6">

                    <label>Total Annual Consumption</label>

                    <div class="input-group">

                        <input class="form-control left-border-none totalanualconsumption" placeholder="0.00" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" type="text" name="totalanualconsumption" >

                        <span class="input-group-addon transparent">

                        MWh</span>

                    </div>

                  </div>

                  <input type="hidden" class="monthsallow" value="yes">

                  <div class="col-md-6" style="margin-top: 15px;">

                    <label>Allocate Consumption per month</label>

                    <label class="switch" for="checkbox">

                        <input type="checkbox" id="checkbox" />

                        <div class="slider round"></div>

                      </label>

                  </div>

                </div>

                

                <label>Divide Equality between months</label>

                <label class="switchs" for="checkboxs">

                  <input type="checkbox" id="checkboxs" />

                  <div class="sliders rounds"></div>

                </label>

                <div class="allowdvi">

                  

                </div>

                

                

              </div>

              <!--Index details-->

              <div class="tab indexdex" id="index">

                <h6>New Supply Contract</h6>

                <h3>Index Details</h3>

                <hr>

                  <label>Index Structure Type</label><br>

                  <div style="display: inline-block;">

                  <div class="cat action">

                    <label>

                      <input type="checkbox" class="indexstr" name="indexstr[]" value="Consumption(MWh)" 

                      checked><span class="disabledbutton dis">Consumption(MWh)</span>

                    </label>

                  </div>

                  <div class="cat action naturalGass" id="naturalgas">

                    <label>

                      <input type="checkbox" class="indexstr" name="indexstr[]" value="Power(MW)" 

                       ><span class="disabledbutton">Power(MW)</span>

                    </label>

                  </div>

                </div>

                

                <div class="alrw">

                  <label>Allowable trade periods</label><br>

                      <a onclick="addTradeperiods()"class="btn btn-default" style="padding: 2px 12px;"><img src="img/addtrade-icon.svg" alt="Add Icon">Add allowable trade period</a><br>

                      <input type="hidden" class="rowcount" value="1" name="rowcount">

                  

                  

                 

                  <div class="addTrade">

                    

                  </div>



                </div>

               

                

                

                <label>Open Position pricing mechanism</label><br>

                <select class="chosen-select pricMech" name="openmech" style="width: 69.4%; margin: 0 0 10px 0;">

                  <?php

                    $getUserfields =array();

                    $getsupplydetails = "SELECT * FROM nus_pricing_mechanisam";

                    $result = $conn->query($getsupplydetails);

                        if ($result->num_rows > 0) {

                            while($row = $result->fetch_assoc()) {

                                $getUserfields[] = $row;

                            }

                        }



                      ?>

                          <option value="">Plese Select</option>

                      <?php

                       

                        foreach ($getUserfields as $key => $value) {

                         

                          ?>

                            <option value="<?=$value['pricingMechName'].','.$value['priceMechDesc']?>" ><?=$value['pricingMechName']?>, <?=$value['priceMechDesc']?></option>

                            

                        <?php

                        }

                        ?>

                  

                </select>

                

              </div>



              <div class="tab" id="preview">

                 <h6>New Supply Contract</h6>

                <h3>Contract Preview</h3>

                <hr>

                <div class="contrac preview1">

                  

                </div>



                <div class="contrac preview2">

                  

                </div>



                <div class="contrac preview3">

                

                </div>

              </div>

              <div style="overflow:auto;">

                <div class="testing" >



                  

                  <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1,'next')">continue <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

</button>



                  <button type="button" id="prevBtn" class="btn btn-default" onclick="nextPrev(-1,'previous')"><i class="fa fa-long-arrow-left" aria-hidden="true"></i><i class="fa fa-long-arrow-left" aria-hidden="true"></i>

 Previous</button>



                  <button type="button" id="cancelBtn" class="btn btn-default" onclick="window.location.href='index.php'"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancel </button>

                </div>

              </div>



              



            </form>

        </div>

        </div>

    </div>

<script

    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

  <script type="text/javascript">

    $(document).ready(function() {

      $('.input-daterange').datepicker({

        format: 'dd-M-yyyy'

      });

      

    });

    function checkcurrency(vals){

      var val = vals;



      

      

      val += '';

      x = val.split('.');

      x1 = x[0];

      x2 = x.length > 1 ? '.' + x[1] : '';



      var rgx = /(\d+)(\d{3})/;



      while (rgx.test(x1)) {

        x1 = x1.replace(rgx, '$1' + ',' + '$2');

      }

      return x1 + x2+'';

    }







    $('#checkbox').on('click',function(){

      if($('.startdate').val()!="" && $('.endate').val()!=""){



      if($(this).is(':checked')){

        var a = $('.totalanualconsumption').val();

          

        a=a.replace(/\,/g,''); // 1125, but a string, so convert it to number

        

        var anualTotal=parseFloat(a);

        

        var countdiv = $('.countmonths').val();

        var allmonths = $('.allmonths').val();

            allmonths = allmonths.split(',');

           

        var getmnts = [];

        for(var j=0;j<allmonths.length;j++){

            var splitmonth = allmonths[j].split('-');

            getmnts.push(splitmonth[1]);

        }

        var totalmonths = getmnts.length;

        if(totalmonths>12){

          totalmonths = 12;

        }

      

        var yearDiv = parseInt(anualTotal)/12;

        var printData = '';



        var months = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'];

        var sumtotal = 0;

        for(var i=0;i<totalmonths;i++){

          printData +='<div class="diviy">';

          printData +='<div class="row marf">';

          printData +='<div class="col-md-1">';

          printData +='<p>'+months[getmnts[i]-1]+'</p>';

          printData +='</div>';

          printData +='<div class="col-md-7">'

          printData +='<input type="range" id="points" class="rangslider sliderrange'+i+'" value="'+Math.round(yearDiv)+'" name="points" min="0" max="'+parseInt(anualTotal)+'" onchange="showVal(this.value,'+i+')">';

          printData +='</div>';

          printData +='<div class="col-md-4">';

          printData +='<div class="input-group">';

        

          printData +='<input class="months'+i+'"  type="hidden" value="'+months[getmnts[i]-1]+'">';

          printData +='<input class="form-control left-border-none peryr '+i+' peryearval'+i+'" placeholder="0.00" type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="'+checkcurrency(parseFloat(yearDiv).toFixed(2))+'">';

          printData +='<span class="input-group-addon transparent">MWh</span>';

          printData +='</div>';

          printData +='</div>';

          printData +='</div>';



          sumtotal +=yearDiv;

        }

      

        printData +='<hr>';

        printData +='<div class="row">';

        

        printData +='<div class="col-md-8">';

        printData +='<h3 class="mdt">Total Annual Consumptions</h3>';

        printData +='</div>';

        printData +='<div class="col-md-4 text-right">';

        printData +='<span style="color:red" class="errormax"></span>';

        printData +='<input type="hidden" name="totlcnsumtion" class="totlcnsumtion" value="'+Math.round(parseFloat(yearDiv)*12)+'">';

        printData +='<h3 class="mdt"><span class="anuTolal">'+checkcurrency(parseFloat(sumtotal).toFixed(2))+'</span> <span class="mwh">MWH</span></h3>';

        printData +='</div>';

        printData +='</div>';

        $('.allowdvi').html(printData);

      

      }else{

        $('.allowdvi').html('');

      }

    }else{

      alert('Please select the contract period');

      $(this).prop('checked',false);

    }

    })

    $('#checkboxs').on('click',function(){

      if($(this).is(':checked')){

        $('.monthsallow').val('yes');

        bringitback();

        $('.diviy').each(function(){

            $(this).find('.rangslider').prop('disabled',true);

            $(this).find('.peryr').attr('readonly',true);

          

        })

      }else{

        bringitback();

        $('.diviy').each(function(){

          

            $(this).find('.rangslider').prop('disabled',false);

            $(this).find('.peryr').attr('readonly',false);

          

        })

      }

    });

    function showVal(rangeval, rowval){

      var val = rangeval;

      val += '';

      x = val.split('.');

      x1 = x[0];

      x2 = x.length > 1 ? '.' + x[1] : '';



      var rgx = /(\d+)(\d{3})/;



      while (rgx.test(x1)) {

        x1 = x1.replace(rgx, '$1' + ',' + '$2');

      }

      $('.peryearval'+rowval).val(x1 + x2+'');

      var total = 0;

      var count =[];

      var totalmonths =12;

      $('.peryr').each(function(){

        var a = $(this).val();

        a = a.toString().replace(/\,/g,'');

        var anualTotal = parseFloat(a);

        total += anualTotal;

        count.push('yes');

        

      });

      totalmonths = totalmonths - (count.length);

      var consumption = $('.totalanualconsumption').val()

      consumption = consumption.replace(/,/g, '');

      consumption  = parseFloat(consumption);

      var peramt = parseFloat(consumption)/12;

      var datamt = totalmonths * peramt;

                    

      var sumdata = total +datamt;

                    

                    if(sumdata>consumption){

                      $('.monthsallow').val('no');

                       $('.errormax').html('maximum consumption');

                    }

                    else{

                       $('.monthsallow').val('yes');

                      $('.errormax').html('');

                    }

      var totalCns = parseInt($('.totalanualconsumption').val());

      $('.anuTolal').html(formated(total));

     

      

    }

    $(document).ready(function(){

    $('.peryr').keyup(function(){

      console.log('this');

        // console.log($(this).val());

      

    })

  });

    function bringitback(){

      console.log('j');

      var a = $('.totalanualconsumption').val();

        a=a.replace(/\,/g,''); // 1125, but a string, so convert it to number

        var anualTotal=parseFloat(a);

        

        var countdiv = $('.countmonths').val();

        var allmonths = $('.allmonths').val();

            allmonths = allmonths.split(',');

           

        var getmnts = [];

        for(var j=0;j<allmonths.length;j++){

            var splitmonth = allmonths[j].split('-');

            getmnts.push(splitmonth[1]);

        }

        var totalmonths = getmnts.length;

        if(totalmonths>12){

          totalmonths = 12;

        }

       

        var yearDiv = parseFloat(anualTotal)/12;

        var printData = '';



        var months = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'];

        var sumtotal = 0;

        for(var i=0;i<totalmonths;i++){

          printData +='<div class="diviy">';

          printData +='<div class="row marf">';

          printData +='<div class="col-md-1">';

          printData +='<p>'+months[getmnts[i]-1]+'</p>';

          printData +='</div>';

          printData +='<div class="col-md-7">'

          printData +='<input type="range" id="points" class="rangslider" value="'+Math.round(yearDiv)+'" name="points" min="0" max="'+parseInt(anualTotal)+'" onchange="showVal(this.value,'+i+')">';

          printData +='</div>';

          printData +='<div class="col-md-4">';

          printData +='<div class="input-group">';

          printData +='<input class="months'+i+'"  type="hidden" value="'+months[getmnts[i]-1]+'">';

          printData +='<input class="form-control left-border-none peryr peryearval'+i+'" placeholder="0.00" type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="'+checkcurrency(parseFloat(yearDiv).toFixed(2))+'">';

          printData +='<span class="input-group-addon transparent">MWh</span>';

          printData +='</div>';

          printData +='</div>';

          printData +='</div>';

          sumtotal +=parseFloat(yearDiv);

        }

        console.log(sumtotal)

        printData +='<hr>';

        printData +='<div class="row">';

        

        printData +='<div class="col-md-8">';

        printData +='<h3 class="mdt">Total Annual Consumptions</h3>';

        printData +='</div>';

        printData +='<div class="col-md-4 text-right">';

        printData +='<span style="color:red" class="errormax"></span>';

        printData +='<input type="hidden" name="totlcnsumtion" class="totlcnsumtion" value="'+parseFloat(sumtotal)+'">'

        printData +='<h3 class="mdt"><span class="anuTolal">'+formated(sumtotal)+'</span> <span class="mwh">MWH</span></h3>';

        printData +='</div>';

        printData +='</div>';

        $('.allowdvi').html(printData);

    }

  </script>





 <script>



var currentTab = 0; 

showTab(currentTab); 

function showTab(n) {



  var x = document.getElementsByClassName("tab");



  x[n].style.display = "block";

  var contractType = $('.contactType:checked').val();

  $('.cttype').val(contractType);



  if (n == 0) {

    var comlength = $('.commodity').filter(':checked').length;

    var contracttype = $('.contactType').filter(':checked').length;

    // var val = false;



    // if($('.clint').val() != ''){

    //   val = true;

    // }

    // if(val === true){

    //   $('#nextBtn').prop('disabled',false);

    // }else{

    //   $('#nextBtn').prop('disabled',true);

    // }



    document.getElementById("cancelBtn").style.display = "inline";

    document.getElementById("cancelBtn").innerHTML = '<i class="fa fa-long-arrow-left" aria-hidden="true"></i> cancel ';

    document.getElementById("prevBtn").style.display = "none";

  } else {

    document.getElementById("cancelBtn").style.display = "none";

    document.getElementById("prevBtn").innerHTML = '<i class="fa fa-long-arrow-left" aria-hidden="true"></i> previous ';

    document.getElementById("prevBtn").style.display = "inline";

  }

  var editval = $('.edittab').val();

  if(contractType == 'fixed'){

    

    $('.dynamictext').html('Term, Consumption and Price - Fixed Price Contract');

    

    if (n == (x.length-1)) {

      

      x[n].style.display = "block";

      document.getElementById("prevBtn").style.display = "block";

      document.getElementById("nextBtn").innerHTML = "Create Contract";

      // $('#nextBtn').addClass('fullwidth');

 



      

    }else {

      if(n==2 && editval =='normal'){

          $(x[n]).remove();



      }

      if(n==2){

        x[n].style.display = "block";

        document.getElementById("nextBtn").innerHTML = "Create Contract";

      }else{

        document.getElementById("nextBtn").innerHTML = 'continue <i class="fa fa-long-arrow-right" aria-hidden="true"></i>';

      }

      

      

     

    }

  }

  else{

    

    if($('.indexdex').length==0){

      var print ='';

          print +='<div class="tab indexdex" id="index">';

          print +='<h6>New Supply Contract</h6>';

          print +='<h3>Index Details</h3>';

          print +='<hr>';

          print +='<label>Index Structure Type</label><br>';

          print +='<div style="display: inline-block;">';

          print +='<div class="cat action">';

          print +='<label>';

          print +='<input type="checkbox" class="indexstr" name="indexstr[]" value="Consumption(MWh)" checked><span class="disabledbutton dis">Consumption(MWh)</span>';

          print +='</label>';

          print +='</div>';

          print +='<div class="cat action">';

          print +='<label>';

          print +='<input type="checkbox" class="indexstr" name="indexstr[]" value="Power(MW)" ><span class="disabledbutton dis">Power(MW)</span>';

          print +='</label>';

          print +='</div>';

          print +='</div>';

                

          print +='<div class="alrw">';

          print +='<label>Allowable trade periods</label><br>';

          print +='<a onclick="addTradeperiods()"class="btn btn-default"><img src="img/addtrade-icon.svg" alt="Add Icon">Add allowable trade period</a><br>';

          print +='<input type="hidden" class="rowcount" value="1" name="rowcount">';

          print +='<div class="addTrade">';

                    

          print +='</div>';



          print +='</div>';

               

                

                

          print +='<label>Open Position pricing mechanism</label><br>';

          print +='<select class="chosen-select pricMech" name="openmech">';

          print +='<option>Please Select</option>';

          print +='<option value="Day Ahead,Spot Daily Market">Day Ahead, Spot Daily Market</option>';  

          print +='<option value="Day Ahead,Spot Average for month">Day Ahead,Spot Average for month</option>';

          print +='<option value="Month Ahead,Last Value">Month Ahead,Last Value</option>';

          print +='<option value="Month Ahead,Average Value">Month Ahead,Average Value</option>';

          print +='<option value="Quarter Ahead,Last Value">Quarter Ahead,Last Value</option>';

          print +='<option value="Quarter Ahead,Average Value">Quarter Ahead,Average Value</option>';

          print +='<option value="Calendar Ahead,Last Value">Calendar Ahead,Last Value</option>';

          print +='</select>';

          print +='</div>';

      $(x[x.length-2]).after(print);

    }

    

     $('.dynamictext').html('Term and Consumption - Indexed Contract');

     if (n == (x.length - 1)) {

      document.getElementById("prevBtn").style.display = "block";

      document.getElementById("nextBtn").innerHTML = "Create Contract";

      // $('#nextBtn').addClass('fullwidth');

      



    } else {



      document.getElementById("nextBtn").innerHTML = 'continue <i class="fa fa-long-arrow-right" aria-hidden="true"></i>';

    }

}

  

}

function showfrontTab(current){

  var x = document.getElementsByClassName("tab");

  

  x[current].style.display='block';

  x[1].style.display='none';

  x[2].style.display='none';

  x[3].style.display='none';

  if (current == 0) {

    currentTab = current;

    document.getElementById("cancelBtn").style.display = "inline";

    document.getElementById("prevBtn").style.display = "none";

    $('#nextBtn').removeClass('fullwidth');

    

  } 

  if (current == (x.length - 1)) {

    document.getElementById("prevBtn").style.display = "none";

    document.getElementById("nextBtn").innerHTML = "Continue";

    $('#nextBtn').addClass('fullwidth');



  } else {



    document.getElementById("nextBtn").innerHTML = 'continue <i class="fa fa-long-arrow-right" aria-hidden="true"></i>';

  }

}

function showTabs(n,current){

   

  var x = document.getElementsByClassName("tab");

  var contractType = $('.contactType:checked').val();

  x[n].style.display='block';



  x[current].style.display='none';

  $('.edittab').val('edit');

  if(contractType == 'fixed'){

    $('.edittab').val('normal');

   }else{

     $('.edittab').val('edit');

   }

  if (n == 0) {

    currentTab = n;

    document.getElementById("cancelBtn").style.display = "inline";

    document.getElementById("prevBtn").style.display = "none";

    $('#nextBtn').removeClass('fullwidth');

    

  } else {

    currentTab = n;

    document.getElementById("cancelBtn").style.display = "none";

    document.getElementById("prevBtn").style.display = "inline";

    $('#nextBtn').removeClass('fullwidth');

  }

  document.getElementById("nextBtn").innerHTML = 'continue <i class="fa fa-long-arrow-right" aria-hidden="true"></i>';



}



function nextPrev(n,type) {

  

  var x = document.getElementsByClassName("tab");

  var contractType = $('.contactType:checked').val();

  

  if(type=='next'){

    var obj = {};

    if(currentTab == 0){

      var parentt = $('.parent').val();

      // alert(parentt);

      console.log("parent = "+parentt);

      var clint = $('.clientname').val();

      console.log("Client = "+clint);

      var unit = '';

      if($('.commodity:checked').val() == 'natural gas'){

          unit = $('.unit:checked').val();

      }

      var commodity =$('.commodity:checked').val();

      

      console.log("Commodity = "+commodity);



      if(commodity == "natural gas") {

        console.log('Hi');

        document.getElementById('naturalgas').classList.add('naturalGass');

      } else {

        document.getElementById('naturalgas').classList.remove('naturalGass');

      }



      var supplier = $('.supplr').val();

      obj.country = $('.country').val();

      var index = '';

      if($('.contactType:checked').val() == 'indexed'){

          index = $('.indexType').val();

      }

      var contractType = $('.contactType:checked').val();

      var startDate = $('.startdate').val();

      var endDate = $('.enddate').val();



      obj.parent = parentt;

      obj.client = clint;

      obj.commodity = [{name:commodity,unit:unit}];

      obj.supplier = supplier;

      obj.contracttype = [{type:contractType, index: index}];

      localStorage.setItem('obj', JSON.stringify(obj));

       

     

    }

     var contractType = $('.contactType:checked').val();

      if(contractType == 'fixed'){

        $('.compr').show();

       

      }else{

        $('.compr').hide();

        

      }

   

    

      if(currentTab == 1){



        var retrievedObject = localStorage.getItem('obj');



        var parsedObject = JSON.parse(retrievedObject);

        parsedObject.contractterm = $('.startdate').val()+' to '+$('.endate').val();

        parsedObject.comodityprice = $('.comdyprice').val();

        parsedObject.totalanualconsumption = $('.totalanualconsumption').val();

        parsedObject.contractprice = $('.contractprice').val();

        var countdiv = $('.countmonths').val();

        var allmonths = $('.allmonths').val();

            allmonths = allmonths.split(',');

           

        var getmnts = [];

        var months = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'];

         var year = [];

        for(var j=0;j<allmonths.length;j++){

            console.log(allmonths[j]);

            var splitmonth = allmonths[j].split('-');

            year.push(splitmonth[0]);

            getmnts.push(months[splitmonth[1]-1]+'-'+splitmonth[0]);

        }

        var uniqueyear = year.filter(function (x, i, a) { 

          return a.indexOf(x) == i; 

        });

        $('.yearmonths').val(uniqueyear.toString());

        // console.log(getmnts);

        // 1125, but a string, so convert it to number

        // var anualTotal=parseFloat(a);

        var dividemnt = $('.totalanualconsumption').val();

            dividemnt = dividemnt.replace(/\,/g,'');

            dividemnt = parseFloat(dividemnt)/12;



     





        var monthsdata = [];

        var monthshedge = [];



        var jsonObj ={};

        var moths = [];

        for(k=0;k<getmnts.length;k++){

          var vla = $('.peryearval'+k).val();

          if($('.peryearval'+k).val() !=undefined){

            let splitstring = getmnts[k];

                splitstring = splitstring.split('-');

            jsonObj[splitstring[0]] = $('.peryearval'+k).val();



            // var lot = getmnts[k]+'+'+$('.peryearval'+k).val();

            // testing.push(lot);

          }

          if($('.peryearval'+k).val() ==undefined){

            var splitstring = getmnts[k];

                splitstring = splitstring.split('-');

            let lot = splitstring[0];

            // var lot = getmnts[k]+'+'+$('.peryearval'+k).val();

            moths.push(lot);

          }

          // console.log(getmnts[k]);

          // var anth =getmnts[k]+'-'+ (($('.peryearval'+k).val() !=undefined)?(parseFloat(vla.replace(/,/g, ''))):dividemnt);

          // var ges = getmnts[k]+'-'+0;

        }

        console.log(jsonObj);

        for(k=0;k<getmnts.length;k++){

          let splitstring = getmnts[k];

              splitstring = splitstring.split('-');

          // console.log();

          // var anth =getmnts[k]+'-'+ (($('.peryearval'+k).val() !=undefined)?($('.peryearval'+k).val()):formated(dividemnt));

          

          // if(getmnts[k] && $('.peryearval'+k).val() ==undefined){

          //   if(getmnts[k] && $('.peryearval'+k).val() ==undefined)

          // }

          var putext = '';

          if($('.peryearval'+k).val() !=undefined){

            var vla = $('.peryearval'+k).val();

            putext = parseFloat(vla.replace(/,/g, ''));

          }else{

            for(i=0;i<moths.length;i++){

              if(moths[i]==splitstring[0]){

                putext = jsonObj[splitstring[0]];

                putext = parseFloat(putext.replace(/,/g, ''));

              }

            }

          }

          var anth =getmnts[k]+'-'+putext;

          var ges = getmnts[k]+'-'+0;

         

          monthshedge.push(ges);

          monthsdata.push(anth);

        }

        // console.log(monthsdata);

        $('.contracttermdata').val(monthsdata.join("|"));

        $('.hedge').val(monthshedge.join("|"));





        var totalmonths = getmnts.length;

        if(totalmonths>12){

          totalmonths = 12;

        }

        



        for(i=0;i<totalmonths;i++){

          var value = $('.months'+i).val();

          var vals = value+"consumption";

          parsedObject[vals]= $('.peryearval'+i).val();

        }

        localStorage.setItem('obj', JSON.stringify(parsedObject));

        var contractType = $('.contactType:checked').val();



        if(contractType == 'fixed'){

          console.log(parsedObject);

          var printdata = '';

        printdata +='<div class="row">';

        printdata +='<div class="col-md-6">';

        printdata +='<h6>Contract Details</h6>';

        printdata +='</div>'

        printdata +='<div class="col-md-6 text-right">'

        printdata +='<a class="btn btn-primary" onclick="showTabs(0,2,10)">Edit</a>';

        printdata +='</div>';

        printdata +='</div>';

        printdata +='<table class="table">';

        printdata +='<tr>';

        printdata +='<td>Parent</td>';

        printdata +='<td>'+parsedObject.parent+'</td>';

        printdata +='</tr>';

        printdata +='<tr>';

        printdata +='<td>Client</td>';

        printdata +='<td>'+parsedObject.client+'</td>';

        printdata +='</tr>';

        printdata +='<tr>';

        printdata +='<td>Country</td>';

        printdata +='<td>'+parsedObject.country+'</td>';

        printdata +='</tr>';

        printdata +='<tr>';

        printdata +='<td>Commodity</td>';

        printdata +='<td>'+parsedObject.commodity[0].name+'</td>';

        printdata +='</tr>';

        printdata +='<tr>';

        printdata +='<td>Supplier</td>';

        printdata +='<td>'+parsedObject.supplier+'</td>';

        printdata +='</tr>';

        printdata +='<tr>';

        printdata +='<td>Contract Type</td>';

        printdata +='<td>'+parsedObject.contracttype[0].type+'</td>';

        printdata +='</tr>';

        if(parsedObject.contracttype[0].index != ""){

          printdata +='<tr>';



          printdata +='<td>Index name</td>';

          printdata +='<td>'+parsedObject.contracttype[0].index+'</td>';

          printdata +='</tr>';

        }

        printdata +='<tr>';

        printdata +='<td>Contract Commodity Currency</td>';

        printdata +='<td>'+parsedObject.contractprice+'</td>';

        printdata +='</tr>';

        printdata +='</table>';

        $('.preview1').html(printdata);

        var printtwodata = '';

        printtwodata +='<div class="row">';

        printtwodata +='<div class="col-md-6">';

        printtwodata +='<h6>Length And Consumption</h6>';

        printtwodata +='</div>'

        printtwodata +='<div class="col-md-6 text-right">'

        printtwodata +='<a class="btn btn-primary" onclick="showTabs(1,2,10)">Edit</a>';

        printtwodata +='</div>';

        printtwodata +='</div>';

        printtwodata +='<table class="table">';

        printtwodata +='<tr>';

        printtwodata +='<td>Contract Term</td>';

        printtwodata +='<td>'+parsedObject.contractterm+'</td>';

        printtwodata +='</tr>';

        printtwodata +='<tr>';

        printtwodata +='<td>Commodity Price</td>';

        printtwodata +='<td>'+parseFloat(parsedObject.comodityprice).toFixed(2)+' per MWh</td>';

        printtwodata +='</tr>';

        

        printtwodata +='<tr>';

        printtwodata +='<td>Total Annual Consumption</td>';

        printtwodata +='<td>'+parseFloat(parsedObject.totalanualconsumption).toFixed(2)+' MWh</td>';

        printtwodata +='</tr>';

        printtwodata +='<tr>';



        var allmonths = $('.allmonths').val();

            allmonths = allmonths.split(',');

           

        var getmnts = [];

        for(var j=0;j<allmonths.length;j++){

            var splitmonth = allmonths[j].split('-');

            getmnts.push(splitmonth[1]);

        }

        var totalmonths = getmnts.length;

        if(totalmonths>12){

          totalmonths = 12;

        }

        for(var i=0;i<totalmonths;i++){

          var monthja = $('.months'+i).val();

          printtwodata +='<td>'+$('.months'+i).val()+ ' Consumption</td>';

          var cons =eval('parsedObject.'+monthja+'consumption');

          printtwodata +='<td>'+cons+' MWh</td>';

          printtwodata +='</tr>';

          printtwodata +='<tr>';

        }

       



        printtwodata +='</table>';

        $('.preview2').html(printtwodata);

         

        }







      }

    

      

    if(currentTab == 2){

      var retrievedObject = localStorage.getItem('obj');

      var parsedObject = JSON.parse(retrievedObject);

      console.log(parsedObject);

      // console.log(parsedObject.commodity[0].name);

      parsedObject.index = $('.indexstr:checked').val();

      console.log(parsedObject.index);



      parsedObject.totalanualconsumption = $('.totalanualconsumption').val();

      var rowcount = $('.rowcount').val();

      var tradper = [];

      var tranches = [];

      var consumption =[];



      for ( i = 0; i < rowcount; i++) {

        if(typeof($('.tradsel'+i).val()) != "undefined"){

          tradper.push($('.tradsel'+i).val());

          var value = $('.tradsel'+i).val();

          var vals = value;

          tranches.push($('.tradsel'+i).val()+'-'+$('.tranche'+i).val());

          consumption.push($('.minsize'+i+':checked').val()+' + '+$('.tranche'+i).val());

        }

      }

      var allper =  tradper.toString();

      parsedObject[vals]= tranches.toString();

      parsedObject.cons = consumption.toString();

      parsedObject.allowperiod = allper;

      var mins = $('.clnmin').val();

      parsedObject[mins] = $('.minsize').val();

      parsedObject.pricMech = $('.pricMech').val();

      var x = document.getElementsByClassName("tab");

     

      var printdata = '';

        printdata +='<div class="row">';

        printdata +='<div class="col-md-6">';

        printdata +='<h6>Contract Details</h6>';

        printdata +='</div>'

        printdata +='<div class="col-md-6 text-right">'

        printdata +='<a class="btn btn-primary" onclick="showTabs(0,3)">Edit</a>';

        printdata +='</div>';

        printdata +='</div>';

        printdata +='<table class="table">';

        printdata +='<tr>';

        printdata +='<td>Parent</td>';

        printdata +='<td>'+parsedObject.parent+'</td>';

        printdata +='</tr>';

        printdata +='<tr>';

        printdata +='<td>Client</td>';

        printdata +='<td>'+parsedObject.client+'</td>';

        printdata +='</tr>';

        printdata +='<tr>';

        printdata +='<td>Country</td>';

        printdata +='<td>'+parsedObject.country+'</td>';

        printdata +='</tr>';

        printdata +='<tr>';

        printdata +='<td>Commodity</td>';

        printdata +='<td>'+parsedObject.commodity[0].name+'</td>';

        printdata +='</tr>';

        printdata +='<tr>';

        printdata +='<td>Supplier</td>';

        printdata +='<td>'+parsedObject.supplier+'</td>';

        printdata +='</tr>';

        printdata +='<tr>';

        printdata +='<td>Contract Type</td>';

        printdata +='<td>'+parsedObject.contracttype[0].type+'</td>';

        printdata +='</tr>';

        if(parsedObject.contracttype[0].index != ""){

          printdata +='<tr>';

          printdata +='<td>Index name</td>';

          printdata +='<td>'+parsedObject.contracttype[0].index+'</td>';

          printdata +='</tr>';

        }

        printdata +='<tr>';

        printdata +='<td>Contract Commodity Currency</td>';

        printdata +='<td>'+parsedObject.contractprice+'</td>';

        printdata +='</tr>';

        printdata +='</table>';

        $('.preview1').html(printdata);

        var printtwodata = '';

        printtwodata +='<div class="row">';

        printtwodata +='<div class="col-md-6">';

        printtwodata +='<h6>Length And Consumption</h6>';

        printtwodata +='</div>'

        printtwodata +='<div class="col-md-6 text-right">'

        printtwodata +='<a class="btn btn-primary" onclick="showTabs(1,3)">Edit</a>';

        printtwodata +='</div>';

        printtwodata +='</div>';

        printtwodata +='<table class="table">';

        printtwodata +='<tr>';

        printtwodata +='<td>Contract Term</td>';

        printtwodata +='<td>'+parsedObject.contractterm+'</td>';

        printtwodata +='</tr>';

        

        



          // printtwodata +='<tr>';

          // printtwodata +='<td>Commodity Price</td>';

          // printtwodata +='<td>'+parsedObject.comodityprice+'</td>';

          // printtwodata +='</tr>';



        printtwodata +='<tr>';

        printtwodata +='<td>Total Anual Consumption</td>';

        printtwodata +='<td>'+parsedObject.totalanualconsumption+' MWh</td>';

        printtwodata +='</tr>';

        printtwodata +='<tr>';



        var allmonths = $('.allmonths').val();

            allmonths = allmonths.split(',');

           

        var getmnts = [];

        for(var j=0;j<allmonths.length;j++){

            var splitmonth = allmonths[j].split('-');

            getmnts.push(splitmonth[1]);

        }

        var totalmonths = getmnts.length;

        if(totalmonths>12){

          totalmonths = 12;

        }

        for(var i=0;i<totalmonths;i++){

          var monthja = $('.months'+i).val();

          printtwodata +='<td>'+$('.months'+i).val()+ ' Consumption</td>';

          var cons =eval('parsedObject.'+monthja+'consumption');

          printtwodata +='<td>'+cons+' MWh</td>';

          printtwodata +='</tr>';

          printtwodata +='<tr>';

        }

        printtwodata +='</table>';

        $('.preview2').html(printtwodata);

        var printthreedata = '';

        printthreedata +='<div class="row">';

        printthreedata +='<div class="col-md-6">';

        printthreedata +='<h6>Index Details</h6>';

        printthreedata +='</div>'

        printthreedata +='<div class="col-md-6 text-right">'

        printthreedata +='<a class="btn btn-primary" onclick="showTabs(2,3)">Edit</a>';

        printthreedata +='</div>';

        printthreedata +='</div>';

        printthreedata +='<table class="table">';

        printthreedata +='<tr>';

        printthreedata +='<td>Index Structure</td>';

        printthreedata +='<td>'+parsedObject.index+'</td>';

        printthreedata +='</tr>';

        console.log(parsedObject);

        var tradeper = parsedObject.allowperiod;

        var arrayval = tradeper.split(",");

        var cconsum = parsedObject.cons;

            cconsum = cconsum.split(",");

            

            // balaji = cconsum;



              var mwflag = 0;

              for(var he=0; he<cconsum.length; he++) {

                  let res = cconsum[he];

                  cconsum[he] = res.replace("undefined +","");

                  let position = res.search("undefined +");

                  if(position === 0) {

                    mwflag = 1;

                  }

              }



              if(mwflag === 1) {

                for(l=0;l<arrayval.length;l++){

                    printthreedata +='<tr>';

                    printthreedata +='<td>selected trade period + clicks</td>';



                    printthreedata +='<td>'+arrayval[l]+' + '+cconsum[l]+'</td>';

                    printthreedata +='</tr>';

                  

                  // parsedObject.cons = consumption.toString();

                  

                  }

              } else {

                  for(l=0;l<arrayval.length;l++){

                    printthreedata +='<tr>';

                    printthreedata +='<td>selected trade period + type + clicks</td>';



                    printthreedata +='<td>'+arrayval[l]+' + '+cconsum[l]+'</td>';

                    printthreedata +='</tr>';

                  

                  // parsedObject.cons = consumption.toString();

                  

                  }

              }



        console.log(arrayval);

        // var consum = ['% consumption','#MWhs'];



        // for(var key in parsedObject){

        //   if(arrayval.includes(key)){

        //     var test = parsedObject[key].split(',');

        //     for(m=0;m<test.length;m++){

        //       printthreedata +='<tr>';

        //       printthreedata +='<td>selected trade period + type + clicks</td>';

              

        //         printthreedata +='<td>'+test[m]+'-'+key+'</td>';

        //         printthreedata +='</tr>';

              

        //     }

            

        //   }

        //   if(consum.includes(key)){

        //     printthreedata +='<tr>';

        //     printthreedata +='<td>clicks / Tranches Minimum size ('+key+')</td>';

        //     printthreedata +='<td>'+parsedObject[key]+'</td>';

        //     printthreedata +='</tr>';

        //   }

        

        // }

        



        printthreedata +='<td>Open Position Pricing Mechanism</td>';

        printthreedata +='<td>'+parsedObject.pricMech+'</td>';

        printthreedata +='</tr>';

        

        printthreedata +='</table>';

        $('.preview3').html(printthreedata);



        

    }







  }



  

    if (n == 1 && !validateForm(currentTab)) return false;

    x[currentTab].style.display = "none";

    currentTab = currentTab + n;

    if (currentTab >= x.length) {

        var form = document.getElementById("regForm");

        form.submit();

        return false;



    }

    showTab(currentTab);

}

 

function validateForm(currentTab) {

  var contractType = $('.contactType:checked').val();

  if(currentTab == 0){

    if(($('.clint').val() == '') || ($('.supplr').val() == '') || ($('.parent').val() == '')){

      alert('please select required fields');

      return false;

    }

    // if($('.clint'))

  }

  if(currentTab == 1){

    var tewst = $('.monthsallow').val();

    if(tewst !='yes'){

       alert('please select required fields');

        return false;

    }

    if(($('.startdate').val() == '') || ($('.endate').val() == '') || ($('.totalanualconsumption').val() == 0) || ($('.totalanualconsumption').val() == '')){

       alert('please select required fields');

      return false;

    }

    var columnepmpty =[];

    $('.peryr').each(function(){

      if($(this).val() =='' || $(this).val() ==undefined){

        columnepmpty.push(1);

      }

    })

    if(columnepmpty.length>0){

      alert('please select required fields');

        return false;

    }

    if(contractType =='fixed'){

      if(($('.comdyprice').val()=='')){

         alert('please select required fields');

        return false;

      }

    }

    if (!$("#checkbox").is(":checked")) {

       alert('please select required fields');

     return false;

    }

  }

   if(contractType !='fixed'){

    if(currentTab == 2){



      var rowcount = $('.rowcount').val();

      var emptyarray = [];

      for(var i=1;i<rowcount;i++){

        if($('.tranche'+i).val()=='' ){

          emptyarray.push(3)

        }

        if($('.minsize'+i).length >0){

          if (!$('.minsize'+i).is(":checked")){

            emptyarray.push(1);

          }

        }

      }

      if(emptyarray.length>0){

        alert('please select required fields');

        return false;

      }

      if(($('.addTrade div').length ==0) || ($('.pricMech').val() == '')){

        alert('please select required fields');

        return false;

      }

    }

  }



  

  

  // if({

  //   return false;

  // }

 

  return true; 

}



  $(".commodity").each(function () {

    

    $(this).on('change',function(){

      if($(this).prop('checked', true)){

        var commdty = $(this).val();

        $.ajax({

        type:'POST',

        url: 'js/callbacks/indexdropdown.php',

        data:{

          'commodityVal':commdty

        

        },

        success: function(data){

        

          $('.indxt').html(data);

        }

      });

        if($(this).val() == 'natural gas'){

          $('.units').css('display','block');

        }else{

          $('.units').css('display','none');

        }





      }

    })

    

    

    

  });

$('.contactType').on('change',function(){

  if($(this).prop('checked', true)){

    if($(this).val() == 'indexed'){

      var commdty = $('.commodity:checked').val();

      $.ajax({

        type:'POST',

        url: 'js/callbacks/indexdropdown.php',

        data:{

          'commodityVal':commdty

        

        },

        success: function(data){

        

          $('.indxt').html(data);

        }

      });

      $('.indexcl').css('display','block');

    }else{

      $('.indexcl').css('display','none');

    }

  }

});



$('input[type="checkbox"].indexstr').on('change', function() {

   $('input[type="checkbox"].indexstr').not(this).prop('checked', false);

});

$('input[type="checkbox"].commodity').on('change', function() {

   $('input[type="checkbox"].commodity').not(this).prop('checked', false);

});

$('input[type="checkbox"].unit').on('change', function() {

   $('input[type="checkbox"].unit').not(this).prop('checked', false);

});

$('input[type="checkbox"].contactType').on('change', function() {

   $('input[type="checkbox"].contactType').not(this).prop('checked', false);

});



function getclientdetails(clientId){

  $.ajax({

      type:'POST',

      url: 'js/callbacks/getclientdeails.php',

      data:{

        'clientId':clientId

      

      },

      success: function(data){

        var obj = JSON.parse(data);

        $('.country').val(obj.clientcountry);

        $('.clientname').val(obj.clientname);

        console.log(data);

      }

    });

}

function getparentdetails(parentId){

  $.ajax({

      type:'POST',

      url: 'js/callbacks/getparentdetails.php',

      data:{

        'parentId':parentId

      

      },

      success: function(data){

        $('.clint').html(data);

      }

    });

}



function calcualteMonthYr(startdate,enddate){

    var todate = new Date();

    if(enddate){



        todate = new Date(enddate);

    }

    var fromdate = new Date();

    if(startdate){



        fromdate = new Date(startdate);

    }

    console.log(fromdate);

    var getstartmonth = fromdate.getMonth();

    var getendmonth = todate.getMonth();

    var months=0;

        months = (todate.getFullYear() - fromdate.getFullYear()) * 12;

        months -= fromdate.getMonth();

        months += todate.getMonth();

            // if (todate.getDate() < fromdate.getDate()){

            //     months--;

            // }

   

    var dates      = [];

    var startYear =  Math.abs(fromdate.getFullYear());

    

    var endYear = Math.abs(todate.getFullYear());

    for(var i = startYear; i <= endYear; i++) {



      var endMonth = i != endYear ? 11 : parseInt(getendmonth);

      var startMon = i === startYear ? parseInt(getstartmonth) : 0;

      console.log('>>startmnt'+startMon+'>>endMonth'+endMonth);

      for(var j = startMon; j <= endMonth; j = j > 12 ? j % 12 || 11 : j+1) {

        var month = j+1;

        var displayMonth = month < 10 ? month : month;

        dates.push([i+'-'+displayMonth+'-'+'01']);

      }

    }

    

    $('.allmonths').val(dates);

    $('.countmonths').val(months+1);

  

}

// var rocount =['Calendar Yearly', 'Calendar Quarterly', 'Calendar Monthly', 'Season'];

var rocount =['Calendar Yearly', 'Calendar Quarterly', 'Calendar Monthly'];

var selectedarray =[];



function addTradeperiods(){

   

  var rowcount = parseInt($('.rowcount').val());



   var selectedval =  $("select.tradep > option:selected").map(function(){ selectedarray.push(this.value); })

     var list = selectedarray.filter(function (x, i, a) { 

      return a.indexOf(x) == i; 

    });

    console.log(list);

  if(rocount.length == list.length){

    alert('you can add more allowable trade');

    return;

  }



  var printData = '';



  if($('.indexstr:checked').val() == 'Power(MW)'){

        // alert($('.indexstr:checked').val());

        // document.querySelector('.hideonm').classList.add('.hideonmw');

        // document.querySelector('.clnmin').classList.add('.hideonmw');

        console.log(selectedarray);

        var printData = '';

      printData +='<div class="trade'+rowcount+'">';

      printData +='<div class="row">';

      printData +='<div class="col-md-7">';

      printData +='</div>';

      printData +='<div class="col-md-5">';

      printData +='<label style="margin: 0 0 0 -27%;">Clicks / tranches</label><br>';            

      printData +='</div>';

      printData +='</div>';

      printData +='<div class="row">';

      printData +='<div class="col-md-6">';

      // printData +='<label>Choose Calendar</label>';

      printData +='<select class="chosen-select tradep tradsel'+rowcount+'" name="tradsel'+rowcount+'">';



      printData +='<option value="Calendar Yearly" '+((selectedarray.includes('Calendar Yearly'))?

          'disabled':'')+'>Calendar Yearly</option>';

      printData +='<option value="Calendar Quarterly" '+((selectedarray.includes('Calendar Quarterly'))?

          'disabled':'')+'>Calendar Quarterly</option>';

      printData +='<option value="Calendar Monthly" '+((selectedarray.includes('Calendar Monthly'))?

          'disabled':'')+'>Calendar Monthly</option>';

      // printData +='<option value="Season" '+((selectedarray.includes('Season'))?

      //     'disabled':'')+'>Season</option>';

      printData +='</select>';

      printData +='</div>';

      printData +='<div class="col-md-4">';

      printData +='<input type="text" style="margin: 0 0 0 -44%;" class="form-control tranche'+rowcount+'" name="tranche'+rowcount+'">';

      printData +='</div>';

      printData +='<div class="col-md-2"><i class="fa fa-trash-o deleteIcon" onclick="removerow('+rowcount+')" aria-hidden="true"></i>';

      printData +='</div>';

      printData +='</div><br>';

      // printData +='<div class="row" style="margin: 3px 0 0 -1px;">';

      

      // printData +='<div class="input-group">';

      // printData +='<span class="input-group-addon input-group-addon2 transparent" style="width: 30%;">';

      // printData +='<input type="radio" style="width:3%;" id="consumption'+rowcount+'" class="clnmin minsize'+rowcount+'" name="minsize'+rowcount+'" value="% consumption"><label for="consumption'+rowcount+'">% consumption</label>';

      // printData +='<input type="radio" id="mwh'+rowcount+'" style="width:3%;" class="clnmin minsize'+rowcount+'" name="minsize'+rowcount+'" value="#MWhs"><label for="mwh'+rowcount+'">#MWhs</label><br>';

     

      // printData +='</span>';

      

      // printData +='<span class="input-group-addon transparent"> %</span>';

      // printData +='</div>';

      // printData +='</div>';

      printData +='</div>';

      // printData +='<br/>';

      // printData +='<hr>';

  }

  else{

    console.log(selectedarray);

    var printData = '';

      printData +='<div class="trade'+rowcount+'">';

      printData +='<div class="row">';

      printData +='<div class="col-md-7">';

      printData +='</div>';

      printData +='<div class="col-md-5">';

      printData +='<label style="margin: 0 0 0 -27%;">Clicks / tranches</label><br>';            

      printData +='</div>';

      printData +='</div>';

      printData +='<div class="row">';

      printData +='<div class="col-md-6">';

      // printData +='<label>Choose Calendar</label>';

      printData +='<select class="chosen-select tradep tradsel'+rowcount+'" name="tradsel'+rowcount+'">';



      printData +='<option value="Calendar Yearly" '+((selectedarray.includes('Calendar Yearly'))?

          'disabled':'')+'>Calendar Yearly</option>';

      printData +='<option value="Calendar Quarterly" '+((selectedarray.includes('Calendar Quarterly'))?

          'disabled':'')+'>Calendar Quarterly</option>';

      printData +='<option value="Calendar Monthly" '+((selectedarray.includes('Calendar Monthly'))?

          'disabled':'')+'>Calendar Monthly</option>';

      // printData +='<option value="Season" '+((selectedarray.includes('Season'))?

      //     'disabled':'')+'>Season</option>';

      printData +='</select>';

      printData +='</div>';

      printData +='<div class="col-md-4">';

      printData +='<input type="text" style="margin: 0 0 0 -44%;" class="form-control tranche'+rowcount+'" name="tranche'+rowcount+'">';

      printData +='</div>';

      printData +='<div class="col-md-2"><i class="fa fa-trash-o deleteIcon" onclick="removerow('+rowcount+')" aria-hidden="true"></i>';

      printData +='</div>';

      printData +='</div><br>';

      // printData +='<div class="row" style="margin: 3px 0 0 -1px;">';

      

      // printData +='<div class="input-group">';

      // printData +='<span class="input-group-addon input-group-addon2 transparent" style="width: 30%;">';

      printData +='<input type="radio" style="width:3%;" id="consumption'+rowcount+'" class="clnmin minsize'+rowcount+'" name="minsize'+rowcount+'" value="% consumption"><label for="consumption'+rowcount+'">% consumption</label>';

      printData +='<input type="radio" id="mwh'+rowcount+'" style="width:3%;" class="clnmin minsize'+rowcount+'" name="minsize'+rowcount+'" value="#MWhs"><label for="mwh'+rowcount+'">#MWhs</label><br>';

     

      // printData +='</span>';

      

      // printData +='<span class="input-group-addon transparent"> %</span>';

      // printData +='</div>';

      // printData +='</div>';

      printData +='</div>';

      // printData +='<br/>';

      // printData +='<hr>';

  }



 // var selectedval = $('.tradep :selected').val();

      // selectedarray.push(selectedval);

//  console.log(selectedarray);

//   var printData = '';

//       printData +='<div class="trade'+rowcount+'">';

//       printData +='<div class="row">';

//       printData +='<div class="col-md-7">';

//       printData +='</div>';

//       printData +='<div class="col-md-5">';

//       printData +='<label style="margin: 0 0 0 -27%;">Clicks / tranches</label><br>';            

//       printData +='</div>';

//       printData +='</div>';

//       printData +='<div class="row">';

//       printData +='<div class="col-md-6">';

//       // printData +='<label>Choose Calendar</label>';

//       printData +='<select class="chosen-select tradep tradsel'+rowcount+'" name="tradsel'+rowcount+'">';



//       printData +='<option value="Calendar Yearly" '+((selectedarray.includes('Calendar Yearly'))?

//           'disabled':'')+'>Calendar Yearly</option>';

//       printData +='<option value="Calendar Quarterly" '+((selectedarray.includes('Calendar Quarterly'))?

//           'disabled':'')+'>Calendar Quarterly</option>';

//       printData +='<option value="Calendar Monthly" '+((selectedarray.includes('Calendar Monthly'))?

//           'disabled':'')+'>Calendar Monthly</option>';

//       // printData +='<option value="Season" '+((selectedarray.includes('Season'))?

//       //     'disabled':'')+'>Season</option>';

//       printData +='</select>';

//       printData +='</div>';

//       printData +='<div class="col-md-4">';

//       printData +='<input type="text" style="margin: 0 0 0 -44%;" class="form-control tranche'+rowcount+'" name="tranche'+rowcount+'">';

//       printData +='</div>';

//       printData +='<div class="col-md-2"><i class="fa fa-trash-o deleteIcon" onclick="removerow('+rowcount+')" aria-hidden="true"></i>';

//       printData +='</div>';

//       printData +='</div><br>';

//       // printData +='<div class="row" style="margin: 3px 0 0 -1px;">';

      

//       // printData +='<div class="input-group">';

//       // printData +='<span class="input-group-addon input-group-addon2 transparent" style="width: 30%;">';

//       printData +='<input type="radio" style="width:3%;" id="consumption'+rowcount+'" class="clnmin minsize'+rowcount+'" name="minsize'+rowcount+'" value="% consumption"><label for="consumption'+rowcount+'">% consumption</label>';

//       printData +='<input type="radio" id="mwh'+rowcount+'" style="width:3%;" class="clnmin minsize'+rowcount+'" name="minsize'+rowcount+'" value="#MWhs"><label for="mwh'+rowcount+'">#MWhs</label><br>';

     

//       // printData +='</span>';

      

//       // printData +='<span class="input-group-addon transparent"> %</span>';

//       // printData +='</div>';

//       // printData +='</div>';

//       printData +='</div>';

//       // printData +='<br/>';

//       // printData +='<hr>';

      

 

        

      

      

    

      

  $('.addTrade').append(printData);

  $('.rowcount').val(rowcount+1);

  

}

function removerow(row){

  var selectedvalue = $('.tradsel'+row).val();

  

  const index = selectedarray.indexOf(selectedvalue);

  if (index > -1) { 

    selectedarray.splice(index, 1); 

  }

  $('.trade'+row).remove();

}

</script>

    <?php

        include('hoverinclude/hoversupply.php');

    ?>



</body>

</html>