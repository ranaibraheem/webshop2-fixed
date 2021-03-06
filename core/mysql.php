<?php

/**
 * Connecting to a database
 * @param $dbHost, a host like 'localhost'
 * @param $dbName, the name of the database you wish to connect to
 * @param $dbUser, the username to connect with the database
 * @param $dbPass, the password to connect with the database
 * 
 * If one of the params is empty then they will be retrieved from config file
 */
function connect($dbHost = null, $dbName = null, $dbUser = null, $dbPass = null)
{
    if (empty($dbHost) || empty($dbName) || empty($dbUser) || empty($dbPass)) {
        $dbHost = $_ENV['DB_HOST'];
        $dbName = $_ENV['DB_NAME'];
        $dbUser = $_ENV['DB_USER'];
        $dbPass = $_ENV['DB_PASS'];
    }

    try {
        $dbh = new \PDO('mysql:host=' . $dbHost . ';dbname=' . $dbName, $dbUser, $dbPass);
    } catch (\PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    return $dbh;
}

/**
 * Execture a PDO query
 * @param $query (required), the query to execute
 * @param $dbHost: a host like 'localhost'
 * @param $dbName: the name of the database you wish to connect to
 * @param $dbUser: the username to connect with the database
 * @param $dbPass: the password to connect with the database
 * @return $stmt object: result from PDO 
 */
function query($query, $executeString = array(), $dbHost = null, $dbName = null, $dbUser = null, $dbPass = null)
{
    $dbh = connect($dbHost = null, $dbName = null, $dbUser = null, $dbPass = null);

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $stmt = $dbh->prepare($query);
        $stmt->execute($executeString);
    } catch (\PDOException $e) {
        var_dump($e->getMessage());
    }
    $lastInsertedId = $dbh->lastInsertId();
    return $stmt;
}

/**
 * Insert data into the database
 * @param $data array: a associative array with columns and values
 * @param $table string: the table to insert into
 */
function insert($data, $table)
{
    $values = array();
    $questionMarks = "";
    $fields = "";
    $index = 0;

    $query = "INSERT INTO " . $table . "(";

    foreach ($data as $col => $val) {
        $fields .= $col . ",";
        array_push($values, $val);

        $questionMarks .= "?,";
        $index++;
    }

    $fields = rtrim($fields, ',');
    $questionMarks = rtrim($questionMarks, ',');

    $query .= $fields . ") VALUES (" . $questionMarks . ")";

    query($query, $values);
}

/**
 * Create an update query to update a record in the database
 * @param $data array: associative array with columns and values
 * @param $table string: the table to update
 * @param $id int: the id of the record to update
 */
function update($data, $table, $id)
{
    $setStr = "";
    $params = array();

    foreach ($data as $col => $val) {
        if (trim(strtolower($col)) === 'id') {
            continue;
        }

        $setStr .= "`$col` = :$col,";
        $params[$col] = $val;
    }

    $setStr = rtrim($setStr, ",");

    $params['id'] = $id;
    $query = "UPDATE $table SET $setStr WHERE id = :id";

    query($query, $params);
}

function delete($id, $table)
{
    $query = "SELECT deleted FROM " . $table . " WHERE id=" . $id . " AND deleted IS NULL";
    $data = query($query)->fetch(PDO::FETCH_ASSOC);

    if ($data !== false) {
        $data['deleted'] = date('Y-m-d H:i:s');
        $data['deleted_by'] = 1;
        update($data, $table, $id);
    }
}