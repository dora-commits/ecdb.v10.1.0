<?php

/**
 * Trait Model
 */
Trait Model
{
    use Database;
    // protected $table = 'admin';
    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "asc"; //asc/desc
    protected $order_column = "id";
    public $errors = [];

    public function query($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);
        $check = $stm->execute($data);

        if ($check) {
            // return $stm->fetchAll(PDO::FETCH_OBJ) ?: false;
            // TODO: Fixed return false when update/edit data in table.
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        return false;
    }

    public function findAll()
    {
        $query = "SELECT * FROM {$this->table} 
                  ORDER BY {$this->order_column} {$this->order_type} 
                  LIMIT {$this->limit} OFFSET {$this->offset}";
        return $this->query($query);
    }

    public function where($data = [], $data_not = [])
    {
        $whereClauses = $this->buildWhereClauses($data, $data_not);
        $query = "SELECT * FROM {$this->table} WHERE {$whereClauses} 
                  ORDER BY {$this->order_column} {$this->order_type} 
                  LIMIT {$this->limit} OFFSET {$this->offset}";
        $params = array_merge($data, $data_not);
        return $this->query($query, $params);
    }

    public function first($data, $data_not = [])
    {
        $whereClauses = $this->buildWhereClauses($data, $data_not);
        $query = "SELECT * FROM {$this->table} WHERE {$whereClauses} 
                  LIMIT 1 OFFSET {$this->offset}";
        $params = array_merge($data, $data_not);
        $result = $this->query($query, $params);
        return $result ? $result[0] : false;
    }

    public function insert($data)
    {
        $data = $this->filterAllowedColumns($data);
        $columns = implode(",", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        return $this->query($query, $data);
    }

    public function update($id, $data, $id_column = 'id')
    {
        $data = $this->filterAllowedColumns($data);
        $setClauses = $this->buildSetClauses($data);
        $query = "UPDATE {$this->table} SET {$setClauses} WHERE {$id_column} = :{$id_column}";
        $data[$id_column] = $id;
        return $this->query($query, $data);
    }

    public function delete($id, $id_column = 'id')
    {
        $query = "DELETE FROM {$this->table} WHERE {$id_column} = :{$id_column}";
        return $this->query($query, [$id_column => $id]);
    }

    private function buildWhereClauses($data, $data_not)
    {
        $clauses = [];
        foreach ($data as $key => $value) {
            $clauses[] = "{$key} = :{$key}";
        }
        foreach ($data_not as $key => $value) {
            $clauses[] = "{$key} != :{$key}";
        }
        return implode(" AND ", $clauses);
    }

    private function filterAllowedColumns($data)
    {
        if (!empty($this->allowedColumns)) {
            return array_filter($data, function ($key) {
                return in_array($key, $this->allowedColumns);
            }, ARRAY_FILTER_USE_KEY);
        }
        return $data;
    }

    private function buildSetClauses($data)
    {
        $clauses = [];
        foreach ($data as $key => $value) {
            $clauses[] = "{$key} = :{$key}";
        }
        return implode(", ", $clauses);
    }
}