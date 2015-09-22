<?php


class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private static $message = '';
	private static $enteredName = '';

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return void BUT writes to standard output and cookies!
	 */

	public function response($isLoggedIn) {
		if ($isLoggedIn) {
			$response = $this->generateLogoutButtonHTML(self::$message);
		} else {
			$response = $this->generateLoginFormHTML(self::$message, self::$enteredName);
		}
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message, $enteredName) {
		return '
			<form method="post"> 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $enteredName . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
	}
	
	public function didUserPressLogin() {
		return isset($_POST[self::$login]);
	}
	
	public function didUserPressLogout() {
		if (isset($_POST[self::$logout])) {
			$_SESSION['loggedIn'] = false;
			self::$message = 'Bye bye!';
		}
	}
	
	public function getUserName() {
		return $_POST[self::$name];
	}
	
	public function getPassword() {
		return $_POST[self::$password];
	}
	
	public function getMessageId() {
		return $_POST[self::$messageId];
	}
	
	public function setMessageId($id) {
		self::$messageId = $id;
	}
	
	public function setMessage($messageText) {
		self::$message = $messageText;
	}
	
}