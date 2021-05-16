<?php
include('dbcon.php');
include('links.php');


?>
<?php

$sql1 = "select * from customers";
$result1 = $conn->query($sql1);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {
        // Update the record
        $sno = $_POST["snoEdit"];
        $rec = $_POST["rec_accnt_no1"];

        $sen = $_POST["sen_no"];
        $amount = $_POST["amount"];


        // to check the balance is availbe in senders account or not
        $sql11 = "SELECT * from customers where account_no = '$sen' ";
        $res = $conn->query($sql11);
        $rr = $res->fetch_assoc();
        $sen_amt = $rr['amount'];


        // to derive the balance is availbe in recivers account
        $sql12 = "SELECT * from customers where account_no = '$rec' ";
        $res1 = $conn->query($sql12);
        $rr1 = $res1->fetch_assoc();
        $rec_amt = $rr1['amount'];
        echo $rec_amt;



        if ($sen_amt < $amount) {
?>
            <script>
                alert('Insufficient balance!');
                location.href = 'customers.php';
            </script>
            <?php
        } else {
            // Sql query to be executed
            // adding amount in recivers and deducting from senders
            $re_amt = $rec_amt + $amount;
            $se_amt = $sen_amt - $amount;

            $sql3 = "UPDATE customers SET amount = '$re_amt'  WHERE account_no = '$rec' ";
            $sql4 = "UPDATE customers SET amount = '$se_amt'  WHERE account_no = '$sen' ";

            $result1 = $conn->query($sql3);
            $result2 = $conn->query($sql4);
            if ($result1 && $result2) {

    $sql = "INSERT INTO `transactions` (`senders_account`, `recivers_account`, `amount`) VALUES ('$sen','$rec','$amount')";
    $result2 = $conn->query($sql);

            ?>
                <script>
                    alert('Transfered successfully');
                    location.href = 'customers.php';
                </script>
<?php
            } else {
                echo "We could not update the record successfully";
            }
        }
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>All Customers</title>
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

    <!-- modal starts  -->
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Transfer your money</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="customers.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <label for="rec_accnt_no">Reciver's Account No</label>
                            <input type="text" class="form-control" id="rec_accnt_no1" name="rec_accnt_no1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="sen_no">Sender's Account No</label>
                            <input type="text" class="form-control" id="sen_no" name="sen_no" aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input class="form-control" id="amount" name="amount"></input>
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Transfer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal ends -->



    <!-- table start -->
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto">
            <div class="flex flex-col text-center w-full">
                <h2 class="text-xl text-indigo-500 tracking-widest font-medium title-font mb-1">All Customers</h2>

            </div>


            <table class="table table-striped" id='myTable'>
                <thead>
                    <tr>
                        <th scope="col">Account No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>

                <?php
                $a = 0;
                while ($customer = $result1->fetch_assoc()) {
                    $a++;
                ?>


                    <tbody>
                        <tr>

                            <td><?php echo $customer['account_no']; ?></td>
                            <td><?php echo $customer['name']; ?></td>
                            <td><?php echo $customer['phone']; ?></td>
                            <td><?php echo $customer['email']; ?></td>
                            <td><?php echo $customer['amount']; ?></td>
                            <td> <button class='transfer btn btn-sm btn-primary' id=<?php echo $customer['account_no']; ?>>Transfer</button> </td>

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
    <script type="text/javascript">
        edits = document.getElementsByClassName('transfer');
        // console.log(edits);
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("transfer");
                console.log(e);
                tr = e.target.parentNode.parentNode;
                rec_accnt_no = tr.getElementsByTagName("td")[0].innerText;
                rec_accnt_no1.value = rec_accnt_no;
                snoEdit.value = e.target.id;
                console.log(e.target.id)
                $('#editModal').modal('toggle');
            })
        });
    </script>
    <!-- table ends -->



</body>

</html>