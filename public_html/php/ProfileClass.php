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

class ProfileClass implements \JsonSerializable  {
	//source not yet included
	//use ValidateDate;

	/**
	 * id for this profile; this is the primary key
	 * @var int $userId
	 **/
	private $userId;
	/**
	 * The user name; Unique
	 * @var string $userName
	 **/
	private $userName;
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
	 * constructor for this Tweet
	 *
	 * @param int|null $newUserId id of this user
	 * @param string $newUserName string containing the username
	 * @param string $newUserEmail string containing the user's email
	 * @param int|null $newUserLevel int containing the user's level
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	**/
	public function __construct(int $newUserId = null, string $newUserName, string 	$newUserEmail, int $newUserLevel = null) {
		try {
			$this->setuserId($newUserId);
			$this->setUserName($newUserName);
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
	 * accessor method for user name
	 *
	 * @return int value of user name
	 **/
	public function getUserName() {
		return($this->userName);
	}
	/**
	 * mutator method for user name
	 *
	 * @param string $newUserName new value of user name
	 * @throws \InvalidArgumentException if $newUserName is not a string or insecure
	 * @throws \RangeException if $newUserName is > 32 characters
	 * @throws \TypeError if $newUserName is not a string
	 **/
	public function setUserName(string $newUserName) {
		// verify the user name is secure
		$newUserName = trim($newUserName);
		$newUserName = filter_var($newUserName, FILTER_SANITIZE_STRING);
		if(empty($newUserName) === true) {
			throw(new \InvalidArgumentException("user name is empty or insecure"));
		}

		// verify the user name will fit in the database
		if(strlen($newUserName) > 32) {
			throw(new \RangeException("user name is too large"));
		}

		// store the user name
		$this->userName = $newUserName;
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
	public function setUserName(string $newUserEmail) {
		// verify the user email is secure
		$newUserEmail = trim($newUserEmail);
		$newUserEmail = filter_var($newUserEmail, FILTER_SANITIZE_STRING);
		if(empty($newUserEmail) === true) {
			throw(new \InvalidArgumentException("user email is empty or insecure"));
		}

		// verify the user email will fit in the database
		if(strlen($newUserEmail) > 128) {
			throw(new \RangeException("user email is too large"));
		}

		// store the user name
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
		$query = "INSERT INTO profile(userId, userName, userEmail, userLevel) VALUES(:userId, :userName, :userEmail, :userLevel)"; //wtf is : for?
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["userId" => $this->userId, "userName" => $this->userName, "userEmail" => $this->userEmail, "userLevel" => $this->userLevel];
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
		// enforce the user id is not null (i.e., don't delete a tweet that hasn't been inserted)
		if($this->userId === null) {
			throw(new \PDOException("unable to delete a user that does not exist"));
		}

		// create query template
		$query = "DELETE FROM profile WHERE userId = :tuserId";
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
		// enforce the userId is not null (i.e., don't update a tweet that hasn't been inserted)
		if($this->userId === null) {
			throw(new \PDOException("unable to update a tweet that does not exist"));
		}

		// create query template
		$query = "UPDATE profile SET userId = :userLevel, userName = :userName, userEmail = :userEmail WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["userName" => $this->userName, "userEmail" => $this->userEmail, "userLevel" => $userLevel, "userId" => $this->userId];
		$statement->execute($parameters);
	}



}

