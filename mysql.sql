CREATE DATABASE IF NOT EXISTS file_system;
USE file_system;

CREATE TABLE IF NOT EXISTS Element (
  id int AUTO_INCREMENT NOT NULL,
  name varchar(25) NOT NULL,
  id_parent int NULL,
  CONSTRAINT pk_element PRIMARY KEY (id),
  CONSTRAINT fk_element FOREIGN KEY (id_parent) REFERENCES Element(id)
);
