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
        $result_1 = $this->query($query, ['id' => $id]);
    
        // TODO: orderitems
        $query = "SELECT COUNT(*) FROM orderitems WHERE orderid = :id";
        $result_2 = $this->query($query, ['id' => $id]);

        if (gettype($result_1) != "boolean" && gettype($result_2) != "boolean") {
            return $result_1[0]->{"COUNT(*)"} > 0 || $result_2[0]->{"COUNT(*)"} > 0;
        }

        return false;
    }
}
