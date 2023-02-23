<?php
require(__DIR__ . "./../../../secrets.php");

class Connection
{   
    const PREFIX = 'rs_';
    private $pdo;
    private $sQuery;
    private $settings;
    private $bConnected = false;
    private $log;
    private $parameters;
    
    public function __construct()
    {
        $this->logs = new Logs("datenbank");
        $this->Connect();
        $this->parameters = array();
    }
    
    private function Connect()
    {
        $this->settings["host"] = DB_HOST;
		$this->settings["dbname"] = DB_NAME;
		$this->settings["user"] = DB_USERNAME;
		$this->settings["password"] = DB_PASSWORD;
		
        $dsn            = 'mysql:dbname=' . $this->settings["dbname"] . ';host=' . $this->settings["host"] . '';
        try {
          
            $this->pdo = new PDO($dsn, $this->settings["user"], $this->settings["password"], array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"
            ));
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->bConnected = true;
        }
        catch (PDOException $e) {
            echo $this->ExceptionLog($e->getMessage());
            die();
        }
    }

    public function CloseConnection()
    {
        $this->pdo = null;
    }
    private function Init($query, $parameters = "")
    {
        if (!$this->bConnected) {
            $this->Connect();
        }
        try {
            $this->sQuery = $this->pdo->prepare($query);
            $this->bindMore($parameters);
            if (!empty($this->parameters)) {
                foreach ($this->parameters as $param => $value) {
                    
                    $type = PDO::PARAM_STR;
                    switch ($value[1]) {
                        case is_int($value[1]):
                            $type = PDO::PARAM_INT;
                            break;
                        case is_bool($value[1]):
                            $type = PDO::PARAM_BOOL;
                            break;
                        case is_null($value[1]):
                            $type = PDO::PARAM_NULL;
                            break;
                    }
                    $this->sQuery->bindValue($value[0], $value[1], $type);
                }
            }
            
            $this->sQuery->execute();
        }
        catch (PDOException $e) {
            echo $this->ExceptionLog($e->getMessage(), $query);
            die();
        }
        $this->parameters = array();
    }

    public function bind($para, $value)
    {
        $this->parameters[sizeof($this->parameters)] = [":" . $para , $value];
    }
    public function bindMore($parray)
    {
        if (empty($this->parameters) && is_array($parray)) {
            $columns = array_keys($parray);
            foreach ($columns as $i => &$column) {
                $this->bind($column, $parray[$column]);
            }
        }
    }
    public function query($query, $params = null, $fetchmode = PDO::FETCH_ASSOC , $fetchClass = '')
    {
        $query = trim(str_replace("\r", " ", $query));
        
        $this->Init($query, $params);
        
        $rawStatement = explode(" ", preg_replace("/\s+|\t+|\n+/", " ", $query));
        $statement = strtolower($rawStatement[0]);
        
        if ($statement === 'select' || $statement === 'show') {
			if($fetchClass!=''){
			return $this->sQuery->fetchAll($fetchmode,$fetchClass);
			}else{
            return $this->sQuery->fetchAll($fetchmode);
			}
        } elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
            return $this->sQuery->rowCount();
        } else {
            return NULL;
        }
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function beginTransaction()
    {
        return $this->pdo->beginTransaction();
    }

    public function executeTransaction()
    {
        return $this->pdo->commit();
    }

    public function rollBack()
    {
        return $this->pdo->rollBack();
    }
    
    public function column($query, $params = null)
    {
        $this->Init($query, $params);
        $Columns = $this->sQuery->fetchAll(PDO::FETCH_NUM);
        
        $column = null;
        
        foreach ($Columns as $cells) {
            $column[] = $cells[0];
        }
        
        return $column;
        
    }
 
    public function row($query, $params = null, $fetchmode = PDO::FETCH_ASSOC)
    {
        $this->Init($query, $params);
        $result = $this->sQuery->fetch($fetchmode);
        $this->sQuery->closeCursor();
        return $result;
    }
 
    public function single($query, $params = null)
    {
        $this->Init($query, $params);
        $result = $this->sQuery->fetchColumn();
        $this->sQuery->closeCursor(); 
        return $result;
    }

    private function ExceptionLog($message, $sql = "")
    {
        $exception = 'Unerwarteter Fehler. <br />';
        $exception .= $message;
        $exception .= "<br /> Siehe Logs.";
        
        if (!empty($sql)) {
            $message .= "\r\nRaw SQL : " . $sql;
            $message .="\r\nRaw Parameters : ".json_encode($this->parameters);
        }
        $this->logs->write($message);
        
        return $exception;
		
    }
}
?>
