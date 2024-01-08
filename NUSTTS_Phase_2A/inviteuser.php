<!-- jQuery library -->
<?php
include_once 'security.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Edit user Details</title> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://phpcoder.tech/multiselect/js/jquery.multiselect.js"></script>
    <link rel="stylesheet" href="https://phpcoder.tech/multiselect/css/jquery.multiselect.css">


    <title>NUS TTS System | Create user</title>
    <link rel="icon" href="img/social-square-n-blue.png">
    <link rel="stylesheet" href="css/inviteusers.css">

</head>
<style type="text/css">
    hr {
        margin-top: 0px;
        margin-bottom: 0px;
        border: 0;
        border-top: 1px solid #eee;
    }

    #role,
    #roleparentdata,
    .roleparent,
    .passwordvalue {
        width: 90%;
        margin: 10px 0 20px 20px;
        padding: 10px;
        border: 1.5px solid blue;
        background: white;
        border-radius: 5px;
    }

    .ms-options-wrap {
        width: 90%;
        margin: 10px 0 0px 20px;
        padding: 5px;
        border: 1.5px solid blue;
        background: white;
        border-radius: 5px;
    }

    .ms-options-wrap>button:focus,
    .ms-options-wrap>button {
        border: none;
    }

    .errlog {
        color: red;
        padding: 0px 0px 0px 19px;
    }

    .parentContainer {
        background: #fff;
        width: 400px;
        position: absolute;
        border: 2px solid #d2ddec;
        border-radius: 8px;
        top: auto;
        left: 50%;
        transform: translate(-50%);
        box-shadow: 0px 5px 12px 2px lightgrey;
    }

    input[placeholder='Search'] {
        margin: 0 auto !important;
    }
</style>

