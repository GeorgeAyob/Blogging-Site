<?php # Script 12.2 - login_functions.inc.php changed
// This page defines two functions used by the login/logout process.
/* This function determines an absolute URL and redirects the user there.
 * The function takes one argument: the page to be redirected to.
 * The argument defaults to index.php.
 */
function redirect_user1($page = 'index.php') {
	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');
	// Add the page:
	$url .= '/' . $page;
	// Redirect the user:
	header("Location: $url");
	exit(); // Quit the script.
} // End of redirect_user() function.
/* This function validates the form data (the email address and password).
 * If both are present, the database is queried.
 * The function requires a database connection.
 * The function returns an array of information, including:
 * - a TRUE/FALSE variable indicating success
 * - an array of either errors or the database result
 */
function check_login1($dbc, $email = '', $pass = '') {
	$errors = []; // Initialize error array.
	// Validate the email address:
	if (empty($email)) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($email));
	}
	// Validate the password:
	if (empty($pass)) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($pass));
	}
	
	
	if (empty($errors)) { // If everything's OK.
		// Retrieve the user_id and first_name for that email/password combination:
		 $p = SHA2($p);
		 $query = "SELECT user_id, first_name FROM users WHERE email=? AND pass=?";
		 $stmt = $dbc -> prepare($query);
  $stmt->bind_param('ss',$email,$p);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($user_id, $first_name);
  
	if ($stmt->num_rows >0)
	{
		$stmt->fetch();
		$data = array('user_id'=>$user_id,'first_name'=>$first_name);
		return [true,$data];
			
	}
 else { // Not a match!
			$errors[] = 'The email address and password entered do not match those on file.';
		}
	}
	return [false,$errors];
} // End of check_login() function.
