<?php

/**
 *  class HomeController
 */
class HomeController extends Controller
{
    public function index(){
        // $this->view('home');
        // TODO: ...
        redirect('admin');
    }
}
