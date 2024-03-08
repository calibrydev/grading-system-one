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

th {
  background-color: lightblue;
  color: black;
}

table {
  width: 50%;
  border-collapse: collapse;
}

table,
th,
td {
  border: 1px solid black;
  padding: 6px;
  border-collapse: collapse;
}

/* Print-specific styles */
@media print {
  th,
  td {
    border: 1px solid black;
    padding: 6px;
    border-collapse: collapse;
  }
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
  
  <div class="main-content" id="printable">
    <h2>Manna Bible Insttitute</h2>
    <p>P.O.BOX 365 ,0051</p>
    <p>Ongata Rongai</p>
    <p>DIPLOMA BIBLE AND THEOLOGY</p>
    <p>NAME :</p>
    <p>ADM : <?$_SESSION['adm'];?></p>
    <button onclick="printTable()">print</button>
    <table >


      <thead>
        <tr>
          <th>Transcript Detail</th>
          <th>Start Date </th>
          <th>End Date</th>
          <th>Num Grade</th>
          <th>Ltr Grade</th>
          <th>Attempted hours </th>
          <th>Earned Hours </th>
          <th>Quality Points</th>
        </tr>
      </thead>
      <tbody>
        
<?php 
session_start();
    include('testconnection.php');
        $tid=$_SESSION['adm'];
       $sql="SELECT * FROM gradess WHERE adm=:tid ";
       $sqlz="SELECT * FROM enrolled WHERE adm=:tid ";

       $stmt=$conns->prepare($sql);
       $stmtz=$conns->prepare($sqlz);

       $data=[
        ':tid'=>$tid
       ];
       $stmt->execute($data);
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
        $result3=$gmt->fetch(PDO::FETCH_ASSOC);
     
      // Example usage:
      // $number = 9.777776;
      $echoz= $result3['SUM(weight)'];
      function formatFloatingPoint($number) {
        return number_format($number, 1);
      }
      
      $formattedNumber = formatFloatingPoint($echoz);
      // echo $echoz."<br>";
      // echo $formattedNumber;
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

              <td><?=$row->unit;?> </td>
              <td></td>
              <td></td>
              <td><?=$row->mark;?> </td>

              <td><?=$row->grade;?> </td>
              <td><?=$row->credithours;?> </td>
              <td><?=$row->credithours;?> </td>

              <td><?=$row->qpoints;?> </td>
            </tr>
                

                <?php
        }
    }


?>
      
      </tbody>
    </table>

    <p id="adm">  GPA  is <?=$gpaz;?> </p>





  </div>
  <script>
    let adm=document.getElementById('adm');
  function printTable() {
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Official Transcript</title>');
        printWindow.document.write('<div class="main-content" id="printable">');
    printWindow.document.write('<h2>Manna Bible Insttitute</h2>');
    printWindow.document.write('<p>P.O.BOX 365 ,0051</p>');
    printWindow.document.write('<p>Ongata Rongai</p>');
    printWindow.document.write('<p>DIPLOMA BIBLE AND THEOLOGY</p>');
    printWindow.document.write('<p>NAME :</p>');    
    printWindow.document.write('<p>ADM:</p>');    
    
    
    printWindow.document.write('<title>Official Transcript</title>');
    printWindow.document.write('<style>table {width: 100%;border-collapse: collapse;} th, td {border: 1px solid #ddd;padding: 8px;text-align: left;} th {background-color: #f2f2f2;}</style>');
    // printWindow.document.write('</div></head><body>');
    printWindow.document.write(document.querySelector('table').outerHTML);
    printWindow.document.write(adm.innerHTML);    
    printWindow.document.write('</div></body></html>');
    printWindow.document.close();
        printWindow.print();
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
})
        </script>
</body>
</html>
