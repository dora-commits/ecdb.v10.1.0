<?php

/**
 *  API
 */
class Api
{
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

    public function orders_chart(){
        $order = new OrderModel();
        $result = $order->for_api();
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
