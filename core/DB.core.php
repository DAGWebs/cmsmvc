<?php

class DB {
    private static $_instance = null;
    private $_pdo, $_query, $_error = false, $_results, $_count = 0, $_lastInsertID = null;

    private function __construct() {
        try {
            $this->_pdo = new PDO(Config::get("db.driver") . ':host=' . Config::get('db.host') . ';dbname=' . Config::get('db.name'), Config::get('db.user'), Config::get('db.pass'));
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if(!isset(self::$_instance)) {
            return self::$_instance = new DB();
        } else  {
            return self::$_instance;
        }
    }

    public function query($sql, $params = []) {
        $this->setError();
        if($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if(count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchALL(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
                $this->_lastInsertID = $this->_pdo->lastInsertID();
                return $this->results();
            } else {
               return false;
            }
        }
        return false; 
    }

    public function createTable($table, $fields, $primaryKey = null, $options = '') {
        $sql = "CREATE TABLE IF NOT EXISTS {$table} (";

        if(is_array($fields)) {
            foreach($fields as $field => $fieldType) {
                $sql .= "{$field} {$fieldType}, ";
            }
        }

        $sql = rtrim($sql, ", ");

        if(!empty($primaryKey)) {
            $sql .= ", PRIMARY KEY ({$primaryKey})";
        }

        $sql .= ") {$options}";

        return $this->query($sql);
    }

    public function tableExists($table) {
        $sql = "SHOW TABLES LIKE '{$table}'";

        $query = $this->query($sql);

        if($this->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function saveTable($table, $fields, $primaryKey = null, $options = '') {
        $this->migrateTable($table, $fields, $primaryKey, $options);
    }

    private function updateTable($table, $fields, $primaryKey = null, $options = '') {
        $tableExists = $this->tableExists($table);

        if(!$tableExists) {
            return false;
        }

        $currentColumns = $this->getTableColumns($table);
    
        foreach ($fields as $column => $type) {
            if(!strpos($type, 'PRIMARY KEY')) {
                if (array_key_exists($column, $currentColumns)) {
                    $sql = "ALTER TABLE {$table} MODIFY COLUMN {$column} {$type}";
                } else {
                    $sql = "ALTER TABLE {$table} ADD COLUMN {$column} {$type}";
                }
                $this->query($sql);
                unset($currentColumns[$column]);
            }
            unset($currentColumns[$column]);
        }
    
        foreach ($currentColumns as $column => $type) {
            $alterSql = "ALTER TABLE {$table} DROP COLUMN {$column}";
            $this->query($alterSql);
        }
    
        if (!empty($options)) {
            $this->query("ALTER TABLE {$table} {$options}");
        }
        
    }

   

    private function migrateTable($table, $fields, $primaryKey = null, $options = '') {
        if($this->tableExists($table)) {
            $currentFields = $this->getTableColumns($table);
            
            if($this->fieldsNeedUpdate($currentFields, $fields)) {
                $this->updateTable($table, $fields, $primaryKey, $options);
            } 
        } else {
            $this->createTable($table, $fields, $primaryKey, $options);
        }
    }

    private function fieldsNeedUpdate($currentFields, $desiredFields) {
        return !empty(array_diff_assoc($desiredFields, $currentFields)) || !empty(array_diff_assoc($currentFields, $desiredFields));
    }

    public function getTableColumns($table) {
        $columns = [];
        if(!$this->tableExists($table)) {
            return false;
        }
        $result = $this->query("DESCRIBE {$table}");
        $result = $this->results();

        foreach($result as $row) {
            $columns[$row->Field] = $row->Type;
        }

        return $columns;
    }


    protected function _read($table, $params = []) {
        $conditionString = '';
        $bind = [];
        $order = '';
        $limit = '';

        if(isset($params['conditions'])) {
            if(is_array($params['conditions'])) {
                if(array_key_exists('cond', $params['conditions'])) {
                    $cond = $params['conditions']['cond'];
                } else {
                    $cond = '';
                }

                if(array_key_exists('params', $params['conditions'])) {
                    foreach($params['conditions']['params'] as $param) {
                        $conditionString .= " {$param} = ? {$cond}";
                    }

                    $conditionString = trim($conditionString);
                    $conditionString = rtrim($conditionString, "{$cond}");
                }
            } else {
                $conditionString = $params['conditions'];
            }
            
        }

        if(array_key_exists('bind', $params)) {
            $bind = $params['bind'];
        }

        if(array_key_exists('order', $params)) {
            $order = " ORDER BY {$params['order']}";
        }

        if(array_key_exists('limit', $params)) {
            $limit = " LIMIT {$params['limit']}";
        }

        if(empty($bind)) {
            $sql = "SELECT * FROM {$table}";
        } else {
            $sql = "SELECT * FROM {$table} WHERE {$conditionString} {$order} {$limit}";
        }
        
        if($this->query($sql, $bind)) {
            return $this->results();
        } else {
            return false;
        }
   }

   public function find($table, $params = []) {
       return $this->_read($table, $params);
   }

   public function findFirst($table, $params = []) {
    return $this->_read($table, $params)[0];
   }

    public function insert($table, $fields = []) {
        $fieldString = '';
        $valueString = '';
        $values = [];

        if(!is_array($fields)) {
            die("Fields must be an array please fix that!");
        }

        foreach($fields as $field => $value) {
            $fieldString .= "`{$field}`, ";
            $valueString .= "?, ";
            $values[] = $value; 
        }

        $fieldString = rtrim($fieldString, ', ');
        $valueString = rtrim($valueString, ', ');
        $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";

        if(!$this->query($sql, $values)) {
            $this->setError();
            return false;
        } else {
            return true;
        }
    }

    public function update($table, $id, $fields = []) {
        $fieldString = '';
        $values = [];

        if(!is_array($fields)) {
            die("Fields must be an array please fix that!");
        }

        foreach($fields as $field => $value) {
            $fieldString .= "`{$field}` = ?, ";
            $values[] = $value; 
        }

        $fieldString = rtrim($fieldString, ', ');
        $fieldString = trim($fieldString, ', ');
        $sql = "UPDATE {$table} SET {$fieldString} WHERE {$id[0]} = {$id[1]}";

        if(!$this->query($sql, $values)) {
            $this->setError();
            return false;
        } else {
            return true;
        }
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM {$table} WHERE {$id[0]} = {$id[1]}";

        if(!$this->query($sql)) {
            $this->setError();
            return false;
        } else {
            return true;
        }
    }

    public function results() {
        return $this->_results;
    }

    public function count() {
        return $this->_count;
    }

    public function lastID() {
        return $this->_lastInsertID;
    }

    public function getError() {
        return $this->_error;
    }

    public function setError($error = true) {
        $this->_error = $error;
    }
}