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
        
        // show($d->first($arr));

        // $arr['firstname'] = 'Truong Giang';
        // $arr['lastname'] = 'Pham';
        // $arr['email'] = 'giang@gmail.com';
        // $arr['password'] = '88888888';
        // $d->insert($arr);

        // $d->update(1, $arr);

        // $d->delete(1);

        $result = $d->findAll();
        header('Content-Type: application/json');
        echo json_encode($result);

        $this->view('home');
    }
}
