<!-- <?php

//     include('testconnection.php');    
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enroll'])) { 
//   // Prepare SQL statement to insert enrolled students into the enrollment table
//   $stmt = $conns->prepare("INSERT INTO enrolled (adm,unitname,teacher,unitcode,satelite,hours) VALUES (?,?,?,?,?,?)"); 
//   // Insert each selected student into the enrollment table
// //   foreach ($_POST['enroll'] as $student_id) {
// // } 
// $unit = $_POST['unite'];
//  $query="SELECT * FROM  classes WHERE unitname=:unit"; 
//   $stmtz=$conns->prepare($query);
//   // $stmt->bindParam(':unit',$unit);
//   $stmtz->execute([':unit'=>$unit]); 
//   $result=$stmtz->fetchAll(PDO::FETCH_OBJ);
//   foreach($result as $row){
//       $teacher=$row->teacher; 
//   $chours=$row->credithours;
//   $satelite=$row->satelite;
//   $unitcode=$row->unitcode;
//   }
// // $chours=$_POST['chours']; 
// $unit = $_POST['unite'];


// foreach ($_POST['enroll'] as $key => $value) {
//   $namecharge='units';
//   $student_id=$_POST['enroll'][$key];
//   $charge=1100;

//             $sqlzz = "INSERT INTO balances  (adm,name,charge) VALUES (?,?,?)"; 
//             $stmtzz=$conns->prepare($sqlzz); 
//             $stmtzz->execute([$student_id,$namecharge,$charge]);
//     $stmt->execute([$student_id,$unit,$teacher,$unitcode,$satelite,$chours]); 
//     // Bind parameters and execute the statement
// }

//   echo "Enrollment successful!";
// } else {
// //   echo "No students selected for enrollment!";
// }


//     if(isset($_POST['register'])){

          
//         foreach($_POST['unit'] as $adm){
//             // $unit=$_POST['unit'];
//             $unit=$_POST['unite'];
//             $sqle="SELECT * FROM classes WHERE unitname=:unitname";
//             $query=$conns->prepare($sqle);
//             $query->bindValue(":unitname", $unit);
//             $query->execute();
//             $result=$query->fetch(PDO::FETCH_OBJ);
//                     $teacher=$result->teacher;
//             $status="pending";
//             $namecharge='units';
//             $sqlzz = "INSERT INTO balances  (adm,name,charge) VALUES (?,?,?)"; 
//             $stmtzz=$conns->prepare($sqlzz); 
//             $stmtzz->execute([$adm,$namecharge,$charge]);
//             // $unitname="maths";
//             // adm	email	password	cpassword	address	phone	satelite	level	 
//             $sql="INSERT INTO `enrolled`(`adm`,`unitname`,`status`,`teacher`) VALUES (:adm,:unitname,:status,:teacher)";
//             $stmt=$conns->prepare($sql);
//             $stmt->execute(['adm'=>$adm,'unitname'=>$unit,'status'=>$status,'teacher'=>$teacher]); 
        
//             header('location:registerstudent.php');


//         }
     
//     }


?> -->
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

<div class="topnav">
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

<div class="sidenav">
  <a href="Addmin.php">Enrollment</a>
  <a href="performanceA.php">Performance</a>
  <a href="tdash.php">Dashboard</a> 
        <a href="teacherunits.php">Classes</a>
        <a href="tunits.php">Units</a>
        <a href="gradeAll.php">Grade</a>
</div>

<div class="content">
  <div class="search-container">  
  <form action="gradeAll.php" method="get">

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
//    <td>Unit Number : ".$row->name."<br>"; 
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















    <form action="gradeAllb.php" method="post">
        <?php
        // Include database connection
        include 'testconnection.php';
        if(isset($_GET['fetcher'])){ 
            $unit=$_GET['unitnamez'];
        // Fetch enrolled students from database
        $stmt = $conns->prepare("SELECT adm FROM enrolled WHERE unitname=:unit"); 
        $stmt->execute([':unit'=>$unit]);
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($students as $student) {
            echo "<div class='student'>";
            echo "Admission Number: " . $student['adm'] . "<br>";
            echo "<input type='number' name='project[]' placeholder='Project'>";
            // echo "<input type='number' name='cat2[]' placeholder='Cat 2'>";  
            echo "<input type='number' name='assignment1[]' placeholder='Assignment 1'>";
            // echo "<input type='number' name='assignment2[]' placeholder='Assignment 2'>";
            echo "<input type='number' name='final_exam[]' placeholder='Final Exam'>";
            echo "<input type='hidden' name='admission_number[]' value='" . $student['adm'] . "'>";
            
            echo "</div>";
        }
    }
        ?>
        <input type="hidden" name="unit" value="<?php echo $unit; ?>">
        <button type="submit" name="grade">Grade Students</button>
        <button type="reset">Reset</button>
    </form>







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
