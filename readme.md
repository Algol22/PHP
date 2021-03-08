  ## To run the app the ensuing two tables (MySQL) must be created:
  
  CREATE TABLE people(
  Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(15),
  Surname VARCHAR(15),
  Patronymic VARCHAR(15)
  );

  CREATE TABLE comments(
  id_comment INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  comment TEXT not null,
  id_people int(8) not null,
  foreign key(id_people) references people(Id) on delete cascade);
