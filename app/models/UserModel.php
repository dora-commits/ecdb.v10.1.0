<?php

/**
 * class UserModel
 */
class UserModel
{
    use Model; // Assuming Model trait is used here

    protected $table = 'users';

    public function countAll()
    {
        $query = "SELECT COUNT(*) as total FROM $this->table";
        $result = $this->query($query);
        $num = $result[0]->{"total"};
        return $num;
    }

    public function hasReferences($id)
    {
        // TODO: reviews
        $query = "SELECT COUNT(*) FROM reviews WHERE pid = :id";
        $result = $this->query($query, ['id' => $id]);

        if (gettype($result) != "boolean") {
            return $result[0]->{"COUNT(*)"} > 0;
        }

        // TODO:  wishlist, usersmeta
        // ... 

        return false;
    }
}
