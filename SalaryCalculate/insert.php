<?php include("connection.php")?>
<?php
    $empid = $_REQUEST['empid'];
    $naId = $_REQUEST['naId'];
    $empname = $_REQUEST['empname'];
    $emplname = $_REQUEST['emplname'];
    $position = $_REQUEST['position'];
    $salary = $_REQUEST['salary'];
    // echo $salary;

    // if($position == 'delivery_man'){
    //     $salary = 15000;
    // }else if($position == 'cashier'){
    //     $salary = 16000;
    // }else if($position == 'brach_manager'){
    //     $salary = 20000;
    // }else if($position == 'parcel_carrier'){
    //     $salary = 11000;
    // }else if($position == 'porter'){
    //     $salary = 9500;
    // }
    // $salary =0+$salary ;


    $bonus = $_REQUEST['bonus'];
    if($bonus == 'Overtime 3 hr'){

        $total_salary = $salary * 1.05; 
    }
    else if($bonus == 'Overtime 6 hr'){
        $total_salary = $salary * 1.1;
    }
    else if($bonus == 'Overtime 9 hr'){
        $total_salary = $salary * 1.15;
    }else{
        $total_salary = $salary;
    }

    echo $total_salary;
    $bulk = new MongoDB\Driver\BulkWrite;
     $bulk->insert([
        'empid'=>$empid,
        'naId'=>$naId,
        'empname'=>$empname,
        'emplname'=>$emplname,
        'position'=>$position,
        'salary'=>$salary,
        'bonus'=>$bonus,
        'total_salary'=>$total_salary
     ]);
    $result = $manager->executeBulkWrite('hr.SalaryCalculate', $bulk);
    echo "<script>alert('เพิ่มข้อมูลเสร็จสิ้น');window.location.assign('index.html');</script>";
?>