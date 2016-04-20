<?php
include_once __SITE_PATH . 'controller/engine/login.class.php';
Class loginController Extends baseController
{

	public function index()
	{
		if (isset($_POST['username'], $_POST['password']))
		{
			$loginClass = new Login();
			$username = $_POST['username'];
			$password = $_POST['password'];
			$login = $loginClass->login($username, $password);
		}
		#$this->registry->template->login = $login;
	    $this->registry->template->show('login');
	}
}
?>
