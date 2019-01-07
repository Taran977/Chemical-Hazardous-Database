<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Hazardous Materials Database</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="assets/css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>
    <body>
        <div class="container">
            <div class="row text-center ">
                <div class="col-md-12">
                    <br /><br />
                    <h2>Hazardous Materials Database</h2>

                    <h5>( Login yourself to get access )</h5>
                    <br />
                </div>
            </div>
            <?php
            if (isset($_GET["invalid"]) && $_GET["invalid"] == 1)
                echo"<h2 align=center>Incorrect Information!</h2>";
            if (isset($_GET["invalid"]) && $_GET["invalid"] == 2)
                echo "<div class=blue style=text-align:center>Session Expired!</div>";
            ?>
            <div class="row ">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>   Enter Details To Login </strong>  
                        </div>
                        <div class="panel-body">
                            <form role="form" action="processlogin.php" method="post">
                                <br />
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                    <input type="text" required class="form-control" placeholder="Your Username " name="username"/>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" required class="form-control"  name="password" placeholder="Your Password" />
                                </div>
                                    <div class="form-group">
                                            
                                            <span class="pull-right">
                                                   <a href="forget_password.php" >Forget password ? </a> 
                                            </span>
                                        </div>

                                <input type="submit" name="submit" value="Login" class="btn btn-primary">&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="btn btn-primary">

                                        </form>
                                        </div>

                                        </div>
                                        </div> 
                                        </div>
                                        </div> 
                                        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
                                        <!-- JQUERY SCRIPTS -->
                                        <script src="assets/js/jquery-1.10.2.js"></script>
                                        <!-- BOOTSTRAP SCRIPTS -->
                                        <script src="assets/js/bootstrap.min.js"></script>
                                        <!-- METISMENU SCRIPTS -->
                                        <script src="assets/js/jquery.metisMenu.js"></script>
                                        <!-- CUSTOM SCRIPTS -->
                                        <script src="assets/js/custom.js"></script> 
                                        </body>
                                        </html>
