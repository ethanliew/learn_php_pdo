<?php
/**
 * Created by Ethan Liew
 * Project  :
 * Date     : 1/16/14
 * Time     : 4:50 PM
 * Version  :
 * Desc     :
 *
 *
 */

// github :  https://github.com/ethanliew/learn_php_pdo


try {
    # MS SQL Server and Sybase with PDO_DBLIB
    #$DBH = new PDO("mssql:host=$host;dbname=$dbname, $user, $pass");
    #$DBH = new PDO("sybase:host=$host;dbname=$dbname, $user, $pass");

    # MySQL with PDO_MYSQL
    $DBH = new PDO("mysql:host=localhost;dbname=test", "root", "");

    # SQLite Database
    #$DBH = new PDO("sqlite:my/database/path/database.db");


//$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );
//$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    # STH means Statement Handle

    # no placeholders - ripe for SQL Injection!
//      $STH = $DBH->prepare("INSERT INTO folks (name, addr, city) values ($name, $addr, $city)");

    # unnamed placeholders
//    $STH = $DBH->prepare("INSERT INTO folks (name, addr, city) values (?, ?, ?) ");
//    $STH->bindParam(1, $name);
//    $STH->bindParam(2, $addr);
//    $STH->bindParam(3, $city);


    # the data we want to insert
//    $data = array('Cathy', '9 Dark and Twisty Road', 'Cardiff');
//    $STH = $DBH->prepare("INSERT INTO folks (name, addr, city) values (?, ?, ?)");
//    $STH->execute($data);


    # named placeholders
//    $STH = $DBH->prepare("INSERT INTO `login`(`username`, `password`) values(:username, :password)");
//    $STH->bindParam(':username', 'ethan');
//    $STH->bindParam(':password', '123123');

//    $data = array('username' => 'ethan', 'password' => '123123');
//    $sth = $DBH->prepare("INSERT INTO `login` (`username`, `password`) VALUES (:username, :password)");
//    $sth->execute($data);


//    include_once('CPerson.php');
//    $data = new CPerson("ethan2", "654321");
//    $sth = $DBH->prepare("INSERT INTO `login` (`username`, `password`) VALUES (:username, :password)");
//    $sth->execute((array)$data);


//
//Data is obtained via the ->fetch(), a method of your statement handle. Before calling fetch, it’s best to tell PDO how you’d like the data to be fetched. You have the following options:
//PDO::FETCH_ASSOC: returns an array indexed by column name
//PDO::FETCH_BOTH (default): returns an array indexed by both column name and number
//PDO::FETCH_BOUND: Assigns the values of your columns to the variables set with the ->bindColumn() method
//PDO::FETCH_CLASS: Assigns the values of your columns to properties of the named class. It will create the properties if matching properties do not exist
//PDO::FETCH_INTO: Updates an existing instance of the named class
//    PDO::FETCH_LAZY: Combines PDO::FETCH_BOTH/PDO::FETCH_OBJ, creating the object variable names as they are used
//PDO::FETCH_NUM: returns an array indexed by column number
//PDO::FETCH_OBJ: returns an anonymous object with property names that correspond to the column names
//In reality, there are three which will cover most situations: FETCH_ASSOC, FETCH_CLASS, and FETCH_OBJ. In order to set the fetch method, the following syntax is used:
//

# using the shortcut ->query() method here since there are no variable
# values in the select statement.
    $STH = $DBH->query('SELECT username, password from login');


//    $STH->setFetchMode(PDO::FETCH_ASSOC);
//    echo "Fetch Assoc \n";
//    while ($row = $STH->fetch()) {
//        echo $row['username'] . "\n";
//        echo $row['password'] . "\n";
//    }


//    $STH->setFetchMode(PDO::FETCH_OBJ);
//    echo "Fetch Object \n";
//    while ($row = $STH->fetch()) {
//        echo $row->username . "\n";
//        echo $row->password . "\n";
//    }


    echo "Fetch Result to Class \n";
    $STH = $DBH->query('SELECT username, password from login');
    //$STH->setFetchMode(PDO::FETCH_CLASS, 'CPerson');
     $STH->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'CPerson');
    //$STH->setFetchMode(PDO::FETCH_CLASS, 'CPerson', array('stuff'));

    while ($obj = $STH->fetch()) {
        echo $obj->username . "\n";
        echo $obj->password . "\n";
    }


//    $i = 0;
//    while ($rowObj = $STH->fetch(PDO::FETCH_CLASS, 'CPerson', array($i))) {
//        // do stuff
//        $i++;
//    }

  //  $DBH->exec('DELETE FROM folks WHERE 1');
 //   $safe = $DBH->quote($unsafe);
    //$rows_affected = $STH->rowCount();


    $sql = "SELECT COUNT(`id`) FROM login";
    if ($STH = $DBH->query($sql)) {
        # check the row count
        if ($STH->fetchColumn() > 0) {

            echo "Have rows matched the query.";
        }
        else {
            echo "No rows matched the query.";
        }
    }



    $DBH = null;

} catch (Exception $e) {
    echo $e->getMessage();

    date_default_timezone_set('Asia/Kuala Lumpur');
    file_put_contents('PDOErrors.txt', date('Y-m-d H:i:s A') . " >> " . $e->getMessage() . "\r\n", FILE_APPEND);
}


