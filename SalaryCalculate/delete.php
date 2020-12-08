<?php include("connection.php")?>
<?php
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['empid'=>$_REQUEST['empid']]);
    $result = $manager->executeBulkWrite('hr.SalaryCalculate', $bulk);
    echo "<script>alert('ลบข้อมูลเสร็จสิ้น');window.location.assign('index.html');</script>";
?>


