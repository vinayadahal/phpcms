<?php

try {
    $dbh = new PDO("mysql:host=" . host, username, password);
    $dbh->exec("CREATE DATABASE IF NOT EXISTS `" . database . "`;");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db = new PDO("mysql:host=" . host . ";dbname=" . database, username, password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // To create user table and insert data
    $createUserTable = "CREATE TABLE IF NOT EXISTS `user` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(255) NOT NULL,
                        `gender` varchar(255) NOT NULL,
                        `email` varchar(255) NOT NULL,
                        `phone` varchar(255) NOT NULL,
                        `username` varchar(255) NOT NULL,
                        `password` varchar(255) NOT NULL,
                        `role` varchar(255) NOT NULL,
                        PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
    $dropProc = "DROP PROCEDURE IF EXISTS CreateUser;";
    $createProcedure = "CREATE PROCEDURE CreateUser()
                        BEGIN
                        SELECT COUNT(*) into @count FROM user;
                        IF @count = 0 THEN
                        INSERT INTO `user` (`id`, `name`, `gender`, `email`, `phone`, `username`, `password`, `role`)
                        VALUES (NULL, 'administator', 'male', 'admin@websitename.com', '123342324', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin');
                        END IF;
                        END;";

    // To create content table
    $createContentTable = "CREATE TABLE IF NOT EXISTS `content` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
                            `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
                            `desc` text COLLATE utf8_unicode_ci NOT NULL,
                            `keyword` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
                            `metadata` mediumtext COLLATE utf8_unicode_ci NOT NULL,
                            PRIMARY KEY (`id`),
                            UNIQUE KEY `type` (`keyword`)
                            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;";
    $db->exec($dropProc);
    $db->exec($createProcedure);
    $db->exec('CALL CreateUser();');
    $db->exec($dropProc);
//    $db->exec($createContentTable);
} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
    exit();
}