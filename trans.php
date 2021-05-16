<?php
include('dbcon.php');
include('links.php');


?>
<?php

//for courses
$sql1 = "select * from transactions";
$result1 = $conn->query($sql1);



?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Transactions</title>
    <!-- <link rel="icon" href="images/titleicon.ico" type="image/x-icon" >
     -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


    <style>
    </style>
</head>

<body>

    <!-- navbar starts -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 2px 2px lightgray;">
        <a class="navbar-brand" style="margin: auto; color: darkcyan;" href="index.php"><strong>Banking System</strong></a>
    </nav>

    <!-- navbar ends -->


    <!-- body starts -->

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto flex flex-wrap flex-col">
            <?php
            include('extra.php');
            nav();
            ?>
        </div>
    </section>


    <!-- body ends -->


    <!-- table start -->
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto">
            <div class="flex flex-col text-center w-full">
                <h2 class="text-xl text-indigo-500 tracking-widest font-medium title-font mb-1">All Transactions</h2>

            </div>


            <table class="table table-striped" id='myTable'>
                <thead>
                    <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Sender's Account No</th>
                        <th scope="col">Reciver's Account No</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>

                    </tr>
                </thead>

                <?php
                $a = 0;
                while ($trans = $result1->fetch_assoc()) {
                    $a++;
                ?>


                    <tbody>
                        <tr>

                            <td><?php echo $trans['sno']; ?></td>
                            <td><?php echo $trans['senders_account']; ?></td>
                            <td><?php echo $trans['recivers_account']; ?></td>
                            <td><?php echo $trans['amount']; ?></td>
                            <td><?php echo $trans['date']; ?></td>

                        </tr>
                    </tbody>
                <?php

                }
                ?>

            </table>

            <div class="container my-4">


            </div>
            <hr>

        </div>

        </div>
    </section>


    <script type="text/javascript" src=" ../bootstrap/js/jquery.vide.js"></script>
    <script type="text/javascript" src="../bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();

        });
    </script>




</body>

</html>