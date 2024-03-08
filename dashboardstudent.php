<?php 
session_start();
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
        border-collapse: collapse;
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
    <a href="dashboardstudent.php">Dashboard</a>
    <a href="newprinter.php">Performance</a>
    <a href="unitsz.php">My units</a>
    <!-- <a href="fee.php">financials</a> -->
  </div>
  
  <div class="main-content">
    <h2>Personal Details</h2>
    <h3>Welcome  <?php echo $_SESSION['adm'] ?> </h3><br>
    <table>

      <thead>
        <tr>
          <th>adm</th>
          <th>email</th>
          <th>satelite</th>
          <th>sem</th>
          <th>level</th>
          <th>edit</th>
        </tr>
      </thead>
      <tbody>
        
<?php 
    include('testconnection.php');
        $tid=$_SESSION['adm'];
       $sql="SELECT * FROM studentdetails WHERE adm=:tid ";
       $sqlz="SELECT * FROM enrolled WHERE adm=:tid ";

       $stmt=$conns->prepare($sql);
       $stmtz=$conns->prepare($sqlz);

       $data=[
        ':tid'=>$tid
       ];
       $stmt->execute($data);
       $stmtz->execute($data);
       $result2=$stmtz->fetchAll(PDO::FETCH_OBJ);
      if($result2){

          foreach($result2 as $rows){
              // echo "enrolled ".$rows->unitname."  ";
              
            }
        }
       $result=$stmt->fetchAll(PDO::FETCH_OBJ);
       if($result){
        foreach($result as $row){
            ?>
            <tr>

              <td><?=$row->adm;?> </td>
              <td><?=$row->email;?> </td>
              <td><?=$row->satelite;?> </td>
              <td><?=$row->semester;?> </td>
              <td><?=$row->satelite;?> </td>
              <td><a  href='editstudents.php?id=<?=$row->satelite;?>' >Edit</a> </td>


              
            </tr>
                

                <?php
        }
    }


?>
      
      </tbody>
    </table>










  </div>
</body>
</html>
