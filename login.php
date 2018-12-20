<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ghapla_bank";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn){
        die("Connection Failed:".mysqli_connect_error());
    }
    else{
        header('Location: welcome.html');
    }
    try{     
        if(!isset($_POST['customer_id'])){
            throw new Exception;
        }
        $customer_id = $_POST['customer_id'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = '".$customer_id."' AND PASSWORD = '".$password."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['account_no'] = $row['account_no'];
            $_SESSION['username'] = $row['username'];
            $sql2 = "UPDATE CUSTOMER SET LOGIN_DATE = CURDATE(), LOGIN_TIME = CURTIME() WHERE ACCOUNT_NO = '".$row['account_no']."'";
            if(mysqli_query($conn, $sql2)){
                
                header('Location: welcome.php');
            }
            else{
                echo("Error description: " . mysqli_error($conn));
            }
        }
        else{
            echo "<script type = 'text/javascript'>
                    alert('Invalid Credentials');
                    window.location.href = 'login.html';
                </script>";
        }
        //echo $customer_id;
        //echo $password;
    }
    catch(Exception $e){
        $card_no = $_POST['card_no'];
        $pin_no = $_POST['pin_no'];
        $sql = "SELECT * FROM CUSTOMER WHERE CARD_NO = '".$card_no."' AND PIN_NO = '".$pin_no."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['account_no'] = $row['account_no'];
            $_SESSION['username'] = $row['username'];
            header('Location: welcome.php');
        }
        else{
            echo "<script type = 'text/javascript'>
                    window.location.href = 'login.html';
                    alert('Invalid Credentials');
                </script>";
        }
    }
?>