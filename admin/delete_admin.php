<?php
  	/*
	 * License
	 
	 * Copyright 2015 DevWurm
	
	 * This file is part of order_system.

	 *  order_system is free software: you can redistribute it and/or modify
	    it under the terms of the GNU General Public License as published by
	    the Free Software Foundation, either version 3 of the License, or
	    (at your option) any later version.
	
	    order_system is distributed in the hope that it will be useful,
	    but WITHOUT ANY WARRANTY; without even the implied warranty of
	    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	    GNU General Public License for more details.
	
	    You should have received a copy of the GNU General Public License
	    along with order_system.  If not, see <http://www.gnu.org/licenses/>.
	
	    Diese Datei ist Teil von order_system.
	
	    order_system ist Freie Software: Sie können es unter den Bedingungen
	    der GNU General Public License, wie von der Free Software Foundation,
	    Version 3 der Lizenz oder (nach Ihrer Wahl) jeder späteren
	    veröffentlichten Version, weiterverbreiten und/oder modifizieren.
	
	    order_system wird in der Hoffnung, dass es nützlich sein wird, aber
	    OHNE JEDE GEWÄHRLEISTUNG, bereitgestellt; sogar ohne die implizite
	    Gewährleistung der MARKTFÄHIGKEIT oder EIGNUNG FÜR EINEN BESTIMMTEN ZWECK.
	    Siehe die GNU General Public License für weitere Details.
	
	    Sie sollten eine Kopie der GNU General Public License zusammen mit diesem
	    Programm erhalten haben. Wenn nicht, siehe <http://www.gnu.org/licenses/>.
*/

//get dependencies
	if (DIRECTORY_SEPARATOR == '\\') { //Windows Systems --> use ; as seperator
    	set_include_path(get_include_path().";../includes".";./includes"); //set include directory, so includes folder is available from every (sub)directory
	}
	else { //unix Systems --> use : as seperator
		set_include_path(get_include_path().":../includes".":./includes"); //set include directory, so includes folder is available from every (sub)directory
	}
   	include ('../includes/session.php');
   	if (!isset($__READ_CONFIG__)) { //check if read_config.php is already included
   		include('read_config.php'); //include config parsing library
	}
	
//Local function declarations

	
	function delete_admin() { //delete admin acoount from the database
		$config = read_config(); //read mysql config
		
		$db_link = mysqli_connect($config['mysql_host'], $config['mysql_user'], $config['mysql_password'], $config['mysql_database'], $config['mysql_port']); //connect to database
		if (!$db_link) { //handle connection error
			die("FEHLER: Verbindung zur Datenbank fehlgeschlagen!");
		}
		
		
		//send delete query to the database and return true at successfull and false at unsuccessfull handeling	
		if (!mysqli_query($db_link, "DELETE FROM admins WHERE user_name='".$_SESSION['admin_username']."'")) {
			return FALSE;
		}
		else {
			return TRUE;
		}
		mysqli_close($db_link);
	}
?>
<?php
// Execute deletion
if (!check_session('admin')) { //check if not logged in
		header('Location: ./index.php');
		exit();
	}
	else {
			if (delete_admin()) {
				?>
					<!DOCTYPE html>
					<html lang="en">
						<head>
							<meta charset="utf-8">
					
					
							<title>Order</title>
							<meta name="description" content="Löschen des Accounts">
							<meta name="author" content="DevWurm">
					
					
							<!-- Stylesheets -->
							<link rel="stylesheet" type="text/css" href="./css/body.css" />
							<link rel="stylesheet" type="text/css" href="./css/header.css" />
							
						</head>
					
						<body>
							<div>
								<header>
									<h1>Order</h1>
								</header>
					
								<div>							
									<h2>Account gelöscht!</h2>
									<a href="./index.php">Zur Registrierung!</a>
								</div>
					
								<footer>
									<p>
										order_system von DevWurm ist lizenziert unter GPL3 Lizenz
									</p>
								</footer>
							</div>
						</body>
					</html>
			<?php
				if(!isset($_SESSION['proof'])) {session_start(); $_SESSION['proof']=TRUE;} //start session if not started
				session_destroy();
			}
			else {
				die("FEHLER: Fehler beim Löschen des Accounts!");
			}		
		
}
?>