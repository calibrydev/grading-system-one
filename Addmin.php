<?php

    include('testconnection.php');
    
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enroll'])) {
  // Prepare SQL statement to insert enrolled students into the enrollment table
  $stmt = $conns->prepare("INSERT INTO enrolled (adm) VALUES (?)");


  // Insert each selected student into the enrollment table
  foreach ($_POST['enroll'] as $student_id) {
      $stmt->execute([$student_id]);
  } 

  echo "Enrollment successful!";
} else {
  echo "No students selected for enrollment!";
}


    if(isset($_POST['register'])){

          
        foreach($_POST['unit'] as $adm){
            // $unit=$_POST['unit'];
            $unit=$_POST['unite'];
            $sqle="SELECT * FROM classes WHERE unitname=:unitname";
            $query=$conns->prepare($sqle);
            $query->bindValue(":unitname", $unit);
            $query->execute();
            $result=$query->fetch(PDO::FETCH_OBJ);
                    $teacher=$result->teacher;
            $status="pending";
            // $unitname="maths";
            // adm	email	password	cpassword	address	phone	satelite	level	 
            $sql="INSERT INTO `enrolled`(`adm`,`unitname`,`status`,`teacher`) VALUES (:adm,:unitname,:status,:teacher)";
            $stmt=$conns->prepare($sql);
            $stmt->execute(['adm'=>$adm,'unitname'=>$unit,'status'=>$status,'teacher'=>$teacher]); 
    
        }
     
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Layout</title>
  <link rel="stylesheet" href="admin.css">
  <style>
    .table{
        margin-top: 40px;
    }
    .company-name button{
  display: none;
}
.navy{
  display: none;
}
  @media screen and (max-width: 600px) {
    .topnav{
        height: 10vh;
        display: flex;
        flex-direction: column;
        justify-content: start;
        overflow: hidden;
    }
    .topnav div{
        margin-bottom: 30px;
    }
    .company-name button{
        height: 50%;
    }
    .company-name button{
      display: block;
    }
      
  .sidenav a:hover {
    color: black;
  }
  .sidenav{
    margin-top: 50px;
  }

    .company-name h1{
      font-size: 1rem;
    }
    .company-name{
      display: flex;
      flex-direction: row;
      margin-top: 10px;
    }
    .navy{
        display: flex;
        flex-direction: column;
    }
    .search-container form {
        display: flex;
        flex-direction: column;
    }
    .search-container input::placeholder {
        text-align: center;
    }
    .search-container input {
        margin-bottom: 20px;
    }
    .search-container input[type=submit] {
        width: 50%;
        padding: 4px;
        margin-left: 77px;
    }

    .navy a{
        color: white;
        font-size: 1.6rem;
        padding: 10px;
        text-decoration: none;
    }
    .user-access{
        display: none;
    }
    .table{
        margin-top: 50px;
        margin-left: 0px;
    }
    .selecter{
        margin-left: 60px;
    }
}

  </style>
</head>
<body>

<div class="topnav" style="">
  <div class="company-name">
      <h1 style="font-size:20px;"> MANNA STUDENT MANAGEMENT SYSTEM </h1>
      <button>Open </button>
  </div>
  <div class="navy">
  <a href="Addmin.php">Enrollment</a>
  <a href="performanceA.php">Performance</a>
</div>
  <div class="user-access">
    <div id="userButton">
    <img src="user_3177440.png" alt="">
    <select name="" id="sel">
    <option value="teacher">teacher</option>
    <option value="student">student</option>

        <option value="Admin">Admin</option>
    </select>

</div>
    <div class="dropdown-content">
      <a href="#">Admin</a>
      <a href="#">Teacher</a>
      <a href="#">Student</a>
    </div>
  </div>
</div>

<div class="sidenav" style="margin-top:80px;">
  <a href="Addmin.php">Enrollment</a>
  <a href="performanceA.php">Performance</a>
  <a href="tdash.php">Dashboard</a> 
        <a href="teacherunits.php">Classes</a>
        <a href="tunits.php">Units</a>
        <a href="gradeAll.php">Grade</a>
</div>

<div class="content">
  <div class="search-container">
    
  <form action="Addmin.php" method="post">
            <input type="text" name="satelite" placeholder="satelite">
            <input type="text" name="level" placeholder="level">
            <input type="submit" name="fetch" value="fetch">

        </form>
  
</div>

<select name="unite" class="selecter">

<?php 
    include('testconnection.php');
    if(isset($_POST['fetch'])){
    $satelite=$_POST['satelite']; 
       $sql="SELECT * FROM classes where satelite=:satelite ";
       $stmt=$conns->prepare($sql);
        $data=[
        ':satelite' => $satelite,
        ];
       $stmt->execute($data);
       $result=$stmt->fetchAll(PDO::FETCH_OBJ);
       if($result){
        foreach($result as $row){
            ?>
                    <option value="<?=$row->unitname;?>"> <?=$row->unitname;?>    </option>
                
                <?php
        }
    }
}

?>
</select>
<?php
            // Include database connection file
         
            ?>
    <!-- <input type="submit" name="register" value="Enroll"> -->
<!-- </table> -->

</form>

<form action="Addmin.php" method="post" id="rgz">           
            <!-- <table method="post"  action>
            <tr>
                <th>Units</th>
            </tr> -->
                <table class="table">
                    <tr>
                        <th>adm</th>
                          <th>select</th>
                    </tr>
                    <form action="Addmin.php" method="post">
<?php       
    include('testconnection.php');
    if(isset($_POST['fetch'])){
       $level=$_POST['level'];
    //    $sem=$_POST['sem'];
       $satelite=$_POST['satelite'];
       $sql="SELECT * FROM studentdetails WHERE level=:level   && satelite=:satelite ";
       $stmt=$conns->prepare($sql);
       $data=[
        ':level' => $level,
        ':satelite'=>$satelite
       ];
       $stmt->execute($data);
       // Retrieve student data from the database
      //  $stmt = $conns->query("SELECT * FROM studentdetails");
       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
           echo "<tr>";
           echo "<td>" . htmlspecialchars($row['name']) . "</td>";
           echo "<td><input type='checkbox' name='enroll[]' value='" . $row['adm'] . "'></td>";
           echo "</tr>";
       }
        echo '<input type="submit" value="Enroll Selected Students">';
    echo '</form>';
       $unitsArray=array();
       $result=$stmt->fetchAll(PDO::FETCH_OBJ);
       if($result){
        while($resultRow=$stmt->fetch()){
           array_push($unitsArray,$resultRow);
           echo "Unit Number : ".$row->unitname."<br>"; 
        }
            // array_push($unitsArray,$row);
        foreach($result as $row ){
?>  
<tr>
    <td><?=$row->adm;?> </td>
    <td><?=$row->level;?> </td>
    <td><?=$row->satelite;?> </td>

</tr>

<input type="text" name="unit[]" value="<?=$row->adm;?>" hidden>

                
                <?php
        }
    }
}


?>

</table>

</div>

<script>
  document.getElementById("userButton").onclick = function() {
    document.querySelector(".dropdown-content").classList.toggle("show");
  }

  window.onclick = function(event) {
    if (!event.target.matches('#userButton')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
</script>

</body>
</html>
