create database wo_web;

use wo_web;

CREATE TABLE Customers (
    id_customer INT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(100)
);

CREATE TABLE Admin (
    idAdmin INT PRIMARY KEY,
    nama VARCHAR(100),
    username VARCHAR(100),
    password VARCHAR(100)
);