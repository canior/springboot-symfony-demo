CREATE DATABASE IF NOT EXISTS test;

CREATE TABLE test.account LIKE snazzycrm.account;
INSERT INTO test.account SELECT * FROM snazzycrm.account;

CREATE TABLE test.contact LIKE snazzycrm.contact;
INSERT INTO test.contact SELECT * FROM snazzycrm.contact;
