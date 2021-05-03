<?php
include_once('classes/sql.php');


function filterData ($str) {
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}
 
$fileName  = "lmsdata-" . date('Ymd') . ".xls"; 


// Column names 
$fields = array('#', 'FIRSTNAME', 'LASTNAME', 'EMAIL'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 


$users = "select firstname, lastname, email from users";
$users = DB::query($users);
$num = 0;
if(count($users) > 0){
    foreach($users as $user){ 
        $num++;
        $rowData = array($num, $user['firstname'], $user['lastname'], $user['email']);
        array_walk($rowData, 'filterData');
        $excelData .= implode("\t", array_values($rowData)). "\n";

    } 
}else{
    $excelData .= "No records Found...". "\n";

}
 
// Headers for download 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
header("Content-Type: application/vnd.ms-excel"); 

echo $excelData; 
 