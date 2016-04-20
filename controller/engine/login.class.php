<?php
/**
* Blog Class
*/
class Login extends dbConnect
{
	public $loggedIn;

	function __construct(){
		$this->db_con = $this->connect();
	}

	public function login($username, $password)
	{
		$sql = sqlsrv_query($this->db_con, "SELECT * FROM employees WHERE emp_id='$username' AND pass_word='$password'",array(), array("Scrollable"=> SQLSRV_CURSOR_KEYSET));
		$sqlRow = sqlsrv_num_rows($sql);
		session_start();
		if ($sqlRow > 0){ // Checks if good
    		while ($rows = sqlsrv_fetch_object($sql)){

    		    $username = $rows->emp_id;

    		    $password = $rows->pass_word;

    		  	$_SESSION['name'] = $rows->Emp_Name;
    		  	$_SESSION['employeeid'] = $rows->emp_id;
    		  	$_SESSION['manager'] = $rows->Supervisor;
    		  	$_SESSION['company'] =$rows->Company;
    		  	$_SESSION['branch'] = $rows->Branch_Number;
    		  	$_SESSION['exempt'] = $rows->exempt_status;
    		  	$_SESSION['job_title'] = $rows->Job_Title;
    		  	$loggedIn = 1;
    		  	$_SESSION['loggedIn']= $loggedIn;
    		  	//$_SESSION['name']
    		    $return = header('location: timeSheet.php'); // Redirecting if login is good;
    		    $password = $rows->pass_word;
    		    #$return = "$username $password";
    		   // $return = header('location: timeSheet.php'); // Redirecting To Other Page

    		}
		}
		else
		{
			$loggedIn = 2;
			$_SESSION['loggedIn'] = $loggedIn;
		    $return = 'Invalid entry';

		}
		return($return);
	}
}
?>
