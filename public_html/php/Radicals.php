<?php

/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 10/18/2016
 * Time: 11:20 AM
 */

/**
 * Small Cross Section of a WaniKani radical
 *
 * This is an example of how a WaniKani radical interacts with radicals
 *
 * @author Matthew Fisher <mfisher16@cnm.edu>
 * @version 1.0
 **/


namespace Edu\Cnm\mfisher16\DataDesign;

//No idea what to do with this at the moment
//require_once("autoload.php");

class Radicals /*implements \JsonSerializable*/  {
	//source not yet included
	//use ValidateDate;

	/**
	 * id for this radical; this is the primary key
	 * @var int $radicalId
	 **/
	private $radicalId;
	/**
	 * The radical; Unique
	 * @var string $radical
	 **/
	private $radical;
	/**
	 * The radical's level; Unique
	 * @var int $radicalLevel
	 **/
	private $radicalLevel;
	/**
	 * the number of times the radical must be correctly guessed to progress;
	 * @var int $radicalCorrectThreshold
	 **/
	private $radicalCorrectThreshold;

	/**
	 * constructor for this radical
	 *
	 * @param int|null $newRadicalId id of this user
	 * @param string $newRadical string containing the radical
	 * @param int|null $newRadicalLevel the radical's level
	 * @param int|null $newRadicalCorrectThreshold int containing the user's level
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newRadicalId = null, string $newRadical, string 	$newRadicalLevel, int $newRadicalCorrectThreshold = null) {
		try {
			$this->setRadicalId($newRadicalId);
			$this->setRadical($newRadical);
			$this->setRadicalLevel($newRadicalLevel);
			$this->setRadicalCorrectThreshold($newRadicalCorrectThreshold);
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
	 * accessor method for radical id
	 *
	 * @return int|null value of radical id
	 **/
	public function getRadicalId() {
		return($this->radicalId);
	}
	/**
	 * mutator method for radical id
	 *
	 * @param int|null $newRadicalId new value of radical id
	 * @throws \RangeException if $newRadicalId is not positive
	 * @throws \TypeError if $newRadicalId is not an integer
	 **/
	public function setRadicalId(int $newRadicalId = null) {
		// base case: if the radical id is null, this a new User without a mySQL assigned 		id (yet)
		if($newRadicalId === null) {
			$this->radicalId = null;
			return;
		}

		// verify the radical id is positive
		if($newRadicalId <= 0) {
			throw(new \RangeException("radical id is not positive"));
		}

		// convert and store the radical id
		$this->radicalId = $newRadicalId;
	}
	/**
	 * accessor method for radical
	 *
	 * @return int value of radical
	 **/
	public function getRadical() {
		return($this->radical);
	}
	/**
	 * mutator method for radical
	 *
	 * @param string $newRadical new value of radical
	 * @throws \InvalidArgumentException if $newRadical is not a string or insecure
	 * @throws \RangeException if $newRadical is > 32 characters
	 * @throws \TypeError if $newRadical is not a string
	 **/
	public function setRadical(string $newRadical) {
		// verify the radical is secure
		$newRadical = trim($newRadical);
		$newRadical = filter_var($newRadical, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newRadical) === true) {
			throw(new \InvalidArgumentException("radical is empty or insecure"));
		}

		// verify the radical will fit in the database
		if(strlen($newRadical) > 32) {
			throw(new \RangeException("radical is too large"));
		}

