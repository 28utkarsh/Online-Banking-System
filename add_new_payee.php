<?php
    // Gathering all Form variables
    session_start();
    $payee_name = $_POST['payee_name'];
    $nickname = $_POST['nickname'];
    $beneficiary_acc_num = $_POST['acc_no'];
    $customer_acc_num = $_SESSION['account_no'];
    $confirm_acc_num = $_POST['confirm_acc_no'];
    $ifsc = $_POST['ifsc'];
    if($confirm_acc_num == $beneficiary_acc_num){
        // Connecting to Database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ghapla_bank";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Query to fetch data from customer table to check for the existence of beneficiary account number
        $sql = "SELECT * FROM CUSTOMER WHERE ACCOUNT_NO = '".$beneficiary_acc_num."'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            // Query to fetch data from customer table to check the ifsc code entered is same as that of the repective beneficiary account number
            $sql = "SELECT * FROM CUSTOMER WHERE IFSC = '".$ifsc."' AND ACCOUNT_NO = '".$beneficiary_acc_num."'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                // Query to Insert Data into Beneficiary Table
                $sql = "INSERT INTO beneficiary VALUES ('".$customer_acc_num."','".
                                                        $beneficiary_acc_num."','".
                                                        $payee_name."','".
                                                        $nickname."','".
                                                        $ifsc."')";
                
                // Executing the Query
                if (mysqli_query($conn, $sql)) {
                    echo "<script type='text/javascript'> alert('Payee added successfully'); window.location.href='transfer_funds.php';</script>";
                } 
                else {
                ?>
                    <script>
                        alert("Error");
                    </script>
                <?php
                    header('Location: add_new_payee.php');
                }
                mysqli_close($conn);
            }
            else{
                echo "<script type = 'text/javascript'>alert('Beneficiary\'s IFSC Number is incorrect.');history.go(-1);</script>";
            }
        }
        else{
            echo "<script type = 'text/javascript'>alert('Beneficiary\'s Account Number doesn\'t exists in the Bank\'s Database.');history.go(-1);</script>";
        }
    }
    else{
        echo "<script type = 'text/javascript'>alert('Account Number doesn\'t match');history.go(-1);</script>";
    }
?>