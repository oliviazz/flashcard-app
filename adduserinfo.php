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
    $first = (string)$_GET["first"];
    $last = (string)$_GET["last"];
    $un = (string)$_GET["user"];
    $pw = (string)$_GET["pass"];
    $full = "$first $last";

    $squltxt = "
        INSERT INTO UserInfo (Name, Username, Password)
        VALUES ($full, $un, $pw);";

    $ret = $db->exec($sql);
    if(!$ret)
    {
      echo $db->lastErrorMsg();
    }
    else
    {
      echo "Records created successfully\n";
    }
    $db->close();
 ?>
