<?php

/**
 * class AdminModel
 */
class AdminModel
{
    use Model;

    protected $table = 'admin';
    protected $allowedColumns = [
        'firstname',
        'lastname',
        'email',
        'password'
    ];
}