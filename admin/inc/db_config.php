<?php

///connection
    $hname = "localhost";
    $uname = "root";
    $pass = "";
    $db = "hostelweb";

    $con = mysqli_connect($hname,$uname,$pass,$db);

    if(!$con){
        die("Cannot connect to Database" .mysqli_connect_error());
    }

//filterstion data
    function filteration($data){
        foreach($data as $key => $value) {
           $value = trim($value);
           $value = stripcslashes($value);
           $value = htmlspecialchars($value);
           $value = strip_tags($value);
           $data[$key] = $value;
        };

        return $data;
     }

    ///select all data in database
    function selectAll($table)
    {
     $con = $GLOBALS['con'];
     $res = mysqli_query($con,"SELECT * FROM $table");
     return $res;
    }

     ///select data 
     function select($sql,$values,$datatypes)
     {
       $con = $GLOBALS['con'];
       if ($stmt = mysqli_prepare($con,$sql)){
         mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if (mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
                    mysqli_stmt_close($stmt);
            die("Query not be executed - Select");
        } 

       }
       else{
        die("Query not be prepared - Select");
       }
     }
 ///update data
     function update($sql,$values,$datatypes)
     {
       $con = $GLOBALS['con'];
       if ($stmt = mysqli_prepare($con,$sql))
       {
         mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if (mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
                    mysqli_stmt_close($stmt);
            die("Query not be executed - Update");
        } 

       }
       else{
        die("Query not be prepared - Update");
       }
     }

    // inserting data
     function insert($sql,$values,$datatypes)
     {
       $con = $GLOBALS['con'];
       if ($stmt = mysqli_prepare($con,$sql))
       {
         mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if (mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
                    mysqli_stmt_close($stmt);
            die("Query not be executed - Insert");
        } 

       }
       else{
        die("Query not be prepared - Insert");
       }
     }

 /////delete data functin
     function p_delete($sql,$values,$datatypes)
     {
       $con = $GLOBALS['con'];
       if ($stmt = mysqli_prepare($con,$sql))
       {
         mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if (mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
                    mysqli_stmt_close($stmt);
            die("Query not be executed - Delete");
        } 

       }
       else{
        die("Query not be prepared - Delete");
       }
     }

?>