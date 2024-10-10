<?php

/**
 *  class _404Controller
 */
class _404Controller extends Controller
{
    public function index(){
        // echo "This is 404 Controller";
        $this->view('404');
    }
}
