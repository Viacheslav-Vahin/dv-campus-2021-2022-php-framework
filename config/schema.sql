DROP TABLE IF EXISTS `category_post`;
#---
DROP TABLE IF EXISTS `daily_statistics`;
#---
DROP TABLE IF EXISTS `post`;
#---
DROP TABLE IF EXISTS `author`;
#---
DROP TABLE IF EXISTS `category`;
#---
CREATE TABLE `author`
(
    `author_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Author ID',
    `firstname` varchar(127) NOT NULL COMMENT 'First name',
    `lastname` varchar(127) NOT NULL COMMENT 'Last name',
    `url`       varchar(127) NOT NULL COMMENT 'URL',
    PRIMARY KEY (`author_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='Author Entity';
#---
INSERT INTO `author` (`firstname`, `lastname`, `url`)
VALUES ('Author', 'name1', 'author-1'),
       ('Author', 'name2', 'author-2'),
       ('Author', 'name3', 'author-3'),
       ('Author', 'name4', 'author-4'),
       ('Author', 'name5', 'author-5');
#---
CREATE TABLE `post`
(
    `post_id`         int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Post ID',
    `name`            varchar(127) NOT NULL COMMENT 'Name',
    `url`             varchar(127) NOT NULL COMMENT 'URL',
    `description`     varchar(4095) DEFAULT NULL COMMENT 'Description',
    `author_id`       int unsigned DEFAULT NULL COMMENT 'Author ID',
    PRIMARY KEY (`post_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='Post Entity';
#---
ALTER TABLE `post`
    ADD COLUMN `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        COMMENT 'Created At' AFTER `url`,
    ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
        COMMENT 'Updated At' AFTER `created_at`,
    ADD CONSTRAINT `FK_AUTHOR_ID` FOREIGN KEY (`author_id`)
        REFERENCES `author` (`author_id`) ON DELETE SET NULL;
#---
INSERT INTO `post` (`name`, `url`, `description`, `author_id`)
VALUES ('post 1', 'post-1', 'Lorem ipsum dolor sit amet', 1),
       ('post 2', 'post-2', 'Lorem ipsum dolor sit amet', 2),
       ('post 3', 'post-3', 'Lorem ipsum dolor sit amet', 3),
       ('post 4', 'post-4', 'Lorem ipsum dolor sit amet', 4),
       ('post 5', 'post-5', 'Lorem ipsum dolor sit amet', 5),
       ('post 6', 'post-6', 'Lorem ipsum dolor sit amet', 1),
       ('post 7', 'post-7', 'Lorem ipsum dolor sit amet', 2),
       ('post 8', 'post-8', 'Lorem ipsum dolor sit amet', 3),
       ('post 9', 'post-9', 'Lorem ipsum dolor sit amet', 4),
       ('post 10', 'post-10', 'Lorem ipsum dolor sit amet', 5),
       ('post 11', 'post-11', 'Lorem ipsum dolor sit amet', 1),
       ('post 12', 'post-12', 'Lorem ipsum dolor sit amet', 2),
       ('post 13', 'post-13', 'Lorem ipsum dolor sit amet', 3),
       ('post 14', 'post-14', 'Lorem ipsum dolor sit amet', 4),
       ('post 15', 'post-15', 'Lorem ipsum dolor sit amet', 5);
#---
CREATE TABLE `category`
(
    `category_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Category ID',
    `name`        varchar(127) NOT NULL COMMENT 'Name',
    `url`         varchar(127) NOT NULL COMMENT 'URL',
    PRIMARY KEY (`category_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='Category Entity';
#---
INSERT INTO `category` (`name`, `url`)
VALUES ('News', 'news'),
       ('Articles', 'articles'),
       ('Sport', 'sport'),
       ('Media', 'media'),
       ('Stories', 'stories');
#---
CREATE TABLE `category_post`
(
    `category_post_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `post_id`          int unsigned NOT NULL COMMENT 'Post ID',
    `category_id`      int unsigned NOT NULL COMMENT 'Category ID',
    PRIMARY KEY (`category_post_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='Category post';
#---
ALTER TABLE `category_post`
    ADD CONSTRAINT `FK_CATEGORY_ID` FOREIGN KEY (`category_id`)
        REFERENCES `category` (`category_id`) ON DELETE CASCADE,
    ADD CONSTRAINT `FK_POST_ID` FOREIGN KEY (`post_id`)
        REFERENCES `post` (`post_id`) ON DELETE CASCADE;
#---
INSERT INTO `category_post` (`category_id`, `post_id`)
VALUES (1, 1), (1, 2), (1, 3), (1, 7),
       (2, 2), (2, 3), (2, 8), (2, 9),
       (3, 2), (3, 3), (3, 10), (3, 11),
       (4, 4), (4, 6), (4, 12),
       (5, 5), (5, 13), (5, 14), (5, 15);
#---
CREATE TABLE `daily_statistics`
(
    `statistics_date_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `post_id`        int unsigned NOT NULL COMMENT 'Post ID',
    `statistics_date`     date DEFAULT NULL COMMENT 'Statistics Date',
    `views`               smallint DEFAULT NULL COMMENT 'views',
    PRIMARY KEY (`statistics_date_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='Daily statistics Entity';
#--
ALTER TABLE `daily_statistics`
    ADD CONSTRAINT `FK_DS_POST_ID` FOREIGN KEY (`post_id`)
        REFERENCES `post` (`post_id`) ON DELETE CASCADE;
#---
INSERT INTO `daily_statistics` (`statistics_date`, `post_id`, `views`)
VALUES ('1987-11-14', 1, 1),
       ('1987-11-14', 2, 2),
       ('1987-11-14', 3, 3),
       ('1987-11-14', 4, 4),
       ('1987-11-14', 5, 3),
       ('1987-11-14', 6, 9),
       ('1987-11-14', 7, 6),
       ('1987-11-14', 8, 4),
       ('1987-11-14', 9, 1),
       ('1987-11-14', 10, 2),
       ('1987-11-14', 11, 3),
       ('1987-11-14', 12, 4),
       ('1987-11-14', 13, 3),
       ('1987-11-14', 14, 1),
       ('1987-11-14', 15, 2);
#---
ALTER TABLE `post` ADD UNIQUE INDEX `POST_INDEX_URL` (`url`);