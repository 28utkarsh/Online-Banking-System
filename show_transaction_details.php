<html>
    <head>   
        <link rel="stylesheet" href="welcome.css">
        <style>
            td {
                text-align: center;
            }
        </style>
    </head>
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
            <table align = "center" border = "1px" style = "width:98%; line-height:30px;">
            <tr>
                <th colspan = "8"><h2>Transaction Details</h2></th>
            </tr>
            <tr>
                <th> Account Number </th>
                <th> Date </th>
                <th> Bank Detail </th>
                <th> Amount </th>
                <th> DR / CR </th>
                <th> Bank Balance </th>
                <th> Pay Method </th>
                <th> Remarks </th>
            </tr>
            <br><br><br>
            <?php
                session_start();
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "ghapla_bank";
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                $account_no = $_SESSION['account_no'];
                $sql = "SELECT * FROM TRANSACTION WHERE CUSTOMER_ACCOUNT_NUMBER = '".$account_no."'";
                $result = mysqli_query($conn, $sql);
                while($rows = mysqli_fetch_assoc($result))
                {
            ?>  
                <tr>
                    <td><?php echo $rows['beneficiary_account_number'];?></td>
                    <td><?php echo $rows['date'];?></td>
                    <td><?php echo $rows['transaction_details'];?></td>
                    <td><?php echo $rows['amount'];?></td>
                    <td><?php echo $rows['dr_cr'];?></td>
                    <td><?php echo $rows['balance_amount'];?></td>
                    <td><?php echo strtoupper($rows['pay_via']);?></td>
                    <td><?php echo strtoupper($rows['remarks']);?></td>
                </tr>
            <?php        
                }
            ?>
            <script type="text/javascript">
                function logout(){
                    window.location.href = 'login.html';
                        alert('Successfully Logged Out');
                }
            </script>
    </body>
</html>