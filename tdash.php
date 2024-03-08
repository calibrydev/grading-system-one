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
        text-align: center;
    }

    th{
        background-color: lightblue;
        color: black;
      }
    table,th,td{
        border: 1px solid black;
        border-collapse: collapse;
        padding: 6px;
    }
    </style>
</head>

<body>
    <div class="sidenav">
        <a href="tdash.php">Dashboard</a>
        <a href="teacherunits.php">My Classes </a>
        <a href="Addmin.php">Enrollment</a>
         <a href="performanceA.php">Performance</a>
        <a href="tunits.php">Units</a>
        <a href="gradeAll.php">Grade</a>
    </div>

    <div class="main-content">
        <h2> TTeacher Details </h2>
        <table>

            <thead>
                <tr>
                    <th>name</th>
                    <th>email</th>
                    <th>Phone</th>
                    <th>address</th>
                </tr>
            </thead>
            <tbody>

                <?php
                session_start();
                include('testconnection.php');
                $tid = "123j";
                $sql = "SELECT * FROM teachers WHERE tid=:tid ";

                $stmt = $conns->prepare($sql);
                $data = [
                    ':tid' => $tid
                ];
                $stmt->execute($data);
           
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                if ($result) {
                    foreach ($result as $row) {
                ?>
                        <tr>

                            <td><?= $row->name; ?> </td>
                            <td><?= $row->email; ?> </td>
                            <td><?= $row->name; ?> </td>

                            <td><?= $row->email; ?> </td>

                        </tr>


                <?php
                    }
                }


                ?>

            </tbody>
        </table>
               <div>
                <p>Total Classes</p>

               </div> 








    </div>
</body>

</html>