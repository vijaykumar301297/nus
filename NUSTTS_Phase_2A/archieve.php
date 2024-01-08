<?php
    include('security.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUS TTS System | Archieve Parent Company</title>
    <link rel="icon" href="img/social-square-n-blue.png" />
    <link rel="stylesheet" type="text/css" href="css/archieve.css" />

    
</head>
<body onload = "stopBack();">


    <section class="sec1Container">
        <div class="sec1Wrapper">
            <div class="archievecontainer">
                <h2>Archiving <?php echo base64_decode($_GET['id'])?></h2>
                <div class="close-btn" onclick='location.href="addhome.php";';>&times;</div>
                <hr color="#d2ddec">
                <form action="postarchieve.php" method="POST" class="archieveform">
                    <!-- <label for="" hidden>Parent Company</label> -->
                    <input autocomplete="off" type="text" name="parentcompany"  value="<?php echo base64_decode($_GET['id'])?>" hidden  >
                    <input autocomplete="off" type="text" name="id"  value="<?php echo $_GET['ids']?>" hidden  >

                    <label for="">Date</label>
                    <input type="date" id="date" name="datevalue" readonly>
                    <label for="">Type</label>
                    <input type="text" name="state" id="" value="Archived" readonly>
                    <label for="">Username</label>
                    <input type="text" name="user" id="" value="<?php echo $_SESSION['user']; ?>"readonly >
                    <label for="">Description</label>
                    <textarea name="description" id="" cols="20" rows="2" required></textarea>
                    <hr color="#d2ddec" class="line">
                    <div class="one">
                        <button type="reset" class="cancelClass" onclick='location.href="addhome.php";';>Cancel <img src="img/cancel-svgrepo-com.svg" alt="cancel icon" width="14px"></button>
                        <button type="submit" class="createClass">Confirm <img src="img/confirm.svg" alt="plus icon" width="14px"></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<script>
    const dateInput = document.getElementById('date');

    dateInput.value = formatDate();

    // console.log(formatDate());

    function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
    }

    function formatDate(date = new Date()) {
    return [
        date.getFullYear(),
        padTo2Digits(date.getMonth() + 1),
        padTo2Digits(date.getDate()),
    ].join('-');
    }


</script>
</body>
</html>