This is a procedural PHP BLog CMS. 
To use it, first create a mysql database and tables using the following command:

    CREATE DATABASE cms;
    USE cms;

    CREATE TABLE categories (
        cat_id int primary key auto_increment,
        cat_title varchar(255)
    );

    CREATE TABLE comments (
        comment_id int primary key auto_increment,
        comment_post_id int,
        comment_author varchar(255),
        comment_email varchar(255),
        comment_content text,
        comment_status varchar(255)
    );

    CREATE TABLE posts (
        post_id int primary key auto_increment,
        post_category_id int,
        post_title varchar(255),
        post_author varchar(255),
        post_date date,
        post_image text,
        post_content text,
        post_tags varchar(255),
        post_comment_count int,
        post_status varchar(255),
        post_view_counts int
    );

    CREATE TABLE users (
        user_id int primary key auto_increment,
        user_username varchar(255),
        user_password varchar(255),
        user_firstname varchar(255),
        user_lastname varchar(255),
        user_email varchar(255),
        user_image text,
        user_role varchar(255),
        user_randSalt varchar(255) DEFAULT '$2a$09$anexamplestringforsalt$'
    );

Then, create the first admin user by entering

    INSERT INTO users(user_username) VALUES ('anyvalue');

Then, click on the register tab on the navigation bar on the home page. Register a user as an admin. 

After loggin in, you can use this CMS.