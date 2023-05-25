<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SpGetCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        $procedure = "CREATE PROCEDURE `sp_get_customers`()
            begin
            
            select concat(first_name,' ', last_name) as client_name,
                    dob,
                    phone,
                    email,
                    address,
                    count(p.id) as payments,
                    sum(p.payment) as total
            from customers c 
            left join payments p 
            on c.id = p.customer_id 
            group by c.id;
            
            END";
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_customers");

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
