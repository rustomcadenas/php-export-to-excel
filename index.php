<?php 
    include_once('classes/sql.php');
    $users = "select firstname, lastname, email from users";
    $users = DB::query($users);
    $num = 0; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
<body> 

    <div class="container ">  

        <table class="table table-striped table-sm mt-5">
            <thead>
            <tr>
                <th>#</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th> 
            </tr>
            </thead>
            <tbody>
            <?php 
                foreach($users as $user) { 
                $num++
            ?>
            <tr> 
                <td><?= $num."."?></td>
                <td><?= $user['firstname'] ?></td>
                <td><?= $user['lastname'] ?></td>
                <td><?= $user['email'] ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

                    <!-- this one  -->
        <form action="" method="post">
            <button type="submit" id="btnExport" name='export' class="btn btn-outline-success" >Export Data</button>
        </form> 
        <a href="to-ecel.php" class="btn btn-outline-success">Export Data</a>

        
    </div>
    <!-- /Container +++++++++++++++++++++++++ -->
</body>
</html>


<?php
if(isset($_POST['export'])){
    $timestamp = time();
    $filename = 'Export_excel_' . $timestamp . '.xls';
    
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    
    $isPrintHeader = false;
    // foreach ($productResult as $row) {
    //     if (! $isPrintHeader) {
    //         echo implode("\t", array_keys($row)) . "\n";
    //         $isPrintHeader = true;
    //     }
    //     echo implode("\t", array_values($row)) . "\n";
    // }
    // exit();
   
    foreach($users as $user) { 
        if (! $isPrintHeader) {
            echo implode("\t", array_keys($user)) . "\n";
            $isPrintHeader = true;
        }
        echo implode("\t", array_values($row)) . "\n";
    }
    exit();
}
?>