<?php
$dataDir = "../lib/data";

function initDB($filename)
{
    $db = new PDO("sqlite:$filename");
    initTables($db);
    initData($db);
    return $db;
}

function getDB($id)
{
    return new PDO("sqlite:$filename");
}

function initTables($db)
{
    $db->query('create table users (id integer primary key, username string, password string)');
    $db->query('create table comments (id integer primary key, title string, body text)');
}

function initData($db)
{
    $db->query('delete from users');
    $db->query('insert into users (username, password) values ("user", "password")');
    $db->query('insert into users (username, password) values ("admin", "admin_pass")');
}
?>
