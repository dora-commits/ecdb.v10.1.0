<?php

/**
 * class CategoryModel
 */
class CategoryModel
{
    use Model; // Assuming Model trait is used here

    protected $table = 'category';

    /**
     * If category has more one product, we can not delete that category from database
     */
    public function hasReferences($id)
    {
        $query = "SELECT COUNT(*) FROM products WHERE catid = :id";
        $result = $this->query($query, ['id' => $id]);

        if (gettype($result) != "boolean") {
            return $result[0]->{"COUNT(*)"} > 0;
        }

        return false;
    }
}
