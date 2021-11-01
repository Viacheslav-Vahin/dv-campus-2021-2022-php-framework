DROP DATABASE IF EXISTS viacheslavvahin_blog;

DROP USER IF EXISTS 'viacheslavvahin_blog_user'@'%';

CREATE DATABASE viacheslavvahin_blog;

CREATE USER 'viacheslavvahin_blog_user'@'%' IDENTIFIED BY 'Sla601601';

GRANT ALL ON viacheslavvahin_blog.* TO 'viacheslavvahin_blog_user'@'%';