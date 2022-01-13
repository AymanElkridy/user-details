<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="/style/style.css">
        <title>User Registration Form</title>
    </head>
    <body>
        <h1 class="formH">User Registration Form</h1>
        <form class="theForm" method="post" action="<?=($_SERVER['PHP_SELF'])?>">
            <div class="row mb-3">
                <label for="Name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="Email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" name="email">
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="radioFemale" value="Female">
                        <label class="form-check-label" for="Female">
                            Female
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="radioMale" value="Male">
                        <label class="form-check-label" for="Male">
                            Male
                        </label>
                    </div>
                </div>
            </fieldset>
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="agree" name="mailStatus">
                        <label class="form-check-label" for="Agree">
                            Recieve E-mails from us.
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-cancel" onclick="window.location.href = 'user-details.php'">Cancel</button>
        </form>
    </body>
</html>

<?php 

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'userDB';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

    $sql = "create database if not exists $dbname";
    $retval = mysqli_query($conn, $sql);

    if(! $retval ) {
        die('Could not create database: ' . mysqli_error($conn));
    }

    mysqli_select_db($conn, $dbname);

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

    $requestDone = false;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST['gender'])) {$gender = "undefined";}
        elseif ($_POST['gender'] == "Female") {$gender = "F";}
        elseif ($_POST['gender'] == "Male") {$gender = "M";}
        if (isset($_POST['mailStatus'])) {$mailStatus = "yes";}
        if (!isset($_POST['mailStatus'])) {$mailStatus = "no";}

        if (($_POST['name']) && ($_POST['email']) && (isset($_POST['gender']))) {
            $sql = 'INSERT INTO userDetails(userName, userEmail, userGender, userMailStatus)
            VALUES ("'. $_POST['name']. '","'. $_POST['email']. '","'. $gender. '","'. $mailStatus. '")';
            $requestDone = true;
            }

        $retval = mysqli_query($conn,$sql);
        if(! $retval ) {
            die('Could not insert to table: ' . mysqli_error($conn));
        }
    }

    mysqli_close($conn);
    if ($requestDone == true) {
        header("Location: /view-record.php");
    }

?>