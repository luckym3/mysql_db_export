<?php

/*

Useful to export mysql database from places where no phpmyadmin (or similar app) nor ssh access available
Simply upload to web accessible directory and call it from your browser
!!! REMOVE !!! it from server when you are done 

*/



    /**
    *
    * Used to avoid PHP Notice exception
    * @param string key for POST array
    * @return mixed Either POST data or false
    *
    */
    function checkpost($val)
    {
	if (isset($_POST[$val]) )
	{
	    return $_POST[$val];
	}
	else
	{
	    return false;
	}
    }


    if ( isset($_POST['Submit']) )
    {
	header("Content-Disposition: attachment; filename=".checkpost('database').".sql");
	header("Content-type: text/x-sql");
	passthru("mysqldump -u".checkpost('username')."  -p".checkpost('password')." --databases ".checkpost('database') );
    }



?>

<!DOCTYPE HTML>
    <head>
	<style>
	    body {
		font-family: Arial;
		font-size: 12pt;
	    }
	
	    input {
		border: #CCCCCC 1px solid;
	    }
	    
	    .container {
		margin: auto;
		border: #000000 1px solid;
		height: 205px;
		width: 300px;
	    }
	    
	    .wrapper {
		padding-top: 10px;
		width: 61%;
		margin: auto;
	    }
	</style>
    </head>
    <body>
	<div class="container">
	    <div class="wrapper">
		<form method="POST">
		    <label for="username">Username</label> <input type="text" id="username" name="username" value="<?php echo checkpost('username') ?>"> <br><br>
		    <label for="password">Password</label> <input type="text" id="password" name="password" value="<?php echo checkpost('password') ?>"> <br></br>
		    <label for="database">Database</label> <input type="text" id="database" name="database" value="<?php echo checkpost('database') ?>">
		    <br><br>
		    <input type="submit" name="Submit" value="Submit">
		</form>
	    </div>
	</div>
    </body>
</html>