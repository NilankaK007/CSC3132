<?php
//get the db connection file
require_once 'database.php';

function print_table($name,$connect,$arr){
//query
try{

    $sql="select ";
    for($i=0; $i<sizeof($arr)-1;$i++){
        $sql.=$arr[$i].",";
    }
    $sql .=$arr[sizeof($arr)-1]." from $name";

    //$sq1="SELECT * FROM $name";

    //execute the query
    $result=mysqli_query($connect,$sql);

    //check if data exists in the table
    if(mysqli_num_rows($result)>0){
        echo "<table border='1'>";
        $col=mysqli_fetch_fields($result);
        echo "<tr>";
        foreach($arr as $col){
            echo "<td>$col</td>";
        }
        echo "</tr>";
       
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            foreach($row as $key=>$value){
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }else{
        echo "No results";
    }
}
catch(Exception $e){
    die($e->getmessage());
}
}

print_table("students",$connect,["id","name","age","course"]);
//print_table("teacher",$connect,["Teacher Id","Teacher name","age"],"SELECT * FROM teacher");
?>