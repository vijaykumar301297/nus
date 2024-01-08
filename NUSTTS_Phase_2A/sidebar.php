<style type="text/css">
[aria-current="page"] {
  pointer-events: none;
  cursor: default;
  text-decoration: none;
  color: grey!important;
}
</style>
<?php include('dbconn.php')?>

<ul>
        <li><a id="logo" href="index.php"><img src="img/nus-logo-2020.svg" alt="NUS Consulting Group Logo"></a>
        
        <?php
        if($_SESSION['role'] == 'Client Company'){
           ?>
            <li><a class="hoverHome" href="clientcompany.php">Home</a></li>
        <?php
        }

        else{
        ?>
        
        <li><a class="hoverHome" href="addhome.php">Home</a></li>
        <?php
        }
        ?>
            <?php
                if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager' || $_SESSION['role'] == 'NUS User') {
                    $grycl ='';
                    if($_SESSION['role'] == 'NUS User' || $_SESSION['role'] == 'NUS Manager') {
                        $grycl ='aria-current="page"';
                    }    
            ?>
                <li><a class="hoveraddCompany" href="addcompany.php" <?=$grycl?>>Company</a></li>
            <?php
            }
            ?>
            <?php
                if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager' || $_SESSION['role'] == 'NUS User') {
                    $grycl ='';
                    if($_SESSION['role'] == 'NUS User'){
                        $grycl ='aria-current="page"';
                    }
            ?>
            <li><a class="hoversupplyContract" href="addsupplycontract.php" <?=$grycl?>>Supply Contract</a></li>
           
            <li><a class="hoverenterTrade" href="entertrade.php" <?=$grycl?>>Enter Trade</a></li>
            <?php
            }
            ?>
        <li><a class="hovergenerateReport" href="generatereport.php">Generate Report</a></li>
        <?php
            if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager' || $_SESSION['role'] == 'NUS User') {
                $grycl ='';
                if($_SESSION['role'] == 'NUS Manager' || $_SESSION['role'] == 'NUS User'){
                    $grycl ='aria-current="page"';
                }

        ?>
            <li><a class="hoveruserManagement" href="table.php" <?=$grycl?>>User Management</a></li>
        <?php
        }
        ?>
        <li><a class="hoverlogOut" href="logout.php">Logout</a></li>
</ul>