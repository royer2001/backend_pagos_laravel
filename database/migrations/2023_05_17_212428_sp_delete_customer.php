<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SpDeleteCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "CREATE PROCEDURE `sp_delete_customers`( in customer_id bigint(20))
             begin
                 DELETE FROM customers  
                 WHERE id = customer_id;
             END";
         DB::unprepared("DROP PROCEDURE IF EXISTS sp_delete_customers");

         DB::unprepared($procedure);
         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
