<?php
include('dbcon.php');
include('links.php');

//for courses
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
                location.href = 'index.php';
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
                    location.href = 'index.php';
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

    <title>Banking System</title>
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
            <img class="xl:w-1/4 lg:w-1/3 md:w-1/2 w-2/3 block mx-auto mb-10 object-cover object-center rounded" alt="hero" src="bank.jpg">
            <div class="flex flex-col text-center w-full">
                <h1 class="text-xl font-medium title-font mb-4 text-gray-900">Welcome to Online Banking</h1>
                <div class="flex mx-auto flex-wrap mb-8">
                    <a href="index.php" class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium bg-gray-100 inline-flex items-center leading-none border-gray-200 text-indigo-500 tracking-wider rounded-t">

                        <strong class="btn btn-primary mr-1">Home</strong> </a>
                    <a class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium bg-gray-100 inline-flex items-center leading-none border-gray-200 text-indigo-500 tracking-wider rounded-t">

                        <strong class="transfer btn btn-primary mr-1">Transfer Money</strong> </a>
                    <a href="customers.php" class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none border-gray-200 hover:text-gray-900 tracking-wider">
                        <strong class="btn btn-primary mr-1">All Customers</strong>
                    </a>
                    <a href="trans.php" class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none border-gray-200 hover:text-gray-900 tracking-wider">
                        <strong class="btn btn-primary mr-1">Transactions</strong>
                    </a>

                </div>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Easy and secure platform for all your transactions.</p>
            </div>
        </div>
    </section>


    <!-- body ends -->


    <!-- modal starts  -->
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit this Course</h5>
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


    <script type="text/javascript">
        edits = document.getElementsByClassName('transfer');
        // console.log(edits);
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("transfer");
                console.log(e);
                snoEdit.value = e.target.id;
                console.log(e.target.id)
                $('#editModal').modal('toggle');
            })
        });
    </script>
</body>

</html>