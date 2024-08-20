<?php

/**
 * class OrderModel
 */
class OrderModel
{
    use Model; 

    protected $table = 'orders';

    public function countAll()
    {
        $query = "SELECT COUNT(*) as total FROM $this->table";
        $result = $this->query($query);
        $num = $result[0]->{"total"};
        return $num;
    }

    public function hasReferences($id)
    {
        // TODO: ordertracking
        $query = "SELECT COUNT(*) FROM ordertracking WHERE orderid = :id";
        $result = $this->query($query, ['id' => $id]);

        if (gettype($result) != "boolean") {
            return $result[0]->{"COUNT(*)"} > 0;
        }

        return false;
    }
}
