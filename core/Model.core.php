<?php
class Model {
    protected $_db, $_table, $_modelName, $_softDelete = false, $_columnNames = [];
    public $id;

    public function __construct($table, $fields) {
        $this->_db = DB::getInstance();
        $this->_table = $table;

        if($this->_db->tableExists($table)) {
            $this->_db->getTableColumns($table);
        }        

        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $table)));

        $this->_db->saveTable($table, $fields);
    }

    public function find($params = []) {
        return $this->_db->find($this->_table, $params);
    }

    public function findFirst($params = []) {
        return $this->_db->findFirst($this->_table, $params);
    }

    public function insert($fields = []) {
        return $this->_db->insert($this->_table, $fields);
    }

    public function update($id, $fields = []) {
        return $this->_db->update($this->_table, $id, $fields);
    }

    public function delete($id) {
        return $this->_db->delete($this->_table, $id);
    }

    public function save($fields) {
        if(property_exists($this, 'id') && $this->id != '') {
            return $this->update($this->id, $fields);
        } else {
            return $this->insert($fields);
        }
    }

    public function query($sql, $params = []) {
        return $this->_db->query($sql, $params);
    }

    public function findByID($identifier, $id) {
        return $this->find([
            'conditions' => [
                'params' => [$identifier]
            ],
            'bind' => [$id]
        ]);
    }

    public function findFirstByID($identifier, $id) {
        return $this->findFirst([
            'conditions' => [
                'params' => [$identifier]
            ],
            'bind' => [$id]
        ]);
    }

    public function getColumns() {
        return $this->_columnNames;
    }
}


