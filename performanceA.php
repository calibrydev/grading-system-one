<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Layout</title>
  <link rel="stylesheet" href="admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    table{
        margin-left: 30%;
    }
    .print{
        display: block;
        margin-left: 20%;
        margin-top: 30px;
        }
        
        @media print {
    table {
    }
    th, td {
      border: 1px solid black !important;
      border-collapse: collapse !important;;
    }
}
.sidenav a:hover{
color: black;
}
.company-name button{
  display: none;
}
.navy{
  display: none;
}
  @media screen and (max-width: 600px) {
            table{
                margin-left: 10px;
                width: 100%;
            }
            .print{
                margin-top: 30px;
            }
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
        display: block;
    }
    .company-name h1{
      font-size: 1rem;
      margin-left: 0;
    }
    .company-name{
        display: flex;
        margin-top: 10px;
        flex-direction: row;
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
    #printable{
      width: 50%;
    }
    .table{
      width: 90%;
    }
          }
        
  </style>
</head>
<body>

<div class="topnav" id="nav">
  <div class="company-name">
    <h1 style=""> MANNA STUDENT MANAGEMENT SYSTEM </h1>
    <button  >Open </button>
  </div>
  <div class="navy">
  <a href="Addmin.php">Enrollment</a>
  <a href="performanceA.php">Performance</a>
  <a href="tdash.php">Dashboard</a> 
        <a href="teacherunits.php">Classes</a>
        <a href="tunits.php">Units</a>
        <a href="gradeAll.php">Grade</a>
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
          <div class="table">

  <table id="printable" style="margin-top:50px;">
  <!-- <button class="print" id="print" onclick="printData()">Print</button> -->

  <caption> Manna students transcripts </caption>
      <tr>
        <th>Adm</th>

        <th>unitname</th>
        <th>credithours</th>
        <th>grade</th>
        <!-- <th>Action</th> -->
      </tr>
       
      <?php 
session_start();
    include('testconnection.php');
        $tid=$_SESSION['adm'];
       $sql="SELECT * FROM gradess  ";
       $sqlz="SELECT * FROM enrolled WHERE adm=:tid ";

       $stmt=$conns->prepare($sql);
       $stmtz=$conns->prepare($sqlz);

       $data=[
        ':tid'=>$tid
       ];
       $stmt->execute();
       $stmtz->execute($data);
       $math="  SELECT SUM(weight)
FROM gradess
WHERE adm=:tid;
       ";
        $stmtzz = $conns->prepare("SELECT SUM(qpoints) AS total_sum FROM gradess WHERE adm=:tid");
        $stmtzc = $conns->prepare("SELECT SUM(credithours) AS total_sum FROM gradess WHERE adm=:tid");

    
        // Execute the query
        $stmtzz->execute($data);
        $stmtzc->execute($data);
        
        // Fetch the result
        $result1 = $stmtzz->fetch(PDO::FETCH_ASSOC);
        $result2 = $stmtzc->fetch(PDO::FETCH_ASSOC);

        $gpa=abs($result1['total_sum']);
        $credit=$result2['total_sum'];
          $qpointers =$result1['total_sum'];
          $ttcredit= $result2['total_sum'];

       $gpaz=$qpointers/$ttcredit;

        
        // Echo the sum value
        if ($result1) {
            // echo "Your GPA IS : " . $gpa;
        } else {
            echo "No rows found."; 
        }
       $gmt=$conns->prepare($math);
        $gmt->execute($data);
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
              <td><?=$row->unit;?> </td>
              <td><?=$row->mark;?> </td>
              <td><?=$row->grade;?> </td>
<!-- 
              <td>    
        <a href=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
        <a href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
      </td> -->

            </tr>
                

                <?php
        }
    }


?>






















     
    </thead>
    <tbody>
      <!-- Table content goes here -->
    </tbody>
  </table>
  </div>

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

  function printData()
{
   var divToPrint=document.getElementById("printable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
});
function open(){
  let nav=document.getElementById("nav");
  nav.style.height='100vh';
}
</script>

</body>
</html>
