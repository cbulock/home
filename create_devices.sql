CREATE TABLE devices(
	id INTEGER PRIMARY KEY,
	name TEXT,
	hostname TEXT,
	ip_address TEXT,
	mac_address TEXT,
	device_type INT,
	primary_user INT,
	location_floor INT,
	location_x INT,
	location_y INT
);

CREATE TABLE device_types(
	id INTEGER PRIMARY KEY,
	type TEXT
);

CREATE TABLE users(
	id INTEGER PRIMARY KEY,
	name TEXT
);