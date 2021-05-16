<?php
function nav()
{
?>
    <div class="flex mx-auto flex-wrap mb-8">
        <a href="index.php" class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium bg-gray-100 inline-flex items-center leading-none border-gray-200 text-indigo-500 tracking-wider rounded-t">

            <strong class="btn btn-primary mr-1">Home</strong> </a>
        <a href="customers.php" class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none border-gray-200 hover:text-gray-900 tracking-wider">
            <strong class="btn btn-primary mr-1">All Customers</strong>
        </a>
        <a href="trans.php" class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none border-gray-200 hover:text-gray-900 tracking-wider">
            <strong class="btn btn-primary mr-1">Transactions</strong>
        </a>

    </div>

<?php
}
?>