<body>

    <section class="sec1Container">
        <div class="sec1Wrapper">
            <div class="parentContainer">
                <br>
                <h2>Add user</h2>
                <div class="close-btn" onclick='window.history.go(-1);'>&times;</div>
                <br>
                <hr color="#d2ddec">
                <form action="postinviteuser.php" method="POST" class="parentAddForm">

                    <label class="userdata">User name</label>
                    <input autocomplete="off" type="text" name="username" class="userNames" placeholder="Enter username" required>

                    <label class="emaildata">Enter Email</label>
                    <input autocomplete="off" type="text" name="emailId" class="emailiddata" placeholder="Enter email" required>

                    <label class="role">Role</label>

                    <select onchange="ChangeDropdowns(this.value)" id="role" class="selecting" name="role" required>
                        <option value="" selected disabled>Select an option</option>
                        <option value="Admin">Admin</option>
                        <option value="NUS Manager">NUS Manager</option>
                        <option value="NUS User">NUS User</option>
                        <option value="Parent company">Parent User</option>
                        <option value="Client company">Client User</option>
                    </select>
                    <div class="userform" id='showunit' style="display:none">
                        <label class="roleid">Parent company</label>

                        <select id="showunit" name="parentcompany" id="showunit" class="roleparent" onchange="callMe();">
                            <option value="" disabled selected>Select a parent company</option>


                            <?php
                            include "dbconn.php";
                            $getparent = array();
                            $getparentdetails = "SELECT * FROM parentcompanydata";
                            $results = $conn->query($getparentdetails);
                            if ($results->num_rows > 0) {
                                while ($row = $results->fetch_assoc()) {
                                    $getparent[] = $row;
                                }
                            }

                            foreach ($getparent as $key => $valueparent) {

                            ?>
                                <option value="<?= $valueparent['id'] ?>"><?= $valueparent['parentcompany'] ?></option>

                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="nususerform" id='nusUsershowunit' style="display:none">
                        <label class="roleid">Parent company</label>

                        <select id="nusUsershowunits" name="parentcompany[]" class="roleparent" multiple>
                            <!-- <option value="" disabled>Select a parent company</option> -->


                            <?php
                            include "dbconn.php";
                            $getparent = array();
                            $getparentdetails = "SELECT * FROM parentcompanydata";
                            $results = $conn->query($getparentdetails);
                            if ($results->num_rows > 0) {
                                while ($row = $results->fetch_assoc()) {
                                    $getparent[] = $row;
                                }
                            }

                            foreach ($getparent as $key => $valueparent) {

                            ?>
                                <option value="<?= $valueparent['id'] ?>"><?= $valueparent['parentcompany'] ?></option>

                            <?php
                            }
                            ?>
                        </select>
                    </div>



                    <div class="userform" id='show' style="display:none">

                        <label class="roleid">Client company</label>
                        <br>
                        <select id="roleparentdata" name="bussinessunit[]" class="roleparent">
                            <option value="" selected disabled>Select a client company</option>
                            <?php
                            // include "dbconn.php";  // Using database connection file here

                            // $parentcompany = mysqli_query($conn, "SELECT * From clientcompanydata;");  // Use select query here 

                            // while ($parentcompanydata = mysqli_fetch_array($parentcompany)) {
                            // echo "<option value='" . $parentcompanydata['id'] . "'>" . $parentcompanydata['clientcompany'] . ' - ' . $parentcompanydata['country'] . "</option>";  // displaying data in option menu
                            // }
                            ?>
                        </select>



                    </div>

                    <!-- <label for="" class="password">Password</label>


                    <input type="password" class="passwordvalue" onkeyup="passwordlengthcheck(this.value)" name="password" placeholder="Enter your password" required><br>
                    <span class="errlog passwordval"></span> -->

                    <hr color="#d2ddec">

                    <div class="one" style="margin: 15px 0px 5px 22px;">
                        <button name="cancel" value="Cancel" type="reset" class="cancelClass cancelUser" onclick='window.history.go(-1);'>Cancel <img src="img/cancel-svgrepo-com.svg" alt="cancel icon" width="14px"></button>
                        <!-- <button type="submit" class="createClass" style="margin: 0px 0px 0px 83px;">Create Parent <img src="img/plus-white.svg" alt="plus icon" width="14px"></button> -->
                        <input value="Invite User" class="createClass inviteUser" id="enable_button" type="submit" name="submit" onclick="validate();" style="margin: 0px 0px 0px 121px;">
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </section>



    <script>
        function passwordlengthcheck(val) {
            var length = val.length;
            console.log(length);
            if (length < 8) {
                $('.errlog').html('Password should be above 8 charactors');
            } else {
                $('.errlog').html('');
            }
        }

        function checkpasswordlength() {
            var charlength = $('.passwordvalue').val();
            var getlength = charlength.length;
            if (getlength < 8) {
                return false;
            }
            return true;
        }

        function ChangeDropdowns() {
            const dropDown = document.getElementById('role').value;
            const div = document.getElementById('show');
            const div1 = document.getElementById('showunit');
            const div2 = document.getElementById('nusUsershowunit');

            console.log('Inside Changedropdown client');

            console.log(dropDown)

            if (dropDown == "NUS User") {
                // alert('Hi');
                div2.style.display = "block";
                div.style.display = 'none';
                div1.style.display = 'none';
                
                $('.roleparent').attr('required', false);
                $('#roleparentdata').attr('required', false);
                $('#nusUsershowunits').attr('required', true);
                jQuery('#nusUsershowunits').multiselect({
                    columns: 1,
                    placeholder: 'Select one or more parent company',
                    search: true
                });
            } else if (dropDown == "Client company") {
                div.style.display = 'block';
                div1.style.display = 'block';
                div2.style.display = 'none';
                $('.roleparent').attr('required', true);
                $('#nusUsershowunits').attr('required', false);
                $('#roleparentdata').attr('required', true);
            } else if (dropDown == "Parent company") {
                div.style.display = 'none';
                div1.style.display = 'block';
                div2.style.display = 'none';
                $('.roleparent').attr('required', true);
                $('#nusUsershowunits').attr('required', false);
                $('#roleparentdata').attr('required', false);
            } else {
                div.style.display = 'none';
                div1.style.display = 'none';
                div2.style.display = 'none';
                $('.roleparent').attr('required', false);
                $('#nusUsershowunits').attr('required', false);
                $('#roleparentdata').attr('required', false);
            }
        }
    </script>

    <script>
        function togglepopUp() {
            document.getElementById("popup-1").classList.toggle("active");
        }
    </script>

    <script>
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
                    console.log(data);
                }
            });
        }

        function getparentdetails(parentId) {
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
    </script>
    <!-- Multiple Dropdown Selection -->
    <script>
        function callMe() {
            let role_Value = document.getElementById('role').value;
            console.log(role_Value);
            if (role_Value === 'Client company') {
                $(document).ready(function() {
                    let parent = $('.roleparent').val();
                    console.log(parent);
                    $.ajax({
                        type: 'POST',
                        url: 'ajax/getclientInvite.php',
                        data: {
                            'parentId': parent
                        },
                        success: function(data) {
                            $('#show').html(data),
                                $('#roleparentdata').multiselect({
                                    columns: 1,
                                    placeholder: 'Select one or more Bussiness unit',
                                    search: true
                                });
                        }
                    });
                });
            } else {
                console.log('Bye');
            }
        }

        function validate() {
            res = $('#role').val();

            if (res == 'NUS User') {
                document.getElementById('nusUsershowunits').value == '' ? alert('Please select parent company!') : console.log('ok');
            } else if (res == 'Client company') {
                document.getElementById('roleparentdata').value == '' ? alert('Please select client company!') : console.log('ok');
            }
        }
    </script>
</body>

</html>