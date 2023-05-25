<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SpPostCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $procedure = "CREATE PROCEDURE sp_post_customers(   
            in first_name varchar(255), 
            in last_name varchar(255), 
            in dob date, 
            in email varchar(255),
            in phone varchar(8), 
            in address varchar(255))
            
            begin
                insert into customers(
                    first_name,
                    last_name,
                    dob,
                    email,
                    phone,
                    address)
                values
                    (
                    first_name,
                    last_name,
                    dob,
                    email,
                    phone,
                    address
                    );
            END";
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_post_customers");

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
