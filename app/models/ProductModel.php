<?php

/**
 * class ProductModel
 */
class ProductModel
{
    use Model; // Assuming Model trait is used here

    protected $table = 'product';

    /**
     * If product has more one orderitems, we can not delete that product from database
     */
    public function hasReferences($id)
    {
        $query = "SELECT COUNT(*) FROM orderitems WHERE pid = :id";
        $result = $this->query($query, ['id' => $id]);

        if (gettype($result) != "boolean") {
            return $result[0]->{"COUNT(*)"} > 0;
        }

        return false;
    }

    public function findAll_products()
    {
        $query = "SELECT products.*, category.name as category_name 
                FROM products 
                JOIN category ON products.catid = category.id 
                ORDER BY {$this->order_column} {$this->order_type} 
                LIMIT {$this->limit} OFFSET {$this->offset}";

        return $this->query($query);
    }
}
