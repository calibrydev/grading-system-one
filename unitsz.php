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
        border-collapse: collapse;
    }
    th{
        background-color: lightblue;
        color: black;
      }
    table,th,td{
        border: 1px solid black;
        border-collapse: collapse;
        padding: 6px;
        text-align: center;
    }

  </style>
</head>
<body>
  <div class="sidenav">
    <a href="dashboardstudent.php">Dashboard</a>
    <a href="newprinter.php">Performance</a>
    <a href="unitsz.php">My units</a>
    <!-- <a href="fee.php">financials</a> -->
  </div>
  
  <div class="main-content">
    <h2>Enrolled Units</h2>
 

      <table>
        <tr>

          <th>teacher</th>
          <th>
            unitname
          </th>
        </tr>
        <?php 
    include('testconnection.php');
    session_start();
        $adm=$_SESSION['adm'];
        // $teacherz=$_POST['unitnamez'];
//         $sql="  SELECT sd.student_name, e.adm, e.unit
// FROM studentdetails sd
// JOIN enrolled e ON sd.admission_number = e.admission_number;
//         ";
        $sqllz="SELECT sd.name, d.adm
        FROM studentdetails sd
        JOIN enrolled d ON sd.adm =d.adm ";
        $stmtzz=$conns->prepare($sqllz);
        $stmtzz->execute();
        $rezolts=$stmtzz->fetchAll(PDO::FETCH_OBJ);
        echo "Name : ".$rezolts[0]->name." ADM : ".$rezolts[0]->adm." The following are your units ";
        foreach ($rezolts as $key) {
        }

     

        $sql="SELECT * FROM enrolled WHERE adm=:unitnamez ";
        // $sql="SELECT * FROM enrolled WHERE adm=:unitnamez INNER JOIN (SELECT * FROM studentdeatils WHERE adm=:unitnamez) ON enrolled.unitname=unitss.unitname ";
        $stmt=$conns->prepare($sql);
        $data=[
        ':unitnamez'=>$adm
    ];
    $stmt->execute($data);
    $result=$stmt->fetchAll(PDO::FETCH_OBJ);
    if($result){
        foreach($result as $row){
            ?>
            <tr>
            <td> <?=$row->teacher;?> </td> 

            <td>   <?=$row->unitname;?>  </td>
            </tr>
                
            
            <?php
        }
}


?>
      </table>









  </div>
</body>
</html>
