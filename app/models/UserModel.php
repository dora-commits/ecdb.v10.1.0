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
}
