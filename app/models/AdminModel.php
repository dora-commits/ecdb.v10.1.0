<?php

/**
 * class AdminModel
 */
class AdminModel
{
    use Model;

    protected $table = 'admin';
    protected $allowedColumns = [
        'id',
        'firstname',
        'lastname',
        'email',
        'password'
    ];
}