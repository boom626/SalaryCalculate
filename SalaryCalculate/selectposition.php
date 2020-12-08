<?php include("connection.php") ?>

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: #FF9AA2;
            color: white;
        }
    </style>

</head>
<?php
$filter = ['position' => $_REQUEST['position']];
$query = new MongoDB\Driver\Query($filter);
$predoc = $manager->executeQuery('hr.SalaryCalculate', $query);
$data = array();
foreach ($predoc as $doc) {
    array_push($data, $doc);
}
$json = json_encode($data);
// echo "<pre>";
// echo $json;
// echo "</pre>";
$show = json_decode($json);
// echo "<pre>";
// echo $dis[0]->position;
// echo "</pre>";
$count = count($data);
$i = 0;
echo "<table><tr>
            <th>รหัสพนักงาน</th>
            <th>ชื่อ</th>
           <th>ตำแน่งงาน</th>
            <th>โบนัส</th>
            <th>เงินเดือนทั้งหมด(รวมโบนัส)</th>
        </tr>";
while ($i < $count) {
    echo  "<tr>
            <td>" . $show[$i]->empid . "</td>
            <td>" . $show[$i]->empname . "</td>
            <td>" . $show[$i]->position . "</td>
            <td>" . $show[$i]->bonus . "</td>
            <td>" . $show[$i]->total_salary . "</td>
            </tr>";
    $i++;
}
echo "</table>";

?>