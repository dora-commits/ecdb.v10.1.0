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
        $result_1 = $this->query($query, ['id' => $id]);

        // TODO:  wishlist
        $query = "SELECT COUNT(*) FROM wishlist WHERE pid = :id";
        $result_2 = $this->query($query, ['id' => $id]);

        if (gettype($result_1) != "boolean" && gettype($result_2) != "boolean") {
            return $result_1[0]->{"COUNT(*)"} > 0 || $result_2[0]->{"COUNT(*)"} > 0;
        }

        // TODO: usersmeta
        // ... 

        return false;
    }
}
