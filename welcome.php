<html>
    <?php
    session_start();
    ?>
    
        <link rel="stylesheet" href="welcome.css">
    <body background="bg.jpg">
        
        <ul class="nav">
            <li>
              <img src="ghapla_logo.jpg">
            </li>
              <li>
                  <a href="#">Snapshots</a>
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
          <br><br><br>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ghapla_bank";
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            $acc_no = $_SESSION['account_no'];
            $username = $_SESSION['username'];
            //echo "<h1>".$acc_no."</h1><br>";
            //echo "<h1>".$username."</h1>";
            $sql = "SELECT * FROM CUSTOMER WHERE ACCOUNT_NO = '".$acc_no."'";
            $row = mysqli_query($conn, $sql);
            $result = mysqli_fetch_assoc($row);
            $customer_name = $result['username'];
            $customer_id = $result['customer_id'];
            $email = $result['email'];
            $phone_number = $result['phone_no'];
            $account_balance = $result['account_balance'];
            $account_type = $result['account_type'];
            $login_date = $result['login_date'];
            $login_time = $result['login_time'];

            //echo "<script type='text/javascript'>alert('Successfully Logged in.');</script>";
        ?> 
        <div class="details" align = 'center'>
            <h1>Account Details</h1>
            <div class="customer_details" style = 'margin-left:20%'>
                <h2 style = "width:300px">Account Holder Name</h2>
                <div class="name">
                    <h3><?php echo $customer_name; ?></h3>
                </div>
            </div>
            <div class="customer_details" style = 'margin-left:44%;'>
                <h2>Customer ID</h2>
                <div class="name">
                    <h3><?php echo $customer_id;?></h3>
                </div>    
            </div>
            <div class="customer_details" style = 'margin-left:61%;'>
                <h2>Customer ID</h2>
                <div class="name" >
                    <h3><?php echo $email;?></h3>
                </div>    
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br>         
        <div class="details">
            <div class="customer_details" style = 'margin-left:24%;'>
                <h2>Phone Number</h2>
                <div class="name" style = 'margin-left:17%;'>
                    <h3><?php echo $phone_number ?></h3>
                </div>
            </div>
            <div class="customer_details" style = 'margin-left:43%;'>
                <h2>Account Balance</h2>
                <div class="name" style = 'margin-left:25%;'>
                    <h3>Rs.<?php echo $account_balance;?></h3>
                </div>    
            </div>
            <div class="customer_details" style = 'margin-left:63%;'>
                <h2>Account Type</h2>
                <div class="name" style = 'margin-left:25%;'>
                    <h3><?php echo $account_type;?></h3>
                </div>    
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br>
        <div class="details">
            <div class="customer_details" style = 'margin-left:24%;'>
                <h2>Last Login Date</h2>
                <div class="name" style = 'margin-left:23%;'>
                    <h3><?php echo $login_date ?></h3>
                </div>
            </div>
            <div class="customer_details" style = 'margin-left:43%;'>
                <h2>Last Login Time</h2>
                <div class="name" style = 'margin-left:25%;'>
                    <h3><?php echo $login_time;?></h3>
                </div>    
            </div>
            <div class="customer_details" style = 'margin-left:63%;'>
                <h2>Full Statement</h2>
                <div class="name" style = 'margin-left:-4%;'>
                    <button onclick='window.location.href = "show_transaction_details.php"' style = 'width: auto; padding: 8px 35px; border: 2px solid black;font-size: 20px; float: left;'>Click Here</button>
                </div>    
            </div>
        </div>        
        
        <script type="text/javascript">
        function logout(){
            window.location.href = 'login.html';
                alert('Successfully Logged Out');
        }
        </script>
    </body>
</html>