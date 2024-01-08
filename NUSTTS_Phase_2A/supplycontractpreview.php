<?php
include('security.php');
include('dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NUS TTS System | Supply Contract</title>
  <link rel="icon" href="img/social-square-n-blue.png" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/stylenew.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


</head>
<style type="text/css">
  .suplycnt {
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

  .deleteIcon {
    margin: 0 0 0 -75%;
    background: white;
    padding: 7px 9px;
    border: 1.5px solid #345DA6;
    border-radius: 50%;
    cursor: pointer;
  }

  #nextBtn {
    float: right;
    /* color:#345DA6; */
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
    width: 10em;
    height: 3.0em;
    font-size: 13px !important;
  }

  .input-group-addon2 {
    padding: 0 !important;
    background: transparent !important;
    border: none !important;
    border-radius: none !important;
    vertical-align: middle !important;
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
    /* font-family: 'Segoe UI'; */
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
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
    font-size: 22px;
    color: #345DA6;

  }

  .padmd0 select {
    border: 1px solid lightgrey;
    box-shadow: none;
    height: 34px !important;
    background-color: rgb(255, 255, 255);
    cursor: pointer;
    color: #345DA6;
    border: 1px solid #1363F1;
    border-radius: 6px;
    padding-left: 10px;
    /* margin-bottom:20px; */
  }

  .padmd0 h6 {
    text-transform: uppercase;
    color: #345DA6;
    font-size: 15px;
    letter-spacing: 1px;
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

  .naturalGass {
    display: none;
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
  .action input:hover+span {
    background-color: #fff;
    color: blue;
    border: 1px solid blue;
  }

  .action input:hover+span {
    background-color: #fff;
    opacity: 1;
    color: #1363F1;
    border: 1px solid #1363F1;
  }

  .action input:hover+span img {
    filter: invert(25%) sepia(94%) saturate(3383%) hue-rotate(215deg) brightness(98%) contrast(92%);
  }

  .action input:checked+span {
    background-color: #fff;
    opacity: 1;
    color: #1363F1;
    border: 1px solid #1363F1;
  }

  .action input:checked+span img {
    filter: invert(25%) sepia(94%) saturate(3383%) hue-rotate(215deg) brightness(98%) contrast(92%);
  }

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
    line-height: normal !important;
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

  @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

  .suplycnt {
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
    width: 10em;
    height: 3.0em;
    font-size: 13px !important;
    border-radius: 6px;
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
    /* font-family: 'Segoe UI'; */
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
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
    font-size: 22px;
    color: #345DA6;

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
  .action input:hover+span {
    background-color: #fff;
    color: blue;
    border: 1px solid blue;
  }

  .action input:hover+span {
    background-color: #fff;
    opacity: 1;
    color: #1363F1;
    border: 1px solid #1363F1;
  }

  .action input:hover+span img {
    filter: invert(25%) sepia(94%) saturate(3383%) hue-rotate(215deg) brightness(98%) contrast(92%);
  }

  .action input:checked+span {
    background-color: #fff;
    opacity: 1;
    color: #1363F1;
    border: 1px solid #1363F1;
  }

  .action input:checked+span img {
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
    border-radius: none !important;
  }

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

  /** FF*/

  input[type="range"]::-moz-range-progress {
    background-color: #293043;
    border-radius: 5px;
  }

  input[type="range"]::-moz-range-track {
    background-color: #293043;
    border-radius: 5px;
    border: none;
    box-shadow: none;
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

  .enterbutton {
    margin: 0 0 0 200px;
  }

  select[readonly],
  input[readonly] {
    pointer-events: none !important;
    /* cursor: no-drop; */
    padding-left:10px ;
    border-radius: 6px;
  }

  input[type="checkbox"][readonly] {
    pointer-events: none !important;
  }

  .states {
    position: absolute;
    right: 0;
    top: 79px;
    /* bottom: 0; */
    background: #EEE;
    font-weight: 500;
    letter-spacing: 0.5px;
    padding: 5px 10px;
    border-radius: 4px;
  }

  .tradenamefilter {
    width: 100%;
    display: flex;
    /* height: 84px; */
  }

  /* .formFilter { */
 

  .executing {
    font-size: 13px;
    color: black;
    letter-spacing: 0.25px;
    font-weight: normal;
  }

  .filter {
    display: flex;
    align-items: center;
    justify-content: space-around;
    font-size: 8px;
    float: left;
    gap: 20px;
  }
  
  .tradename {
    float: left;
    width: 50%;
  }

  #preview {
    margin: 60px 0 0 0;
  }
  .filterHeading {
    /* width: 50%; */
    position: absolute;
    top: 0;
    /* right: -8%; */
    left: 35%;
    z-index: 1;
    margin: 20px 0 0 0;
  }
  .filterheader {
    font-size: 12px;
    color:#345DA6;
  }

  .btnFilter {
    padding: 4px 10px;
    font-size:13px;
    color: black;
    margin: -7px 0 0 0;
  }
  .tradeExecuted {
    /* display: flex;
    justify-content: space-between; */
    width: 100%;
    display: flex;
    /* width: 85%; */
  }
  .tradeyearly {
    float: left;
    width: 50%;
  }
  .tradeexecuteds {
   
    /* width: 50%; */
    display: flex;
    float: left;
    align-items: center;
    gap:10px;
    font-size: 14px;
    font-weight: 500;
    /* margin:10px 0 0 0; */
  }
  .tradeexecutedvalue {
    color: red;
    padding: 10px 10px;
    border-radius: 5px;
    border: none;
    background: #EEE;
  }
  .tradeexecutedvaluess {
    margin:10px 0 0 0;
  }

</style>

<body>
  <div class="main">
    <div class="menu">

      <?php
      include('sidebar.php');
      include('includes/functions.php');
      $functions = new libFunc();
      ?>
    </div>

    <!-- changes -->

    <div class="filterHeading" id ="filteringthedata">
        <div class="filterheader" <?php if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company') echo "style=display:none;"; ?>>
            <h6 style="font-size:13px; font-weight: 500;">Filter By Trade Details:</h6>
        </div>
        <div class="formFilter" <?php if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company') echo "style=display:none;"; ?>>
            <form action="" method="GET">
                <div class="filter">
                    <input type="hidden" name="info" value="<?php echo $_GET['info'];?>">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="type" value="<?php echo $_GET['type']; ?>">
                    <label for="" class="executing"><input type="checkbox" value="Executed" name="executed" <?php echo empty($_GET['executed']) ? '' : 'checked'; ?>>&nbsp;Executed</label>
                    <label for="" class="executing"><input type="checkbox" value="Cancelled" name="cancelled" <?php echo empty($_GET['cancelled']) ? '' : 'checked'; ?>>&nbsp;Cancelled</label>
                    <button class="btn btnFilter" type="submit"><img src="img/reload_apply.svg" alt="reloadicon" width="20px"> Apply</button>
                </div>
            </form>
        </div>
    </div>

    <!--  -->


    <div>
      <div class="contentMove">
        <div class="suplycnt">

          <?php

          // echo "Info = ".$_GET['info'];

          $editsingledata = array();
          $getsupplydetails = "SELECT * FROM nus_supply_contract WHERE supplierId=" . $_GET['id'] . " AND clientId = " . $_GET['info'] . ";";

          // echo "<pre>";
          // echo $getsupplydetails;

          // echo $getsupplydetails;
          $result = $conn->query($getsupplydetails);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $editsingledata[] = $row;
            }
          }

          // echo "<h1>".$editsingledata[0]['countryName']."</h1>";


          $getclientdata = $functions->getclientdata($editsingledata[0]['clientId']);

          ?>

          <div class="padmd0">
            <form id="regForm" action="insertsupplycontract.php?type=edit&id=<?= $_GET['id'] ?>" method="POST">
              <!-- for contract details-->
              <input type="hidden" id="first">
              <input type="hidden" id="second">
              <input type="hidden" id="third">
              <input type="hidden" id="calTotal">
              <input type="hidden" id="yoyo" value=<?= $_GET['id'] ?>>
              <div class="tab" id="contract">
                <h6>Edit Supply Contract</h6>
                <h3>Contract Details</h3>
                <hr>
                <input type="hidden" class="edittab" value="normal">
                <label>Parent</label>
                <select class="chosen-select form-control parent" id="parentNameSuppre" name="parent" onchange="getparentdetails(this.value)" readonly>
                  <option value="">Please Select</option>
                  <?php
                  $getparent = array();
                  $getparentdetails = "SELECT * FROM parentcompanydata";
                  $results = $conn->query($getparentdetails);
                  if ($results->num_rows > 0) {
                    while ($row = $results->fetch_assoc()) {
                      $getparent[] = $row;
                    }
                  }
                  $finalParent = '';
                  foreach ($getparent as $key => $valueparent) {
                    $selected = '';
                    if ($valueparent['parentcompany'] == $editsingledata[0]['parentId']) {
                      $selected = 'selected';
                      $finalParent = $valueparent['parentcompany'];
                    }
                  ?>
                    <option value="<?= $valueparent['parentcompany'] ?>" <?= $selected ?>><?= $valueparent['parentcompany'] ?></option>

                  <?php
                  }
                  ?>
                </select><br>
                <label>Client</label>
                <select class="chosen-select form-control clint" name="client" id="cliensuppedit" onchange="getclientdetails(this.value)" readonly>

                  <?php

                  $getclientdetails = array();
                  $cid = $_GET['id'];
                  // $getsupplydetails = "SELECT * FROM clientcompanydata";
                  $pc = $editsingledata[0]['parentId'];
                  $getsupplydetails = "SELECT * FROM clientcompanydata AS c INNER JOIN nus_supply_contract AS n ON n.supplierId=$cid AND c.parentcompany='" . $pc . "' AND c.state='Active';";

                  echo $getsupplydetails;

                  $result = $conn->query($getsupplydetails);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $getclientdetails[] = $row;
                    }
                  }

                  foreach ($getclientdetails as $key => $value) {
                    $selected = '';
                    if ($value['id'] == $editsingledata[0]['clientId']) {
                      $selected = 'selected';
                    }

                  ?>
                    <option value="<?= $value['id'] ?>" <?= $selected ?>><?= $value['clientcompany'].' - '.$value['country'] ?></option>

                  <?php
                  }
                  ?>
                </select><br>
                <input type="hidden" class="country" name="country" value="<?= $editsingledata[0]['countryName'] ?>">

                <input type="hidden" class="clientname" name="clientname" value="<?= $getclientdata[0]['clientcompany'] ?>">
                <div class="row">
                  <div class="col-md-6">
                    <label>Commodity</label><br>

                    <div style="display: inline-block;">
                      <div class="cat action">
                        <label>
                          <input type="checkbox" value="electricity" name="commodity[]" class="commodity" id="electricedit" <?php

                                                                                                                            if ($editsingledata[0]['commodityName'] == 'electricity') {
                                                                                                                              echo 'checked';
                                                                                                                            }
                                                                                                                            ?> readonly><span class="disabledbutton act"><img src="img/electricity-hover.svg">Electricity</span>
                        </label>
                      </div>

                      <div class="cat action">
                        <label>
                          <input type="checkbox" value="natural gas" name="commodity[]" class="commodity" id="naturalgasedit" readonly <?php

                                                                                                                                        if ($editsingledata[0]['commodityName'] == 'natural gas') {
                                                                                                                                          echo 'checked';
                                                                                                                                        }
                                                                                                                                        ?>><span class="disabledbutton dis" id="naturalgasedit"><img src="img/naturalgas.svg"> Natrual Gas</span>
                        </label>
                      </div>
                      <input type="hidden" name="commodity[]" value="<?= $editsingledata[0]['commodityName'] ?>">
                    </div>
                  </div>

                  <?php
                  $class = 'style="display:none"';
                  if ($editsingledata[0]['commodityName'] == 'natural gas') {
                    $class = 'style="display:block"';
                  }
                  ?>
                  <div class="col-md-6 units" <?= $class ?>>
                    <label>Units</label><br>
                    <div class="natru" style="display: inline-block;">
                      <div class="cat action">
                        <label>
                          <input type="checkbox" value="MWh_GE" name="units[]" class="unit" <?php
                                                                                            if ($editsingledata[0]['commodityUnits'] == 'MWh') {
                                                                                              echo 'checked';
                                                                                            }

                                                                                            ?> checked><span class="disabledbutton dis">MWh</span>

                        </label>
                      </div>
                      <!-- edit natural gas start -->
                      <!-- <div class="cat action"> -->
                      <!-- <label> -->
                      <!-- <input type="checkbox" value="Therms" name="units[]" class="unit"  -->
                      <?php
                      //if($editsingledata[0]['commodityUnits'] == 'Therms'){
                      // echo 'checked';
                      //  }
                      ?>
                      <!-- ><span class="disabledbutton dis">Therms</span> -->
                      <!-- </label> -->
                      <!-- </div> -->
                      <!-- edit natural gas end -->
                    </div>
                  </div>

                </div>
                <div><br>
                  <input type="hidden" class="contracttermdata" name="allmonthsdata" value="<?= $editsingledata[0]['consumptionmonth'] ?>">
                  <label>Supplier</label>
                  <input type="text" class="form-control supplr" name="supplr" id="supplyedit" value="<?= $editsingledata[0]['supplyName'] ?>" readonly>

                </div><br>
                <div>
                  <label>Contract Commodity Price</label>
                  <select class="form-control contractprice" name="contractprice" id="commodityprice" readonly>
                    <?php
                    include "dbconn.php";
                    $countrycurrencies = mysqli_query($conn, "SELECT currencies From nus_currencies");
                    while ($currencies = mysqli_fetch_array($countrycurrencies)) {
                      echo "<option value='" . $currencies['currencies'] . "'>" . $currencies['currencies'] . "</option>";
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
                          <input type="hidden" value="<?php echo $editsingledata[0]['contractType']; ?>" id="contracttype">
                          <input type="checkbox" value="fixed" name="contacttype[]" class="contactType" id="fixed" <?php
                                                                                                                    if ($editsingledata[0]['contractType'] == 'fixed') {
                                                                                                                      echo 'checked';
                                                                                                                    }
                                                                                                                    ?>><span class="disabledbutton dis">Fixed</span>
                        </label>
                      </div>
                      <div class="cat action">
                        <label>

                          <input type="checkbox" class="contactType" name="contacttype[]" value="indexed" id="indexed" <?php
                                                                                                                        if ($editsingledata[0]['contractType'] == 'indexed') {
                                                                                                                          echo 'checked';
                                                                                                                        }
                                                                                                                        ?>><span class="disabledbutton dis">Indexed</span>
                        </label>
                      </div>
                      <input type="hidden" name="contacttype[]" value="<?= $editsingledata[0]['contractType'] ?>">
                    </div>
                  </div>
                  <input type="hidden" class="cttype" name="contType">
                  <?php
                  $getctype = 'style="display:none"';
                  if ($editsingledata[0]['contractType'] == 'indexed') {
                    $getctype = 'style="display:block"';
                  }
                  ?>
                  <div class="col-md-6 indexcl" <?= $getctype ?>>
                    <label>Index</label><br>
                    <select class="chosen-select indexType form-control" name="indexed" id="selectindex" readonly>
                      <?php
                      $getdatas = '';
                      if ($editsingledata[0]['commodityName'] == 'electricity') {
                        $getdatas = "SELECT * FROM nus_electricity_index ORDER BY country ASC, indexlist ASC;";
                      } else if ($editsingledata[0]['commodityName'] == 'natural gas') {
                        $getdatas = "SELECT * FROM nus_naturalgas_index ORDER BY country ASC, indexlist ASC;";
                      }
                      $result = $conn->query($getdatas);

                      if ($result->num_rows > 0) {
                        // $found = 0;
                        $showDropdowndata = '';

                        while ($row = $result->fetch_assoc()) { {
                            $selected = '';
                            $row1 = $row['indexlist'];
                            $row2 = $row['country'];
                            $rowRes = $row1." / ".$row2;
                            if (trim($rowRes) == trim($editsingledata[0]['contractIndexId'])) {
                              $selected = 'selected';
                              // $found = 1;
                            }
                            // $showDropdowndata .= "<option value='" . $row['indexlist'] . "' " . $selected . ">" . $row['indexlist'] . "</option>";
                            $showDropdowndata .= "<option value='" . $row['indexlist'] .' / '.$row['country'] . "' " . $selected . ">" . $row['indexlist'] .' / '.$row['country']. "</option>";
                          }
                        }
                        // if ($found === 0) {
                        //   echo "<option value='Financial Hedging / International' selected>Financial Hedging / International</option>" . $showDropdowndata;
                        // } else {
                        //   echo "<option value='Financial Hedging / International'>Financial Hedging / International</option>" . $showDropdowndata;
                        // }
                        echo $showDropdowndata;
                      }
                      ?>
                    </select>
                  </div>
                </div>

              </div>
              <!-- for Length and consumption-->
              <div class="tab" id="length">
                <h6>Edit Supply Contract</h6>
                <h3 class="dynamictext">
                  <?php
                  if ($editsingledata[0]['contractType'] == 'fixed') {
                    echo 'Term, Consumption, and Price - Fixed Price Contract';
                  } else {
                    echo 'Term and Consumption - Indexed Contract';
                  }
                  ?>
                </h3>
                <hr>
                <!-- input type hidden for hedged consumption START-->

                <input type="hidden" value=<?= $editsingledata[0]['hedgeconsumption'] ?> class="hedgeConsumption">
                <input type="hidden" value=<?= $_GET['info']; ?> name="infovalue">

                <!-- input type hidden for hedged consumption END-->
                <label>Contract Term (DD/MMM/YYYY)</label>
                <div class="input-group input-daterange">
                  <input id="startDate1" name="startDate1" type="text" class="form-control startdate" onchange="calcualteMonthYr(this.value,$('.endate').val())" value="<?= date('d-M-Y', strtotime($editsingledata[0]['contractTermfromDate'])) ?>" readonly> <span class="input-group-addon">
                    <!--  <span
                    class="glyphicon glyphicon-calendar"></span> -->
                  </span> <span class="input-group-addon">to</span> <input id="endDate1" name="endDate1" type="text" value="<?= date('d-M-Y', strtotime($editsingledata[0]['contractTermtoDate'])) ?>" class="form-control endate" onchange="calcualteMonthYr($('.startdate').val(), this.value)">
                  <span class="input-group-addon">

                  </span>
                </div><br>

                <?php
                $getmonthscout = explode(',', $editsingledata[0]['allmonts'])
                ?>

                <input type="hidden" class="countmonths" value="<?= count($getmonthscout) ?>">
                <input type="hidden" name="hedge" class="hedge" value="<?= $editsingledata[0]['hedgeconsumption'] ?>">
                <input type="hidden" name="baseconsumption1" class="baseconsumption" value="<?= $editsingledata[0]['basegenconsumption'] ?>">
                <input type="hidden" name="effectivec1" class="effectivec" value="<?= $editsingledata[0]['effectcon'] ?>">
                <input type="hidden" name="openconsumption" class="openconsumption" value="<?= $editsingledata[0]['openconsumption'] ?>">

                <input type="hidden" class="allmonths" name="allmonths" value="<?= $editsingledata[0]['allmonts'] ?>">
                <?php
                $shoprice = 'units';
                if ($editsingledata[0]['contractType'] == 'fixed') {
                  $shoprice = 'displayblck';
                }

                ?>
                <div class="compr <?= $shoprice ?>">
                  <label>Commodity Price (per MWh)</label>


                  <div class="input-group">
                    <input class="form-control left-border-none comdyprice" placeholder="0.00" type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="commodityprice" name="commodityprice" value="<?= number_format($editsingledata[0]['commodityPrice'], 2) ?>" readonly>
                    <span class="input-group-addon transparent">
                      MWh</span>
                    <input type="hidden" name="commodityprice" value="<?= $editsingledata[0]['commodityPrice'] ?>">

                  </div>
                </div>
                <script type="text/javascript">
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


                    var count = [];
                    var totalmonths = 12;
                    if ($(ctrl).hasClass('peryr')) {
                      let classlist = $(ctrl).attr('class');
                      classlist = classlist.split(' ');
                      var testnu = parseInt(num);
                      // console.log(testnu);
                      $('.sliderrange' + classlist[3]).val(number).trigger("input");


                      $('.peryr').each(function() {
                        // console.log($(this).val());
                        // if($(this).val() !=''){
                        var toNumber = $(this).val();
                        toNumber = toNumber.replace(/,/g, '');
                        count.push('yes');
                        summ += parseFloat(toNumber);

                        // }

                      })
                      // summ +=parseFloat(num);

                    }
                    totalmonths = totalmonths - (count.length);
                    // console.log(totalmonths);
                    var consumption = $('.totalanualconsumption').val()
                    consumption = consumption.replace(/,/g, '');
                    consumption = parseFloat(consumption);
                    var peramt = parseFloat(consumption) / 12;
                    var datamt = totalmonths * peramt;

                    var sumdata = summ + datamt;
                    // console.log(consumption);
                    if (sumdata > consumption) {
                      $('.monthsallow').val('no');
                      $('.errormax').html('maximum consumption');
                    } else {
                      $('.monthsallow').val('yes');
                      $('.errormax').html('');
                    }

                    $('.anuTolal').html(formated(summ));
                    // var rgx = /(\d+)(\d{3})/;

                    // while (rgx.test(x1)) {
                    //     x1 = x1.replace(rgx, '$1' + ',' + '$2');
                    // }

                  }

                  function CheckNumeric() {
                    return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;
                  }
                </script>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <input type="hidden" class="monthsallow" value="yes">
                    <label>Total Annual Consumption</label>
                    <div class="input-group">
                      <input class="form-control left-border-none totalanualconsumption" placeholder="0.00" type="text" name="totalanualconsumption" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="<?= $editsingledata[0]['totalAnualConsumption'] ?>" readonly>
                      <span class="input-group-addon transparent">
                        MWh</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label>Allocate Consumption per month</label>
                    <label class="switch" for="checkbox">
                      <input type="checkbox" id="checkbox" class="onoff" checked />
                      <div class="slider round"></div>
                    </label>
                  </div>

                </div>

                <label>Divide Equality between months</label>
                <label class="switchs" for="checkboxs">
                  <input type="checkbox" id="checkboxs" class="onoff" disabled />
                  <div class="sliders rounds"></div>
                </label>
                <div class="allowdvi">
                  <?php
                  $ant = str_replace(',', '', $editsingledata[0]['totalAnualConsumption']);
                  $anualTotal = (int)$ant;
                  $mnthscnt = count($getmonthscout);
                  $allmonths = $editsingledata[0]['allmonts'];
                  $allmonths = explode(',', $allmonths);

                  $getmnts = array();
                  for ($j = 0; $j < count($allmonths); $j++) {
                    $splitmonth = explode('-', $allmonths[$j]);
                    array_push($getmnts, $splitmonth[1]);
                  }
                  $totalmonths = count($getmnts);
                  if ($totalmonths > 12) {
                    $totalmonths = 12;
                  }
                  $yearDiv = $anualTotal / 12;
                  $y = $editsingledata[0]['consumptionmonth'];
                  $printdata = '';
                  $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                  $sumtotal = 0;


                  // total consumption for each month



                  $consumptionformonth = explode('|', $editsingledata[0]['consumptionmonth']);

                  $allmonths = $editsingledata[0]['allmonts'];
                  $allmonths = explode(',', $allmonths);

                  $getmnts = array();
                  for ($j = 0; $j < count($allmonths); $j++) {
                    $splitmonth = explode('-', $allmonths[$j]);
                    array_push($getmnts, $splitmonth[1]);
                  }
                  $totalmonths = count($getmnts);

                  if ($totalmonths > 12) {
                    $totalmonths = 12;
                  }



                  for ($i = 0; $i < $totalmonths; $i++) {
                    $letp = explode('-', $consumptionformonth[$i]);
                  ?>
                    <!-- <tr> -->
                    <!-- <td>//$months[$getmnts[$i]-1]?> Consumption</td> -->
                    <!-- <td>//currencyformat(round($letp[2],2))?> MWh</td> -->
                    <!-- </tr> -->

                  <?php
                  }


                  // end


                  for ($i = 0; $i < $totalmonths; $i++) {
                    // echo $i;
                    // echo $months[$getmnts[$i]-1];

                    $letp = explode('-', $consumptionformonth[$i]);

                    $printdata .= "<div class='diviy'>";
                    $printdata .= "<div class='row marf'>";
                    $printdata .= '<div class="col-md-1">';
                    $printdata .= '<p>' . $months[$getmnts[$i] - 1] . '</p>';
                    $printdata .= '</div>';
                    $printdata .= '<div class="col-md-6">';
                    $printdata .= '<input type="range" id="points" class="rangslider" value="' . currencyformat(round($letp[2], 2)) . '" name="points" min="0" max="' . $anualTotal . '" onchange="showVal(this.value,' . $i . ')" readonly>';
                    $printdata .= '</div>';
                    $printdata .= '<div class="col-md-5">';
                    $printdata .= '<div class="input-group">';
                    $printdata .= '<input class="months' . $i . '"  type="hidden" value="' . $months[$getmnts[$i] - 1] . '">';
                    $printdata .= '<input class="form-control left-border-none peryr yearconsupedit peryearval' . $i . '" placeholder="0.00" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" type="text" value="' . currencyformat(round($letp[2], 2)) . '" readonly>';
                    $printdata .= '<span class="input-group-addon transparent">MWh</span></div>';
                    $printdata .= '</div>';
                    $printdata .= '</div>';
                    $printdata .= '</div>';
                    $sumtotal += $yearDiv;
                  }
                  $printdata .= '<hr>';
                  $printdata .= '<div class="row">';

                  $printdata .= '<div class="col-md-8">';
                  $printdata .= '<h3 style="font-size:18px;">Total Annual Consumptions</h3>';
                  $printdata .= '</div>';
                  $printdata .= '<div class="col-md-4 text-right">';
                  $printdata .= '<span style="color:red" class="errormax"></span>';
                  $printdata .= '<input type="hidden" name="totlcnsumtion" class="totlcnsumtion" value="' . currencyformat($sumtotal) . '">';
                  $printdata .= '<h3 style="font-size:18px;"><span class="anuTolal">' . currencyformat($sumtotal) . '</span> <span style="font-size:14px">MWH</span></h3>';
                  $printdata .= '</div>';
                  $printdata .= '</div>';
                  echo $printdata;

                  ?>

                </div>


              </div>

              <div class="tab indexdex" id="index">
                <h6>Edit Supply Contract</h6>
                <h3>Index Details</h3>
                <hr>
                <label>Index Structure Type</label><br>
                <div style="display: inline-block;">
                  <input type="hidden" class="hiddenCommodity" id="commodityname" value=<?php echo $editsingledata[0]['commodityName']; ?>>
                  <input type="hidden" class="hiddenPower" value=<?php echo $editsingledata[0]['indexStructureType']; ?> id="indextypes">

                  <div class="cat action">
                    <label id="consumptionLabel" for="consumptionn">
                      <input type="checkbox" class="indexstr" id="consumptionn" name="indexstr[]" value="Consumption(MWh)"><span class="disabledbutton dis">Consumption(MWh)</span>
                    </label>
                  </div>
                  <div class="cat action naturalGass" id="naturalgas">
                    <label id="powerLabel" for="powerr">
                      <input type="checkbox" class="indexstr" id="powerr" name="indexstr[]" value="Power(MW)"><span class="disabledbutton dis">Power(MW)</span>
                    </label>
                  </div>
                  <input type="hidden" name="indexstr[]" value=<?= $editsingledata[0]['indexStructureType'] ?>>
                </div>

                <div class="alrw">
                  <label>Allowable trade periods</label><br>
                  <a onclick="addTradeperiods()" class="btn btn-default" style="padding: 2px 12px;" id="addperiods"><img src="img/addtrade-icon.svg" alt="Add trade Icon">Add allowable trade period</a><br>

                  <?php
                  $getTradableprice = array();
                  $getallowabletrade = "SELECT * FROM nus_tradeperiods WHERE supplierId =" . $_GET['id'] . "";
                  $result = $conn->query($getallowabletrade);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $getTradableprice[] = $row;
                    }
                  }

                  ?>
                  <input type="hidden" class="rowcount" value="<?= (count($getTradableprice) == 0) ? 1 : count($getTradableprice) + 1 ?>" name="rowcount">
                  <div class="addTrade">

                    <?php
                    $tradevol = array();
                    foreach ($getTradableprice as $key => $value) {
                      $tradevol[] = $value['periodsId'];
                    ?>
                      <div class="trade<?= ($key + 1) ?>">
                        <div class="row">
                          <div class="col-md-7">
                          </div>
                          <div class="col-md-5">
                            <label style="margin: 0 0 0 -28%;">Clicks / tranches</label><br>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <select class="chosen-select tradsel<?= ($key + 1) ?> calendarselection" name="tradsel<?= ($key + 1) ?>" id="calendarselection">

                              <option value="Calendar Yearly" <?php
                                                              if ($value['periodsId'] == 'Calendar Yearly') {
                                                                echo 'selected';
                                                              }
                                                              ?>>Calendar Yearly</option>
                              <option value="Calendar Quarterly" <?php
                                                                  if ($value['periodsId'] == 'Calendar Quarterly') {
                                                                    echo 'selected';
                                                                  }
                                                                  ?>>Calendar Quarterly</option>
                              <option value="Calendar Monthly" <?php
                                                                if ($value['periodsId'] == 'Calendar Monthly') {
                                                                  echo 'selected';
                                                                }
                                                                ?>>Calendar Monthly</option>
                              <!-- <option value="Season"  -->
                              <?php
                              //if($value['periodsId'] == 'Season'){
                              //echo 'selected';
                              // }
                              ?>
                              <!-- >Season</option> -->
                            </select>


                          </div>
                          <div class="col-md-4">
                            <input type="hidden" class="one" value=<?php echo $value['clicktracnches']; ?>>
                            <input type="number" pattern=" 0+\.[0-9]*[1-9][0-9]*$" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control tranche<?= ($key + 1) ?> alltracheValues" name="tranche<?= ($key + 1) ?>" value="<?= $value['clicktracnches'] ?>" style="margin: 0 0 0 -44%; border-radius: none !important;">
                          </div>
                          <div class="col-md-2"><i class="fa fa-trash-o deleteIcon" onclick="removerow(<?= ($key + 1) ?>)" aria-hidden="true"></i>
                          </div>
                        </div>
                        <div class="r" id="displayCon" style="margin: 4px 0px 4px 1px;">
                          <label>Clicks / tranche minimum size</label><br>


                          <input type="radio" style="width:3%;" id="consumption<?= ($key + 1) ?>" class="clnmin minsize<?= ($key + 1) ?> consumptionpercent" name="minsize<?= ($key + 1) ?>" value="% consumption" <?php
                                                                                                                                                                                                                    if ($value['clicktranches'] == '% consumption') {
                                                                                                                                                                                                                      echo 'checked';
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    ?>><label for="consumption<?= ($key + 1) ?>">% consumption</label>
                          <input type="radio" id="mwh<?= ($key + 1) ?>" style="width:3%;" class="clnmin minsize<?= ($key + 1) ?> mwhpercent" name="minsize<?= ($key + 1) ?>" value="#MWhs" <?php
                                                                                                                                                                                            if ($value['clicktranches'] == '#MWhs') {
                                                                                                                                                                                              echo 'checked';
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>><label for="mwh<?= ($key + 1) ?>">#MWhs</label><br>
                          <input type="hidden" name="minsize<?= ($key + 1) ?>" value="<?= $value['clicktranches'] ?>">

                          <!-- <span class="input-group-addon transparent"> %</span> -->

                        </div>
                      </div>
                      <!-- <hr> -->
                    <?php
                    }
                    ?>
                  </div>

                </div>



                <label>Open Position pricing mechanism</label><br>
                <select class="chosen-select pricMech" name="openmech" style="width: 69.5%;" id="openposition">
                  <?php
                  $getUserfields = array();
                  $getsupplydetails = "SELECT * FROM nus_pricing_mechanisam ";
                  $result = $conn->query($getsupplydetails);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $getUserfields[] = $row;
                    }
                  }



                  foreach ($getUserfields as $key => $value) {
                    $selected = '';

                    if ($value['pricingMechName'] == $editsingledata[0]['openPrizemechanism']) {
                      $selected = 'selected';
                    }
                  ?>
                    <option value="<?= $value['pricingMechName'] . ',' . $value['priceMechDesc'] ?>"><?= $value['pricingMechName'] ?>, <?= $value['priceMechDesc'] ?></option>

                  <?php
                  }
                  ?>

                </select>
              </div>
              <br>
              <div class="states">
                <?php
                $clientstate = mysqli_query($conn, "SELECT  * FROM nus_supply_contract WHERE supplierId ='" . $_GET['id'] . "';");
                $row = mysqli_fetch_array($clientstate);

                if ($row['state'] == 'Archived') {
                  echo "<span class=archives style=color:#345DA6;>" . $row['state'] . "</span>";
                } else if ($row['state'] == 'Cancelled') {
                  echo "<span class=archives style= color:Red;>" . $row['state'] . "</span>";
                } else {
                  echo "<span class=archives style= color:black;>" . $row['state'] . "</span>";
                }

                ?>
              </div>

              <div class="tab" id="preview">
                <?php
                if (isset($_SESSION['updated']) && ((time() - $_SESSION['updated']) < 2)) {

                  echo '<script> toastr.success("successfully Updated", "Supply contract ");</script>';
                  if ((time() - $_SESSION['updated']) > 2) {
                    unset($_SESSION['updated']);
                  }
                }
                if (isset($_SESSION['updatedtrade']) && ((time() - $_SESSION['updatedtrade']) < 2)) {

                  echo '<script> toastr.success("successfully Added", "Trade data");</script>';
                  if ((time() - $_SESSION['updatedtrade']) > 2) {
                    unset($_SESSION['updatedtrade']);
                  }
                }
                if (isset($_SESSION['updatedtradedata']) && ((time() - $_SESSION['updatedtradedata']) < 2)) {

                  echo '<script> toastr.success("successfully Updated", "Trade data");</script>';
                  if ((time() - $_SESSION['updatedtradedata']) > 2) {
                    unset($_SESSION['updatedtradedata']);
                  }
                }

                ?>
                <!-- <h6>New Supply Contract</h6> -->
                <?php
                  $details = $_GET['type'];
                  $resDisplay = 'View';
                  if($details == 'edit') {
                    $resDisplay = 'Preview';
                  }
                ?>
                <h3>Contract <?php echo $resDisplay;?></h3>


                <hr>
                <div class="contrac preview1">
                  <div class="row">
                    <div class="col-md-6">
                      <h6>Contract Details</h6>
                    </div>
                    <!-- editing trade start -->
                    <div class="col-md-6 text-right">
                      <?php
                      if ($_GET['type'] == 'edit') {
                        if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager') {
                      ?>
                          <a class="btn btn-primary" onclick="showTabs(0,3)">Edit</a>
                      <?php
                        }
                      }
                      ?>
                    </div>
                    <!-- edit trade end -->
                  </div>
                  <table class="table" style="table-layout: fixed; width:100%;">
                      
                    <tr>
                      <td>Contract Name</td>
                      <td><?= $editsingledata[0]['contract_id'] ?></td>
                  
                    </tr>
                    <tr>
                      <td>Parent</td>
                      <td><?= $editsingledata[0]['parentId'] ?></td>
                    </tr>
                    <tr>
                      <td>Client</td>
                      <td><?= $getclientdata[0]['clientcompany'] ?></td>
                    </tr>
                    <tr>
                      <td>Country</td>
                      <td><?= $editsingledata[0]['countryName'] ?></td>
                    </tr>
                    <tr>
                      <td>Commodity</td>
                      <td><?= $editsingledata[0]['commodityName'] ?></td>
                    </tr>
                    <tr>
                      <td>Supplier</td>
                      <td><?= $editsingledata[0]['supplyName'] ?></td>
                    </tr>
                    <tr>
                      <td>Contract Type</td>
                      <td><?= $editsingledata[0]['contractType'] ?></td>
                    </tr>
                    <?php
                    if ($editsingledata[0]['contractType'] != "fixed") { ?>
                      <tr>

                        <td>Index name</td>
                        <td><?= $editsingledata[0]['contractIndexId'] ?></td>
                      </tr>
                    <?php
                    }
                    ?>
                    <tr>
                      <td>Contract Commodity Currency</td>
                      <td><?= $editsingledata[0]['contractpricetype'] ?></td>
                    </tr>
                  </table>



                </div>

                <div class="contrac preview2">

                  <div class="row">
                    <div class="col-md-6">
                      <h6>Length Consumption</h6>
                    </div>
                    <div class="col-md-6 text-right">
                      <?php
                      if ($_GET['type'] == 'edit') {
                        if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager') {
                          if ($row['state'] != 'Active') {
                            echo '<script>alert("You don\'t have the access to view this page!"); location.href="index.php";</script>';
                          }
                      ?>
                          <a class="btn btn-primary" onclick="showTabs(1,3)">Edit</a>
                      <?php
                        } else {
                          echo '<script>alert("You don\'t have the access to view this page!"); location.href="index.php";</script>';
                        }
                      }
                      ?>
                    </div>
                  </div>
                  <table class="table" style="table-layout: fixed; width:100%;">
                    <tr>
                      <td>Contract Term</td>
                      <td><?= date('d-M-Y', strtotime($editsingledata[0]['contractTermfromDate'])) . ' to ' . date('d-M-Y', strtotime($editsingledata[0]['contractTermtoDate'])) ?></td>
                    </tr>
                    <?php
                    if ($editsingledata[0]['contractType'] == 'fixed') {
                    ?>
                      <tr>
                        <td>Commodity Price</td>
                        <td><?= number_format($editsingledata[0]['commodityPrice'], 2); ?> per MWh</td>
                      </tr>
                    <?php
                    }
                    ?>

                    <tr>
                      <td>Total Annual Consumption</td>
                      <td><?= $editsingledata[0]['totalAnualConsumption'] ?> MWh</td>
                    </tr>

                    <?php

                    $consumptionformonth = explode('|', $editsingledata[0]['consumptionmonth']);
                    // print_r($consumptionformonth);
                    // $totalconsumptionmonths = count($consumptionformonth);

                    // if($totalconsumptionmonths>12){
                    //   $totalconsumptionmonths = 12;
                    // }
                    // for($k=0;$k<$totalconsumptionmonths;$k++) {
                    //   echo $consumptionformonth[$k];
                    // }

                    // foreach ($consumptionmonth as $key => $value) {
                    //   // code...
                    // }

                    $allmonths = $editsingledata[0]['allmonts'];
                    $allmonths = explode(',', $allmonths);

                    $getmnts = array();
                    for ($j = 0; $j < count($allmonths); $j++) {
                      $splitmonth = explode('-', $allmonths[$j]);
                      array_push($getmnts, $splitmonth[1]);
                    }
                    $totalmonths = count($getmnts);

                    if ($totalmonths > 12) {
                      $totalmonths = 12;
                    }



                    for ($i = 0; $i < $totalmonths; $i++) {
                      $letp = explode('-', $consumptionformonth[$i])
                    ?>
                      <tr>
                        <td><?= $months[$getmnts[$i] - 1] ?> Consumption</td>
                        <td><?= currencyformat(round($letp[2], 2)) ?> MWh</td>
                      </tr>

                    <?php
                    }
                    ?>

                  </table>

                </div>
                <!-- <div class="contrac preview3">
                </div> -->

                <div class="contrac preview3">
                  <?php
                  if ($editsingledata[0]['contractType'] != 'fixed') {

                  ?>
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Index Details</h6>
                      </div>
                      <!-- edit trade -->
                      <div class="col-md-6 text-right">
                        <?php
                        if ($_GET['type'] == 'edit') {
                          if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager') {
                        ?>
                            <a class="btn btn-primary" onclick="showTabs(2,3)">Edit</a>
                        <?php
                          }
                        }
                        ?>
                      </div>
                      <!-- edit trade end -->
                    </div>
                    <table class="table" style="table-layout: fixed; width:100%;">
                      <tr>
                        <td>Index Structure</td>
                        <td><?= $editsingledata[0]['indexStructureType'] ?></td>
                      </tr>

                      <?php
                      $allowabletrade = array();
                      $geminsize = array();
                      $getallowabletrade = "SELECT * FROM nus_tradeperiods WHERE supplierId =" . $_GET['id'] . "";
                      $result = $conn->query($getallowabletrade);
                      $printdata = '';
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          $allowabletrade[] = $row['periodsId'] . '-' . $row['clicktracnches'];
                          // $geminsize[] =  $row['clicktranches'].'-'.$row['tranchesvalue'];
                          if ($row['clicktranches'] == '') {
                            $printdata .= '<tr>';
                            $printdata .= '<td>selected trade period + clicks</td>';
                            $printdata .= '<td>' . $row['periodsId'] . '  + ' . $row['clicktracnches'] . '</td>';
                            $printdata .= '</tr>';
                          } else {
                            $printdata .= '<tr>';
                            $printdata .= '<td>selected trade period + type + clicks</td>';
                            $printdata .= '<td>' . $row['periodsId'] . ' + ' . $row['clicktranches'] . ' + ' . $row['clicktracnches'] . '</td>';
                            $printdata .= '</tr>';
                          }
                        }
                      }
                      echo $printdata;
                      ?>
                      <!-- <tr>
                      <td>Allowable Trade Periods</td>
                      <td><?= implode(',', $allowabletrade) ?></td>
                  </tr> -->
                      <!--  var tradeper = parsedObject.allowperiod;
        var arrayval = tradeper.split(",");
        parsedObject.cons = consumption.toString();
        

        console.log(arrayval);
        var consum = ['% consumption','#MWhs'];
        for(var key in parsedObject){
          if(arrayval.includes(key)){
            printthreedata +='<tr>';
            printthreedata +='<td>'+key+' clicks / Tranches</td>';
            printthreedata +='<td>'+parsedObject[key]+'</td>';
            printthreedata +='</tr>';
          }
          // if(consum.includes(key)){
          //   printthreedata +='<tr>';
          //   printthreedata +='<td>clicks / Tranches Minimum size ('+key+')</td>';
          //   printthreedata +='<td>'+parsedObject[key]+'</td>';
          //   printthreedata +='</tr>';
          // }
         -->
                      <!--  } -->
                      <!-- <tr>
                        <td>clicks / Tranches Minimum size </td>
                        <td><?= implode(',', $geminsize) ?></td>
                    </tr> -->
                      <tr>
                        <td>Open Position Pricing Mechanism</td>
                        <td><?= $editsingledata[0]['openPrizemechanism'] ?></td>
                      </tr>

                    </table>
                  <?php
                  }
                  ?>
                </div>
                <?php
                $getcontract = "SELECT * FROM enter_trade WHERE supplycontractid='" . $editsingledata[0]['contract_id'] . "' AND clientId = '" . $_GET['info'] . "'";
                // echo $getcontract;
                $getcontract = mysqli_query($conn, $getcontract);
                $trades = array();
                while ($tradeRow = mysqli_fetch_assoc($getcontract)) {
                  $trades[] = $tradeRow;
                }
                if (count($trades) > 0) {
                ?>
                  <div class="contrac preview4" id ="tradeshide">
                    <div class="row">
                    <div class="col-md-12 tradenamefilter">
                        <div class="tradename">
                           <h6>Trade Details</h6>
                        </div>
                      </div>
                    </div>
                    <?php

                      $executed = empty($_GET['executed'])? '': $_GET['executed'];
                      $cancelled = empty($_GET['cancelled'])? '': $_GET['cancelled'];

                      if($_SESSION['role'] != 'Parent company' && $_SESSION['role'] != 'Client company') {
                        if($executed == '' && $cancelled == '') {
                          $getcontract = "SELECT * FROM enter_trade WHERE supplycontractid='" . $editsingledata[0]['contract_id'] . "' AND clientId = '" . $_GET['info'] . "'";
                          
                        }
                       
                        else {
                          $getcontract = "SELECT * FROM enter_trade WHERE supplycontractid='" . $editsingledata[0]['contract_id'] . "' AND clientId = '" . $_GET['info'] . "' AND tradeexecuted IN ('$executed','$cancelled');";
                        }

                        // echo $getcontract;
                        $getcontract = mysqli_query($conn, $getcontract);
                        $trades = array();
                        while ($tradeRow = mysqli_fetch_assoc($getcontract)) {
                          $trades[] = $tradeRow;
                          // print_r($tradeRow);
                          
                        }
                      }
                      // condition added to display only executed trade for parent and client 
                      else {
                        $getcontract = "SELECT * FROM enter_trade WHERE supplycontractid='" . $editsingledata[0]['contract_id'] . "' AND clientId = '" . $_GET['info'] . "' AND tradeexecuted = 'Executed';";
                      
                        // echo $getcontract;
                        $getcontract = mysqli_query($conn, $getcontract);

                        $trades = array();
                        while ($tradeRow = mysqli_fetch_assoc($getcontract)) {
                          $trades[] = $tradeRow;
                      }
                     $a = count($trades);

                     // code for hiding tradedetails block
                     echo "<script>
                        let a = $a;
                       
                        if(a==0) {
                          document.getElementById('tradeshide').style.display = 'none';
                        }
                        else {
                          document.getElementById('tradeshide').style.display = 'block';
                        }
                        </script>";

                     
                    }
                    // end 
                    
                   
                    foreach ($trades as $key => $tradevalue) {
               

                    ?>



                      <div class="row tradevalue">
                        <div class="col-md-6 tradeExecuted">
                          <div class="tradeyearly">
                            <h6><?= $tradevalue['trade'] ?></h6>
                       
                          </div>

                        <?php 
                            if($_GET['type']=='preview') {      
                        ?>
                            <div class="tradeexecuteds" <?php if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company') echo "style=display:none;"; ?>>
                                <div class="tradestate">
                                    <?php 
                                    if ($tradevalue['tradeexecuted'] == 'Executed') {
                                        echo "<a href=''class=tradeexecutedvalue style=color:#345DA6;text-decoration:none; >" . $tradevalue['tradeexecuted'] . "</a>";
                                    }
                                    else {
                                        echo "<a href=tradecancel.php?id=$tradevalue[tradeId] class=tradeexecutedvalue style=color:red; >" . $tradevalue['tradeexecuted'] . "</a>";
                                    }
                                    ?>        
                           </div>
                          </div>
                          <?php } else {
                          ?>

                            <div class="tradeexecuteds" <?php if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company') echo "style=display:none;"; ?>>
                                <div class="tradestate">
                                    <?php

                                        if ($tradevalue['tradeexecuted'] == 'Executed') {
                                            echo "<a class=tradeexecutedvalue style=color:#345DA6;text-decoration:none;  >" . $tradevalue['tradeexecuted'] . "</a>";
                                        }
                                        else {
                                            echo "<a href=tradecancel.php?id=$tradevalue[tradeId]  class=tradeexecutedvalue style=color:red; >" . $tradevalue['tradeexecuted'] . "</a>";
                                        }
                                    ?>
                                </div>
                                <?php
                                  if($editsingledata[0]['state']==='Active') {
                                ?>
                                    <?php
                                      if ($tradevalue['tradeexecuted'] == 'Executed') {
                                    ?>
                               
                                      <div class="btn-group ">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                              
                                                <a id="" href="tradeexecuted.php?id=<?=$tradevalue['tradeId']?>&nustradeid=<?=$tradevalue['nustradeId']?>&year=<?=$tradevalue['tradevalue']?>&tradevolume=<?=$tradevalue['tradevolume']?>&calandar=<?= $tradevalue['trade'] ?>&q=<?=$tradevalue['quartval']?>&tradeid=<?=$tradevalue['tradingId']?>&supplyId=<?=$_GET['id']?>">Cancel</a>
                                            </li>
                                        </div>
                                    <?php  
                                      } 
                                    ?>
                                  <?php 
                                  } 
                                  ?>          
                            </div>






                          <?php }
                          ?>
                         
                        </div>
                        <div class="col-md-6">
                          <div class="col-md-6 text-right">
                            <!-- edit start -->
                            <?php
                            // if($_GET['type']=='edit'){
                            //   if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager' || $_SESSION['role'] == 'NUS User'){
                            ?>
                            <!-- <a class="btn btn-primary enterbutton" href="editentertrade.php?id=<? //=$tradevalue['tradeId']
                                                                                                    ?>">Edit</a> -->
                            <?php
                            //   }
                            // }
                            ?>
                            <!-- edit end -->
                          </div>
                        </div>
                      </div>
                      <table class="table" style="table-layout: fixed; width:100%;">
                        <tr>
                          <td>Trade Volume (MWh)</td>
                          <?php

                          ?>
                          <td><?= currencyformat(round(numberreturn($tradevalue['tradevolume']), 2)) ?></td>
                        </tr>
                        <tr>
                          <td>Base Load Price (per MWh)</td>
                          <td><?= number_format($tradevalue['baseload'], 2) ?></td>
                        </tr>
                        <tr>
                          <td>Effective Load Price (per MWh)</td>
                          <td><?= number_format($tradevalue['effectiveprice'], 2) ?></td>
                        </tr>
                        <tr>
                          <td>Trade Period</td>
                          <td><?= $tradevalue['trade'] . ' - ' . $tradevalue['tradevalue'] . ($tradevalue['quartval'] == "" ? '' : ' - ' . $tradevalue['quartval']) ?></td>
                        </tr>
                        <tr>
                          <td>Trade Execution Date</td>
                          <td><?= date('d-M-Y', strtotime($tradevalue['tradeDate'])) ?></td>
                        </tr>
                      </table>

                    <?php
                    }
                    ?>




                  </div>
                <?php
                }
                ?>
              </div>
              <?php
              if ($_GET['type'] == 'edit') {
              ?>
                <div style="overflow:auto;">
                  <div class="testing">

                    <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1,'next')">continue <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </button>
                    <button type="button" id="prevBtn" class="btn btn-default" onclick="nextPrev(-1,'previous')"><i class="fa fa-long-arrow-left" aria-hidden="true"></i><i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                      Previous</button>
                    <button type="button" id="cancelBtn" class="btn btn-default" onclick="window.location.href='index.php'"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancel </button>
                  </div>
                </div>
              <?php
              }
              ?>


            </form>
          </div>
        </div>
      </div>
      <?php
      function numberreturn($value)
      {
        $toremovecomma = floatval(preg_replace('/[^\d. ]/', '', $value));
        return $toremovecomma;
      }
      ?>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          $('.input-daterange').datepicker({
            format: 'dd-M-yyyy'
          });

        });




        $('#checkbox').on('click', function() {
          if ($(this).is(':checked')) {

            var a = $('.totalanualconsumption').val();
            a = a.replace(/\,/g, ''); // 1125, but a string, so convert it to number
            var anualTotal = parseInt(a, 10);
            var countdiv = $('.countmonths').val();
            var allmonths = $('.allmonths').val();
            allmonths = allmonths.split(',');
            // console.log(allmonths); //
            var getmnts = [];
            for (var j = 0; j < allmonths.length; j++) {
              var splitmonth = allmonths[j].split('-');
              getmnts.push(splitmonth[1]);
            }
            var totalmonths = getmnts.length;
            if (totalmonths > 12) {
              totalmonths = 12;
            }
            // console.log(getmnts);//
            var yearDiv = parseInt(anualTotal) / 12;
            var printData = '';

            //to write the values from the database to the when the user clicks on the allowcate button checkbox modified on 25 Apr 2023

            let consumValue = document.querySelector('.contracttermdata').value;
            let newconsumArrayRes = consumValue.split("|");
            // console.log(newArrayRes);
            let finalConsumRes = [];
            for (i = 0; i < newconsumArrayRes.length; i++) {
              finalConsumRes.push(newconsumArrayRes[i].split("-"));
            }
            console.log(finalConsumRes[1][0]);

            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var sumtotal = 0;
            for (var i = 0; i < totalmonths; i++) {
              printData += '<div class="diviy">';
              printData += '<div class="row marf">';
              printData += '<div class="col-md-1">';
              printData += '<p>' + months[getmnts[i] - 1] + '</p>';
              printData += '</div>';
              printData += '<div class="col-md-6">'
              if (finalConsumRes[i] == undefined) {
                printData += '<input type="range" id="points" class="rangslider" value="' + Math.round(yearDiv) + '" name="points" min="0" max="' + parseInt(anualTotal) + '" onchange="showVal(this.value,' + i + ')" readonly>';
              } else {
                printData += '<input type="range" id="points" class="rangslider" value="' + Math.round(finalConsumRes[i][2]) + '" name="points" min="0" max="' + parseInt(anualTotal) + '" onchange="showVal(this.value,' + i + ')" readonly>';
              }
              printData += '</div>';
              printData += '<div class="col-md-5">';
              printData += '<div class="input-group">';
              printData += '<input class="months' + i + '"  type="hidden" value="' + months[getmnts[i] - 1] + '">';
              if (finalConsumRes[i] == undefined) {
                printData += '<input class="form-control left-border-none peryr peryearval' + i + '" placeholder="0.00" type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="' + checkcurrency(parseFloat(yearDiv).toFixed(2)) + '">';
                printData += '<span class="input-group-addon transparent">MWh</span>';
              } else {
                printData += '<input class="form-control left-border-none peryr peryearval' + i + '" placeholder="0.00" type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="' + checkcurrency(parseFloat(finalConsumRes[i][2]).toFixed(2)) + '" readonly>';
                printData += '<span class="input-group-addon transparent">MWh</span>';
              }

              printData += '</div>';
              printData += '</div>';
              printData += '</div>';
              sumtotal += yearDiv;
            }
            printData += '<hr>';
            printData += '<div class="row">';

            printData += '<div class="col-md-8">';
            printData += '<h3>Total Annual Consumptions</h3>';
            printData += '</div>';
            printData += '<div class="col-md-4 text-right">';
            printData += '<span style="color:red" class="errormax"></span>';
            printData += '<input type="hidden" name="totlcnsumtion" class="totlcnsumtion" value="' + checkcurrency(sumtotal) + '">'
            printData += '<h3><span class="anuTolal">' + checkcurrency(parseFloat(sumtotal).toFixed(2)) + '</span> MWH</h3>';
            printData += '</div>';
            printData += '</div>';
            $('.allowdvi').html(printData);
          } else {
            $('.allowdvi').html('');
          }
        })
        $('#checkboxs').on('click', function() {
          if ($(this).is(':checked')) {
            $('.monthsallow').val('yes')
            bringitback();
            $('.diviy').each(function() {
              // $(this).find('.rangslider').prop('disabled',true);
              $(this).find('.peryr').attr('readonly', true);

            })
          } else {
            $('.diviy').each(function() {

              // $(this).find('.rangslider').prop('disabled',false);
              $(this).find('.peryr').attr('readonly', false);

            })
          }
        });

        function showVal(rangeval, rowval) {
          var val = rangeval;
          val += '';
          x = val.split('.');
          x1 = x[0];
          x2 = x.length > 1 ? '.' + x[1] : '';

          var rgx = /(\d+)(\d{3})/;

          while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
          }
          $('.peryearval' + rowval).val(x1 + x2 + '');
          var total = 0;
          var count = [];
          var totalmonths = 12;
          $('.peryr').each(function() {
            var a = $(this).val();
            a = a.toString().replace(/\,/g, '');
            var anualTotal = parseFloat(a);
            total += anualTotal;
            count.push('yes');

          });
          totalmonths = totalmonths - (count.length);
          var consumption = $('.totalanualconsumption').val()
          consumption = consumption.replace(/,/g, '');
          consumption = parseFloat(consumption);
          var peramt = parseFloat(consumption) / 12;
          var datamt = totalmonths * peramt;

          var sumdata = total + datamt;

          if (sumdata > consumption) {
            $('.monthsallow').val('no');
            $('.errormax').html('maximum consumption');
          } else {
            $('.monthsallow').val('yes');
            $('.errormax').html('');
          }
          var totalCns = parseInt($('.totalanualconsumption').val());
          $('.anuTolal').html(formated(total));
        }
      </script>


      <script>
        var previeew = "<?php echo $_GET['type'] ?>";
        // console.log(previeew);//
        var currentTab = 0;
        if (previeew == 'preview' || previeew == 'edit') {
          currentTab = 3;
        }
        showTab(currentTab);

        function showTab(n) {

          var x = document.getElementsByClassName("tab");
          x[n].style.display = "block";
          var contractType = $('.contactType:checked').val();
          $('.cttype').val(contractType);
          var contractType = $('.contactType:checked').val();

          if (contractType == 'fixed') {
            $('.edittab').val('normal');
            $('.preview3').hide();
          } else {
            $('.edittab').val('edit');
            $('.preview3').show();
          }

          if (n == 0) {
            document.getElementById("cancelBtn").style.display = "inline";
            document.getElementById("cancelBtn").innerHTML = '<i class="fa fa-long-arrow-left" aria-hidden="true"></i> cancel ';
            document.getElementById("prevBtn").style.display = "none";
          } else {
            document.getElementById("cancelBtn").style.display = "none";
            document.getElementById("prevBtn").innerHTML = '<i class="fa fa-long-arrow-left" aria-hidden="true"></i> previous ';
            document.getElementById("prevBtn").style.display = "inline";
          }
          var editval = $('.edittab').val();
          if (contractType == 'fixed') {

            $('.dynamictext').html('Term, Consumption, and Price - Fixed Price Contract');

            if (n == (x.length - 1)) {

              x[n].style.display = "block";
              document.getElementById("prevBtn").style.display = "block";
              document.getElementById("nextBtn").innerHTML = "Update Contract";
              // $('#nextBtn').addClass('fullwidth');



            } else {
              if (n == 2 && editval == 'normal') {
                $(x[n]).remove();

              }
              if (n == 2) {
                x[n].style.display = "block";
                document.getElementById("nextBtn").innerHTML = "Update Contract";
              } else {
                document.getElementById("nextBtn").innerHTML = 'continue <i class="fa fa-long-arrow-right" aria-hidden="true"></i>';
              }



            }
          } else {
            if ($('.indexdex').length == 0) {
              var print = '';
              print += '<div class="tab indexdex" id="index">';
              print += '<h6>New Supply Contract</h6>';
              print += '<h3>Index Details</h3>';
              print += '<hr>';
              print += '<label>Index Structure Type</label><br>';
              print += '<div style="display: inline-block;">';
              print += '<div class="cat action">';
              print += '<label>';
              print += '<input type="checkbox" class="indexstr" name="indexstr[]" value="Consumption(MWh)" checked><span class="disabledbutton dis">Consumption(MWh)</span>';
              print += '</label>';
              print += '</div>';
              print += '<div class="cat action">';
              print += '<label>';
              print += '<input type="checkbox" class="indexstr" name="indexstr[]" value="Power(MW)" ><span class="disabledbutton dis">Power(MW)</span>';
              print += '</label>';
              print += '</div>';
              print += '</div>';

              print += '<div class="alrw">';
              print += '<label>Allowable trade periods</label><br>';
              print += '<a onclick="addTradeperiods()"class="btn btn-default">add allowable trade periods</a><br>';
              print += '<input type="hidden" class="rowcount" value="1" name="rowcount">';
              print += '<div class="addTrade">';

              print += '</div>';

              print += '</div>';



              print += '<label>Open Position pricing mechanism</label><br>';
              print += '<select class="chosen-select pricMech" name="openmech">';
              print += '<option value="Day Ahead,Spot Daily Market">Day Ahead,Spot Daily Market</option>';
              print += '<option value="Day Ahead,Spot Average for month">Day Ahead,Spot Average for month</option>';
              print += '<option value="Month Ahead,Last Value">Month Ahead,Last Value</option>';
              print += '<option value="Month Ahead,Average Value">Month Ahead,Average Value</option>';
              print += '<option value="Quarter Ahead,Last Value">Quarter Ahead,Last Value</option>';
              print += '<option value="Quarter Ahead,Average Value">Quarter Ahead,Average Value</option>';
              print += '<option value="Calendar Ahead,Last Value">Calendar Ahead,Last Value</option>';
              print += '</select>';
              print += '</div>';
              $(x[x.length - 2]).after(print);
            }
            $('.dynamictext').html('Term and Consumption - Indexed Contract');
            if (n == (x.length - 1)) {
              document.getElementById("prevBtn").style.display = "block";
              document.getElementById("nextBtn").innerHTML = "Update Contract";
              // $('#nextBtn').addClass('fullwidth');


            } else {

              document.getElementById("nextBtn").innerHTML = 'continue <i class="fa fa-long-arrow-right" aria-hidden="true"></i>';
            }
          }

        }

        function showfrontTab(current) {
          var x = document.getElementsByClassName("tab");

          x[current].style.display = 'block';
          x[1].style.display = 'none';
          x[2].style.display = 'none';
          x[3].style.display = 'none';
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

        function showTabs(n, current) {

          var x = document.getElementsByClassName("tab");
          var contractType = $('.contactType:checked').val();
          x[n].style.display = 'block';

          x[current].style.display = 'none';
          if (contractType == 'fixed') {
            $('.edittab').val('normal');
          } else {
            $('.edittab').val('edit');
          }

          if (n == 0) {
            currentTab = n;
            document.getElementById("cancelBtn").style.display = "inline";
            document.getElementById("filteringthedata").style.display="none";
            document.getElementById("prevBtn").style.display = "none";
            $('#nextBtn').removeClass('fullwidth');
            
          } else {
            currentTab = n;
            document.getElementById("cancelBtn").style.display = "none";
            document.getElementById("prevBtn").style.display = "inline";
            document.getElementById("filteringthedata").style.display="none";
            $('#nextBtn').removeClass('fullwidth');
          }
          document.getElementById("nextBtn").innerHTML = 'continue <i class="fa fa-long-arrow-right" aria-hidden="true"></i>';

        }

        function bringitback() {
          var a = $('.totalanualconsumption').val();
          a = a.replace(/\,/g, ''); // 1125, but a string, so convert it to number
          var anualTotal = parseInt(a, 10);

          var countdiv = $('.countmonths').val();
          var allmonths = $('.allmonths').val();
          allmonths = allmonths.split(',');

          var getmnts = [];
          for (var j = 0; j < allmonths.length; j++) {
            var splitmonth = allmonths[j].split('-');
            getmnts.push(splitmonth[1]);
          }
          var totalmonths = getmnts.length;
          if (totalmonths > 12) {
            totalmonths = 12;
          }

          var yearDiv = parseInt(anualTotal) / 12;
          var printData = '';

          var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
          var sumtotal = 0;
          for (var i = 0; i < totalmonths; i++) {
            printData += '<div class="diviy">';
            printData += '<div class="row marf">';
            printData += '<div class="col-md-1">';
            printData += '<p>' + months[getmnts[i] - 1] + '</p>';
            printData += '</div>';
            printData += '<div class="col-md-7">'
            printData += '<input type="range" id="points" class="rangslider" value="' + Math.round(yearDiv) + '" name="points" min="0" max="' + parseInt(anualTotal) + '" onchange="showVal(this.value,' + i + ')">';
            printData += '</div>';
            printData += '<div class="col-md-4">';
            printData += '<div class="input-group">';
            printData += '<input class="months' + i + '"  type="hidden" value="' + months[getmnts[i] - 1] + '">';
            printData += '<input class="form-control left-border-none peryr peryearval' + i + '" placeholder="0.00" type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="' + checkcurrency(parseFloat(yearDiv).toFixed(2)) + '">';
            printData += '<span class="input-group-addon transparent">MWh</span>';
            printData += '</div>';
            printData += '</div>';
            printData += '</div>';
            sumtotal += yearDiv;
          }
          printData += '<hr>';
          printData += '<div class="row">';

          printData += '<div class="col-md-8">';
          printData += '<h3 class="mdt">Total Annual Consumptions</h3>';
          printData += '</div>';
          printData += '<div class="col-md-4 text-right">';
          printData += '<span style="color:red" class="errormax"></span>';
          printData += '<input type="hidden" name="totlcnsumtion" class="totlcnsumtion" value="' + checkcurrency(parseFloat(sumtotal)) + '">'
          printData += '<h3 class="mdt"><span class="anuTolal">' + checkcurrency(parseFloat(sumtotal).toFixed(2)) + '</span> <span class="mwh">MWH</span></h3>';
          printData += '</div>';
          printData += '</div>';
          $('.allowdvi').html(printData);
        }

        function nextPrev(n, type) {

          var x = document.getElementsByClassName("tab");
          var contractType = $('.contactType:checked').val();

          if (type == 'next') {
            var obj = {};
            if (currentTab == 0) {
              var parentt = $('.parent').val();
              console.log('parentt:' + parentt);
              var clint = $('.clientname').val();
              var unit = '';
              if ($('.commodity:checked').val() == 'natural gas') {
                unit = $('.unit:checked').val();
              }
              var commodity = $('.commodity:checked').val();

              var hiddenCommodity = $('.hiddenCommodity').val();

              console.log("Hidden commodity = " + hiddenCommodity);

              // if(hiddenCommodity == 'electricity') {
              //   document.getElementById('naturalgas').classList.remove('naturalGass');
              // }

              console.log("Commodity name = " + commodity);

              // if(commodity == "natural gas") {
              //   console.log('Hi');
              //   document.getElementById('naturalgas').classList.add('naturalGass');
              // } else {
              //   document.getElementById('naturalgas').classList.remove('naturalGass');
              // }

              var supplier = $('.supplr').val();
              obj.country = $('.country').val();
              var index = '';
              if ($('.contactType:checked').val() == 'indexed') {
                index = $('.indexType').val();
              }
              var contractType = $('.contactType:checked').val();
              var startDate = $('.startdate').val();
              var endDate = $('.enddate').val();
              obj.parent = parentt;
              obj.client = clint;
              obj.commodity = [{
                name: commodity,
                unit: unit
              }];
              obj.supplier = supplier;
              obj.contracttype = [{
                type: contractType,
                index: index
              }];
              localStorage.setItem('obj', JSON.stringify(obj));


            }
            var contractType = $('.contactType:checked').val();
            if (contractType == 'fixed') {
              $('.compr').show();

            } else {
              $('.compr').hide();

            }


            if (currentTab == 1) {

              var retrievedObject = localStorage.getItem('obj');

              var parsedObject = JSON.parse(retrievedObject);
              parsedObject.contractterm = $('.startdate').val() + ' to ' + $('.endate').val();
              parsedObject.comodityprice = $('.comdyprice').val();
              parsedObject.totalanualconsumption = $('.totalanualconsumption').val();
              parsedObject.contractprice = $('.contractprice').val();
              var countdiv = $('.countmonths').val();
              var allmonths = $('.allmonths').val();
              allmonths = allmonths.split(',');

              var getmnts = [];
              var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
              var year = [];
              for (var j = 0; j < allmonths.length; j++) {
                console.log(allmonths[j]);
                var splitmonth = allmonths[j].split('-');
                year.push(splitmonth[0]);
                getmnts.push(months[splitmonth[1] - 1] + '-' + splitmonth[0]);
              }
              var uniqueyear = year.filter(function(x, i, a) {
                return a.indexOf(x) == i;
              });
              $('.yearmonths').val(uniqueyear.toString());
              // console.log(getmnts);
              // 1125, but a string, so convert it to number
              // var anualTotal=parseFloat(a);
              var dividemnt = $('.totalanualconsumption').val();
              dividemnt = dividemnt.replace(/\,/g, '');
              dividemnt = parseFloat(dividemnt) / 12;




              var monthsdata = [];
              var monthshedge = [];

              var jsonObj = {};
              var moths = [];
              for (k = 0; k < getmnts.length; k++) {
                var vla = $('.peryearval' + k).val();
                if ($('.peryearval' + k).val() != undefined) {
                  let splitstring = getmnts[k];
                  splitstring = splitstring.split('-');
                  jsonObj[splitstring[0]] = $('.peryearval' + k).val();

                  // var lot = getmnts[k]+'+'+$('.peryearval'+k).val();
                  // testing.push(lot);
                }
                if ($('.peryearval' + k).val() == undefined) {
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
              for (k = 0; k < getmnts.length; k++) {
                let splitstring = getmnts[k];
                splitstring = splitstring.split('-');
                // console.log();
                // var anth =getmnts[k]+'-'+ (($('.peryearval'+k).val() !=undefined)?($('.peryearval'+k).val()):formated(dividemnt));

                // if(getmnts[k] && $('.peryearval'+k).val() ==undefined){
                //   if(getmnts[k] && $('.peryearval'+k).val() ==undefined)
                // }
                var putext = '';
                if ($('.peryearval' + k).val() != undefined) {
                  var vla = $('.peryearval' + k).val();
                  putext = parseFloat(vla.replace(/,/g, ''));
                } else {
                  for (i = 0; i < moths.length; i++) {
                    if (moths[i] == splitstring[0]) {
                      putext = jsonObj[splitstring[0]];
                      putext = parseFloat(putext.replace(/,/g, ''));
                    }
                  }
                }
                var anth = getmnts[k] + '-' + putext;
                var ges = getmnts[k] + '-' + 0;

                monthshedge.push(ges);
                monthsdata.push(anth);
              }
              // console.log(monthsdata);
              $('.contracttermdata').val(monthsdata.join("|"));
              // $('.hedge').val(monthshedge.join("|"));
              // $('.hedge').val(monthshedge.join("|")); commented not needed this line since the code has been written in 3188
              // var valusjdjsk = $('.hedge').val(monthshedge.join("|"));

              console.log("Line number 2619: " + $('.hedge').val());


              var totalmonths = getmnts.length;
              if (totalmonths > 12) {
                totalmonths = 12;
              }


              for (i = 0; i < totalmonths; i++) {
                var value = $('.months' + i).val();
                var vals = value + "consumption";
                parsedObject[vals] = $('.peryearval' + i).val();
              }
              localStorage.setItem('obj', JSON.stringify(parsedObject));
              var contractType = $('.contactType:checked').val();

              if (contractType == 'fixed') {
                console.log(parsedObject);
                var printdata = '';
                printdata += '<div class="row">';
                printdata += '<div class="col-md-6">';
                printdata += '<h6>Contract Details</h6>';
                printdata += '</div>'
                printdata += '<div class="col-md-6 text-right">'
                //editing contract
                printdata += '<a class="btn btn-primary" onclick="showTabs(0,2,10)">Edit</a>';
                printdata += '</div>';
                printdata += '</div>';
                printdata += '<table class="table">';
                printdata += '<tr>';
                printdata += '<td>Parent</td>';
                printdata += '<td>' + parsedObject.parent + '</td>';
                printdata += '</tr>';
                printdata += '<tr>';
                printdata += '<td>Client</td>';
                printdata += '<td>' + parsedObject.client + '</td>';
                printdata += '</tr>';
                printdata += '<tr>';
                printdata += '<td>Country</td>';
                printdata += '<td>' + parsedObject.country + '</td>';
                printdata += '</tr>';
                printdata += '<tr>';
                printdata += '<td>Commodity</td>';
                printdata += '<td>' + parsedObject.commodity[0].name + '</td>';
                printdata += '</tr>';
                printdata += '<tr>';
                printdata += '<td>Supplier</td>';
                printdata += '<td>' + parsedObject.supplier + '</td>';
                printdata += '</tr>';
                printdata += '<tr>';
                printdata += '<td>Contract Type</td>';
                printdata += '<td>' + parsedObject.contracttype[0].type + '</td>';
                printdata += '</tr>';
                if (parsedObject.contracttype[0].index != "") {
                  printdata += '<tr>';

                  printdata += '<td>Index name</td>';
                  printdata += '<td>' + parsedObject.contracttype[0].index + '</td>';
                  printdata += '</tr>';
                }
                printdata += '<tr>';
                printdata += '<td>Contract Commodity Currency</td>';
                printdata += '<td>' + parsedObject.contractprice + '</td>';
                printdata += '</tr>';
                printdata += '</table>';
                $('.preview1').html(printdata);
                var printtwodata = '';
                printtwodata += '<div class="row">';
                printtwodata += '<div class="col-md-6">';
                printtwodata += '<h6>Length And Consumption</h6>';
                printtwodata += '</div>'
                printtwodata += '<div class="col-md-6 text-right">'
                printtwodata += '<a class="btn btn-primary" onclick="showTabs(1,2,10)">Edit</a>';
                printtwodata += '</div>';
                printtwodata += '</div>';
                printtwodata += '<table class="table">';
                printtwodata += '<tr>';
                printtwodata += '<td>Contract Term</td>';
                printtwodata += '<td>' + parsedObject.contractterm + '</td>';
                printtwodata += '</tr>';
                printtwodata += '<tr>';
                printtwodata += '<td>Commodity Price</td>';
                printtwodata += '<td>' + parsedObject.comodityprice.toLocaleString("en-US") + ' per MWh</td>';
                printtwodata += '</tr>';

                printtwodata += '<tr>';
                printtwodata += '<td>Total Annual Consumption</td>';
                printtwodata += '<td>' + parsedObject.totalanualconsumption.toLocaleString("en-US") + ' MWh</td>';
                printtwodata += '</tr>';
                printtwodata += '<tr>';

                var allmonths = $('.allmonths').val();
                allmonths = allmonths.split(',');

                var getmnts = [];
                for (var j = 0; j < allmonths.length; j++) {
                  var splitmonth = allmonths[j].split('-');
                  getmnts.push(splitmonth[1]);
                }
                var totalmonths = getmnts.length;
                if (totalmonths > 12) {
                  totalmonths = 12;
                }
                for (var i = 0; i < totalmonths; i++) {
                  var monthja = $('.months' + i).val();
                  printtwodata += '<td>' + $('.months' + i).val() + ' Consumption</td>';
                  var cons = eval('parsedObject.' + monthja + 'consumption');
                  printtwodata += '<td>' + cons + ' MWh</td>';
                  printtwodata += '</tr>';
                  printtwodata += '<tr>';
                }


                printtwodata += '</table>';
                $('.preview2').html(printtwodata);

              }



            }


            if (currentTab == 2) {
              var retrievedObject = localStorage.getItem('obj');
              var parsedObject = JSON.parse(retrievedObject);
              // console.log(parsedObject);
              parsedObject.index = $('.indexstr:checked').val();
              console.log("Selected index ==>" + parsedObject.index);
              parsedObject.totalanualconsumption = $('.totalanualconsumption').val();
              var rowcount = $('.rowcount').val();
              var tradper = [];
              var tranches = [];
              var consumption = [];

              for (i = 0; i < rowcount; i++) {
                if (typeof($('.tradsel' + i).val()) != "undefined") {
                  tradper.push($('.tradsel' + i).val());
                  var value = $('.tradsel' + i).val();
                  var vals = value;
                  tranches.push($('.tradsel' + i).val() + '-' + $('.tranche' + i).val());
                  consumption.push($('.minsize' + i + ':checked').val() + ' + ' + $('.tranche' + i).val());
                }
              }
              var allper = tradper.toString();
              parsedObject[vals] = tranches.toString();
              parsedObject.cons = consumption.toString();
              parsedObject.allowperiod = allper;
              var mins = $('.clnmin').val();
              parsedObject[mins] = $('.minsize').val();
              parsedObject.pricMech = $('.pricMech').val();
              var x = document.getElementsByClassName("tab");

              var printdata = '';
              printdata += '<div class="row">';
              printdata += '<div class="col-md-6">';
              printdata += '<h6>Contract Details</h6>';
              printdata += '</div>'
              printdata += '<div class="col-md-6 text-right">'
              // edit contract
              printdata += '<a class="btn btn-primary" onclick="showTabs(0,3)">Edit</a>';
              printdata += '</div>';
              printdata += '</div>';
              printdata += '<table class="table">';
              printdata += '<tr>';
              printdata += '<td>Parent</td>';
              printdata += '<td>' + parsedObject.parent + '</td>';
              printdata += '</tr>';
              printdata += '<tr>';
              printdata += '<td>Client</td>';
              printdata += '<td>' + parsedObject.client + '</td>';
              printdata += '</tr>';
              printdata += '<tr>';
              printdata += '<td>Country</td>';
              printdata += '<td>' + parsedObject.country + '</td>';
              printdata += '</tr>';
              printdata += '<tr>';
              printdata += '<td>Commodity</td>';
              printdata += '<td>' + parsedObject.commodity[0].name + '</td>';
              printdata += '</tr>';
              printdata += '<tr>';
              printdata += '<td>Supplier</td>';
              printdata += '<td>' + parsedObject.supplier + '</td>';
              printdata += '</tr>';
              printdata += '<tr>';
              printdata += '<td>Contract Type</td>';
              printdata += '<td>' + parsedObject.contracttype[0].type + '</td>';
              printdata += '</tr>';
              if (parsedObject.contracttype[0].index != "") {
                printdata += '<tr>';

                printdata += '<td>Index name</td>';
                printdata += '<td>' + parsedObject.contracttype[0].index + '</td>';
                printdata += '</tr>';
              }
              printdata += '<tr>';
              printdata += '<td>Contract Commodity Currency</td>';
              printdata += '<td>' + parsedObject.contractprice + '</td>';
              printdata += '</tr>';
              printdata += '</table>';
              $('.preview1').html(printdata);
              var printtwodata = '';
              printtwodata += '<div class="row">';
              printtwodata += '<div class="col-md-6">';
              printtwodata += '<h6>Length Consumption</h6>';
              printtwodata += '</div>'
              printtwodata += '<div class="col-md-6 text-right">'
              printtwodata += '<a class="btn btn-primary" onclick="showTabs(1,3)">Edit</a>';
              printtwodata += '</div>';
              printtwodata += '</div>';
              printtwodata += '<table class="table">';
              printtwodata += '<tr>';
              printtwodata += '<td>Contract Term</td>';
              printtwodata += '<td>' + parsedObject.contractterm + '</td>';
              printtwodata += '</tr>';



              // printtwodata +='<tr>';
              // printtwodata +='<td>Commodity Price</td>';
              // printtwodata +='<td>'+parsedObject.comodityprice+'</td>';
              // printtwodata +='</tr>';

              printtwodata += '<tr>';
              printtwodata += '<td>Total Annual Consumption</td>';
              printtwodata += '<td>' + parsedObject.totalanualconsumption + ' MWh</td>';
              printtwodata += '</tr>';
              printtwodata += '<tr>';

              var allmonths = $('.allmonths').val();
              allmonths = allmonths.split(',');

              var getmnts = [];
              for (var j = 0; j < allmonths.length; j++) {
                var splitmonth = allmonths[j].split('-');
                getmnts.push(splitmonth[1]);
              }
              var totalmonths = getmnts.length;
              if (totalmonths > 12) {
                totalmonths = 12;
              }
              for (var i = 0; i < totalmonths; i++) {
                var monthja = $('.months' + i).val();
                printtwodata += '<td>' + $('.months' + i).val() + ' Consumption</td>';
                var cons = eval('parsedObject.' + monthja + 'consumption');
                printtwodata += '<td>' + cons + ' MWh</td>';
                printtwodata += '</tr>';
                printtwodata += '<tr>';
              }

              printtwodata += '</table>';
              $('.preview2').html(printtwodata);
              var printthreedata = '';
              printthreedata += '<div class="row">';
              printthreedata += '<div class="col-md-6">';
              printthreedata += '<h6>Index Details</h6>';
              printthreedata += '</div>'
              printthreedata += '<div class="col-md-6 text-right">'
              //editing contract
              printthreedata += '<a class="btn btn-primary" onclick="showTabs(2,3)">Edit</a>';
              printthreedata += '</div>';
              printthreedata += '</div>';
              printthreedata += '<table class="table">';
              printthreedata += '<tr>';
              printthreedata += '<td>Index Structure</td>';
              printthreedata += '<td>' + parsedObject.index + '</td>';
              printthreedata += '</tr>';

              //  console.log(parsedObject);
              var tradeper = parsedObject.allowperiod;
              var arrayval = tradeper.split(",");
              var cconsum = parsedObject.cons;
              cconsum = cconsum.split(",");

              //edit index undefined solved code start

              // balaji = cconsum;
              var mwflag = 0;
              for (var he = 0; he < cconsum.length; he++) {
                let res = cconsum[he];
                cconsum[he] = res.replace("undefined +", "");
                let position = res.search("undefined +");
                if (position === 0) {
                  mwflag = 1;
                }
              }


              if (parsedObject.index == "Power (MW)" && mwflag == 1) {
                for (l = 0; l < arrayval.length; l++) {
                  printthreedata += '<tr>';
                  printthreedata += '<td>selected trade period + clicks</td>';
                  printthreedata += '<td>' + arrayval[l] + '' + cconsum[l] + '</td>';
                  printthreedata += '</tr>';
                }
              } else {
                for (l = 0; l < arrayval.length; l++) {
                  printthreedata += '<tr>';
                  printthreedata += '<td>selected trade period + type + clicks</td>';
                  printthreedata += '<td>' + arrayval[l] + ' + ' + cconsum[l] + '</td>';
                  printthreedata += '</tr>';
                  // parsedObject.cons = consumption.toString();
                }
              }
              // console.log(arrayval);
              // if(consum.includes(key)){
              //   printthreedata +='<tr>';
              //   printthreedata +='<td>clicks / Tranches Minimum size ('+key+')</td>';
              //   printthreedata +='<td>'+parsedObject[key]+'</td>';
              //   printthreedata +='</tr>';
              // }

              // }
              // printthreedata +='<tr>';
              // printthreedata +='<td>clicks / Tranches Minimum size </td>';
              // printthreedata +='<td>'+parsedObject.cons+'</td>';
              // printthreedata +='</tr>';
              // printthreedata +='<tr>';

              printthreedata += '<td>Open Position Pricing Mechanism</td>';
              printthreedata += '<td>' + parsedObject.pricMech + '</td>';
              printthreedata += '</tr>';

              printthreedata += '</table>';
              $('.preview3').html(printthreedata);


            }



          }


          if (n == 1 && !validateForm()) return false;
          x[currentTab].style.display = "none";
          currentTab = currentTab + n;
          if (currentTab >= x.length) {

            var form = document.getElementById("regForm");
            form.submit();
            return false;

          }
          showTab(currentTab);
        }

        function validateForm() {

          var supplier = document.getElementById('supplyedit').value;
          if (supplier == '') {
            alert("Please enter value for supplier");
            return false;
          }

          if (currentTab == 1) {
            var tewst = $('.monthsallow').val();
            if (tewst != 'yes') {

              return false;

            }
            if (($('.startdate').val() == '') && ($('.endate').val() == '') && ($('.totalanualconsumption').val() == 0)) {
              return false;
            }
          }

          if (currentTab == 2) {

            if($('#contracttype').val() != 'fixed') {

            var rowcount = $('.rowcount').val();
            var emptyarray = [];
            for (var i = 1; i < rowcount; i++) {
              if ($('.tranche' + i).val() == '') {
                emptyarray.push(3);
                // alert('Illi');
              }
              if ($('#indextypes').val() != 'Power(MW)') {
                if ($('.minsize' + i).length > 0) {
                  if (!$('.minsize' + i).is(":checked")) {
                    emptyarray.push(1);
                    // alert('Illa');
                  }
                }
              }
            }
            // alert("Row count = "+rowcount);
            // alert(emptyarray.length);            
            if (emptyarray.length > 0) {
              alert('please select required fields');
              return false;
            }
            if (($('.addTrade div').length == 0) || ($('.pricMech').val() == '')) {
              alert('please select required fields');
              return false;
            }

            if ($('.tranche1').val() != undefined) {
              if (Number($('.tranche1').val()) >= Number($('#first').val())) {

              } else {
                alert('please enter more clicks than previous');
                return false;
              }
            }

            if ($('.tranche2').val() != undefined) {
              if (Number($('.tranche2').val()) >= Number($('#second').val())) {

              } else {
                alert('please enter more clicks than previous');
                return false;
              }
            }

            if ($('.tranche3').val() != undefined) {
              if (Number($('.tranche3').val()) >= Number($('#third').val())) {

              } else {
                alert('please enter more clicks than previous');
                return false;
              }
            }

            if(Number(rowcount) == 3) {
                if($('.tradsel1').val() == $('.tradsel2').val()) {
                  alert("Same calendar type cannot be used together!");
                  return false;
                }
              }

              if(Number(rowcount) == 4) {
                if($('.tradsel1').val() == $('.tradsel2').val() || $('.tradsel1').val() == $('.tradsel3').val() || $('.tradsel2').val() == $('.tradsel3').val()) {
                  alert("Same calendar type cannot be used together!");
                  return false;
                }
              }


          }
        }

          return true;
        }

        $(".commodity").each(function() {

          $(this).on('change', function() {
            if ($(this).prop('checked', true)) {

              if ($(this).val() == 'natural gas') {
                $('.units').css('display', 'block');
              } else {
                $('.units').css('display', 'none');
              }
            }
          })



        });
        $('.contactType').on('change', function() {
          if ($(this).prop('checked', true)) {
            if ($(this).val() == 'indexed') {
              var commdty = $('.commodity:checked').val();
              $.ajax({
                type: 'POST',
                url: 'js/callbacks/indexdropdown.php',
                data: {
                  'commodityVal': commdty

                },
                success: function(data) {

                  $('.indxt').html(data);
                }
              });
              $('.indexcl').css('display', 'block');
            } else {
              $('.indexcl').css('display', 'none');
            }
          }
        });



        const unitCheckbox = document.querySelectorAll('input[type="checkbox"].unit');
        unitCheckbox.forEach((unitBox) => {
          unitBox.addEventListener('click', () => {
            unitCheckbox.forEach((unitBox) => {
              unitBox.checked = false;
            });
            unitBox.checked = true;
          });
        });
        $('input[type="checkbox"].indexstr').on('change', function() {
          $('input[type="checkbox"].indexstr').not(this).prop('checked', false);
        });
        $('input[type="checkbox"].commodity').on('change', function() {
          $('input[type="checkbox"].commodity').not(this).prop('checked', false);
        });
        // $('input[type="checkbox"].unit').on('change', function() {
        //   $('input[type="checkbox"].unit').not(this).prop('checked', false);
        // });
        $('input[type="checkbox"].contactType').on('change', function() {
          $('input[type="checkbox"].contactType').not(this).prop('checked', false);
        });


        // Getting values for calendar clicks 20 July 2023

        // function resultOne() {
        $(document).ready(function() {
          var supplierId = $('#yoyo').val();
          console.log("Suppliereeer => " + supplierId);
          $.ajax({
            type: 'POST',
            url: 'js/callbacks/getClicksDetails.php',
            data: {
              'supplierId': supplierId
            },
            success: function(data) {
              var obj = JSON.parse(data);
              // console.log(obj);
              // console.log(obj.periodType.length);
              // alert(obj.periodType[0]);
              $('#calTotal').val(obj.periodType.length);

              $('#first').val(obj.numberOfClicks[0]);
              $('#second').val(obj.numberOfClicks[1]);
              $('#third').val(obj.numberOfClicks[2]);

            }
          });
        });


        // var selections = document.querySelectorAll('.alltracheValues');

        // for (var ti = 0; ti < selections.length; ti++) {
        //   selections[ti].addEventListener("click", function(event) {
        //     // console.log(event);
        //     // console.log(event.target.classList[1]);

        //     var checkRes = event.target.classList[1];

        //     if (checkRes == 'tranche1') {
        //       var tradeSelvalue = document.getElementsByClassName('tradsel1');
        //       console.log(document.querySelector('.tradsel1').value);
        //     } else if (checkRes == 'tranche2') {
        //       var tradeSelvalue = document.getElementsByClassName('tradsel2');
        //       console.log(document.querySelector('.tradsel2').value);
        //     } else if (checkRes == 'tranche3') {
        //       var tradeSelvalue = document.getElementsByClassName('tradsel2');
        //       console.log(document.querySelector('.tradsel3').value);
        //     }

        //   });
        // }


        // 

        // }


        function getclientdetails(clientId) {
          $.ajax({
            type: 'POST',
            url: 'js/callbacks/getclientdeails.php',
            data: {
              'clientId': clientId

            },
            success: function(data) {
              var obj = JSON.parse(data);
              $('.country').val(obj.clientcountry);
              $('.clientname').val(obj.clientname);
              // console.log(data);
            }
          });
        }

        function getparentdetails(parentId) {
          // console.log("Parent Id = ".parentId);
          $.ajax({
            type: 'POST',
            url: 'js/callbacks/getparentdetails.php',
            data: {
              'parentId': parentId

            },
            success: function(data) {
              $('.clint').html(data);
            }
          });
        }

        function calcualteMonthYr(startdate, enddate) {
          var todate = new Date();
          if (enddate) {
            todate = new Date(enddate);
          }
          var fromdate = new Date();
          if (startdate) {
            fromdate = new Date(startdate);
          }

          var getstartmonth = fromdate.getMonth();
          var getendmonth = todate.getMonth();
          var months = 0;
          months = (todate.getFullYear() - fromdate.getFullYear()) * 12;
          months -= fromdate.getMonth();
          months += todate.getMonth();
          // if (todate.getDate() < fromdate.getDate()){
          //     months--;
          // }

          var dates = [];
          var startYear = Math.abs(fromdate.getFullYear());
          var endYear = Math.abs(todate.getFullYear());
          for (var i = startYear; i <= endYear; i++) {
            var endMonth = i != endYear ? 11 : parseInt(getendmonth);

            var startMon = i === startYear ? parseInt(getstartmonth) : 0;
            console.log('>>startmnt' + startMon + '>>endMonth' + endMonth);
            for (var j = startMon; j <= endMonth; j = j > 12 ? j % 12 || 11 : j + 1) {
              var month = j + 1;
              var displayMonth = month < 10 ? month : month;
              var datenumber = dates.push([i, displayMonth, '01'].join('-'));
            }
          }

          console.log(dates);
          $('.allmonths').val(dates);
          $('.countmonths').val(months + 1);
          // Calculation for hedge 
          let array1 = $('.hedge').val();
          let effect1 = $('.effectivec').val();
          let baseconsumption = $('.baseconsumption').val();

          //code for edit started on 12 Apr 2023
          var hiddenCom = $('.hiddenCommodity').val();
          console.log("Commodity Name = " + hiddenCom);

          var hiddenPower = $('.hiddenPower').val();
          console.log("Power type = " + hiddenPower);



          if (hiddenCom == "natural gas" || hiddenCom == "natural") {
            console.log('Hi');
            document.getElementById('naturalgas').classList.add('naturalGass');
          } else {
            document.getElementById('naturalgas').classList.remove('naturalGass');

          }

          if (hiddenPower == 'Power(MW)') {
            document.getElementById('powerr').setAttribute('checked', true);
            document.getElementById('powerLabel').style.pointerEvents = 'none';
            // document.getElementById('displayCon').style.display = 'none';
            // console.log(document.querySelectorAll('#displayCon'));
            let displayConn = document.querySelectorAll('#displayCon');
            for (let i = 0; i < displayConn.length; i++) {
              displayConn[i].style.display = 'none';
            }
          } else {
            document.getElementById('consumptionn').setAttribute('checked', true);
            document.getElementById('consumptionLabel').style.pointerEvents = 'none';
          }


          //ended edit code

          console.log(array1);
          let monthArr = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
          let array2 = dates;

          console.log("Hey Boy == " + array2);
          let newMonthArray = array2.slice(",");
          let newYearArray = array1.split("|");
          let neweffective = effect1.split("|");
          let newbase = baseconsumption.split("|");
          // let neweffective = effect1.split("|");


          // console.log("Yo>>>"+neweffective);

          let count1 = newMonthArray.length;
          let count2 = newYearArray.length;


          let newV1 = effectnew = basenew = '';

          console.log("Count1 = " + count1);

          for (let i = 0; i < count1; i++) {
            let value1 = newMonthArray[i];
            let value2 = newYearArray[i];
            let value3 = neweffective[i];

            // console.log(neweffective[i]);
            let value4 = newbase[i];

            // console.log("Value3 >>>" + value3);

            if (value2 == undefined) {
              let v1 = value1.split("-");
              newV1 += "|" + (monthArr[v1[1] - 1]) + "-" + v1[0] + "-0";
            }
            if (value3 == undefined) {
              let v1 = value1.split("-");
              effectnew += "|" + (monthArr[v1[1] - 1]) + "-" + v1[0] + "-0";
              console.log("Why?");
            }
            if (value4 == undefined) {
              let v1 = value1.split("-");
              basenew += "|" + (monthArr[v1[1] - 1]) + "-" + v1[0] + "-0";
            }
            // else {

            // }

          }
          console.log("Effective >>>>" + effectnew);
          finalHedge = array1 + newV1;

          finaleffective = effect1 + effectnew;

          finalbase = baseconsumption + basenew;

          console.log("Hedged Final ==>" + finalHedge);
          $('.hedge').val(finalHedge);

          hedgedCount = finalHedge.split("|");
          countHedge = hedgedCount.length;

          console.log("Hey Boy2 = " + countHedge);

          console.log(finaleffective);
          $('.effectivec').val(finaleffective);

          console.log(finalbase);
          $('.baseconsumption').val(finalbase);

          var hedgeFromDb = $('.hedgeConsumption').val();
          console.log("Hedge ==> " + hedgeFromDb);

          localStorage.removeItem("hedgedConsumption");
          localStorage.setItem('hedgedConsumption', finalHedge);

          if (count1 != countHedge) {
            alert('Cannot choose lesser months after allocation has been made !'); //Vinay
            location.href = 'supplycontractpreview.php?info=<?= $_GET['info']; ?>&id=<?= $_GET['id']; ?>&type=edit';
          }

        }



        // console.log($('.hedge').val());

        // var rocount =['Calendar Yearly', 'Calendar Quarterly', 'Calendar Monthly', 'Season']; //edited season
        var rocount = ['Calendar Yearly', 'Calendar Quarterly', 'Calendar Monthly'];
        var selectedarray = [<?php echo '"' . implode('","', $tradevol) . '"' ?>];

        function addTradeperiods() {
          var rowcount = parseInt($('.rowcount').val());

          var selectedval = $("select.tradep > option:selected").map(function() {
            selectedarray.push(this.value);
          })
          var list = selectedarray.filter(function(x, i, a) {
            return a.indexOf(x) == i;
          });
          console.log(list);
          if (rocount.length == list.length) {
            alert('you can add more allowable trade');
            return;
          }

          // var selectedval = $('.tradep :selected').val();
          // selectedarray.push(selectedval);
          console.log(selectedarray);
          var printData = '';
          printData += '<div class="trade' + rowcount + '">';
          printData += '<div class="row">';
          printData += '<div class="col-md-7">';
          printData += '</div>';
          printData += '<div class="col-md-5">';
          printData += '<label style="margin: 0 0 0 -27%;">Clicks / tranches</label><br>';
          printData += '</div>';
          printData += '</div>';
          printData += '<div class="row">';
          printData += '<div class="col-md-6">';
          // printData +='<label>Choose Calendar</label>';
          printData += '<select class="chosen-select tradep tradsel' + rowcount + '" name="tradsel' + rowcount + '">';

          printData += '<option value="Calendar Yearly" ' + ((selectedarray.includes('Calendar Yearly')) ?
            'disabled' : '') + '>Calendar Yearly</option>';
          printData += '<option value="Calendar Quarterly" ' + ((selectedarray.includes('Calendar Quarterly')) ?
            'disabled' : '') + '>Calendar Quarterly</option>';
          printData += '<option value="Calendar Monthly" ' + ((selectedarray.includes('Calendar Monthly')) ?
            'disabled' : '') + '>Calendar Monthly</option>';
          // printData +='<option value="Season" '+((selectedarray.includes('Season'))?
          //     'disabled':'')+'>Season</option>';
          printData += '</select>';
          printData += '</div>';
          printData += '<div class="col-md-4">';
          printData += '<input type="number" style="margin: 0 0 0 -44%;" pattern=" 0+\.[0-9]*[1-9][0-9]*$" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control tranche' + rowcount + '" name="tranche' + rowcount + '">';
          printData += '</div>';
          printData += '<div class="col-md-2"><i class="fa fa-trash-o deleteIcon" onclick="removerow(' + rowcount + ')" aria-hidden="true"></i>';
          printData += '</div>';
          printData += '</div><br>';
          // printData +='<div class="row" style="margin: 3px 0 0 -1px;">';

          // printData +='<div class="input-group">';
          // printData +='<span class="input-group-addon input-group-addon2 transparent" style="width: 30%;">';
          printData += '<input type="radio" style="width:3%;" id="consumption' + rowcount + '" class="clnmin minsize' + rowcount + '" name="minsize' + rowcount + '" value="% consumption"><label for="consumption' + rowcount + '">% consumption</label>';
          printData += '<input type="radio" id="mwh' + rowcount + '" style="width:3%;" class="clnmin minsize' + rowcount + '" name="minsize' + rowcount + '" value="#MWhs"><label for="mwh' + rowcount + '">#MWhs</label><br>';

          // printData +='</span>';

          // printData +='<span class="input-group-addon transparent"> %</span>';
          // printData +='</div>';
          // printData +='</div>';
          printData += '</div>';
          // printData +='<br/>';
          // printData +='<hr>';







          $('.addTrade').append(printData);
          $('.rowcount').val(rowcount + 1);


        }

        function removerow(row) {
          $('.trade' + row).remove();
        }

        function checkcurrency(vals) {
          var val = vals;



          val += '';
          x = val.split('.');
          x1 = x[0];
          x2 = x.length > 1 ? '.' + x[1] : '';

          var rgx = /(\d+)(\d{3})/;

          while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
          }
          return x1 + x2 + '';
        }

        function formated(val) {
          var num = val;
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
          var number = formatted + ((parts) ? "." + parts[1].substr(0, 2) : ".00");
          return number;
        }
      </script>
      <?php
      include('hoverinclude/hoversupply.php');
      ?>
      <?php
      function currencyformat($val)
      {
        $regex = "/\B(?=(\d{3})+(?!\d))/i";
        return $usd = preg_replace($regex, ",", $val);
      }
      ?>

      <script>
        //   document.getElementById('parentNameSuppre').setAttribute('readonly',true);
        document.getElementById('cliensuppedit').removeAttribute('readonly');
        document.getElementById('supplyedit').removeAttribute('readonly');
        const com = document.getElementById('commodityname').value;
        console.log("com=" + com);
        if (com == "electricity") {
          document.getElementById('naturalgasedit').setAttribute('disabled', true);
        } else {
          document.getElementById('electricedit').setAttribute('disabled', true);

        }
        document.getElementById('commodityprice').removeAttribute('readonly'); //removes the readonly attribute for the currency

        const contracttypes = document.getElementById('contracttype').value;
        console.log("contracttypes=" + contracttypes);
        if (contracttypes == "fixed") {
          document.getElementById('indexed').setAttribute('disabled', true);
        } else {
          document.getElementById('fixed').setAttribute('disabled', true);
        }

        // document.getElementById('selectindex').setAttribute('readonly', true);
        document.getElementById('selectindex').removeAttribute('readonly'); //removes the readonly attribute for the selected index types
        document.getElementById('startDate1').setAttribute('readonly', true);

        const indexstructure = document.getElementById('indextypes').value;
        console.log("indexstructure=" + indexstructure);
        if (indexstructure == "Consumption(MWh)") {
          document.getElementById('powerr').setAttribute('disabled', true);
        } else {
          document.getElementById('consumptionn').setAttribute('disabled', true);
        }

        // document.getElementById('addperiods').setAttribute('disabled', true);
        // document.getElementById('addperiods').removeAttribute('onclick');
        // document.getElementById('addperiods').setAttribute('disabled', false);
        // document.getElementById('addperiods').removeAttribute('onclick');
        // document.getElementById('calendarselection').setAttribute('readonly',true);
        const calendarselections = document.querySelectorAll('.calendarselection');
        for (i = 0; i < calendarselections.length; i++) {
          console.log("calendarselections = " + calendarselections[i]);
          calendarselections[i].setAttribute('readonly', true);
        }

        // console.log(document.querySelectorAll('.alltracheValues'));
        // const clickTranches = document.querySelectorAll('.alltracheValues');
        // for (i = 0; i < clickTranches.length; i++) {
        //   console.log("CLicks = " + clickTranches[i]);
        //   clickTranches[i].setAttribute('readonly', true);
        // }

        const consumptmwh = document.querySelectorAll('.consumptionpercent');
        for (i = 0; i < consumptmwh.length; i++) {
          console.log("consumptmwh = " + consumptmwh[i]);
          consumptmwh[i].setAttribute('disabled', true);
        }

        const mwhconsumpt = document.querySelectorAll('.mwhpercent');
        for (i = 0; i < mwhconsumpt.length; i++) {
          console.log("mwhconsumpt = " + mwhconsumpt[i]);
          mwhconsumpt[i].setAttribute('disabled', true);
        }

        const deleteIcons = document.querySelectorAll('.deleteIcon');
        for (i = 0; i < deleteIcons.length; i++) {
          console.log("deleteIcons = " + deleteIcons[i]);
          deleteIcons[i].removeAttribute('onclick');
        }

        // document.getElementById('openposition').setAttribute('readonly', true);
        document.getElementById('openposition').removeAttribute('readonly'); // remove attribute readonly attribute for changing position

        const yearconsupedits = document.querySelectorAll('.yearconsupedit');
        for (i = 0; i < yearconsupedits.length; i++) {
          console.log("yearconsupedits = " + yearconsupedits[i]);
          yearconsupedits[i].setAttribute('readonly', true);
        }
        const rangsliders = document.querySelectorAll('.rangslider');
        for (i = 0; i < rangsliders.length; i++) {
          console.log("rangsliders = " + rangsliders[i]);
          rangsliders[i].removeAttribute('onchange');
          rangsliders[i].setAttribute('readonly', true);
        }

        document.querySelector('.totalanualconsumption').setAttribute('readonly', true);

        const onoffs = document.querySelectorAll('.onoff');
        for (i = 0; i < onoffs.length; i++) {
          console.log("onoffs = " + onoffs[i]);
          //onoffs[i].removeAttribute('checked');
          onoffs[i].setAttribute('readonly', true);
        }

        document.querySelectorAll('.onoff').setAttribute('readonly', true);

        //Divide equally between months disable
        const disableDivide = document.getElementById('checkboxs');
        disableDivide.removeAttribute('onclick');
        disableDivide.setAttribute("disabled", "true");
      </script>

</body>

</html>