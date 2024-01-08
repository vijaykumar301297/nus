<?php

include('security.php');
if ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'NUS Manager') {
  //echo 'You have no acesss to view the page';
  echo "<script>alert('You have no access to view this page!');window.location.href='index.php';</script>";
  die();
}
include 'dbconn.php';
error_reporting(E_ERROR | E_PARSE);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="css/entertrade.css">

  <script src="js/function.js"></script>

  <!-- <script src="js/jquery.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/functions.js"></script> -->

  <title>NUS TTS System | Enter trade</title>

  <link rel="icon" href="img/social-square-n-blue.png">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

  <style>
    input {

      position: relative;

      /*   width: 150px; height: 20px;

    color: white;*/

    }



    input:before {

      position: absolute;

      top: 11px;

      left: 12px;

      content: attr(data-date);

      display: inline-block;

      color: #345DA6;

    }



    input::-webkit-datetime-edit,

    input::-webkit-inner-spin-button,

    input::-webkit-clear-button {

      display: none;

    }



    input::-webkit-calendar-picker-indicator {

      position: absolute;

      top: 11px;

      right: 0;

      color: black;

      opacity: 1;

    }



    .date-value {

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
  </style>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');



    .suplycnt {

      margin: 40px 0 0 300px;

    }



    .row {

      display: flex;

    }



    .col-md-8 {

      width: 55%;

      margin-right: 10px;

    }



    .col-md-6 {

      width: 50%;

    }



    .col-md-4 {

      width: 40%;

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



    #nextBtn {

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



    .cat {

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

      border-radius: 6px;



    }



    .cat label input {

      position: absolute;

      display: none;



    }



    /* selects all of the text within the input element and changes the color of the text */

    /*.cat label input + span{color: #fff;}

*/



    /* This will declare how a selected input will look giving generic properties */

    .cat input:checked+span {

      color: #ffffff;



    }



    .disabledbutton {

      color: grey;

      border: 1px solid grey;

      opacity: 0.5;

    }



    .cat label span img {

      filter: grayscale(100%);

    }



    .activebutton {

      color: #1363F1 !important;

      border: 1px solid #1363F1;

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

      padding: 0px !important;

      /*margin: 0 0 -15px 0;*/

    }



    .catw {

      display: inline-block;

    }



    .padmd0 h3 {

      margin-top: 6px;

      font-size: 26px;

      color: #345DA6;



    }



    .padmd0 select {

      border: 1px solid lightgrey;

      box-shadow: none;

      color: #000;

      height: 38px !important;

      background-color: rgb(255, 255, 255);

      cursor: pointer;

      color: #345DA6;

      border: 1px solid #1363F1;

      border-radius: 6px;

    }



    .padmd0 h6 {

      text-transform: capitalize;

      color: #345DA6;

      font-size: 14px;

      /* letter-spacing: 1px; */

    }



    .switch {

      display: inline-block;

      height: 27px;

      position: relative;

      width: 55px;

      top: 14px;

    }



    .switch input {

      display: none;

    }



    .switchs {

      display: inline-block;

      height: 27px;

      position: relative;

      width: 55px;

      top: 14px;

    }



    .switchs input {

      display: none;

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



    .tradevolume input {

      width: 70%;

    }

    #tradevalue {

      border-radius: 6px 0 0 6px;

      height: 36.5px;
      
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



    input:checked+.sliders {

      background-color: #1363F1;

    }



    input:checked+.sliders:before {

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



    input:checked+.slider {

      background-color: #1363F1;

    }



    input:checked+.slider:before {

      transform: translateX(26px);

    }



    .slider.round {

      border-radius: 34px;

    }



    .slider.round:before {

      border-radius: 50%;

    }



    .contrac {

      background: white;

      border-radius: 8px;

    }



    .client {

      position: relative;

    }



    .searchs {

      position: absolute;

      top: 5px;

      left: 3px;

      width: 10%;

    }



    .page select {

      font-size: 10px;

      padding: 7px !important;

    }



    .flitr {

      position: absolute;

      right: 5px;

      top: 5px;

    }



    .fullwidth {

      width: 100%;

      float: unset !important;

    }



    .clientbr ul {

      padding-inline-start: 0px;

    }



    .clientbr ul li {

      display: inline;

    }



    .clientbr ul li a {

      padding: 7px;

      text-decoration: none;

    }



    .client input[type="text"] {

      padding-left: 25px;

    }



    .units {

      display: none;

    }



    .indexcl {

      display: none;

    }



    .page {

      position: absolute;

      right: 15%;

      top: 5px;

    }



    .sttab {

      width: 77%;

    }



    .bfg {

      height: 1px;

      background-color: lightgrey;

    }



    div label input {

      margin-right: 100px;

    }



    /*

This following statements selects each category individually that contains an input element that is a checkbox and is checked (or selected) and chabges the background color of the span element.

*/

    /* .action input:hover +span{

  background-color: #fff;

  color: blue;

  border:1px solid blue;

  padding: 0px 10px;



} */

    .action input:hover+span {

      background-color: #fff;

      opacity: 1;

      color: #1363F1;

      border: 1px solid #1363F1;

      padding: 0px 10px;

    }



    /* .action input:hover +span img{

  filter: invert(25%) sepia(94%) saturate(3383%) hue-rotate(215deg) brightness(98%) contrast(92%);

} */

    .action input:checked+span {

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

    .chosen-container-single .chosen-single {

      height: 35px !important;

      padding: 6px 0px 0px 8px !important;

    }



    .tab {

      display: none;

    }



    .widse {

      width: 100%;

      margin: auto;

    }



    .tab img {

      margin: 3px;

    }



    .padmd0 {



      position: absolute;

      width: 46%;

      left: 58%;

      top: 5%;

      transform: translate(-50%, 0%);

    }



    body {

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

      box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);

      border: 3px solid #fff;

      height: 17px;

      width: 17px;

      border-radius: 50%;

      background: #1363F1;



      cursor: pointer;

      -webkit-appearance: none;

      margin-top: -8px;

    }



    .allowdvi {

      padding-top: 24px;

    }



    input[type=range]:focus::-webkit-slider-runnable-track {

      background: #E3EBF6;

    }



    .diviy p {

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

      border-radius: 6px;

    }



    .input-group-addon {



      background-color: rgb(255, 255, 255);

      cursor: pointer;

      color: #345DA6;

      border: 1px solid #1363F1;

      /* border-radius: 6px; */

      border-radius: 0 6px 6px 0;



    }



    #cancelBtn,

    #prevBtn {

      background-color: rgb(255, 255, 255);

      cursor: pointer;

      color: #345DA6;

      border: 1px solid #1363F1;

      border-radius: 6px;

    }



    .seasonyear {

      display: none;

      margin: 0 0 0 12px;

    }



    .calendarquater {

      display: none;

      margin: 0 0 0 12px;

    }



    .calendarmonths {

      display: none;

      margin: 0 0 0 12px;

    }



    #calenderseason {

      padding: 0 20px;



    }



    #monthyear {

      width: 670px;

      height: 33px;

      padding-left: 10px;

      height: 40px;

      margin:10px 0 0 0;

    }



    #yearc {

      padding: 0 10px;

    }



    #quarteryear {

      padding: 0 10px;

    }



    #monthsyear {

      padding: 0 10px;

    }



    #checkc {

      margin: 0 0 0 7px;

    }



    /* #effectiveprices {

    position: absolute;

    bottom: 30%;

} */



    #Q1 {

      padding: 0px 16px 0px;

      gap: 10px;

    }



    #Q2 {

      padding: 0px 16px 0px;

      gap: 10px;

    }



    #Q3 {

      padding: 0px 16px 0px;

      gap: 10px;

    }



    #Q4 {

      padding: 0px 16px 0px;

      gap: 10px;

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

      margin: 4px 0 10px 0px;

    }



    .cur {

      position: absolute;

      z-index: 1;

    }



    /*#tradevalue {

  width:74%;

}*/



    .input-group-addon {

      position: absolute;

      top: 0%;

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



    .baslad input {

      width: 100%;

    }



    .tradevolume {

      margin: 0 0 0 15px;

    }



    .effectprss {

      display: none;

    }



    .creatdate {

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
  </style>

</head>



<body>

  <?php

  if (isset($_SESSION['errorclick']) && ((time() - $_SESSION['errorclick']) < 2)) {



    echo '<script> toastr.warning("click not available", "Trade ");</script>';

    if ((time() - $_SESSION['errorclick']) > 2) {

      unset($_SESSION['errorclick']);
    }
  }

  if (isset($_SESSION['errorconsumption']) && ((time() - $_SESSION['errorconsumption']) < 2)) {



    echo '<script> toastr.warning("consumption not available", "Trade ");</script>';

    if ((time() - $_SESSION['errorconsumption']) > 2) {

      unset($_SESSION['errorconsumption']);
    }
  }



  ?>

  <div class="containertrade">

    <form action="insertentertrade.php" method="POST" autocomplete="off" onsubmit="return checktradeempty()">

      <input type="hidden" value="" class="fullCalendarTerm" id="fullCalendarTerm1">

      <input type="hidden" value="" class="leapYear" id="leapYear1">

      <div class="header">

        <h2 class="entry">Trade entry</h2>

        <h1 class="trade">New trade entry</h1>

      </div>



      <div class="contents">

        <div class="clientDetails">

          <label class="clientData">Parent</label>

          <select id="client" class="parentname" name="parentid" onchange="parentdetails(this.value)">

            <option value="">Select Parent</option>



            <?php

            $getparent = array();

            $getparentdetails = "SELECT * FROM parentcompanydata where state='Active'";

            $results = $conn->query($getparentdetails);

            if ($results->num_rows > 0) {

              while ($row = $results->fetch_assoc()) {

                $getparent[] = $row;
              }
            }



            foreach ($getparent as $key => $valueparent) {



            ?>
              <option value="<?= $valueparent['parentcompany'] ?>"><?= $valueparent['parentcompany'] ?></option>



            <?php

            }

            ?>

          </select>



        </div>

        <input type="hidden" class="clientsId" name="clientsId">

        <div class="clientDetails">

          <label class="clientData">Client</label>

          <select id="client" class="clientcom" onchange="clientChange(this.value)" name="clientcompany">

            <option value="">Select Client</option>

          </select>



        </div>

        <br>

        <input type="hidden" name="jsonfile" class="jsonfile">

        <input type="hidden" name="supplierid" class="suppId">

        <input type="hidden" class="trancheclick" name="trancheclick">

        <input type="hidden" class="tradeid" name="tranchclick">

        <input type="hidden" class="totalanual">

        <input type="hidden" class="yeardays">

        <input type="hidden" class="quaranual" name="quartanual">

        <div class="contractDetails">

          <label class="contractData">Contract</label>

          <select id="contract" name='clientId' class="contractname" onchange="contractTerm(this.value)">

            <option value="">Select Client</option>

          </select>

        </div>

        <!-- <option id= "nusclient" class="clients" onchange="showdiv('parent', this)">NUS Client  </option> -->



        <div class="contractDetails">

          <label class="contractData">Trade execution date</label>

          <input type="date" class="date-value form-control" name="creationdate" data-date="" data-date-format="DD-MMM-YYYY" value="<?= date('Y-m-d', time()) ?>">

          <!-- <input type="date" data-date="" value="2015-08-09"> -->

          <!-- <div class="input-group input-daterange">

                  <input id="startDate1" name="startDate1" type="text"

                    class="form-control startdate"  readonly="readonly" > <span

                    class="input-group-addon"> -->

          <!--  <span

                    class="glyphicon glyphicon-calendar"></span> -->

          <!--  </span>

                </div> -->

          <!-- <input type="date" name="creationdate" class="input-daterange" value="<?= date('Y-m-d', time()) ?>"> -->

          <!-- <option id= "nusclient" class="clients" onchange="showdiv('parent', this)">NUS Client  </option> -->

        </div>





        <input type="hidden" class="contractTerm">

        <div class="headers">

          <div>

            <span class="tradePeriod">Trade period</span>

            <span class="year">Year</span>

          </div>

        </div>

        <br>

        <div id="checkc" style="display: inline-block;">

          <div class="cat action">

            <label>

              <input type="checkbox" value="Calendar Yearly" name="Tradeperiod[]" class="Tradeperiod" onclick="yearly()" id="yearTrade"><span id="yearc" class="disabledbutton act">Calendar Year</span>

            </label>

          </div>

          <div class="cat action">

            <label>

              <input type="checkbox" value="Calendar Quarterly" name="Tradeperiod[]" class="Tradeperiod" id="quarterstTrade" onclick="quarters()"><span id="quarteryear" class="disabledbutton dis">Calendar Quarters</span>

            </label>

          </div>

          <div class="cat action">

            <label>

              <input type="checkbox" value="Calendar Monthly" name="Tradeperiod[]" class="Tradeperiod" id="monthlytrade" onclick="monthlyData()"><span id="monthsyear" class="disabledbutton dis">Calendar Month</span>

            </label>

          </div>
          <!-- season  edit-->
          <div class="cat action">

            <!-- <label>

              <input type="checkbox" value="Season" name="Tradeperiod[]" class="Tradeperiod" onclick="season()" id="Seasontrade"><span id="calenderseason" class="disabledbutton dis">Season</span>

            </label> -->
            <!-- end season -->

          </div>





          <div class="cat action">

            <select id="ddlYears" name="ddlyear">

              <option selected disabled>Select the year</option>

            </select>

          </div>

        </div>

        <div class="dynamiccheckbox">

          <div class="seasonyear">



            <!-- <label for="">Season</label> -->

            <div style="display: inline-block;">

              <div class="cat action">

                <!-- <label>

                  <input type="checkbox" value="oct-mar" name="seasonname[]" class="seasonname"><span id="octmar" class="disabledbutton act">Oct-Mar</span>

                </label> -->

              </div>



              <div class="cat action">

                <!-- <label>

                  <input type="checkbox" value="apr-sep" name="seasonname[]" class="seasonname"><span id="aprsep" class="disabledbutton dis">Apr-Sep</span>

                </label> -->

              </div>

            </div>

          </div>



          <div class="calendarquater">



            <label for="">Quarter</label>

            <div style="display: inline-block;">

              <div class="cat action">

                <label>

                  <input type="checkbox" value="q1" name="Quarter[]" class="Quarter" onclick="q1()" id="quarter1"><span id="Q1" class="disabledbutton act">Q1</span>

                </label>

              </div>



              <div class="cat action">

                <label>

                  <input type="checkbox" value="q2" name="Quarter[]" class="Quarter" onclick="q2()" id="quarter2"><span id="Q2" class="disabledbutton dis">Q2</span>

                </label>

              </div>



              <div class="cat action">

                <label>

                  <input type="checkbox" value="q3" name="Quarter[]" class="Quarter" onclick="q3()" id="quarter3"><span id="Q3" class="disabledbutton act">Q3</span>

                </label>

              </div>



              <div class="cat action">

                <label>

                  <input type="checkbox" value="q4" name="Quarter[]" class="Quarter" onclick="q4()" id="quarter4"><span id="Q4" class="disabledbutton dis">Q4</span>

                </label>

              </div>

            </div>

          </div>



          <div class="calendarmonths">



            <label for="">Calandar Month</label>

            <div style="display: inline-block;">

              <select id="monthyear" class="form-control" name="month">



                <option value="" selected disabled>Please Select month</option>

                <?php

                $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                $monthvalue = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                for ($i = 0; $i < count($month); $i++) {

                  $index = array_search($month[$i], $month);

                ?>



                  <option value="<?= $monthvalue[$index] ?>"><?= $month[$i] ?></option>



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

            <input type="hidden" class="vinay">

            <div class="col-md-8">

              <h3 style="margin-left: 10px; color:#345DA6" id="vijay">Aggregate Trade volume for the trade period</h3>

              <br>

              <div class="row">

                <div class="col-md-6">

                  <div class="tradevolume">

                    <input type="hidden" class="percentagecal" name="percentagecal">

                    <input type="hidden" class="clicktriches" name="clicktriches" onclick="hideButton()">



                    <div class="input-group">

                      <input class="form-control left-border-none mwhtrade" id="tradevalue" onkeypress="return CheckNumerics()" onkeyup="FormatCurrencys(this)" type="text" placeholder="0.00" name="mwhtrade">

                      <span class="input-group-addon transparent" id="mw">

                        MWh</span>

                    </div>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="tradevolume">

                    <input type="hidden" class="clicktriches" name="clicktriches">



                    <div class="input-group" id='disable' onclick="hideButton()">

                      <input class="form-control left-border-none mwhpercentage" id="tradevalue" placeholder="0%" type="text" value="" name="percentagetrade">

                      <span class="input-group-addon transparent">

                        %</span>

                    </div>

                  </div>

                </div>



              </div>

              <div class="row baslad" style="padding-top: 10px;">

                <div class="col-md-6">

                  <input type="hidden" class="tradename" name="tradename">

                  <div id="baseloadprices" class="cat action">

                    <label for="baseLoad" class="loadprice">Base load price</label>

                    <br>

                    <input class="loadprices" type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" placeholder="0.00" name="baseload" required>

                  </div>

                </div>

                <div class="col-md-6 effectprss">

                  <div id="effectiveprices" class="cat action">

                    <label for="effectiveprice" class="effectiveprice">Effective price</label>

                    <br>

                    <input class="effectiveprice" type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" placeholder="0.00" name="effectiveprice" required>

                  </div>



                </div>

              </div>

            </div>

            <div class="col-md-4">

              <input type="hidden" class="tradename" name="tradename">



              <h3 style="color:#345DA6" id="Est">Est.percentage Volume</h3>

              <br>

              <input type="hidden" class="clicktriches" name="clicktriches">



              <div class="input-group">

                <input class="form-control left-border-none tradevol" type="text" value="" placeholder="0.00" name="tradevolume" readonly style="background: #f5f2f2!important; border-radius:6px 0 0 6px; height:36.5px; width:170px">

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

        <button class="enterTradebtn" onclick="return validForm()">Enter trade</button>

      </div>

  </div>

  </div>

  </form>

  </div>

</body>

<script>
  $("input").on("change", function() {

    this.setAttribute(

      "data-date",

      moment(this.value, "YYYY-MM-DD")

      .format(this.getAttribute("data-date-format"))

    )

  }).trigger("change")
</script>

<script type="text/javascript">
  function percentage(val) {



    var percentage = 0;



    // var val = 0;

    console.log("Two=" + val);

    if (val > 100) {

      alert('Not possible more than 100%!');

      location.href = 'entertrade.php';

    }

    var consumpt = $('.totalanual').val();

    console.log(consumpt);

    percentage = ((val / 100) * consumpt).toFixed(2);

    $('.tradevol').val(percentage);

    console.log($('.tradevol').val(percentage));

  }
</script>

<script type="text/javascript">
  function calc() {

    res = calculatePower();



    let q1 = q2 = q3 = q4 = yeardays = 0;



    for (i = 0; i < 12; i++) {

      if (i >= 0 && i <= 2) {

        q1 += res[i];

      } else if (i >= 3 && i <= 5) {

        q2 += res[i];

      } else if (i >= 6 && i <= 8) {

        q3 += res[i];

      } else {

        q4 += res[i];

      }

    }



    yeardays = q1 + q2 + q3 + q4;



    // console.log(res);



    let leapornot = $('.leapYear').val(); //either leap or notleap



    let year1checked = $('#yearTrade').attr('checked'); // yearly checked value

    // console.log(year1checked);

    let year1value = $('#yearTrade').val(); // yearly name 



    let quaterchecked = $('#quarterstTrade').attr('checked'); // quater checked value    

    let quatervalue = $('#quarterstTrade').val(); // quarter name 



    let monthchecked = $('#monthlytrade').attr('checked'); // month checked value

    let monthvalue = $('#monthlytrade').val(); // month name 



    let q1checked = $('#quarter1').attr('checked'); // quater checked value    

    let q1value = $('#quarter1').val(); // quarter name 



    let q2checked = $('#quarter2').attr('checked'); // quater checked value    

    let q2value = $('#quarter2').val(); // quarter name 



    let q3checked = $('#quarter3').attr('checked'); // quater checked value    

    let q3value = $('#quarter3').val(); // quarter name 



    let q4checked = $('#quarter4').attr('checked'); // quater checked value    

    let q4value = $('#quarter4').val(); // quarter name 



    console.log("YearValue = " + year1value);

    console.log("YearChecked = " + year1checked);



    if (year1checked == 'checked' && year1value == 'Calendar Yearly') {

      if (leapornot == "notleap" && yeardays == 365) {

        result = document.querySelector('.mwhtrade').value;

        final = 365 * result * 24;

        console.log("Not leap");

        console.log(final);

        $('.tradevol').val(final);

      } else if (leapornot == "leap" && yeardays == 366) {

        result = document.querySelector('.mwhtrade').value;

        final = 366 * result * 24;

        $('.tradevol').val(final);

      } else {

        alert('Trade is not possible for Year!');

        window.location = 'entertrade.php';

      }

    } else if (quaterchecked == 'checked' && quatervalue == 'Calendar Quarterly') {

      // quaterly q1

      if (q1checked == 'checked' && q1value == 'q1') {

        if (leapornot == "notleap" && q1 == 90) {



          result = document.querySelector('.mwhtrade').value;

          final = 90 * result * 24;

          console.log("Not leap");

          console.log(final);

          $('.tradevol').val(final);

        } else if (leapornot == "leap" && q1 == 91) {

          result = document.querySelector('.mwhtrade').value;

          final = 91 * result * 24;

          $('.tradevol').val(final);

        } else {

          alert('Trade is not possible for Quaterly 1!');

          window.location = 'entertrade.php';

        }

      }

      //quaterly q2

      if (q2checked == 'checked' && q2value == 'q2') {

        if (q2 == 91) {



          result = document.querySelector('.mwhtrade').value;

          final = 91 * result * 24;

          console.log("Not leap");

          console.log(final);

          $('.tradevol').val(final);

        } else {

          alert('Trade is not possible for Quaterly 2!');

          window.location = 'entertrade.php';

        }

      }



      // quarterly q3



      if (q3checked == 'checked' && q3value == 'q3') {

        if (q3 == 92) {



          result = document.querySelector('.mwhtrade').value;

          final = 92 * result * 24;

          console.log("Not leap");

          console.log(final);

          $('.tradevol').val(final);

        } else {

          alert('Trade is not possible for Quaterly 3!');

          window.location = 'entertrade.php';

        }

      }



      //quaterly q4



      if (q4checked == 'checked' && q4value == 'q4') {

        if (q4 == 92) {



          result = document.querySelector('.mwhtrade').value;

          final = 92 * result * 24;

          console.log("Not leap");

          console.log(final);

          $('.tradevol').val(final);

        } else {

          alert('Trade is not possible for Quaterly 4!');

          window.location = 'entertrade.php';

        }

      }



    } else if (monthchecked == 'checked' && monthvalue == 'Calendar Monthly') {

      let month = document.getElementById('monthyear').value;

      switch (month) {

        case 'Jan':

          if (res[0] == 31) {

            result = document.querySelector('.mwhtrade').value;

            final = 31 * result * 24;

            console.log(final);

            $('.tradevol').val(final);

          } else {

            alert('Trade is not possible for Jan month!');

            window.location = 'entertrade.php';

          }

          break;

        case 'Mar':

          if (res[2] == 31) {

            result = document.querySelector('.mwhtrade').value;

            final = 31 * result * 24;

            console.log(final);

            $('.tradevol').val(final);

          } else {

            alert('Trade is not possible for Mar month!');

            window.location = 'entertrade.php';

          }

          break;

        case 'May':

          if (res[4] == 31) {

            result = document.querySelector('.mwhtrade').value;

            final = 31 * result * 24;

            console.log(final);

            $('.tradevol').val(final);

          } else {

            alert('Trade is not possible for May month!');

            window.location = 'entertrade.php';

          }

          break;

        case 'July':

          if (res[6] == 31) {

            result = document.querySelector('.mwhtrade').value;

            final = 31 * result * 24;

            console.log(final);

            $('.tradevol').val(final);

          } else {

            alert('Trade is not possible for July month!');

            window.location = 'entertrade.php';

          }

          break;

        case 'Aug':

          if (res[7] == 31) {

            result = document.querySelector('.mwhtrade').value;

            final = 31 * result * 24;

            console.log(final);

            $('.tradevol').val(final);

          } else {

            alert('Trade is not possible for Aug month!');

            window.location = 'entertrade.php';

          }

          break;

        case 'Oct':

          if (res[9] == 31) {

            result = document.querySelector('.mwhtrade').value;

            final = 31 * result * 24;

            console.log(final);

            $('.tradevol').val(final);

          } else {

            alert('Trade is not possible for Oct month!');

            window.location = 'entertrade.php';

          }

          break;

        case 'Dec':

          if (res[11] == 31) {

            result = document.querySelector('.mwhtrade').value;

            final = 31 * result * 24;

            console.log(final);

            $('.tradevol').val(final);

          } else {

            alert('Trade is not possible for Dec month!');

            window.location = 'entertrade.php';

          }

          break;



        case 'Apr':

          if (res[3] == 30) {

            result = document.querySelector('.mwhtrade').value;

            final = 30 * result * 24;

            console.log(final);

            $('.tradevol').val(final);

          } else {

            alert('Trade is not possible for April month!');

            window.location = 'entertrade.php';

          }

          break;

        case 'Jun':

          if (res[5] == 30) {

            result = document.querySelector('.mwhtrade').value;

            final = 30 * result * 24;

            console.log(final);

            $('.tradevol').val(final);

          } else {

            alert('Trade is not possible for June month!');

            window.location = 'entertrade.php';

          }

          break;

        case 'Sep':

          if (res[8] == 30) {

            result = document.querySelector('.mwhtrade').value;

            final = 30 * result * 24;

            console.log(final);

            $('.tradevol').val(final);

          } else {

            alert('Trade is not possible for Sep month!');

            window.location = 'entertrade.php';

          }

          break;

        case 'Nov':

          if (res[10] == 30) {

            result = document.querySelector('.mwhtrade').value;

            final = 30 * result * 24;

            console.log(final);

            $('.tradevol').val(final);

          } else {

            alert('Trade is not possible for Nov month!');

            window.location = 'entertrade.php';

          }

          break;



        case 'Feb':

          if (res[1] == 28 && leapornot == "notleap") {

            result = document.querySelector('.mwhtrade').value;

            final = 28 * result * 24;

            console.log("Not leap");

            console.log(final);

            $('.tradevol').val(final);

          } else if (res[1] == 29 && leapornot == "leap") {

            result = document.querySelector('.mwhtrade').value;

            final = 29 * result * 24;

            console.log("leap");

            $('.tradevol').val(final);

          } else {

            alert('Trade is not possible for Feb month!');

            window.location = 'entertrade.php';

          }



          break;



        default:
          alert('invalid month');

          break;

      }

    }



    // if($('#yearTrade').html() == "Calendar Year") {



    // } 









    // days=$('.yeardays').val();

    // if(days==365 || days==366){

    //    result=document.querySelector('.mwhtrade').value;

    //    final=days*result*24;

    //    console.log(final);

    //    $('.tradevol').val(final);

    // }

    // else{

    //    alert("Calendar Year trade is not possible!");

    //    window.location='entertrade.php';

    // }



  }



  // onclick function for yearly, qauter and monthly starts

  function yearly() {

    document.getElementById('yearTrade').setAttribute("checked", true);

    document.getElementById('quarterstTrade').removeAttribute("checked");

    document.getElementById('monthlytrade').removeAttribute("checked");

  }





  function quarters() {

    document.getElementById('quarterstTrade').setAttribute("checked", true);

    document.getElementById('yearTrade').removeAttribute("checked");

    document.getElementById('monthlytrade').removeAttribute("checked");

  }



  function monthlyData() {

    document.getElementById('quarterstTrade').removeAttribute("checked");

    document.getElementById('yearTrade').removeAttribute("checked");

    document.getElementById('monthlytrade').setAttribute("checked", true);
    // Document.getElementById('monthyear').setAttribute("required");

  }



  // 

  function q1() {

    document.getElementById("quarter1").setAttribute("checked", true);

    document.getElementById('quarter2').removeAttribute("checked");

    document.getElementById('quarter3').removeAttribute("checked");

    document.getElementById('quarter4').removeAttribute("checked");

    document.getElementById('yearTrade').removeAttribute("checked");

    document.getElementById('monthlytrade').removeAttribute("checked");

  }



  function q2() {

    document.getElementById("quarter2").setAttribute("checked", true);

    document.getElementById('quarter1').removeAttribute("checked");

    document.getElementById('quarter3').removeAttribute("checked");

    document.getElementById('quarter4').removeAttribute("checked");

    document.getElementById('yearTrade').removeAttribute("checked");

    document.getElementById('monthlytrade').removeAttribute("checked");

  }



  function q3() {

    document.getElementById("quarter3").setAttribute("checked", true);

    document.getElementById('quarter2').removeAttribute("checked");

    document.getElementById('quarter1').removeAttribute("checked");

    document.getElementById('quarter4').removeAttribute("checked");

    document.getElementById('yearTrade').removeAttribute("checked");

    document.getElementById('monthlytrade').removeAttribute("checked");

  }



  function q4() {

    document.getElementById("quarter4").setAttribute("checked", true);

    document.getElementById('quarter2').removeAttribute("checked");

    document.getElementById('quarter3').removeAttribute("checked");

    document.getElementById('quarter1').removeAttribute("checked");

    document.getElementById('yearTrade').removeAttribute("checked");

    document.getElementById('monthlytrade').removeAttribute("checked");

  }







  function FormatCurrencys(ctrl) {

    var num = ctrl.value;

    var str = num.toString().replace("$", ""),

      parts = false,

      output = [],

      i = 1,

      formatted = null;

    if (str.indexOf(".") > 0) {

      parts = str.split(".");

      str = parts[0];

    }

    str = str.split("").reverse();

    for (var j = 0, len = str.length; j < len; j++) {

      if (str[j] != ",") {

        output.push(str[j]);

        if (i % 3 == 0 && j < (len - 1)) {

          output.push(",");

        }

        i++;

      }

    }

    formatted = output.reverse().join("");

    var number = formatted + ((parts) ? "." + parts[1].substr(0, 2) : "");

    ctrl.value = number;

    $('.tradevol').val(number);

  }



  function CheckNumerics() {

    return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46 || event.keyCode == 9;

  }



  function FormatCurrency(ctrl) {

    var num = ctrl.value;

    var str = num.toString().replace("$", ""),

      parts = false,

      output = [],

      i = 1,

      formatted = null;

    if (str.indexOf(".") > 0) {

      parts = str.split(".");

      str = parts[0];

    }

    str = str.split("").reverse();

    for (var j = 0, len = str.length; j < len; j++) {

      if (str[j] != ",") {

        output.push(str[j]);

        if (i % 3 == 0 && j < (len - 1)) {

          output.push(",");

        }

        i++;

      }

    }

    formatted = output.reverse().join("");

    var number = formatted + ((parts) ? "." + parts[1].substr(0, 2) : "");

    ctrl.value = number;



  }



  function CheckNumeric() {

    return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;

  }
</script>

<script>
  $('.Tradeperiod').each(function() {

    $(this).on('change', function() {

      if ($(this).prop('checked', true)) {

        if ($(this).val() == 'Calendar Yearly') {

          $('.year').css('display', 'inline');

          $('#ddlYears').css('display', 'block');

        }

        // else{

        //   $('.year').css('display','none');

        //   $('#ddlYears').css('display','none');

        // }

        if ($(this).val() == 'Season') {

          $('.seasonyear').css('display', 'block');

        } else {

          $('.seasonyear').css('display', 'none');

        }

        if ($(this).val() == 'Calendar Quarterly') {



          $('.calendarquater').css('display', 'block');

        } else {

          $('.calendarquater').css('display', 'none');

        }

        if ($(this).val() == 'Calendar Monthly') {

          $('.calendarmonths').css('display', 'block');

        } else {

          $('.calendarmonths').css('display', 'none');

        }

      }



    })

  })



  function clientChange(val) {



    console.log("One = " + val);
    document.querySelector('.clientsId').value = val;

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



  //code for Enter Trade Starts



  function calculatePower() {

    let day1 = document.getElementById('fullCalendarTerm1').value;



    // console.log(day1.replace('-','/'));



    const regex = /-/g;

    day1 = day1.replace(regex, '/');

    // console.log(day1);

    // let nameyear = "2024";

    let nameyear = document.getElementById('ddlYears').value;



    let a1 = day1.split(",");



    let b1 = Array();



    b1.push(a1[0].split("/"));

    b1.push(a1[1].split("/"));



    let newDate = Array();



    let sDate;

    let fDate;



    if (b1[0][0] == b1[1][0]) {

      newDate.push(day1);

    } else {

      calculateDiff = b1[1][0] - b1[0][0]; // year difference 

      // 3= 0,1,2

      // console.log(calculateDiff);

      for (let i = 0; i <= calculateDiff; i++) {

        res = parseInt(b1[0][0]) + i;

        if (i == 0) {

          sDate = res + "/" + b1[0][1] + "/" + b1[0][2]; // 2023-12-31

          // console.log(sDate);

          eDate = res + "/12/31"; // 2023-12-31

          fDate = sDate + "," + eDate; // 2023-12-31, 2023-12-31

          newDate.push(fDate);

        } else if (i == calculateDiff) {

          sDate = res + "/01/01";

          eDate = b1[1][0] + "/" + b1[1][1] + "/" + b1[1][2]; // 2023-12-31

          fDate = sDate + "," + eDate;

          newDate.push(fDate);

        } else {

          sDate = res + "/01/01";

          eDate = res + "/12/31";

          fDate = sDate + "," + eDate;

          newDate.push(fDate);

        }



        // console.log(res);

      }

    }

    // console.log(newDate);

    var newdate1 = Array();

    let length = newDate.length;

    let a;

    // console.log(length)



    for (i = 0; i < length; i++) {



      let splitting = newDate[i].split(",");

      // console.log(splitting);

      let length1 = splitting.length;



      for (j = 0; j < length1; j++) {



        a = (splitting[j].search(nameyear));

        // console.log(splitting[j]);



        if (a >= 0) {

          newdate1.push(splitting[j]);



        }

      }

    }



    let newq = Array();





    newq.push(newdate1[0].split("/"));

    newq.push(newdate1[1].split("/"));

    // console.log(newq[1][0]);



    // let aaa = new Date(newdate1[0]);

    // let bbb = new Date(newdate1[1]);

    // let month = aaa.getMonth();

    // let day = aaa.getDate();

    // let dayfinal = bbb.getDate();

    // let month1 = bbb.getMonth();





    let year = parseInt(newq[0][0]);

    // console.log(year);

    let stdate;

    let endDate;

    let mm;

    let m;

    let stardtdatearr = Array();

    let endDatear = Array();

    let endDate2;

    let leapyear;

    let final;

    for (i = parseInt(newq[0][1]); i <= parseInt(newq[1][1]); i++) {



      if (i == parseInt(newq[0][1])) {

        stdate = newq[0][0] + "/" + newq[0][1] + "/" + newq[0][2];

        // console.log(stdate);

        stardtdatearr.push(stdate);



      } else {

        stdate = newq[0][0] + "/" + i + "/01";

        // console.log(stdate);

        stardtdatearr.push(stdate);

      }





      if (i <= parseInt(newq[1][1])) {



        switch (i) {



          case 1:

          case 3:

          case 5:

          case 7:

          case 8:

          case 10:

          case 12:

            if (i == (parseInt(newq[1][1]))) {

              endDate = newq[1][0] + "/" + i + "/" + newq[1][2];

              final = stdate + "," + endDate;

              // console.log(final);

              endDatear.push(final);

            } else {

              endDate = newq[0][0] + "/" + i + "/31";

              final = stdate + "," + endDate;

              // console.log(final);

              endDatear.push(final);

            }



            break;





          case 4:

          case 6:

          case 9:

          case 11:

            endDate = newq[0][0] + "/" + i + "/30";

            final = stdate + "," + endDate;

            // console.log(final);

            endDatear.push(final);

            break;



          case 2:

            if (i == (parseInt(newq[1][1]))) {

              endDate = newq[0][0] + "/" + i + "/" + newq[1][2];

              final = stdate + "," + endDate;

              // console.log(final);

              endDatear.push(final);

            } else {

              if ((year % 4 == 0) && (year % 100 != 0) || (year % 400 == 0)) {

                leapyear = newq[0][0] + "/" + i + "/29";

                document.getElementById('leapYear1').value = 'leap';

              } else {

                leapyear = newq[0][0] + "/" + i + "/28";

                document.getElementById('leapYear1').value = 'notleap';

              }

              final = stdate + "," + leapyear;

              endDatear.push(final);

            }



            // final = stdate+","+leapyear;

            // // console.log(final);

            // endDatear.push(final);



            break;



          default:

            break;



        }

      }

    }



    // console.log(endDatear);

    let lengthend = endDatear.length;



    // console.log(lengthend);





    let firstday, lastday, splited, diff, daydiff, dayadd;



    let arr = Array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);



    let day = Array();



    for (i = 0; i < lengthend; i++) {

      // console.log(i);

      firstday = 0;

      lastday = 0;





      splited = endDatear[i].split(",");



      firstday = new Date(splited[0]);



      lastday = new Date(splited[1]);

      // console.log(firstday);







      diff = lastday.getTime() - firstday.getTime();



      daydiff = diff / (1000 * 60 * 60 * 24);



      dayadd = Math.round(daydiff + 1);



      // console.log(dayadd);



      let a = firstday.getMonth();



      // console.log(a);



      arr.splice(a, 1, dayadd);





    }





    let q1 = q2 = q3 = q4 = yeardays = 0;



    for (i = 0; i < 12; i++) {

      if (i >= 0 && i <= 2) {

        q1 += arr[i];

      } else if (i >= 3 && i <= 5) {

        q2 += arr[i];

      } else if (i >= 6 && i <= 8) {

        q3 += arr[i];

      } else {

        q4 += arr[i];

      }

    }



    yeardays = q1 + q2 + q3 + q4;

    console.log(`No of days in year ${nameyear} is ${yeardays}`);



    console.log(`No of days in q1 of year ${nameyear} is ${q1}`);

    console.log(`No of days in q2 of year ${nameyear} is ${q2}`);

    console.log(`No of days in q3 of year ${nameyear} is ${q3}`);

    console.log(`No of days in q4 of year ${nameyear} is ${q4}`);

    console.log(arr);









    console.log(endDatear);



    // console.log(newdate1);

    return arr;





  }



  //Code for Enter Trade Ends



  function contractTerm(contract) {

    console.log($("#contract :selected").text());
    console.log(document.querySelector('.clientcom').value);

    // $("#contract :selected").text();
    // console.log("Contract => ".contract);
    // console.log("Contract => ".contract);
    var origiContract = $("#contract :selected").text();
    var clientId = document.querySelector('.clientcom').value;
    $.ajax({

      url: 'ajax/contractTerm.php',

      type: "POST",

      data: {


        origiContract: origiContract,
        clientId: clientId

      },

      success: function(result) {

        console.log("Result =>".result);

        $('.year').css('display', 'inline');

        $('#ddlYears').css('display', 'block');

        var obj = JSON.parse(result);

        console.log(obj);



        var clicktranchobj = JSON.parse(obj.contractTrade);

        if (obj.commdityname == 'electricity' || obj.commdityname == 'natural gas') {

          $('.effectprss').show();

        } else {

          $('.effectprss').hide();

        }

        $('.suppId').val(obj.supId);

        $('.totalanual').val(obj.consummptionamt);

        // console.log(obj.noofdaysyear);



        // changed code for Power(MW) from here.



        if (obj.vinay == "Power(MW)") {

          // alert("Power(MW)");

          console.log(obj.noofdaysyear);

          $('.yeardays').val(obj.noofdaysyear);

          $('.fullCalendarTerm').val(obj.contractterm);

          document.getElementById('vijay').innerHTML = 'Number of MW Purchased';

          document.getElementById('tradevalue').setAttribute('name', 'mw');

          document.getElementById('tradevalue').setAttribute('onkeyup', 'calc()');

          document.getElementById('tradevalue').removeAttribute('onkeypress');

          document.getElementById('mw').innerHTML = 'MW';

          document.getElementById('Est').innerHTML = 'Est. Trade Volume';

          // to disable to %

          document.getElementById('disable').disabled = true;

          document.getElementById('disable').style.display = 'none';



        }



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



        $('.Tradeperiod').each(function() {



          $(this).on('change', function() {

            if (yearbasis.includes($(this).val())) {



              var keyval = yearbasis.indexOf($(this).val());



              $('.trancheclick').val(trichclick[keyval]);

              $('.tradeid').val(tranchid[keyval]);

              $('.percentagecal').val(clicktranch[keyval]);

              if (clicktranch[keyval] == '% consumption') {

                $('.mwhtrade').prop('readonly', true);

                $('.mwhtrade').css({

                  'background': '#f5f2f2'
                });

                $('.mwhpercentage').prop('readonly', false);

                $('.mwhpercentage').css('background', '#fff');
                // alert('yo');

                let percentValue = document.querySelector(".mwhpercentage");
                percentValue.setAttribute('onkeyup', 'percentage(this.value)');
                //onkeyup="percentage(this.value)"

                if (parseFloat(document.querySelector(".mwhtrade").value) > 0) {
                  document.querySelector('.mwhtrade').value = 0.00;
                  document.querySelector('.tradevol').value = 0.00;
                }


              }

              if (clicktranch[keyval] == '#MWhs') {

                $('.mwhtrade').prop('readonly', false);

                $('.mwhtrade').css('background', '#fff');

                $('.mwhpercentage').css('background', '#f5f2f2');

                $('.mwhpercentage').prop('readonly', true);

                let removeValue = document.querySelector('.mwhpercentage')
                removeValue.removeAttribute('onkeyup');

                if (parseFloat(document.querySelector(".mwhpercentage").value) > 0) {
                  document.querySelector('.mwhpercentage').value = 0.00;
                  document.querySelector('.tradevol').value = 0.00;
                }

              }

              $(this).prop('checked', true);

              if ($(this).is(':checked')) {

                if ($(this).val() == 'Calendar Yearly') {



                  $.ajax({

                    url: 'js/callbacks/getyears.php',

                    type: "POST",

                    data: {

                      'type': 'Calendar Yearly',

                      'suplierid': obj.supId,

                      'tranchid': tranchid[keyval]

                    },

                    success: function(result) {



                      $('#ddlYears').html(result);

                      $('.totalanual').val(obj.consummptionamt);

                      $('.quaranual').val(obj.consummptionamt);



                    }

                  })



                  $('#ddlYears').on('change', function() {

                    $('.tradename').val($(this).val());



                  })

                }

                if ($(this).val() == 'Calendar Monthly') {

                  $.ajax({

                    url: 'js/callbacks/getyears.php',

                    type: "POST",

                    data: {

                      'type': 'Calendar Monthly',

                      'suplierid': obj.supId,

                      'tranchid': tranchid[keyval]

                    },

                    success: function(result) {



                      $('#ddlYears').html(result);



                      console.log(result);

                    }

                  })

                  $('#monthyear').on('change', function() {

                    var yearv = $('#ddlYears').val();

                    var quart = [];

                    $.ajax({

                      url: 'js/callbacks/checkmatchmonths.php',

                      type: "POST",

                      async: false,

                      data: {

                        'suplierid': obj.supId,

                        'tranchid': tranchid[keyval],

                        'year': yearv

                      },

                      success: function(result) {

                        var json = result.split(',');

                        for (i = 0; i < json.length; i++) {

                          quart.push(json[i]);

                        }



                      }

                    })

                    console.log(quart);

                    if (quart.includes($(this).val())) {

                      $.ajax({

                        url: 'js/callbacks/getconsumptions.php',

                        type: "POST",

                        data: {

                          'type': 'Calendar Monthly',

                          'suplierid': obj.supId,

                          'year': $('#ddlYears').val(),

                          'quarterval': $(this).val(),

                        },

                        success: function(result) {

                          $('.totalanual').val(result);

                          $('.quaranual').val(result);

                        }

                      })

                      $('.tradename').val($(this).val());

                    } else {

                      alert('not have option');

                      $(this).val('');

                    }



                    $('.tradename').val($(this).val());



                  })



                }

                if ($(this).val() == 'Calendar Quarterly') {





                  $.ajax({

                    url: 'js/callbacks/getyears.php',

                    type: "POST",

                    data: {

                      'type': 'Calendar Quarterly',

                      'suplierid': obj.supId,

                      'tranchid': tranchid[keyval]

                    },

                    success: function(result) {



                      $('#ddlYears').html(result);



                    }

                  })







                  $('.tradename').val($('.Quarter:checked').val());



                  $('.Quarter').each(function() {





                    $(this).on('change', function() {

                      var yearv = $('#ddlYears').val();

                      var quart = [];

                      $.ajax({

                        url: 'js/callbacks/checkmatchquarter.php',

                        type: "POST",

                        async: false,

                        data: {

                          'suplierid': obj.supId,

                          'tranchid': tranchid[keyval],

                          'year': yearv

                        },

                        success: function(result) {

                          var json = result.split(',');

                          for (i = 0; i < json.length; i++) {

                            quart.push(json[i]);

                          }



                        }

                      })





                      if (quart.includes($(this).val())) {

                        $('.tradename').val($(this).val());

                        $.ajax({

                          url: 'js/callbacks/getconsumptions.php',

                          type: "POST",

                          data: {

                            'type': 'Calendar Quarterly',

                            'suplierid': obj.supId,

                            'year': $('#ddlYears').val(),

                            'quarterval': $(this).val(),



                          },

                          success: function(result) {

                            $('.quaranual').val(result);

                            $('.totalanual').val(result);



                          }

                        })

                      } else {

                        alert('not have option');

                        $(this).prop('checked', false);

                      }

                    })

                  })



                }

                if ($(this).val() == 'Season') {

                  $.ajax({

                    url: 'js/callbacks/getyears.php',

                    type: "POST",

                    data: {

                      'type': 'Season',

                      'suplierid': obj.supId,

                      'tranchid': tranchid[keyval]

                    },

                    success: function(result) {



                      $('#ddlYears').html(result);



                      console.log(result);

                    }

                  })

                  $('.tradename').val($('.seasonname:checked').val());

                  $('.seasonname').each(function() {

                    $(this).on('change', function() {

                      var yearv = $('#ddlYears').val();

                      var quart = [];

                      $.ajax({

                        url: 'js/callbacks/checkmatchseason.php',

                        type: "POST",

                        async: false,

                        data: {



                          'suplierid': obj.supId,

                          'tranchid': tranchid[keyval],

                          'year': yearv

                        },

                        success: function(result) {

                          var json = result.split(',');

                          for (i = 0; i < json.length; i++) {

                            quart.push(json[i]);

                          }



                        }

                      })

                      if (quart.includes($(this).val())) {

                        $('.tradename').val($(this).val());

                        $.ajax({

                          url: 'js/callbacks/getconsumptions.php',

                          type: "POST",

                          data: {

                            'type': 'Season',

                            'suplierid': obj.supId,

                            'year': $('#ddlYears').val(),

                            'quarterval': $(this).val(),

                          },

                          success: function(result) {

                            $('.quaranual').val(result);

                            $('.totalanual').val(result);

                          }

                        })

                      } else {

                        alert('not have option');

                        $(this).prop('checked', false);

                      }



                    })



                  })



                }

              }





              // $(this).prop("disabled", false);



            } else {



              alert('This Trade Periods is not available');

              $(this).prop('checked', false);

              var notchecked = ($(this).not(":checked").val());

              if (notchecked == 'Calendar Monthly') {

                $('.calendarmonths').css('display', 'none');

              }

              // if(notchecked == 'Calendar Yearly'){

              //   $('#ddlYears').css('display','none');

              // }

              if (notchecked == 'Season') {

                $('.seasonyear').css('display', 'none');

              }

              if (notchecked == 'Calendar Quarterly') {

                $('.calendarquater').css('display', 'none');

              }



            }

          })





        });

        var contractterm = obj.contractterm;

        // console.log(noofdaysyear);

        var dates = contractterm.split(",");

        var fromdate = new Date(dates[0]);

        var todate = new Date(dates[1]);

        first = fromdate.getFullYear();

        second = todate.getFullYear();

        arr = Array();

        for (i = first; i <= second; i++) arr.push(i);

        var months = 0;

        months = (todate.getFullYear() - fromdate.getFullYear()) * 12;

        months -= fromdate.getMonth();

        months += todate.getMonth();



        var monthsdata = months + 1;

        var printdata = '';

        printdata += '<option >Select the Year</option>';

        for (i = 0; i < arr.length; i++) {



          printdata += '<option value="' + arr[i] + '">' + arr[i] + '</option>';

        }

        $('#ddlYears').html(printdata);





      }

    })

  }

  $('input[type="checkbox"].Tradeperiod').on('change', function() {

    $('input[type="checkbox"].Tradeperiod').not(this).prop('checked', false);





  });



  $('input[type="checkbox"].seasonname').on('change', function() {

    $('input[type="checkbox"].seasonname').not(this).prop('checked', false);



  });



  $('input[type="checkbox"].Quarter').on('change', function() {

    $('input[type="checkbox"].Quarter').not(this).prop('checked', false);

    // $('.Quarter').attr('checked', true);

  });
</script>

<script type="text/javascript">
  $(document).ready(function() {

    $('.input-daterange').datepicker({

      format: 'dd-M-yyyy'

    });



  });
</script>

<script>
  console.log($("#contract :selected").text());

  $(document).ready(function() {

    $(".creatdate").on("change", function() {

      this.setAttribute(

        "data-date",

        moment(this.value, "DD-MM-YYYY")

        .format(this.getAttribute("data-date-format"))

      )

    }).trigger("change")

  });
</script>



<script type="text/javascript">
  function parentdetails(parentId) {

    $.ajax({

      type: 'POST',

      url: 'js/callbacks/parentdetails.php',

      data: {

        'parentId': parentId



      },

      success: function(data) {

        $('.clientcom').html(data);

      }

    });

  }

  window.onload = function() {

    //Reference the DropDownList.

    var ddlYears = document.getElementById("ddlYears");



    //Determine the Current Year.

    var currentYear = (new Date()).getFullYear();

    currentYear += 30;



    //Loop and add the Year values to DropDownList.

    for (var i = 1950; i <= currentYear; i++) {

      var option = document.createElement("OPTION");

      option.innerHTML = i;

      option.value = i;

      ddlYears.appendChild(option);

    }

  }



  function hideButton() {



    document.getElementById('btn').style.display = 'none';



  }



  function validForm() {


    if ($('.parentname').val() == '') {

      alert('Please select Parent');

      return false;

    }

    if ($('.clientcom').val() == '') {

      alert('Please select client');

      return false;

    }

    if ($('.contractname').val() == '') {

      alert('Please select contract');

      return false;

    }

    var checkClass = [];

    $.each($(".Tradeperiod:checked"), function() {

      checkClass.push($(this).attr('class'));

    });



    if (checkClass.length == 0) {

      alert('Please Check the Tradeperiod');

      return false;

    }

    if ($('#monthlytrade').is(':checked') == true) {
      var vals = $('#monthyear').val();
      if (vals == null) {
        alert('Please select month');
        return false;
      }
    }

    if ($('#quarterstTrade').is(':checked') == true) {
      if ($('#quarter1').is(':checked') == true || $('#quarter2').is(':checked') == true || $('#quarter3').is(':checked') == true || $('#quarter4').is(':checked') == true) {

      } else {
        alert('Please select Quarter');
        return false;
      }
    }

    if ($('.mwhtrade').val() == '' && $('.mwhpercentage').val() == '') {

      alert('Please enter the value');

      return false;

    }



    return true;

  }
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>



</html>