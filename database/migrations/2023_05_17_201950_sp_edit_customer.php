<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SpEditCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $procedure = "CREATE PROCEDURE `sp_edit_customers`( in customer_id bigint(20),
                                                            in first_name varchar(255), 
                                                            in last_name varchar(255), 
                                                            in dob date, 
                                                            in email varchar(255), 
                                                            in phone varchar(8),
                                                            in address varchar(255))
            begin
                UPDATE customers
                SET `first_name`=first_name, 
                    `last_name`=last_name, 
                    `dob`=dob, 
                    `email`=email, 
                    `phone`=phone,
                    `address`=address
                WHERE id=customer_id;
            END";
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_edit_customers");

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
