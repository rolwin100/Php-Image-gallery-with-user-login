# Php-Image-gallery-with-user-login
This is a simple image gallery with user login using mysql database

// follow the below steps to use the code

1 . Enter the connection password and username for my sql db in the 2 file connect.php and gallery/config.inc.php.

2 . Make sure the folders have 777 permissions. If not provide 777 permissions in linux it can be done by using the following command: sudo chmod -R 777 *

3. Import the database from the file db.sql using the command mysql -u <username> -p < db.sql 

4. Login using username: rolwin100 and password: legendforever







//below are the quries used to create tables


create table user(id int auto_increment primary key not null, username varchar(255) not null, email varchar(255) not null,phone bigint(20) not null,password varchar(255) not null);

create table gallery_category (category_id int primary key auto_increment not null, username varchar(255) not null,category_name varchar(255) not null, unique(username,category_name));

CREATE TABLE gallery_photos ( 
  photo_id bigint(20) unsigned NOT NULL auto_increment, 
  photo_filename varchar(25), 
  photo_caption text, 
  photo_category bigint(20) unsigned NOT NULL default '0', 
  PRIMARY KEY  (photo_id), 
  KEY photo_id (photo_id) 
);

