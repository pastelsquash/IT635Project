LOAD DATA LOCAL INFILE 'dater.csv' 
INTO TABLE classes  
    FIELDS TERMINATED BY ', ' 
           OPTIONALLY ENCLOSED BY '"'
    LINES  TERMINATED BY '\n' -- or \r\n
(prefix, num, title, description, prerequisites, department);
