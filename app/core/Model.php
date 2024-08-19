<?php

/**
 * Trait Model
 */
Trait Model
{
    use Database;
    protected $table = 'admin';
    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "desc";
    protected $order_column = "id";
    public $errors = [];

    public function query($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);
        $check = $stm->execute($data);

        if ($check) {
            return $stm->fetchAll(PDO::FETCH_OBJ) ?: false;
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
}