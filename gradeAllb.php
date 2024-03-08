<?php
// Include database connection
include 'testconnection.php';

if (isset($_POST['grade'])) {
    // $cat1 = $_POST['cat1'];
    $project = $_POST['project'];
    $unit = $_POST['unit'];
    $assignment1 = $_POST['assignment1'];
    // $assignment2 = $_POST['assignment2'];
    $final_exam = $_POST['final_exam'];
    $admission_numbers = $_POST['admission_number'];
    foreach ($admission_numbers as $key => $adm) {
        // Convert input values to numeric types
        // $cat1_val = floatval($cat1[$key]);
        $project_val = floatval($project[$key]);
        $assignment1_val = floatval($assignment1[$key]);
        // $assignment2_val = floatval($assignment2[$key]);
        $final_exam_val = floatval($final_exam[$key]);

        // Calculate total mark
        $total_mark = $project_val + $assignment1_val + $final_exam_val;
        
        // Measure grade
        $grade = measureGrade($total_mark);
        $gradez = measureGrade($total_mark);
        $weigher=   weight($gradez);

        // Insert data into database table 'gradess'
        $stmt = $conns->prepare("INSERT INTO gradess (adm, unit,mark, grade,weight) VALUES (?,?,?, ?,?)");
        $stmt->execute([$adm,$unit,$total_mark, $grade,$weigher]);
        header('location:gradefinal.php');
    }
    // foreach ($admission_numbers as $key => $adm) {
    //     // Calculate total mark
    //     $total_mark = $cat1[$key] + $cat2[$key] + $assignment1[$key] + $assignment2[$key] + $final_exam[$key];
        
    //     // Measure grade
    //     $grade = measureGrade($total_mark);

    //     // Insert data into database table 'gradess'
    //     $stmt = $pdo->prepare("INSERT INTO gradess (adm, total_mark, grade) VALUES (?, ?, ?)");
    //     $stmt->execute([$adm, $total_mark, $grade]);
    // }
}

function measureGrade($total_mark) {
    // Your logic to measure the grade based on the total mark
    // Example grading logic:
  
    if ($total_mark >= 95&&$total_mark <=100) {
        return 'A';
    } elseif ($total_mark >= 89 && $total_mark <=94) {
        return 'A-';
    } elseif ($total_mark >= 84&&$total_mark <=89) {
        return 'B+';
    } elseif ($total_mark >=79 && $total_mark <=84) {
        return 'B';
    } 
    elseif ($total_mark >=75 && $total_mark <=79) {
        return 'B-';
    } 
    elseif ($total_mark >69 && $total_mark <=74) {
        return 'C+';
    } 
    elseif ($total_mark >64 && $total_mark <=69) {
        return 'C';
    } elseif ($total_mark >=59 && $total_mark <=65) {
        return 'C-';
    } elseif ($total_mark >=0 && $total_mark <=60) {
        return 'Fail';
    } 
    else {
        return 'Missing';
    }


}



function weight($gradez){
    $grade=$gradez;
    if($grade=='A'){
        return 4;
    }elseif($grade=='A-'){
        return 3.7;
    }
    elseif($grade=="B+"){
     return 3.3;
 }  elseif($grade=="B"){
     return 3;
 }       
    
    elseif($grade=="B-"){
        return 2.6;
    }elseif($grade=="C+"){
        return 2.3; 
    }
     elseif($grade=="C"){
          return 2;
     }
     elseif($grade=="C-"){
         return 1.7;
     }
     elseif($grade=="D+"){
         return 1.6;
     }
     elseif($grade=="D"){
         return 1.3;
     }
     elseif($grade=="D-"){
         return 1;
     }
     elseif($grade=="E"){
         return 2.0;
     }
     elseif($grade=="F"){
         return 0;
     }
     else{
         return 0;
     }

}







?>
