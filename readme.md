  ## To run the app the ensuing two tables (MySQL) must be created:
  
  CREATE TABLE people( <br>
  Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, <br>
  Name VARCHAR(15), <br>
  Surname VARCHAR(15), <br>
  Patronymic VARCHAR(15)); <br>

  CREATE TABLE comments( <br>
  id_comment INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY, <br>
  comment TEXT not null, <br>
  id_people int(8) not null, <br>
  foreign key(id_people) references people(Id) on delete cascade); <br>
