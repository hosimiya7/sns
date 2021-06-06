drop table tweets;

create table tweets(
  id INT auto_increment PRIMARY KEY, 
  user_id INT,
  content TEXT,
  parent_id INT,
  favorites_count INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);