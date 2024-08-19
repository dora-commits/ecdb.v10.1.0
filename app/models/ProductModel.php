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
}
