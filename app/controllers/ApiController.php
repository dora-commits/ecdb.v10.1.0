<?php

/**
 *  API
 */
class ApiController
{
    public function index(){
        header('Content-Type: application/json');
        echo json_encode([]);
    }

    public function orders($id = null){
        $order = new OrderModel();
        if (is_null($id)) {
            $result = $order->findAll();
        } else {
            $result = $order->where(['id' => $id]);
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function products($id = null){
        $products = new ProductModel();
        if (is_null($id)) {
            $result = $products->findAll();
        } else {
            $result = $products->where(['id' => $id]);
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function category($id = null){
        $category = new CategoryModel();
        if (is_null($id)) {
            $result = $category->findAll();
        } else {
            $result = $category->where(['id' => $id]);
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function users($id = null){
        $users = new UserModel();
        if (is_null($id)) {
            $result = $users->findAll();
        } else {
            $result = $users->where(['id' => $id]);
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
