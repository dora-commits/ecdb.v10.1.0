<?php

/**
 *  class AdminController
 */
class AdminController extends Controller
{
    public function index(){
        $d = new AdminModel;
        $this->view('admin/dashboard');
    }
}