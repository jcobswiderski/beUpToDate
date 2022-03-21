CREATE DATABASE `beuptodate`;
USE `beuptodate`;

CREATE TABLE `accountType` (
    `accountTypeID` int primary key auto_increment,
    `accountType` varchar(32) not null
);

CREATE TABLE `account` (
    `accountID` int primary key auto_increment,
    `username` varchar(36) not null,
    `email` varchar(128) not null,
    `password` varchar(64) not null,
    `accountTypeID` int not null,
    CONSTRAINT `account_fk` FOREIGN KEY (`accountTypeID`) REFERENCES `accountType` (`accountTypeID`)
);

CREATE TABLE `note` (
    `noteID` int primary key auto_increment,
    `title` varchar(256) null,
    `content` varchar(8192) null,
    `authorID` int not null,
    CONSTRAINT `note_fk` FOREIGN KEY (`authorID`) REFERENCES `accountType` (`accountTypeID`)
);
