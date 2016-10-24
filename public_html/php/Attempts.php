<?php

/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 10/18/2016
 * Time: 11:20 AM
 */

/**
 * Small Cross Section of a WaniKani attempt (a user attempting to guess a radical)
 *
 * This is an example of how a WaniKani profile interacts with radicals
 *
 * @author Matthew Fisher <mfisher16@cnm.edu>
 * @version 1.0
 **/


namespace Edu\Cnm\mfisher16\DataDesign;

//No idea what to do with this at the moment
//require_once("autoload.php");

class Attempts /*implements \JsonSerializable*/  {
	//source not yet included
	//use ValidateDate;

	/**
	 * attempts user id is the id for the user profile; this is a foreign key
	 * @var int $attemptsUserId
	 **/
	private $attemptsUserId;
	/**
	 * attempts radical id is the id for the radical; this is a foreign key
	 * @var int $attemptsRadicalId
	 **/
	private $attemptsRadicalId;
	/**
	 * Number of times the user has correctly guess the radical; 
	 * @var string $attemptsCorrect
	 **/
	private $attemptsCorrect;
	/**
	 * the time the radical was guessed;
	 * @var int $attemptsTimeTested
	 **/
	private $attemptsTimeTested;
	/**
	 * The username; Unique
	 * @var string $username
	 **/
	private $username;

