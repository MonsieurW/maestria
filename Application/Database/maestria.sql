CREATE TABLE IF NOT EXISTS user (
	idProfil 		INTEGER,
	login 			VARCHAR(20),
	isAdmin			BOOLEAN,
	isModerator		BOOLEAN,
	isProfessor		BOOLEAN,
	password		VARCHAR(255),
	user			VARCHAR(255),
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
/*
Item de connaissance : https://docs.google.com/spreadsheet/ccc?key=0AiLqRPkYo7F_dDF4TDRsSEgtdFRjbG1rZkZFcDc0RUE&usp=sharing#gid=0
*/
CREATE TABLE IF NOT EXISTS connaissance (
	idConnaissance 	INTEGER,
	refDomain		INTEGER,
	refTheme		INTEGER,
	type			INTEGER, 	/* Connaissance | Compétence */
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

INSERT INTO user VAlUES (null,'admin','1','1','1','d033e22ae348aeb5660fc2140aec35850c4da997','Administrateur');
INSERT INTO user VAlUES (null,'thehawk','1','1','1','4438ce731657057ba02736526d2018bfac7d4971','Julien le meilleur prof du monde ;D');

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

INSERT INTO domain VAlUES (null, 'math');
INSERT INTO domain VAlUES (null, 'svt');
INSERT INTO domain VAlUES (null, 'physique');
INSERT INTO domain VAlUES (null, 'chimie');

INSERT INTO user_domain VAlUES(null , 1 , 1);
INSERT INTO user_domain VAlUES(null , 1 , 2);
INSERT INTO user_domain VAlUES(null , 2 , 3);
INSERT INTO user_domain VAlUES(null , 2 , 4);