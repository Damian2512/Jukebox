<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'action/loginHead.php';?>
    </head>

    <body style="overflow-y: hidden !important; ">
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-2 text">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login op deze website</h3>
                            		<p>Vul uw e-mail en wachtwoord in om in te loggen:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            
                            <div class="form-bottom">
                                <div id="registerForm">
                                    <?php include 'action/register.php' ?>
                                </div>
                                <div id="loginForm">
                                    <?php include 'action/loginform.php' ?>
                                </div>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>

</html>