<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Banking System</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/5421b7873e.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="topnav">
        <a class="active" href="index.php"><b>Spark Bank</b></a>
        <a href="aboutus.php"><b>About Us</b></a>
        <a href="transfermoney.php"><b>View All Customers</b></a>
        <a href="transactionhistory.php"><b>Transactions</b></a>
    </div>
    <div class="main1-body">
        <div class="intro">
            <br> <br>
            <h3 style=" text-align: center;">Transfer Money</h3>
            <br>
        </div>

        <?php
        include './connect.php';
        if (isset($_REQUEST['customer_id'])) {
            $sid = $_GET['customer_id'];
            $sql = "SELECT * FROM customers where customer_id=$sid";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "Error : " . $sql . "<br>" . mysqli_error($conn);
            }
            $rows = mysqli_fetch_assoc($result);
        }
        ?>

        <form method="post">
            <div class="container">
                <div class="table1">
                    <table class="table table-bordered ">

                        <tr class="thead-light">
                            <th style=" text-alignt:center" scope="col">Customer Id</th>
                            <th style="padding :1px text-alignt:center" scope="col">Name</th>
                            <th style="padding :1px text-alignt:center" scope="col">Email</th>
                            <th style="padding :1px text-alignt:center" scope="col">Balance Amount</th>
                        </tr>
                        <tr style=" background-color: white">
                            <td class="py-2">
                                <?php echo $rows['customer_id'] ?>
                            </td>
                            <td class="py-2">
                                <?php echo $rows['customer_name'] ?>
                            </td>
                            <td class="py-2">
                                <?php echo $rows['customer_email'] ?>
                            </td>
                            <td class="py-2">
                                Rs
                                <?php echo $rows['customer_bal'] ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="container">
                <br><br><br>
                <label for="to"><b>Transfer To :</b></label>
                <select id="to" name="to" class="form-control" required>
                    <option value="" disabled selected>Choose</option>

                    <?php
                    include './connect.php';
                    $sid = $_REQUEST['customer_id'];
                    $sql = "SELECT * FROM customers where customer_id!=$sid";
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        echo "Error " . $sql . "<br>" . mysqli_error($conn);
                    }
                    while ($rows = mysqli_fetch_assoc($result)) {
                        ?>
                        <option class="table" value="<?php echo $rows['customer_id']; ?>">

                            <?php echo $rows['customer_name']; ?> (Balance Amount : Rs
                            <?php echo $rows['customer_bal']; ?> )

                        </option>
                        <?php
                    }
                    ?>
            </div>
            </select>
            <br>

            <label for="amount"><b>Amount : <b><i class="fa-solid fa-indian-rupee-sign"></i></label>
            <input type="number" class="form-control" name="amount" id="amount" required>
            <div class="text-center">
                <br><br>
                <button class="btn btn-info" class="button" name="submit" type="submit" id="myBtn">Proceed </button>
                <br>
                <br>
            </div>
            <br>
        </form>

        <br><br><br><br><br>
    </div>
    <!-- footer -->
    <footer>
        <div class="footer fixed-bottom">
            <h2>The Sparks Foundation Internship @ 2023 </h2>
        </div>
    </footer>
    <!-- footer -->

</body>

</html>

<?php
include './connect.php';

if (isset($_POST['submit'])) {

    $from = $_GET['customer_id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where customer_id=$from";
    $query = mysqli_query($conn, $sql);
    $sql1 = mysqli_fetch_array($query);

    if (($amount) < 0) {
        echo '<script>';
        echo 'alert("Please enter a valid amount.")';
        echo '</script>';
    } else if ($amount > $sql1['customer_bal']) {
        echo '<script>';
        echo ' alert("Transaction not Successful !! Insufficient Balance ")';
        echo '</script>';
    } else if ($amount == 0) {

        echo "<script>";
        echo "alert('Zero value cannot be transferred')";
        echo "</script>";
    } else {

        $sql = "SELECT * from customers where customer_id=$to";
        $query = mysqli_query($conn, $sql);
        $sql2 = mysqli_fetch_array($query);

        $sender = $sql1['customer_name'];
        $receiver = $sql2['customer_name'];

        $newbalance = $sql1['customer_bal'] - $amount;
        $sql = "UPDATE  customers set  customer_bal=$newbalance where customer_id=$from";
        mysqli_query($conn, $sql);

        $newbalance = $sql2['customer_bal'] + $amount;
        $sql = "UPDATE customers set  customer_bal=$newbalance where customer_id=$to";
        mysqli_query($conn, $sql);

        $sql = "INSERT INTO transaction(`sender`, `receiver`, `transferred_amt`) VALUES ('$sender','$receiver','$amount')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script> alert('Transaction Successful !!'); window.location='transactionhistory.php'; </script>";
        }

        $newbalance = 0;
        $amount = 0;
    }
}
?>