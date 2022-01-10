<?php
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'userDB';
   $conn = mysqli_connect( $dbhost, $dbuser, $dbpass);

    if(! $conn ) {
        die('Could not connect: ' . mysqli_error($conn));
    }

   

    $sql = "create database if not exists $dbname";
    $retval = mysqli_query($conn, $sql);

    if(! $retval ) {
        die('Could not create database: ' . mysqli_error($conn));
    }

    mysqli_select_db( $conn,$dbname );

    $sql = 'CREATE TABLE IF NOT EXISTS userDetails( userID INT NOT NULL AUTO_INCREMENT,
    userName        VARCHAR(50) NOT NULL,
    userEmail       VARCHAR(50) NOT NULL,
    userGender      CHAR NOT NULL,
    userMailStatus  VARCHAR(3) NOT NULL,
    primary key ( userID ))';
 
    $retval = mysqli_query( $conn,$sql );
    
    if(! $retval ) {
       die('Could not create table: ' . mysqli_error($conn));
    }
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <link rel="stylesheet" href="/dashboard/style.css">
        <title>User Details</title>
    </head>
    <body class="body1">
    <div class="container">
        <div class="row">
            <div class="col-5 hCon">
                <h1 class="inlineH">User Details</h1>
            </div>
            <div class="col-2"></div>
            <div class="col-5 bCon">
                <button type="button" class="btn btn-primary add-btn" onclick="window.location.href = 'user-registration-form.php'">Add a New User</button>
            </div>
        </div>
        </div>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Mail Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                
                <?php 
                
                $sql = 'SELECT userID, userName, userEmail, userGender, userMailStatus FROM userDetails';
                $result = mysqli_query($conn,$sql);
                
                if(! $result) {
                   die('Could not get data: ' . mysqli_error($conn));
                }
             
             
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>
                                <td>". $row['userID'] ."</td>
                                <td>". $row['userName'] ."</td>
                                <td>". $row['userEmail'] ."</td>
                                <td>". $row['userGender'] ."</td>
                                <td>". $row['userMailStatus'] ."</td>
                                <td>
                                    <a href=''><i class='uil uil-eye'></i></a>
                                    <a href=''><i class='uil uil-edit-alt'></i></a>
                                    <a href=''><i class='uil uil-trash-alt'></i></a>
                                </td>
                            </tr>";
                   }
                }
                
                ?>

            </tbody>
        </table>
    </body>
</html>

<?php
mysqli_close($conn);
?>