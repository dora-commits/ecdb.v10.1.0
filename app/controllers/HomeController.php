<?php

/**
 *  class HomeController
 */
class HomeController extends Controller
{
    // use Model;
    public function index(){
        $d = new AdminModel;
        // show($d->findAll());

        // $arr['firstname'] = 'Justin';
        // $arr['lastname'] = 'Hartman';
        // show($d->where($arr));
        
        $this->view('home');
    }
}
