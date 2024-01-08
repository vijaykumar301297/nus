<div class="userform" id='show'>

    <label class="roleid">Client Company</label>

    <select id="roleparentdata" name="bussinessunit[]" class="roleparent" multiple required>
        <!-- <option disabled>Select one or more Bussiness units</option> -->
        <?php
        include "../dbconn.php";

        // $parent = $_POST['parentId'];

        $sqlParent = "SELECT * FROM parentcompanydata WHERE id = '".$_POST['parentId']."';";
        $resParent = mysqli_query($conn,$sqlParent);
        $resFetchAssoc = mysqli_fetch_assoc($resParent);

        $parent = $resFetchAssoc['parentcompany'];
        echo $parent;

        $sqlQuery1 = "SELECT * FROM clientcompanydata WHERE parentcompany = '$parent';";
        $resQuery1 = mysqli_query($conn, $sqlQuery1);
        while ($clientcompanydata = mysqli_fetch_array($resQuery1)) {
            echo "<option value='" . $clientcompanydata['id'] . "'>" . $clientcompanydata['clientcompany'] . ' - ' . $clientcompanydata['country'] . "</option>";  // displaying data in option menu
        }
        ?>
    </select>

</div>