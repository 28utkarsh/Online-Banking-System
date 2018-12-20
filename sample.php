<!DOCTYPE html>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $a = '1234567890';
    $dbname = "ghapla_bank";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $query = "SELECT * FROM BENEFICIARY WHERE customer_account_number = ".$a;
    $result = mysqli_query($conn, $query);
    $i = 0;?>
    <form action = '' method = 'post'>
    <table align = "center" border = "1px" style = "width:900px; line-height:30px;">
    <tr>
        <th colspan = 5>BENEFICIARY DETAILS</th>
    </tr>
    <?php
    while ($rows = mysqli_fetch_assoc($result)){
        $a = $rows['beneficiary_account_number'];
    ?>
            <tr>
                <td><input type = 'radio' name = 'rad' value = "<?php echo $a;?>"></td>
                <td><?php echo $rows['beneficiary_account_number'];?></td>
                <td><?php echo $rows['username'];?></td>
                <td><?php echo $rows['nickname'];?></td>
                <td><?php echo $rows['ifsc'];?></td>
            </tr>
    <?php
    }
    ?>
    </table>
    <input type = 'radio' name = 'rad' value="Male" checked>Male
    <input type = 'radio' name = 'rad' value = "Female">Female
    <input type = 'submit' name = 'submit' value = 'Click Me'>
    </form>
    <?php
        if(isset($_POST['submit'])){
            $selected_val = $_POST['rad'];
            echo 'The selected value is '.$selected_val;
        }
    ?>
</body>
</html>