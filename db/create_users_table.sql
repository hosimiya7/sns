drop table users;

create table users(
  id INT auto_increment PRIMARY KEY, 
  name VARCHAR(256),
  mail VARCHAR(256),
  pass VARCHAR(256)
);