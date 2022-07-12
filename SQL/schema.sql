CREATE DATABASE php;

CREATE TABLE `jobinterest` (
  `ID` int(11) NOT NULL,
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL,
  `MobileNumber` text NOT NULL,
  `Email` text NOT NULL,
  `project_name` text NOT NULL,
  `pdf_doc` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `database admins` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


