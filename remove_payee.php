<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ghapla_bank";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $customer_account_number = $_SESSION['account_no'];
    $beneficiary_account_number = $_GET['pay'];
    $sql = "DELETE FROM BENEFICIARY WHERE CUSTOMER_ACCOUNT_NUMBER='".$customer_account_number."' AND BENEFICIARY_ACCOUNT_NUMBER='".$beneficiary_account_number."'";
    if(mysqli_query($conn, $sql)){
        echo "<script type='text/javascript'>alert('Deletion Successful'); window.location.href='transfer_funds.php';</script>";
    }
    else{
        echo "<script type='text/javascript'>alert('ERROR in Deletion');</script>";
    }
?>