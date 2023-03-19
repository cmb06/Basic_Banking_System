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

  <?php
  include './connect.php';
  $sql = "SELECT * FROM customers";
  $result = mysqli_query($conn, $sql);
  ?>

  <div class="topnav">
    <a class="active" href="index.php"><b>Spark Bank</b></a>
    <a href="aboutus.php"><b>About Us</b></a>
    <a href="transfermoney.php"><b>View All Customers</b></a>
    <a href="transactionhistory.php"><b>Transactions</b></a>
  </div>
  <div class="main1-body">
    <div class="intro">
      <br>
      <br>
      <h3 style=" text-align: center;">Transfer Money</h3>
      <br>
    </div>

    <div class="container">
      <div class="jumbotron">
        <div class="card">
          <div class="card-body">

            <table class="table table-striped table-bordered ">
              <thead>
                <tr>
                  <th scope="col">Customer Id</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Balance <i class="fa-solid fa-indian-rupee-sign"></th>
                  <th scope="col">Perform Transactions</th>
                </tr>
              </thead>
              <tbody>

                <?php
                while ($rows = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                    <td class="py-3">
                      <?php echo $rows['customer_id'] ?>
                    </td>
                    <td class="py-3">
                      <?php echo $rows['customer_name'] ?>
                    </td>
                    <td class="py-3">
                      <?php echo $rows['customer_email'] ?>
                    </td>
                    <td class="py-3">
                      <?php echo $rows['customer_bal'] ?>
                    </td>
                    <td class="py-3"><a style=" text-decoration: none; color: white "
                        href="transfer.php?customer_id= <?php echo $rows['customer_id']; ?>"> <button
                          class="btn btn-info">Transfer</a></button></td>
                  </tr>
                  <?php
                }
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <br>
    <br>
    <br>
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