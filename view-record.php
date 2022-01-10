<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname ='userDB';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    
    if(! $conn ) {
       die('Could not connect: ' . mysqli_error($conn));
    }
    
    mysqli_select_db($conn,$dbname);

 #   if () {
        $sql = 'SELECT * FROM userDetails ORDER BY userID DESC LIMIT 1';
 #   }
    
    $result = mysqli_query($conn,$sql);
    
    if(! $result ) {
       die('Could not get data: ' . mysqli_error($conn));
    }
    
    $row = mysqli_fetch_assoc($result);
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="/dashboard/style.css">
        <title>View Record</title>
    </head>
    <body class="body2">
        <h1 class="formH">View Record</h1>
        <div class="container theForm">
            <div class="row mb-3">
                <label for="Name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10 divi" id="firstDivi">
                    <p>

                        <?php 
                        
                            echo $row['userName'];
                        
                        ?>

                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="Email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10 divi">
                    <p>

                        <?php 
                        
                            echo $row['userEmail'];
                        
                        ?>

                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="Gender" class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10 divi">
                    <p>

                        <?php 
                        
                            echo $row['userGender'];
                        
                        ?>

                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2 divi">
                    <p>

                        <?php 
                        
                            if ($row['userMailStatus'] == "yes") {
                                echo "You will recieve e-mails from us.";
                            } else {
                                echo "You won't recieve e-mails from us.";
                            }
                        
                        ?>

                    </p>
                </div>
            </div>
            <button type="button" class="btn btn-cancel btn-back" onclick="window.location.href = 'user-details.php'">Back</button>
        </div>
        <button type="button" class="btn btn-primary btn-add2" onclick="window.location.href = 'user-registration-form.php'">Add Another User</button>
    </body>
</html>