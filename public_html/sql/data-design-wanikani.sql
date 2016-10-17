
DROP TABLE IF EXISTS profile;
DROP TABLE IF EXISTS radocals;
DROP TABLE IF EXISTS attempts;

-- create profile table
CREATE TABLE profile (
	userId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userName varchar(32) NOT NULL,
	userEmail varchar(128) NOT NULL,
	userLevel INT UNSIGNED NOT NULL,
-- unique index
	UNIQUE(userId),
	UNIQUE(userEmail),
-- primary key
	PRIMARY KEY(profileId)
);
-- create radical table
CREATE TABLE radicals (
	radicalId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	radical varchar(32) NOT NULL,
	radicalCorrectThreshold INT UNSIGNED NOT NULL,
	RadicalLevel INT UNSIGNED NOT NULL,
	-- unique index
	UNIQUE(radical),
	-- primary key
	PRIMARY KEY(radicalId)
);
-- create attempts table
CREATE TABLE attempts (
	attemptsUserId INT UNSIGNED NOT NULL,
	attemptsRadicalId INT UNSIGNED NOT NULL,
	attemptsCorrect INT UNSIGNED NOT NULL,
	attemptsTimetested TIMESTAMP NOT NULL,
	-- index of foreign keys
	INDEX(attemptsUserId),
	INDEX(attemptsRadicalId),
	-- foreign key relations
	FOREIGN KEY(attemptsUserId) REFERENCES profile(userId),
	FOREIGN KEY(attemptsRadicalId) REFERENCES radicals(radicalId),
	-- finally, create a composite foreign key with the two foreign keys
	PRIMARY KEY(attemptsUserId, attemptsRadicalId)
);