CREATE TABLE IF NOT EXISTS user (
	idProfil 		INTEGER,
	login 			VARCHAR(20),
	isAdmin			BOOLEAN,
	isModerator		BOOLEAN,
	isProfessor		BOOLEAN,
	password		VARCHAR(255),
	user			VARCHAR(255),
	token			VARCHAR(255),
	/* class cf user_class */
	/* domaine cf user_domain */
	PRIMARY KEY (idProfil)
);

CREATE TABLE IF NOT EXISTS evaluation (
	idEvaluation    INTEGER,
	refUser			INTEGER,
	label			VARCHAR(255),  /* Question existenciel */
	description		TEXT,	/* Qui est arrivé en premier, l'oeuf ou la poule ? */
	time			VARCHAR(255),

	PRIMARY KEY (idEvaluation)
);

CREATE TABLE IF NOT EXISTS questions (
	idQuestion		INTEGER,
	refEvaluation	INTEGER,
	title			VARCHAR(255), /* Quelle est le meilleur prof d'informatique du monde ? */
	note			INTEGER, 	/* 5 */
	taxoPrincipal	INTEGER, /* 0= CN, 1= CP, AP= 2, SY=3 */
	refItem1		INTEGER,
	refItem2	    INTEGER,

	PRIMARY KEY (idQuestion)
);

CREATE TABLE IF NOT EXISTS answer (
	idAnswer		INTEGER,
	refUser			INTEGER,
	refEvaluation   INTEGER,
	note     		TEXT,

	PRIMARY KEY (idAnswer)
);

/*
Item de connaissance : https://docs.google.com/spreadsheet/ccc?key=0AiLqRPkYo7F_dDF4TDRsSEgtdFRjbG1rZkZFcDc0RUE&usp=sharing#gid=0
*/
CREATE TABLE IF NOT EXISTS connaissance (
	idConnaissance 	INTEGER,
	refDomain		INTEGER,
	refTheme		INTEGER,
	lvl				INTEGER, 	/* lvl 9 */
	item		 	TEXT,		/* Les conducteurs sont parcourus par un courant sans avoir de tension à leurs bornes car les conducteurs ne consomment pas d'énergie électrique. */

	PRIMARY KEY (idConnaissance)
);

CREATE TABLE IF NOT EXISTS class (
	idClass	    	INTEGER,
	value		 	VARCHAR(10), /* 2nd5 , TBTS STI, ... */

	PRIMARY KEY (idClass)
);

CREATE TABLE IF NOT EXISTS domain (
	idDomain    	INTEGER,
	domainValue		VARCHAR(50), /* Math, Physique, Chimie, SVT */

	PRIMARY KEY (idDomain)
);

CREATE TABLE IF NOT EXISTS theme (
	idTheme     	INTEGER,
	themeValue		VARCHAR(50), /* Electricité statique, Circuit électrique */

	PRIMARY KEY (idTheme)
);
/**
	Association user/class (la partie gestion par le prof uniquement sera gerer dans l'interface web)
*/
CREATE TABLE IF NOT EXISTS user_class (
	idUserClass		INTEGER,
	refUser			INTEGER,
	refClass		INTEGER,

	PRIMARY KEY (idUserClass)
);
/**
	Association user/domain
*/
CREATE TABLE IF NOT EXISTS user_domain (
	idUserDomain	INTEGER,
	refUser			INTEGER,
	refDomain		INTEGER,

	PRIMARY KEY (idUserDomain)
);

INSERT INTO user VAlUES (null,'admin','1','1','0','d033e22ae348aeb5660fc2140aec35850c4da997','Administrateur', '');
INSERT INTO user VAlUES (null,'mod','0','1','0','7dd30f0a95d522bfc058be4e75847f8b6df9f76b','Moderator', '');
INSERT INTO user VAlUES (null,'prof','0','0','1','d9f02d46be016f1b301f7c02a4b9c4ebe0dde7ef','Professor', '');
INSERT INTO user VAlUES (null,'eleve','0','0','0','0e9a7fdc4821370a252df21582a4a656e81e0687','Eleve', '');
INSERT INTO user VAlUES (null,'thehawk','1','1','1','4438ce731657057ba02736526d2018bfac7d4971','Julien le meilleur prof du monde ;D', '');

INSERT INTO class VAlUES (null, '1°L');
INSERT INTO class VAlUES (null, '1°S');
INSERT INTO class VAlUES (null, '1°ES');
INSERT INTO class VAlUES (null, 'T°L');
INSERT INTO class VAlUES (null, 'T°S');
INSERT INTO class VAlUES (null, 'T°ES');

INSERT INTO user_class VAlUES (null, 1, 1);
INSERT INTO user_class VAlUES (null, 1, 2);
INSERT INTO user_class VAlUES (null, 1, 3);
INSERT INTO user_class VAlUES (null, 2, 4);
INSERT INTO user_class VAlUES (null, 2, 5);
INSERT INTO user_class VAlUES (null, 2, 6);

INSERT INTO domain VAlUES (1, 'electricte');
INSERT INTO domain VAlUES (2, 'physique');
INSERT INTO domain VAlUES (3, 'optique');
INSERT INTO domain VAlUES (4, 'chimie');
INSERT INTO domain VAlUES (5, 'thermo-dynamique');
INSERT INTO domain VAlUES (6, 'mathematique');
INSERT INTO domain VAlUES (7, 'general');

INSERT INTO user_domain VAlUES(null , 1 , 1);
INSERT INTO user_domain VAlUES(null , 1 , 2);
INSERT INTO user_domain VAlUES(null , 2 , 3);
INSERT INTO user_domain VAlUES(null , 2 , 4);