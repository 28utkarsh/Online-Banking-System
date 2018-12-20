<!DOCTYPE html>
<body>
<?php
    session_start();
    $beneficiary_account_number = $_GET['pay'];
    $customer_account_number = $_SESSION['account_no'];
    
    // Creating Connection to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ghapla_bank";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    //Query to Get Beneficiary Account Details from customer table
    $sql_beneficiary = "SELECT * FROM CUSTOMER WHERE ACCOUNT_NO = '".$beneficiary_account_number."'";
    $result_beneficiary = mysqli_query($conn, $sql_beneficiary);
    $row = mysqli_fetch_assoc($result_beneficiary);
    $ifsc_beneficiary = $row['ifsc'];
    $beneficiary_name = $row['username'];
    // $beneficiary_nickname = $row['nickname'];   ---> Fetch it from Beneficiary Table
        $sql_nickname = "SELECT * FROM BENEFICIARY WHERE CUSTOMER_ACCOUNT_NUMBER = '".$customer_account_number."' AND BENEFICIARY_ACCOUNT_NUMBER ='".$beneficiary_account_number."'";
        $result_nickname = mysqli_query($conn, $sql_nickname);
        $row = mysqli_fetch_assoc($result_nickname);
        $beneficiary_nickname = $row['nickname'];  // Nickname of Beneficiary
    //Query to Get Bank Name of Beneficiary
    $sql_ifsc = "SELECT * FROM BANK_BRANCH_IFSC WHERE IFSC = '".$ifsc_beneficiary."'";
    $result_ifsc = mysqli_query($conn, $sql_ifsc);
    $row = mysqli_fetch_assoc($result_ifsc);
    $beneficiary_bank_name = $row['bank_branch'];  //Bank Name of Beneficiary
    //echo "<script>alert('.$beneficiary_nickname.');</script>";
    ?>
    <link rel="stylesheet" href="pay.css">
    <body background="bg.jpg"> 
        <ul class="nav">
            <li>
              <img src="ghapla_logo.jpg">
            </li>
              <li>
                  <a href="welcome.php">Snapshots</a>
              </li>
              <li><a href="#">Accounts</a>
                <div>
                    <div class="nav-column">
                        <ul>
                            <li><a href="#">Operative</a></li>
                            <li><a href="#">Deposits</a></li>
                            <li><a href="#">Loans</a></li>
                            <li><a href="#">PPF Accounts</a></li>
                            <li><a href="#">NPS Accounts</a></li>
                            <li><a href="#">eDGE Rewards</a></li>
                            <li><a href="#">My Credit Cards</a></li>
                            <li><a href="#">My Debit Cards</a></li>
                        </ul>
                    </div>
                </div>
              </li>
              <li>
                  <a href="#">Payments</a>
                  <div>
                      <div class="nav-column">
                          <ul>
                              <li><a href="transfer_funds.php">Transfer Funds</a></li>
                              <li><a href="#">Pay Bills</a></li>
                              <li><a href="#">Pay Ghapla Cards, LIC & Reliance Energy</a></li>
                              <li><a href="#">Recharges</a></li>
                              <li><a href="#">Transaction Status Enquiry</a></li>
                          </ul>
                      </div>
                  </div>
              </li>
              <li><a href="#">Services</a>
                <div>
                    <div class="nav-column">
                        <ul>
                            <li><a href="#">Request For</a></li>
                            <li><a href="#">Tax Services</a></li>
                            <li><a href="#">Other Services</a></li>
                            <li><a href="#">Ghapla Services</a></li>
                        </ul>
                    </div>
                </div>
              </li>
              <li><a href="#">Investments</a>
                <div>
                    <div class="nav-column">
                        <ul>
                            <li><a href="#">My Portfolio</a></li>
                            <li><a href="#">My Demat</a></li>
                            <li><a href="#">Online IPO</a></li>
                            <li><a href="#">Mutual Funds</a></li>
                            <li><a href="#">Kisan Vikas Patra</a></li>
                            <li><a href="#">Atal Pension Yojna</a></li>
                        </ul>
                    </div>
                </div>
              </li>
              <div class="login">
                <button onclick="logout()">Logout</button>
              </div>
          </ul>
          <div class="container">
    <h2 class="heading">Payment Details</h2>
    <div class="details">
        <h3>Payee Details</h3>
        <div class="payee">
            <h4>Payee Name</h4>
            <div class="data">
                <?php
                    echo $beneficiary_name;
                ?>
            </div>
        </div>
      <div class="payee" style="margin-left:20%;">
          <h4>Nickname</h4>
          <div class="data" style="margin-top:-20px; margin-left:5px;">
              <?php
                echo $beneficiary_nickname;
              ?>
          </div>
    </div>
    <div class="payee" style="margin-left:65%; margin-top:-8%;">
          <h4>Account_Number</h4>
          <div class="data" style="margin-top:-20px; margin-left:5px;">
              <?php
                echo $beneficiary_account_number;
              ?>
          </div>
    </div>
    <div class="payee" style="margin-top:1%;">
        <h4 style="margin-left:-0.1%;">Bank_and_Branch</h4>
        <div class="data" style="margin-top:-20px; width:200px;">
            <?php
                echo $beneficiary_bank_name;
            ?>
        </div>
    </div>
    <div class="payee" style="margin-top:1%; margin-left:7%;">
        <h4 style="margin-left:-0.1%;">IFSC_Code</h4>
        <div class="data" style="margin-top:-20px; width:200px;">
            <?php
                echo $ifsc_beneficiary;
            ?>
        </div>
    </div>
      <!--Payee Details(Include a php script)-->
</div>
<hr class="hr">
    <div class="payment-form">
      <h5>Payment Details</h5>
      <form method="GET">
        <div class="fields">
          <h5>Debit Account</h5>
          <label>
          <select name="debit-account" class="dropdown">
            <option value="">Select Option</option>
            <option value="<?php echo $customer_account_number;?>"><?php echo $customer_account_number;?></option>
          </select>
        </label>
        </div>
        <div class="fields">
          <h5>Date</h5>
          <label class="date">
            <input name="date-entered" type="date">
        </label>
        </div>
        <div class="fields">
          <h5>Amount</h5>
          <label class="amount">
            <input type="text" name="amount-entered">
        </label>
        </div>
        <div class="fields">
          <h5>Remarks</h5>
          <label class="remarks">
            <input type="text" name="remarks-given">
        </label>
        </div>
        <div class="fields">
          <h5>Pay Via</h5>
          <label class="pay-via">
            <input type="radio" name="pay-via-method" value="neft" checked>NEFT
            <input type="radio" name="pay-via-method" value="rtgs">RTGS
            <input type="radio" name="pay-via-method" value="imps">IMPS
        </label>
        </div>
        <button formaction = "next.php" class="submit">Next</button>
        <button formaction = "transfer_funds.php" class="submit" style="margin-left:5%;">Cancel</button>
        <input name = 'pay' value = '<?php echo $beneficiary_account_number?>' style = 'visibility: hidden'>  
    </form>
    </div>
  </div>
  <div class="footer">

  </div>
          <script type="text/javascript">
            function logout(){
                window.location.href = 'login.html';
                    alert('Successfully Logged Out');
            }
          </script>
</body>
</html>