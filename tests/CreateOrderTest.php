<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateOrder()
    {
        Print("Date is empty\n");
        $this->post('/order', ["fruits" => ["1"=> 100]])
            ->seeJson(["The date field is required."]);

        Print("Date is zero\n");
        $this->post('/order', ["date"=>0, "fruits" => ["1"=> 100]])
            ->seeJson(["The date must be at least 1."]);

        Print("Date is more than 365\n");
        $this->post('/order', ["date"=>366, "fruits" => ["1"=> 100]])
            ->seeJson(["The date may not be greater than 365."]);

        Print("Fruits are empty\n");
        $this->post('/order', ['date'=>1])
            ->seeJson(["The fruits field is required."]);

        Print("Fruits are invalid format\n");
        $this->post('/order', ['date'=>1, "fruits" => [1]])
            ->seeJson(["The given data was invalid."]);

        Print("Product_id is not existed in database\n");
        $this->post('/order', ['date'=>1, "fruits" => ["1000"=> 100]])
            ->seeJson(["The given data was invalid."]);

        Print("Amount is more than 100kg\n");
        $this->post('/order', ['date'=>1, "fruits" => ["1"=> 200]])
            ->seeJson(["The given data was invalid."]);

        Print("Amount is zero\n");
        $this->post('/order', ['date'=>1, "fruits" => ["1"=> 200]])
            ->seeJson(["The given data was invalid."]);

        Print("Create successfully\n");
        $this->post('/order', ['date'=>1, "fruits" => ["1"=> 50]])
            ->seeJson(["success"]);
    }
}
