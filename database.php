<?php
    function getDBHandle($dbFileName) // opens a connection to the SQL database in $dbFileName
    {
        $sqliteName = "sqlite$dbFileName";
        try
        {
            $dbh = new PDO($sqliteName, $user, $password);
        }
        catch(PDOException $e)
        {
            die("Connection to $sqliteName; " . $e->getMessage());
        }
    }
    function getTableNames($dbh) // returns an array of table names
    {
        $query = "SELECT name FROM sqlite_mast WHERE type='table';";
        try
        {
            $ar = $dbh->query($query);
            return array_diff($ar->fetchAll(PDO::FETCH_COLUMN, 0),array("sqlite_sequence"));
        }
        catch(PDOException $e)
        {
            die("getTableName query failed: " . $e->getMessage());
        }
    }
    function dropTables($dbh, $aTables) // remove the table names given in the array $aTables
    {
        foreach($aTables as $tbl)
        {
            $query = "DROP TABLE IF EXISTS $tbl;";
            try
            {
                $dbh->exec($query);
            }
            catch(PDOException $e)
            {
                die("Failed to remove errant table $tbl<br>" . $e->getMessage());
            }
        }
    }
    function createMissingTables($dbh, $aTables, $createSpecFile) // create those tables listed in array $aTables
    {
        if(!sizeof($aTables))
        {
            return;
        }
        include_once($createSpecFile);
        foreach($aTables as $tbl)
        {
            if(!array_key_exists($tbl=strtolower($tbl), $aTableSpec))
            {
                continue;
            }
            $query = $aTableSpec[$tbl];
            try
            {
                $dbh->exec($query);
            }
            catch(PDOException $e)
            {
                die("Failed to create table $tbl<br>" . $e->getMessage());
            }
        }
    }
 ?>
