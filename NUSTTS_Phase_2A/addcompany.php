<?php
include('security.php');

if ($_SESSION['role'] != 'Admin') {
  //echo 'You have no acesss to view the page';
  echo "<script>alert('You have no access to view this page!');window.location.href='index.php';</script>";
  die();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NUS TTS System | Add company </title>
  <link rel="icon" href="img/social-square-n-blue.png" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <style>
    .boxContainer {
      margin: 5px 0 0 0;
      position: absolute;
      right: 3%;
      top: 5%;
    }

    .boxWrapper {
      max-width: 1200px;
      /* text-align: right; */
    }

    .aClass a {
      background-color: #345da6;
      padding: 8px 25px;
      text-decoration: none;
      color: white;
      margin: 0 10px;
      border-radius: 5px;
    }

    .aClass a:hover {
      color: white;
      text-decoration: none;
    }

    .tabs {
      font-family: "Poppins", sans-serif;
      display: flex;
      align-items: center;
      flex-direction: column;
      width: 100%;
      min-height: 100vh;
    }

    .sidebar {
      display: flex;
      position: absolute;
      left: 23%;
      right: 0;
      padding: 0 0;
      top: 10%
    }

    .usermanagement {
      position: absolute;
      bottom: 100%;
      left: 22%;
    }

    .tab-btn {
      background: none;
      border: none;
      border-bottom: 1px solid #6e84a3;
      color: #6e84a3;
      cursor: pointer;
      padding: 10px 0;
      margin: 10px 0;
      outline: none;
      width: 13%;
      font-size: 16px;
    }

    .tab-btn-active {
      border-bottom: 2px solid #12263f;
      color: #12263f;
      font-size: 16px;
      font-weight: bold;
      background: none;
    }

    /* tabs content */
    /* .content {
  width: 100%;
} */
    .tab-content {
      display: flex;
      flex-direction: column;
      /* align-items: center; */
      /* justify-content: center; */
      /* text-align: center; */
      width: 80%;
      /* height: 100vh; */
      position: absolute;
      top: 10%;
      left: 40px;
      display: none;
    }

    .tab-content-active {
      display: block;
    }

    /* .tab-content img {
  width: 350px;
} */

    .adduserbutton {
      text-decoration: none;
      background: blue;
      padding: 10px 10px;
      position: absolute;
      right: 3%;
      top: 5%;
      color: white;
    }

    table.dataTable thead>tr>th.sorting_asc::before,
    table.dataTable thead>tr>th.sorting_desc::after {
      opacity: 1;
    }

    td {
      background: white;
    }
  </style>

</head>

<body>
  <div class="main">
    <div class="menu">

      <?php
      include('sidebar.php');
      ?>
    </div>
    <div>
      <?php
      if (isset($_SESSION['createdclient']) && ((time() - $_SESSION['createdclient']) < 2)) {

        echo '<script> toastr.success("successfully Added", "New client");</script>';
        if ((time() - $_SESSION['createdclient']) > 2) {
          unset($_SESSION['createdclient']);
        }
      }
      if (isset($_SESSION['createdparent']) && ((time() - $_SESSION['createdparent']) < 2)) {

        echo '<script> toastr.success("successfully Added", "New Parent");</script>';
        if ((time() - $_SESSION['createdparent']) > 2) {
          unset($_SESSION['createdparent']);
        }
      }

      ?>
      <div class="boxContainer">
        <div class="boxWrapper aClass">
          <a href="addparent.php"><img src="img/plus-white.svg" alt="plus icon" width="14px"> Create Parent</a>
          <a href="addclient.php"><img src="img/plus-white.svg" alt="plus icon" width="14px"> Create Client</a>
        </div>
      </div>
      <div class="tabs">
        <div class="sidebar">
          <button class="tab-btn tab-btn-active" data-for-tab="1">Parent Company</button>
          <button class="tab-btn" data-for-tab="2">Client Company</button>
        </div>
        <div class="tab-content tab-content-active" data-tab="1">

          <?php
          include_once('listaddparentcompany.php');
          ?>


        </div>
        <div class="tab-content" data-tab="2">

          <?php
          include_once('listclientcompany.php');
          ?>
        </div>
      </div>
      <!-- </div> -->
    </div>

    <script>
      function setupTabs() {
        document.querySelectorAll(".tab-btn").forEach((button) => {
          button.addEventListener("click", () => {
            const sidebar = button.parentElement;
            const tabs = sidebar.parentElement;
            const tabNumber = button.dataset.forTab;
            const tabActivate = tabs.querySelector(
              `.tab-content[data-tab="${tabNumber}"]`
            );

            sidebar.querySelectorAll(".tab-btn").forEach((button) => {
              button.classList.remove("tab-btn-active");
            });
            tabs.querySelectorAll(".tab-content").forEach((tab) => {
              tab.classList.remove("tab-content-active");
            });
            button.classList.add("tab-btn-active");
            tabActivate.classList.add("tab-content-active");
          });
        });
      }

      document.addEventListener("DOMContentLoaded", () => {
        setupTabs();
      });
    </script>

    <?php
    include('hoverinclude/hovercompany.php');
    ?>
</body>

</html>