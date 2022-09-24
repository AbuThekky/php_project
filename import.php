<?php

$conn = mysqli_connect("localhost", "root", "root", "csv");

if(isset($_POST["import"])){
    $fileName = $_FILES["file"]["tmp_name"];

    if($_FILES["file"]["size"] > 0) {
        $file = fopen($fileName, "r");

        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
            $sqlInsert = "Insert into data (Applicable_For, Value) values ('" . $column[0] . "','" . $column[1] ."')";

            $result = mysqli_query($conn, $sqlInsert);

            if(!empty($result)){
                echo "CSV Data imported into the database";
            }else{
                echo "Problem in importing csv";
            }
             
        }
    }


}

?>

<form class="form-horizontal" action="" methods="posts" name="uploadCsv" enctype="multipart/form-data">
    <div>
        <label>Choose CSV File</label>
        <input type="file" name="file" accept=".csv">
        <button type="submit" name="import">Import</button>
    </div>
</form>