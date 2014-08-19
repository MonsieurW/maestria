CREATE TABLE IF NOT EXISTS user (
	idProfil 		INTEGER,
	login 			VARCHAR(20),
	isAdmin			BOOLEAN,
	isModerator		BOOLEAN,
	isProfessor		BOOLEAN,
	password		VARCHAR(255),
	user			VARCHAR(255),
	class			VARCHAR(255),
	domain			VARCHAR(255),
	PRIMARY KEY (idProfil)
);

CREATE TABLE IF NOT EXISTS task (
	idTask			INTEGER,
	refUser			INTEGER,
	label			VARCHAR(255),
	description		TEXT,
	PRIMARY KEY (idTask)
);

CREATE TABLE IF NOT EXISTS questions (
	idQuestion		INTEGER,
	title			VARCHAR(255),
	note			INTEGER,
	taxoPrincipal	INTEGER,
	taxoSecondaire	INTEGER,
	refPrincipal	INTEGER,
	refSecondaire   INTEGER,
	PRIMARY KEY (idQuestion)
);

CREATE TABLE IF NOT EXISTS connaissance (
	idConnaissance 	INTEGER,
	value		 	TEXT,
	cn 				VARCHAR(20),
	cp 				VARCHAR(20),
	ap 				VARCHAR(20),
	sy 				VARCHAR(20),
	PRIMARY KEY (idConnaissance)
);

INSERT INTO user VAlUES (null,'admin','1','1','1','d033e22ae348aeb5660fc2140aec35850c4da997','Administrateur','','');
INSERT INTO user VAlUES (null,'thehawk','1','1','1','4438ce731657057ba02736526d2018bfac7d4971','Julien le meilleur prof du monde ;D','2°K|2°L','Math|Anglais');