	/**
	 * constructor for this profile
	 *
	 * @param int|null $newAttemptsUserId id of the user making the attempt
	 * @param int|null $newAttemptsRadicalId int containing the attempts radical id
	 * @param boolean $newAttemptsCorrect bool containing info on if the attempt was correct
	 * @param \DateTime|string|null $newAttemptsTimeTested timestamp from when the attempt was made
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newAttemptsUserId = null, int $newAttemptsRadicalId, bool $newAttemptsCorrect, $newAttemptsTimeTested = null) {
		try {
			$this->setAttemptsUserId($newAttemptsUserId);
			$this->setAttemptsRadicalId($newAttemptsRadicalId);
			$this->setAttemptsCorrect($newAttemptsCorrect);
			$this->setAttemptsTimeTested($newAttemptsTimeTested);
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
	 * accessor method for attempts user id
	 *
	 * @return int|null value of attempts user id
	 **/
	public function getAttemptsUserId() {
		return($this->attemptsUserId);
	}
	/**
	 * mutator method for attempts user id
	 *
	 * @param int|null $newAttemptsUserId new value of attempts user id
	 * @throws \RangeException if $newAttemptsUserId is not positive
	 * @throws \TypeError if $newAttemptsUserId is not an integer
	 **/
	public function setAttemptsUserId(int $newAttemptsUserId = null) {

		if($newAttemptsUserId === null) {
			$this->attemptsUserId = null;
			return;
		}

		// verify the attempts user id is positive
		if($newAttemptsUserId <= 0) {
			throw(new \RangeException("Attempts user id is not positive"));
		}

		// convert and store the attempts user id
		$this->attemptsUserId = $newAttemptsUserId;
	}
	/**
	 * accessor method for attemptsRadicalId
	 *
	 * @return int value of attemptsRadicalId
	 **/
	public function getAttemptsRadicalId() {
		return($this->attemptsRadicalId);
	}
	/**
	 * mutator method for attempts radical id
	 *
	 * @param string $newAttemptsRadicalId new value of attempts radical id
	 * @throws \InvalidArgumentException if $newAttemptsRadicalId is not an integer
	 * @throws \RangeException if $newAttemptsRadicalId is not positive
	 **/
	public function setAttemptsRadicalId(int $newAttemptsRadicalId = null) {

		if($newAttemptsRadicalId === null) {
			$this->attemptsRadicalId = null;
			return;
		}

		// verify the attempts radical id is positive
		if($newAttemptsRadicalId <= 0) {
			throw(new \RangeException("Attempts user id is not positive"));
		}

		// convert and store the attempts radical id
		$this->attemptsRadicalId = $newAttemptsRadicalId;
	}
	/**
	 * accessor method for attempts correct
	 *
	 * @return int value of attempts correct
	 **/
	public function getAttemptsCorrect() {
		return($this->attemptsCorrect);
	}
	/**
	 * mutator method for attempts correct
	 *
	 * @param string $newAttemptsCorrect new value of attempts correct
	 * @throws \InvalidArgumentException if $newAttemptsCorrect is not a bool
	 * @throws \RangeException if $newAttemptsCorrect is > 128 characters
	 * @throws \TypeError if $newAttemptsCorrect is not a string
	 **/
	public function setAttemptsCorrect(string $newAttemptsCorrect) {
		// verify the attempts correct is not empty
		if(empty($newAttemptsCorrect) === true) {
			if($newAttemptsCorrect != false || $newAttemptsCorrect != true) {
				throw(new \InvalidArgumentException("Attempts correct is empty or not a boolean"));
			}
		}

		// store the attemptsRadicalId
		$this->attemptsCorrect = $newAttemptsCorrect;
	}
	/**
	 * accessor method for time tested
	 *
	 * @return \DateTime|string|null for time radical was attempted
	 **/
	public function getUserLevel() {
		return($this->attemptsTimeTested);
	}
	/**
	 * mutator method for time tested
	 *
	 * @param \DateTime|string|null $newAttemptsTimeTested for time radical was attempted
	 * @throws \RangeException if $newAttemptsTimeTested is not positive
	 * @throws \TypeError if $newAttemptsTimeTested is not an integer
	 **/
	public function setAttemptsTimeTested($newAttemptsTimeTested = null) {
		// base case: if the User level is null, this a new User without a mySQL assigned 		id (yet)
		if($newAttemptsTimeTested === null) {
			$this->attemptsTimeTested = time();
			return;
		}

		//store timestamp for attempts time tested
		try {
			$newAttemptsTimeTested = self::validateTimestamp($newAttemptsTimeTested);
		}
		catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		}
		catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}

		// convert and store the User level
		$this->attemptsTimeTested = $newAttemptsTimeTested;
	}

	/**
	 * inserts this attempt into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforce the attemptsUserId is null (i.e., don't insert a user id that already exists)
		if($this->attemptsUserId !== null && $this->attemptsUserId !== null) {
			throw(new \PDOException("not a new attempt"));
		}

		// create query template
		$query = "INSERT INTO attempts(attemptsUserId, attemptsRadicalId, attemptsCorrect, attemptsTimeTested) VALUES(:attemptsUserId, :attemptsRadicalId, :attemptsCorrect, :attemptsTimeTested)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["attemptsUserId" => $this->attemptsUserId, "attemptsRadicalId" => $this->attemptsRadicalId, "attemptsCorrect" => $this->attemptsCorrect, "attemptsTimeTested" => $this->attemptsTimeTested];
		$statement->execute($parameters);

		// update the null attemptsUserId with what mySQL just gave us
		$this->attemptsUserId = intval($pdo->lastInsertId());
	}
	/**
	 * deletes this attempt from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// enforce the User Id/radical id is not null (i.e., don't delete an attempt that hasn't been inserted)
		if($this->attemptsUserId === null || $this->attemptsRadicalId === null || $this->attemptsTimeTested === null) {
			throw(new \PDOException("unable to delete an attempt that does not exist"));
		}

		// create query template
		$query = "DELETE FROM attempts WHERE attemptsUserId = :attemptsUserId AND attemptsRadicalId = :attemptsRadicalId AND attemptsTimeTested = :attemptsTimeTested";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["attemptsRadicalId" => $this->attemptsRadicalId, "attemptsCorrect" => $this->attemptsCorrect, "attemptsTimeTested" => $this->attemptsTimeTested, "attemptsUserId" => $this->attemptsUserId];
		$statement->execute($parameters);
	}
	/**
	 * updates this attempt in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		// enforce the attemptsUserId is not null (i.e., don't update an attempt that hasn't been inserted)
		if($this->attemptsUserId === null || $this->attemptsRadicalId === null || $this->attemptsTimeTested === null) {
			throw(new \PDOException("unable to update a profile that does not exist"));
		}

		// create query template
		$query = "UPDATE attempts SET attemptsUserId = :attemptsUserId, attemptsRadicalId = :attemptsRadicalId, attemptsCorrect = :attemptsCorrect, attemptsTimeTested = :attemptsTimeTested WHERE attemptsUserId = :attemptsUserId AND attemptsRadicalId = :attemptsRadicalId AND attemptsTimeTested = :attemptsTimeTested";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["attemptsRadicalId" => $this->attemptsRadicalId, "attemptsCorrect" => $this->attemptsCorrect, "attemptsTimeTested" => $this->attemptsTimeTested, "attemptsUserId" => $this->attemptsUserId];
		$statement->execute($parameters);
	}
	/**
	 * gets the attempts by attemptsRadicalId and attemptUserId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $attemptsRadicalId profile to search for
	 * @return \SplFixedArray SplFixedArray of profiles found -hrm
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAttemptsByUserIdAndRadicalId(\PDO $pdo, int $attemptsRadicalId, int $attemptsUserId) {

		if(empty($attemptsRadicalId) === true || empty($attemptsUserId)) {
			throw(new \PDOException("attemptsRadicalId is invalid"));
		}

		// create query template
		$query = "SELECT attemptsUserId, attemptsRadicalId, attemptsCorrect, attemptsTimeTested FROM attempts WHERE attemptsRadicalId LIKE :attemptsRadicalId";
		$statement = $pdo->prepare($query);

		// bind the attemptsRadicalId to the place holder in the template
		$attemptsRadicalId = "%$attemptsRadicalId%";
		$parameters = ["attemptsRadicalId" => $attemptsRadicalId];
		$statement->execute($parameters);

		$attempt = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$attempt = new Attempts($row["attemptsUserId"], $row["attemptsRadicalId"], $row["attemptsCorrect"], $row["attemptsTimeTested"]);
				$attempt[$attempt->key()] = $attempt;
				$attempt->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($attempt);
	}
	/**
	 * gets the attempt by user name
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $attemptsCorrect profile to search for
	 * @return \SplFixedArray SplFixedArray of profiles found -hrm
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAttemptsByUsername(\PDO $pdo, string $username) {
		// sanitize the description before searching
		$username = trim($username);
		$attemptsCorrect = filter_var($username, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($username) === true) {
			throw(new \PDOException("username is invalid"));
		}

		// create query template
		$query = "SELECT `profile`.userId, `profile`.username, `attempts`.attemptsUserId, `attempts`.attemptsCorrect, `attempts`.attemptsRadicalId, `attempts`.attemptsTimeTested FROM profile JOIN attempts ON `profile`.userId = `attempts`.attemptsUserId WHERE `profile`.username = :username";
		$statement = $pdo->prepare($query);

		// bind the use email to the place holder in the template
		$attemptsCorrect = "%$attemptsCorrect%";
		$parameters = ["attemptsCorrect" => $attemptsCorrect];
		$statement->execute($parameters);

		// build an array of profiles
		$attempt = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$attempt = new Attempts($row["attemptsUserId"], $row["attemptsRadicalId"], $row["attemptsCorrect"], $row["attemptsTimeTested"]);
				$attempt[$attempt->key()] = $attempt;
				$attempt->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($attempt);
	}

	/**
	 * gets all attempts
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of profiles found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllAttempts(\PDO $pdo) {
		// create query template
		$query = "SELECT attemptsUserId, attemptsRadicalId, attemptsCorrect, attemptsTimeTested FROM attempts";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of profiles
		$attempt = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$attempt = new Attempts($row["attemptsUserId"], $row["attemptsRadicalId"], $row["attemptsCorrect"], $row["attemptsTimeTested"]);
				$attempt[$attempt->key()] = $attempt;
				$attempt->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($attempt);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields[""] = $this->getTimestamp() * 1000;
		return($fields);
	}


}

$testAttempt = new Attempts(1, 1, 3, null);
