<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ReportTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testReport()
    {
        Print("From or To are zero\n");
        $this->post('/order', ['from' => 1, 'to'=>400])
            ->seeJson(["The from must be at least 1"]);

        Print("From or To are more than 365\n");
        $this->post('/order', ['from' => 1, 'to'=>400])
            ->seeJson(["The to may not be greater than 365"]);


    }
}
