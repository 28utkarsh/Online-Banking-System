<?php
    session_start();
    // Creating Connection to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ghapla_bank";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $customer_account_number = $_GET['debit-account'];
    $beneficiary_account_number = $_GET['pay'];

    // Other Details of Benficiary
    $pay_via = $_GET['pay-via-method'];
    $date = $_GET['date-entered'];
    $remarks = $_GET['remarks-given'];
    $amount = $_GET['amount-entered'];
    
    // Get the account balance from the customer account
    $sql_account_balance = "SELECT * FROM CUSTOMER WHERE ACCOUNT_NO = '".$customer_account_number."'";
    $result = mysqli_query($conn, $sql_account_balance);
    $row = mysqli_fetch_assoc($result);
    $customer_account_balance = $row['account_balance'];
    $ifsc_customer = $row['ifsc'];
    $sql_ifsc = "SELECT * FROM BANK_BRANCH_IFSC WHERE IFSC = '".$ifsc_customer."'";
    $result_ifsc = mysqli_query($conn, $sql_ifsc);
    $row = mysqli_fetch_assoc($result_ifsc);
    $customer_bank_name = $row['bank_branch'];
    
    if ($customer_account_balance >= $amount){
        // Insert Query to the Transaction table
        $sql_account_balance = "SELECT * FROM CUSTOMER WHERE ACCOUNT_NO = '".$beneficiary_account_number."'";
        $result = mysqli_query($conn, $sql_account_balance);
        $row = mysqli_fetch_assoc($result);
        $beneficiary_account_balance = $row['account_balance'];
        $ifsc_beneficiary = $row['ifsc'];

        //Get the Bank Details of Beneficiary
        $sql_ifsc = "SELECT * FROM BANK_BRANCH_IFSC WHERE IFSC = '".$ifsc_beneficiary."'";
        $result_ifsc = mysqli_query($conn, $sql_ifsc);
        $row = mysqli_fetch_assoc($result_ifsc);
        $beneficiary_bank_name = $row['bank_branch'];
        
        //Update the Balance of Customer and Beneficiary
        $customer_account_balance = $customer_account_balance - $amount;
        $beneficiary_account_balance = $beneficiary_account_balance + $amount;
        
        //Prepare Update Queries
        $sql_update_customer_balance = "UPDATE CUSTOMER SET ACCOUNT_BALANCE = ".$customer_account_balance." WHERE ACCOUNT_NO = '".$customer_account_number."'";
        $sql_update_beneficiary_balance = "UPDATE CUSTOMER SET ACCOUNT_BALANCE = ".$beneficiary_account_balance." WHERE ACCOUNT_NO = '".$beneficiary_account_number."'";
        
        if(mysqli_query($conn, $sql_update_customer_balance)){
            if(mysqli_query($conn, $sql_update_beneficiary_balance)){
                // Prepare Query for Inserting the data
                $sql_customer_insert_new_transaction = "INSERT INTO TRANSACTION (customer_account_number, beneficiary_account_number, `date`, transaction_details, amount, balance_amount, dr_cr, pay_via, remarks) 
                                                        VALUES  ('".$customer_account_number."','".
                                                        $beneficiary_account_number."','".
                                                        $date."','".
                                                        $beneficiary_bank_name."',".
                                                        $amount.",".
                                                        $customer_account_balance.",
                                                        'DR','".
                                                        $pay_via."','".
                                                        $remarks."')";
                $sql_beneficiary_insert_new_transaction = "INSERT INTO TRANSACTION (customer_account_number, beneficiary_account_number, `date`, transaction_details, amount, balance_amount, dr_cr, pay_via, remarks) 
                                                            VALUES ('".$beneficiary_account_number."','".
                                                            $customer_account_number."','".
                                                            $date."','".
                                                            $customer_bank_name."',".
                                                            $amount.",".
                                                            $beneficiary_account_balance.",
                                                            'CR','".
                                                            $pay_via."','".
                                                            $remarks."')";
                if(mysqli_query($conn, $sql_customer_insert_new_transaction)){
                    if(mysqli_query($conn, $sql_beneficiary_insert_new_transaction)){
                        echo "<script type = 'text/javascript'>alert('Transaction Successful');window.location.href = 'transfer_funds.php';</script>";
                    }
                }
            }
        }
    }
    else{
        echo "<script type = 'text/javascript'>alert('Insufficient Funds');history.go(-1);</script>";
    }
?>