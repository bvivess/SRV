CREATE TABLE persones( 
	per_id INT NOT NULL,
	per_fname VARCHAR(50) NOT NULL,
	per_lname VARCHAR(50) NOT NULL,
	CONSTRAINT persones_PK PRIMARY KEY( per_id)
);

CREATE TABLE hobbies( 
	hob_id VARCHAR(3) NOT NULL,
	hob_description VARCHAR(50) NOT NULL,
	CONSTRAINT hobbies_PK PRIMARY KEY( hob_id)
);

CREATE TABLE hob_x_per( 
	hxp_per_id INT NOT NULL, 
	hxp_hob_id VARCHAR(3) NOT NULL,
	CONSTRAINT hob_x_per_PK PRIMARY KEY( hxp_per_id, hxp_hob_id ),
	CONSTRAINT hxp_per_FK FOREIGN KEY( hxp_per_id ) REFERENCES persones( per_id ),
	CONSTRAINT hxp_hob_FK FOREIGN KEY( hxp_hob_id ) REFERENCES hobbies( hob_id )
);

