<?php
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: dashboard.php");
        exit;
    }

    require_once "sql/db_credentials.php";
    $email = $password = "";
    $email_err = $password_err = $login_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["email"]))){
            $email_err = "Please enter e-mail.";
        } else{
            $email = trim($_POST["email"]);
        }

        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }

        if(empty($email_err) && empty($password_err)){
            $sql = "SELECT accountID, username, email, password FROM account WHERE email = :email";

            if($stmt = $pdo->prepare($sql)){

                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                $param_email = trim($_POST["email"]);

                if($stmt->execute()) {
                    if($stmt->rowCount() == 1){
                        if($row = $stmt->fetch()){
                            $accountID = $row["accountID"];
                            $username = $row["username"];
                            $hashed_password = $row["password"];
                            if($password == $hashed_password){
                                session_start();

                                $_SESSION["loggedin"] = true;
                                $_SESSION["accountID"] = $accountID;
                                $_SESSION["username"] = $username;

                                header("location: dashboard.php");
                            } else{
                                $login_err = "Invalid username or password.";
                            }
                        }
                    } else{
                        // Username doesn't exist, display a generic error message
                        $login_err = "Invalid username or password.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                unset($stmt);
            }
        }
        unset($pdo);
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome page!</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>


    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">BeUpToDate</h1>
                <p class="col-lg-10 fs-4">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">

                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" id="floatingInput" placeholder="name@example.com" name="email">
                        <label for="floatingInput">Email address</label>
                        <div class="invalid-feedback"><?= $email_err; ?></div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" id="floatingPassword" placeholder="Password" name="password">
                        <label for="floatingPassword">Password</label>
                        <div class="invalid-feedback"><?= $password_err; ?></div>
                    </div>

                    <?php
                    if(!empty($login_err)){
                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                    }
                    ?>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                    <hr class="my-4">
                    <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
                </form>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>