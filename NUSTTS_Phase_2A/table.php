<?php
    include('security.php');
    if($_SESSION['role'] != 'Admin'){
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
    <title>NUS TTS System | User Management</title>
    <link rel="icon" href="img/social-square-n-blue.png">
    <link rel="stylesheet" type="text/css" href="css/style.css">
<style>
    body {
        background-color: #F9FBFD !important;
        line-height: normal !important;
    }
  a {
    text-decoration:none;
  }
  a:hover {
    text-decoration:none;
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
  left: 0px;
  right: 0;
  padding: 0 0;
  top:10%;

}

.usermanagement {
  position: absolute;
  bottom: 100%;
  left: 22%;
}

table tbody td {
  background: white;
}

.tab-btn {
  background-color: rgba(0,0,0,0);
  border: none;
  border-bottom: 1px solid #6e84a3;
  color: #6e84a3;
  cursor: pointer;
  padding: 10px 0;
  margin: 10px 0;
  outline: none;
  width: 10%;
}
.tab-btn-active {
  border-bottom: 2px solid #12263f;
  color: #12263f;
  font-weight: bold;
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
  width: 100%;
  /* height: 100vh; */
  position: absolute;
  top:25%;
  left: 0px;
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
  background: #345DA6;
  padding: 10px 20px;
  position: absolute;
  right: 3%;
  top: -35%;
  color:white;
  border-radius: 8px;
  font-weight: 500;
}

.adduserbutton:hover {
  text-decoration: none;
  color: white;
  font-weight: 500;
}

 .padmd0{
  position: absolute;
  width:72%;
  left: 20%;
  /* margin: 10px 300px; */
}

</style>
<script>
function showDropdown() {
                    document.getElementById("myDropdown").classList.toggle("show");
                }

                // Close the dropdown if the user clicks outside of it
                window.onclick = function(event) {
                    if (!event.target.matches('.dropbtn')) {
                        var dropdowns = document.getElementsByClassName("dropdown-content");
                        var i;
                        for (i = 0; i < dropdowns.length; i++) {
                            var openDropdown = dropdowns[i];
                            if (openDropdown.classList.contains('show')) {
                                openDropdown.classList.remove('show');
                            }
                        }
                    }
                }
            </script>

  </head>
<body style="background: #F9FBFD;">
<div class="main">
        <div class="menu">

            <?php
                include('sidebar.php');
            ?>
        </div>
    <div>
     <div class="padmd0">
<div class="tabs">
   <div class="sidebar">
   <a class="adduserbutton" href="inviteuser.php"><img src="img/user-plus.svg" alt="Add User Icon" width=18px height=18px> Invite new user</a>
      <!-- tabs buttons  -->
      <button class="tab-btn tab-btn-active" data-for-tab="1">Admin</button>
      <button class="tab-btn" data-for-tab="2">NUS Manager</button>
      <button class="tab-btn" data-for-tab="3">NUS User</button>
      <button class="tab-btn" data-for-tab="4">Parent User</button>
      <button class="tab-btn" data-for-tab="5">Client User</button>
      <button class="tab-btn" data-for-tab="6">Inactive User</button>
    </div>
    
      <!-- <div class="content"> -->
           <div class="tab-content tab-content-active" data-tab="1">
              <?php
                  include_once('listadmin.php');
              ?>
           </div>
           <div class="tab-content" data-tab="2">
              <?php
                  include_once('listmanager.php');
              ?>
            </div>
            <div class="tab-content" data-tab="3">
              <?php
                  include_once('listnususer.php');
              ?>
            </div>
            <div class="tab-content" data-tab="4">
              <?php
                  include_once('listparentuser.php');
              ?>
            </div>
            <div class="tab-content" data-tab="5">
              <?php
                  include_once('listclientuser.php');
              ?>
            </div>
            <div class="tab-content" data-tab="6">
              <?php
                  include_once('listinactiveuser.php');
              ?>
            </div>
            

            
 </div>
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
        include('hoverinclude/hoveruser.php');
    ?>
</body>
</html>