<?php include("connection.php")?>
<?php
    $bulk = new MongoDB\Driver\BulkWrite;

    $filter = ['empid'=>$_REQUEST['empid']];
    $query = new MongoDB\Driver\Query($filter);
    $show = $manager->executeQuery('hr.SalaryCalculate',$query);
    $data = array();
    foreach($show as $doc){
        array_push($data,$doc);
    }
    $json = json_encode($data);
    // echo "<pre>";
    // echo $json;
    // echo "</pre>";
    $dis = json_decode($json);

    // echo "<pre>";
    // echo $dis[0]->salary;
    // echo "</pre>";

    // $position = $dis[0]->position;

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


    // $salary = $_REQUEST['salary'];
    
    $salary = $dis[0]->salary;
    echo $salary;
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

    $bulk->update(['empid'=>$_REQUEST['empid']],
        ['$set' => ['total_salary'=>$total_salary,
                    'bonus'=>$bonus
        ]]);
    $result = $manager->executeBulkWrite('hr.SalaryCalculate', $bulk);
    echo "<script>alert('แก้ไขข้อมูลเสร็จสิ้น');window.location.assign('index.html');</script>";
 


?>