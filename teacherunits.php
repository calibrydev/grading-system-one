
<?php 
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

    <!-- <table>
    <tr>
        <th>adm number</th>
        <th>grade</th>
    </tr> -->
        <?php 
    include('testconnection.php');
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
            ?>
            <!-- <tr> -->
            <!-- <td> <?=$row->adm;?> </td> -->
            <!-- <td> <a href="gradestudentz.php?adm=<?=$row->adm;?>&&unit=<?=$row->unitname;?> ">grade</a> </td> -->
            <!-- </tr> -->
                
            
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
        padding: 6px;
        border: 1px solid black;
        border-collapse: collapse;
    }
    </style>
</head>

<body>
    <div class="sidenav">
        <a href="tdash.php">Dashboard</a>
        <a href="teacherunits.php">Classes</a>
        <a href="tunits.php">Units</a>
        <a href="gradeAll.php">Grade</a>
        <a href="Addmin.php">Enrollment</a>
        <a href="performanceA.php">Performance</a>
        <a href="gradeAll.php">Grade</a>
    </div>

    <div class="main-content">
        <h2> My classes </h2>
        <form action="teacherunits.php" method="post">
            <!-- <select name="unitnamez" id=""> -->
                <table>
                    <tr> 
                        <th>Unitname</th>
                        <th>Satelite</th>
                    </tr>

                <?php 
          include('testconnection.php');
          $sql="SELECT * FROM classes WHERE teacher='kariku maina' ";
          $stmt=$conns->prepare($sql);
          $stmt->execute();
          $result=$stmt->fetchAll(PDO::FETCH_OBJ);
          if($result){
            while($resultRow=$stmt->fetch()){
               array_push($unitsArray,$resultRow);
               echo "Unit Number : ".$row->name."<br>"; 
            }
                // array_push($unitsArray,$row);
            foreach($result as $row){
    ?>
    <tr>

        <td> <?=$row->unitname;?>  </td>
        <td><?=$row->satelite;?> </td>
        <!-- <td><a href="enrollz.php?id=<?=$row->unitname;?>">Enroll</a></td> -->
    </tr>

<!-- <option  > <?=$row->unitname;?> </option> -->
<?php
}
}



          ?>
          <!-- </select> -->
          </table>



            <!-- <input type="submit" name="fetcher" value="fetch"> -->

        </form>
     
          
        
   









    </div>
</body>

</html>