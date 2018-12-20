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
            <br><br><br><br>
            <table align = "center" border = "1px" style = "width:50%; line-height:30px;">
                <tr>
                    <th colspan = "2"><h2>Bank Details</h2></th>
                </tr>
                <tr>
                    <th>IFSC CODE</th>
                    <th>Bank Name</th>
                </tr>
                <?php
                    include 'connection.php';
                    $sql = 'SELECT * FROM BANK_BRANCH_IFSC';
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                        <tr>
                            <td> <?php echo $row['ifsc'];?> </td>
                            <td> <?php echo $row['bank_branch'];?></td>
                        </tr>
                <?php
                    }
                ?>
            </table>
            <br>
            <button onclick = 'history.go(-1);' style="width:7%; font-size: 20px;margin-left:68%;">Back</button>
            <script type="text/javascript">
                function logout(){
                    window.location.href = 'login.html';
                        alert('Successfully Logged Out');
                }
            </script>
    </body>
</html>