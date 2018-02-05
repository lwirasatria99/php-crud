<?php
    require 'database.php';

    if (!empty($_POST)) {
        $nameError = null;
        $emailError = null;
        $mobileError = null;

        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];

        $valid = true;
        if (empty($name)) {
            $nameError = "Please Enter Name";
            $valid = false;
        }
        if (empty($email)) {
            $emailError = "Please Enter Email";
            $valid = false;
        } else if ( !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Please Enter a Valid Email Address";
            $valid = false;
        }
        if (empty($mobile)) {
            $mobileError = "Please Enter Mobile Number";
            $valid = false;
        }

        // Insert Data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO customers (name,email,mobile) values(?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name, $email, $mobile));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3> Create a customer</h3>
            </div>

            <form class="form-horizontal" action="create.php" method="post">

                <div class="control-group <?php echo !empty($nameError) ? 'error':''; ?>">
                    <label class="control-label"> Name </label>
                    <div class="controls">
                        <input name="name" type="text" placeholder="Name" value="<?php echo !empty($name) ? $name:''; ?>">
                        <?php if (!empty($nameError)): ?>
                            <span class="help-inline"> <?php echo $nameError; ?> </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($emailError) ? 'error':''; ?>">
                    <label class="control-label"> Email Address </label>
                    <div class="controls">
                        <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email) ? $email:''; ?>">
                        <?php if (!empty($emailError)): ?>
                            <span class="help-inline"> <?php echo $emailError; ?> </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                    <label class="control-label">Mobile Number</label>
                    <div class="controls">
                        <input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
                        <?php if (!empty($mobileError)): ?>
                            <span class="help-inline"><?php echo $mobileError;?></span>
                        <?php endif;?>
                    </div>
                </div>

                <div class="form-actions">
                    <button class"btn btn-success" type="submit"> Create </button>
                    <a class="btn" href="index.php">Back </a>   
                </div>

            </form>
        </div>
    </div>
</body>

</html>