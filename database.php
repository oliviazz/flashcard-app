<?php
    class MyDB extends SQLite3
    {
       function __construct()
       {
          $this->open('userinfo.db');
       }
    }
    $db = new MyDB();
    if(!$db)
    {
       echo $db->lastErrorMsg();
    }
    else
    {
       echo "Opened database successfully\n";
    }
    $sqltxt = "
        CREATE TABLE UserInfo
        (Name   Text NOT NULL,
        Username  Text NOT NULL,
        Password   REAL NOT NULL);
        ";
    /*$sqltxt2 = "
        CREATE TABLE StudySets
        (Id INTEGER PRIMARY KEY NOT NULL,
        Username    Text NOT NULL,
        )";*/

     $ret = $db->exec($sqltxt);
     ///$ret2 = $db->exec($sqltxt2);
     if(!$ret)
     {
         echo $db->lastErrorMsg();
     }
     else
     {
         echo "Table created successfully\n";
     }
     /*if(!$ret2)
     {
         echo $db->lastErrorMsg();
     }
     else
     {
         echo "Table2 created successfully\n";
     }*/
     $db->close();
 ?>
