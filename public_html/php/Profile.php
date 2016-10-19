<?php

/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 10/18/2016
 * Time: 11:20 AM
 */

/**
 * Small Cross Section of a WaniKani profile
 *
 * This is an example of how a WaniKani profile interacts with radicals
 *
 * @author Matthew Fisher <mfisher16@cnm.edu>
 * @version 1.0
 **/


namespace Edu\Cnm\mfisher16\DataDesign;

//No idea what to do with this at the moment
//require_once("autoload.php");

class Profile /*implements \JsonSerializable*/  {
	//source not yet included
	//use ValidateDate;

	/**
	 * id for this profile; this is the primary key
	 * @var int $userId
	 **/
	private $userId;
	/**
	 * The username; Unique
	 * @var string $username
	 **/
	private $username;
	/**
	 * The user's email; Unique
	 * @var string $userEmail
	 **/
	private $userEmail;
	/**
	 * the user's level;
	 * @var int $userLevel
	 **/
	private $userLevel;

	/**
	 * constructor for this profile
	 *
	 * @param int|null $newUserId id of this user
	 * @param string $newUsername string containing the username
	 * @param string $newUserEmail string containing the user's email
	 * @param int|null $newUserLevel int containing the user's level
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	**/
	public function __construct(int $newUserId = null, string $newUsername, string 	$newUserEmail, int $newUserLevel = null) {
		try {
			$this->setUserId($newUserId);
			$this->setUsername($newUsername);
			$this->setUserEmail($newUserEmail);
			$this->setUserLevel($newUserLevel);
		}
		catch(\InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, 			$invalidArgument));
		}
		catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		catch(\TypeError $typeError) {
			// rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		}
		catch(\Exception $exception) {
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for user id
	 *
	 * @return int|null value of user id
	 **/
	public function getUserId() {
		return($this->userId);
	}
	/**
	 * mutator method for user id
	 *
	 * @param int|null $newUserId new value of user id
	 * @throws \RangeException if $newUserId is not positive
	 * @throws \TypeError if $newUserId is not an integer
	 **/
	public function setUserId(int $newUserId = null) {
		// base case: if the User id is null, this a new User without a mySQL assigned 		id (yet)
		if($newUserId === null) {
			$this->userId = null;
			return;
		}

		// verify the User id is positive
		if($newUserId <= 0) {
			throw(new \RangeException("User id is not positive"));
		}

		// convert and store the User id
		$this->userId = $newUserId;
	}
	/**
	 * accessor method for username
	 *
	 * @return int value of username
	 **/
	public function getUsername() {
		return($this->username);
	}
	/**
	 * mutator method for username
	 *
	 * @param string $newusername new value of username
	 * @throws \InvalidArgumentException if $newusername is not a string or insecure
	 * @throws \RangeException if $newusername is > 32 characters
	 * @throws \TypeError if $newusername is not a string
	 **/
	public function setUsername(string $newUsername) {
		// verify the username is secure
		$newUsername = trim($newUsername);
		$newUsername = filter_var($newUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUsername) === true) {
			throw(new \InvalidArgumentException("username is empty or insecure"));
		}

		// verify the username will fit in the database
		if(strlen($newUsername) > 32) {
			throw(new \RangeException("username is too large"));
		}

		// store the username
		$this->username = $newUsername;
	}
	/**
	 * accessor method for user email
	 *
	 * @return int value of user email
	 **/
	public function getUserEmail() {
		return($this->userEmail);
	}
	/**
	 * mutator method for user email
	 *
	 * @param string $newUserEmail new value of user email
	 * @throws \InvalidArgumentException if $newUserEmail is not a string or insecure
	 * @throws \RangeException if $newUserEmail is > 128 characters
	 * @throws \TypeError if $newUserEmail is not a string
	 **/
	public function setUserEmail(string $newUserEmail) {
		// verify the user email is secure
		$newUserEmail = trim($newUserEmail);
		$newUserEmail = filter_var($newUserEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUserEmail) === true) {
			throw(new \InvalidArgumentException("user email is empty or insecure"));
		}

		// verify the user email will fit in the database
		if(strlen($newUserEmail) > 128) {
			throw(new \RangeException("user email is too large"));
		}

		// store the username
		$this->userEmail = $newUserEmail;
	}
	/**
	 * accessor method for user level
	 *
	 * @return int|null value of user level
	 **/
	public function getUserLevel() {
		return($this->userLevel);
	}
	/**
	 * mutator method for user level
	 *
	 * @param int|null $newUserLevel new value of user level
	 * @throws \RangeException if $newUserLevel is not positive
	 * @throws \TypeError if $newUserLevel is not an integer
	 **/
	public function setUserLevel(int $newUserLevel = null) {
		// base case: if the User level is null, this a new User without a mySQL assigned 		id (yet)
		if($newUserLevel === null) {
			$this->userLevel = null;
			return;
		}

		// verify the User level is positive
		if($newUserLevel <= 0) {
			throw(new \RangeException("User level is not positive"));
		}

		// convert and store the User level
		$this->userLevel = $newUserLevel;
	}

	/**
	 * inserts this Profile into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) { //PDO is a class that represents a db connection
		// enforce the userId is null (i.e., don't insert a user id that already exists)
		if($this->userId !== null) {
			throw(new \PDOException("not a user id"));
		}

		// create query template
		$query = "INSERT INTO Profile(userId, username, userEmail, userLevel) VALUES(:userId, :username, :userEmail, :userLevel)"; //wtf is : for?
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["userId" => $this->userId, "username" => $this->username, "userEmail" => $this->userEmail, "userLevel" => $this->userLevel];
		$statement->execute($parameters);

		// update the null userId with what mySQL just gave us
		$this->userId = intval($pdo->lastInsertId());
	}
	/**
	 * deletes this Profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// enforce the user id is not null (i.e., don't delete a profile that hasn't been inserted)
		if($this->userId === null) {
			throw(new \PDOException("unable to delete a user that does not exist"));
		}

		// create query template
		$query = "DELETE FROM `profile` WHERE userId = :tuserId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["userId" => $this->userId];
		$statement->execute($parameters);
	}
	/**
	 * updates this profile in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		// enforce the userId is not null (i.e., don't update a profile that hasn't been inserted)
		if($this->userId === null) {
			throw(new \PDOException("unable to update a profile that does not exist"));
		}

		// create query template
		$query = "UPDATE profile SET userId = :userId, username = :username, userEmail = :userEmail, userLevel = :userLevel WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["username" => $this->username, "userEmail" => $this->userEmail, "userLevel" => $this->userLevel, "userId" => $this->userId];
		$statement->execute($parameters);
	}
	/**
	 * gets the profile by username
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $username profile to search for
	 * @return \SplFixedArray SplFixedArray of profiles found -hrm
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfileByUsername(\PDO $pdo, string $username) {
		// sanitize the description before searching
		$username = trim($username);
		$username = filter_var($username, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($username) === true) {
			throw(new \PDOException("username is invalid"));
		}

		// create query template
		$query = "SELECT userId, username, userEmail, userLevel FROM profile WHERE username LIKE :username";
		$statement = $pdo->prepare($query);

		// bind the username to the place holder in the template
		$username = "%$username%";
		$parameters = ["username" => $username];
		$statement->execute($parameters);

		// build an array of profiles --- is this necessary? TODO
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$profiles = new Profile($row["userId"], $row["username"], $row["userEmail"], $row["userLevel"]);
				$profiles[$profiles->key()] = $profiles;
				$profiles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($profiles);
	}
	/**
	 * gets the profile by user email
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $userEmail profile to search for
	 * @return \SplFixedArray SplFixedArray of profiles found -hrm
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfileByUserEmail(\PDO $pdo, string $userEmail) {
		// sanitize the description before searching
		$userEmail = trim($userEmail);
		$userEmail = filter_var($userEmail, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($userEmail) === true) {
			throw(new \PDOException("userEmail is invalid"));
		}

		// create query template
		$query = "SELECT userId, userEmail, username, userLevel FROM profile WHERE userEmail LIKE :userEmail";
		$statement = $pdo->prepare($query);

		// bind the use email to the place holder in the template
		$userEmail = "%$userEmail%";
		$parameters = ["userEmail" => $userEmail];
		$statement->execute($parameters);

		// build an array of profiles
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$profiles = new Profile($row["userId"], $row["username"], $row["userEmail"], $row["userLevel"]);
				$profiles[$profiles->key()] = $profiles;
				$profiles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($profiles);
	}
	/**
	 * gets the profile by userId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $userId user id to search for
	 * @return profile|null profile found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfileByUserId(\PDO $pdo, int $userId) {
		// sanitize the userId before searching
		if($userId <= 0) {
			throw(new \PDOException("profile id is not positive"));
		}

		// create query template
		$query = "SELECT userId, username, userEmail, userLevel FROM profile WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		// bind the user id to the place holder in the template
		$parameters = ["userId" => $userId];
		$statement->execute($parameters);

		// grab the profile from mySQL
		try {
			$profile = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$profile = new Profile($row["userId"], $row["username"], $row["userEmail"], $row["userLevel"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($profile);
	}
	/**
	 * gets all profiles
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of profiles found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllProfiles(\PDO $pdo) {
		// create query template
		$query = "SELECT userId, userName, userEmail, userLevel FROM profile";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of profiles
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$profiles = new Profile($row["userId"], $row["username"], $row["userEmail"], $row["userLevel"]);
				$profiles[$profiles->key()] = $profiles;
				$profiles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($profiles);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	/*public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields[""] = $this->->getTimestamp() * 1000;
		return($fields);
	}
	*/

}

