<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ghapla_bank";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $query = "SELECT * FROM BENEFICIARY WHERE customer_account_number = ".$_SESSION['account_no'];
    $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Transfer Funds </title>
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
          <br><br><br>
        <form method = 'get'>
            <table align = "center" border = "1px" style = "width:900px; line-height:30px;">
            <tr>
                <th colspan = "5"><h2>Beneficiary Details</h2></th>
            </tr>
            <tr>
                <th> Pay </th>
                <th> Account Number </th>
                <th> Name </th>
                <th> Nichname </th>
                <th> IFSC Code </th>
            </tr>
            <?php
                $i = 0;
                while($rows = mysqli_fetch_assoc($result))
                {
            ?>  
                    <tr>
                        <td><input type="radio" name="pay" id="pay" value="<?php echo $rows['beneficiary_account_number'];?>" checked></td>
                        <td><?php echo $rows['beneficiary_account_number'];?></td>
                        <td><?php echo $rows['username'];?></td>
                        <td><?php echo $rows['nickname'];?></td>
                        <td><?php echo $rows['ifsc'];?></td>
                    </tr>
            <?php        
                    $i = $i + 1;
                }
            ?>
            </table>
            <br><br>
            <?php
            if ($i > 0){
            ?>
                <div>
                <button formaction = "remove_payee.php" style = 'width: 300px; padding: 8px 35px; border: 2px solid black;margin-right:570px;font-size: 20px; float: right;'>Remove Payee</button>
                <button formaction = "pay.php" style = 'width: 300px; padding: 8px 35px; border: 2px solid black;margin-left:320px;font-size: 20px; float: left;'>Begin Payement</button>
            <?php
                }
            else{
            ?>
                <button style = 'width: 300px; padding: 8px 35px; border: 2px solid black;margin-right:570px;font-size: 20px; float: right;' disabled>Remove Payee</button>
                <button style = 'width: 300px; padding: 8px 35px; border: 2px solid black;margin-left:320px;font-size: 20px; float: left;' disabled>Begin Payement</button>
            <?php    
            }
            ?>
                </div>
        </form>
        <button onclick = "location.href = 'add_new_payee.html';" style = 'width: 300px; padding: 8px 35px; border: 2px solid black;margin-left:320px;font-size: 20px; margin-top:10px;'>Add New Payee</button>
        <script type="text/javascript">
            function logout(){
                window.location.href = 'login.html';
                    alert('Successfully Logged Out');
            }
        </script>
    </body>
</html>