		// store the radical
		$this->radical = $newRadical;
	}
	/**
	 * accessor method for radical level
	 *
	 * @return int value of radical level
	 **/
	public function getRadicalLevel() {
		return($this->radicalLevel);
	}
	/**
	 * mutator method for radical level
	 *
	 * @param string $newRadicalLevel new value of radical level
	 * @throws \InvalidArgumentException if $newRadicalLevel is not a string or insecure
	 * @throws \RangeException if $newRadicalLevel is > 128 characters
	 * @throws \TypeError if $newRadicalLevel is not a string
	 **/
	public function setRadicalLevel(int $newRadicalLevel) {
		// base case: if the radical id is null, this a new User without a mySQL assigned 		id (yet)
		if($newRadicalLevel === null) {
			$this->radicalLevel = null;
			return;
		}

		// verify the radical id is positive
		if($newRadicalLevel <= 0) {
			throw(new \RangeException("radical id is not positive"));
		}

		// store the radical
		$this->radicalLevel = $newRadicalLevel;
	}

	/**
	 * accessor method for radical correct threshold
	 *
	 * @return int|null value of radical correct threshold
	 **/
	public function getRadicalCorrectThreshold() {
		return($this->radicalCorrectThreshold);
	}
	/**
	 * mutator method for radical correct threshold
	 *
	 * @param int|null $newRadicalCorrectThreshold new value of radical correct threshold
	 * @throws \RangeException if $newRadicalCorrectThreshold is not positive
	 * @throws \TypeError if $newRadicalCorrectThreshold is not an integer
	 **/
	public function setRadicalCorrectThreshold(int $newRadicalCorrectThreshold = null) {
		// base case: if the radical correct threshold is null, this a new User without a mySQL assigned 		id (yet)
		if($newRadicalCorrectThreshold === null) {
			$this->radicalCorrectThreshold = null;
			return;
		}

		// verify the radical correct threshold is positive
		if($newRadicalCorrectThreshold <= 0) {
			throw(new \RangeException("radical correct threshold is not positive"));
		}

		// convert and store the radical correct threshold
		$this->radicalCorrectThreshold = $newRadicalCorrectThreshold;
	}

	/**
	 * inserts this Radicals into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) { //PDO is a class that represents a db connection
		// enforce the radicalId is null (i.e., don't insert a radical id that already exists)
		if($this->radicalId !== null) {
			throw(new \PDOException("not a radical id"));
		}

		// create query template
		$query = "INSERT INTO Radical(radicalId, radical, radicalLevel, radicalCorrectThreshold) VALUES(:radicalId, :radical, :radicalLevel, :radicalCorrectThreshold)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["radicalId" => $this->radicalId, "radical" => $this->radical, "radicalLevel" => $this->radicalLevel, "radicalCorrectThreshold" => $this->radicalCorrectThreshold];
		$statement->execute($parameters);

		// update the null radicalId with what mySQL just gave us
		$this->radicalId = intval($pdo->lastInsertId());
	}
	/**
	 * deletes this Radicals from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// enforce the radical id is not null (i.e., don't delete a radical that hasn't been inserted)
		if($this->radicalId === null) {
			throw(new \PDOException("unable to delete a user that does not exist"));
		}

		// create query template
		$query = "DELETE FROM radical WHERE radicalId = :tradicalId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["radicalId" => $this->radicalId];
		$statement->execute($parameters);
	}
	/**
	 * updates this radical in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		// enforce the radicalId is not null (i.e., don't update a radical that hasn't been inserted)
		if($this->radicalId === null) {
			throw(new \PDOException("unable to update a radical that does not exist"));
		}

		// create query template
		$query = "UPDATE radical SET radicalId = :radicalId, radical = :radical, radicalLevel = :radicalLevel, radicalCorrectThreshold = :radicalCorrectThreshold WHERE radicalId = :radicalId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["radical" => $this->radical, "radicalLevel" => $this->radicalLevel, "radicalCorrectThreshold" => $this->radicalCorrectThreshold, "radicalId" => $this->radicalId];
		$statement->execute($parameters);
	}
	/**
	 * gets the radical by radical
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $radical radical to search for
	 * @return \SplFixedArray SplFixedArray of radicals found -hrm
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getRadicalsByRadical(\PDO $pdo, string $radical) {
		// sanitize the description before searching
		$radical = trim($radical);
		$radical = filter_var($radical, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($radical) === true) {
			throw(new \PDOException("radical is invalid"));
		}

		// create query template
		$query = "SELECT radicalId, radical, radicalLevel, radicalCorrectThreshold FROM radical WHERE radical LIKE :radical";
		$statement = $pdo->prepare($query);

		// bind the radical to the place holder in the template
		$radical = "%$radical%";
		$parameters = ["radical" => $radical];
		$statement->execute($parameters);

		// build an array of radicals
		$radicals = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$radicals = new Radicals($row["radicalId"], $row["radical"], $row["radicalLevel"], $row["radicalCorrectThreshold"]);
				$radicals[$radicals->key()] = $radicals;
				$radicals->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($radicals);
	}
	/**
	 * gets the radical by radical level
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $radicalLevel radical to search for
	 * @return \SplFixedArray SplFixedArray of radicals found -hrm
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getRadicalsByRadicalLevel(\PDO $pdo, string $radicalLevel) {
		// sanitize the description before searching
		$radicalLevel = trim($radicalLevel);
		$radicalLevel = filter_var($radicalLevel, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($radicalLevel) === true) {
			throw(new \PDOException("radicalLevel is invalid"));
		}

		// create query template
		$query = "SELECT radicalId, radicalLevel, radical, radicalCorrectThreshold FROM radical WHERE radicalLevel LIKE :radicalLevel";
		$statement = $pdo->prepare($query);

		// bind the use email to the place holder in the template
		$radicalLevel = "%$radicalLevel%";
		$parameters = ["radicalLevel" => $radicalLevel];
		$statement->execute($parameters);

		// build an array of radicals
		$radicals = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$radicals = new Radicals($row["radicalId"], $row["radical"], $row["radicalLevel"], $row["radicalCorrectThreshold"]);
				$radicals[$radicals->key()] = $radicals;
				$radicals->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($radicals);
	}
	/**
	 * gets the radical by radicalId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $radicalId radical id to search for
	 * @return string radical matching the id
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getRadicalsByRadicalId(\PDO $pdo, int $radicalId) {
		// sanitize the radicalId before searching
		if($radicalId <= 0) {
			throw(new \PDOException("radical id is not positive"));
		}

		// create query template
		$query = "SELECT radicalId, radical, radicalLevel, radicalCorrectThreshold FROM radical WHERE radicalId = :radicalId";
		$statement = $pdo->prepare($query);

		// bind the radical id to the place holder in the template
		$parameters = ["radicalId" => $radicalId];
		$statement->execute($parameters);

		// grab the radical from mySQL
		try {
			$radical = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$radical = new Radicals($row["radicalId"], $row["radical"], $row["radicalLevel"], $row["radicalCorrectThreshold"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($radical);
	}
	/**
	 * gets all radicals
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of radicals found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllRadicals(\PDO $pdo) {
		// create query template
		$query = "SELECT radicalId, radical, radicalLevel, radicalCorrectThreshold FROM radical";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of radicals
		$radicals = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$radicals = new Radicals($row["radicalId"], $row["radical"], $row["radicalLevel"], $row["radicalCorrectThreshold"]);
				$radicals[$radicals->key()] = $radicals;
				$radicals->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($radicals);
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

$testRadical = new Radicals(null, "encodedradical", 3, 10);