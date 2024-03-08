
<?php 
session_start();
    include('testconnection.php');
    if(isset($_POST['check'])){
        $tid=$_POST['tid'];
       $sql="SELECT * FROM classes WHERE tid=:tid ";
       $stmt=$conns->prepare($sql);
       $data=[
        ':tid'=>$tid
       ];
       $stmt->execute($data);
       $result=$stmt->fetchAll(PDO::FETCH_OBJ);
       if($result){
        foreach($result as $row){
            ?>
                
                
                <?php
        }
    }
}


?>

    <table>
    <tr>
        <th>adm number</th>
        <th>student name</th>
        <th>contact</th>
    </tr>
       
<?php
if(isset($_POST['fetcher'])){
        $teacherz=$_POST['unitnamez'];
        $sql="SELECT * FROM enrolled WHERE unitname=:unitnamez ";
        $stmt=$conns->prepare($sql);
        $data=[
        ':unitnamez'=>$teacherz
    ];
    $stmt->execute($data);
    $result=$stmt->fetchAll(PDO::FETCH_OBJ);
    if($result){
        foreach($result as $row){
            $Sqle=" SELECT  studentdetails.name,studentdetails.phone,studentdetails.satelite,enrolled.adm,enrolled.unitname,enrolled.hours,studentdetails.adm
            FROM studentdetails
             JOIN enrolled ON studentdetails.adm=enrolled.adm WHERE enrolled.adm=:adm && enrolled.unitname=:unitnamez
            ";
            $stmtz=$conns->prepare($Sqle);
            
            $dataz=[
                ':unitnamez'=>$teacherz,
                ':adm'=>$row->adm
            ]; 
            $stmtz->execute($dataz);
            $resultz=$stmtz->fetchAll(PDO::FETCH_OBJ); 
            if($resultz){
                foreach($resultz as $rowz){
                    ?>
                    <tr>
                    <td> <?=$rowz->adm;?> </td>
                    <td> <?=$rowz->name;?> </td>
                    <td> <?=$rowz->phone;?> </td>

                    <!-- <td> <a href="gradestudentz.php?adm=<?=$rowz->adm;?>&&unit=<?=$teacherz;?>&&hours=<?=$rowz->hours;?> ">grade</a> </td> -->
                    </tr>
                        
                    
                    <?php
                }

            }
            ?>
            
            <tr>
            <!-- <td> <?=$row->adm;?> </td> -->
            <!-- <td> <a href="gradestudentz.php?adm=<?=$row->adm;?>&&unit=<?=$row->unitname;?> ">grade</a> </td> -->
            </tr>
                
            
            <?php
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Side Nav</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidenav {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }

        .sidenav a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        .sidenav a:hover {
            background-color: #555;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the side navigation menu stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .sidenav {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidenav a {
                float: none;
                width: 100%;
            }
        }
        

table{
        width: 50%;
        margin-left: 30%;
        border-collapse: collapse;
        text-align: center;
    }
    th{
        background-color: lightblue;
        color: black;
    }
    table,th,td{
        border: 1px solid black;
        border-collapse: collapse;
    }
    </style>
</head>

<body>
    <div class="sidenav" style="">

        <a href="Addmin.php">Enrollment</a>
  <a href="performanceA.php">Performance</a>
  <a href="tdash.php">Dashboard</a> 
        <a href="teacherunits.php">Classes</a>
        <a href="tunits.php">Units</a>
        <a href="gradeAll.php">Grade</a>
    </div>

    <div class="main-content">
    <!-- <h1>welcome <?=$_SESSION['name'];?> </h1>         -->
        <h2>View Student  </h2>
            <p>Select your class to see  your students</p>
        <form action="tunits.php" method="post">
        <!-- <form action="grademystudents.php" method="get"> -->

            <select name="unitnamez" id="">

                <?php 
          include('testconnection.php');
          session_start();
          echo $_SESSION['name'];
          $sql="SELECT * FROM classes WHERE teacher='karunu kimeu' ";
          $stmt=$conns->prepare($sql);
          $stmt->execute();
          $result=$stmt->fetchAll(PDO::FETCH_OBJ);
          if($result){
            while($resultRow=$stmt->fetch()){
               array_push($unitsArray,$resultRow);
            //    echo "Unit Number : ".$row->name."<br>"; 
            }
                // array_push($unitsArray,$row);
                foreach($result as $row){
                    ?>
<option  > <?=$row->unitname;?> </option>
<?php
}
}



?>
<option value="all">all</option>
          </select>

                
            <input type="submit" name="fetcher" value="fetch">

        </form>
     
          
        
   









    </div>
</body>

</html>