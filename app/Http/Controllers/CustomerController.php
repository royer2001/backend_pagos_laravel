<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $customers = DB::select('call sp_get_customers()');
            return response()->json($customers);
        } catch (\Exception $e) {
            // Manejar la excepción aquí
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // crear un nuevo cliente

        $params = [
            null,
            $request['first_name'],
            $request['last_name'],
            date('Y-m-d', strtotime($request['dob'])),
            $request['email'],
            $request['phone'],
            $request['address'],
            json_encode($request['arrayPayment']),
            null
        ];

        $statement = 'CALL sp_customer_pay(?, ?, ?, ?, ?, ?, ?, ?, ?)';


        $customer = DB::select($statement, $params);
        return response()->json($customer, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        try {
            $payments = DB::select('CALL sp_get_data_by_id(?)', [$request['id']]);
            return response()->json($payments);
        } catch (\Exception $e) {
            // Manejar la excepción aquí
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        // actualizar un cliente existente
        //Customer::findOrFail($request['id']);
        try {
            $params = [
                $request['id'],
                $request['first_name'],
                $request['last_name'],
                date('Y-m-d', strtotime($request['dob'])),
                $request['email'],
                $request['phone'],
                $request['address'],
                json_encode($request['arrayPayment']),
                json_encode($request['todel'])
            ];

            $statement = 'CALL sp_customer_pay(?, ?, ?, ?, ?, ?, ?, ?, ?)';
        } catch (\Throwable $th) {
            //throw $th;
        }




        $customer = DB::select($statement, $params);
        return response()->json($customer, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //eliminar un cliente existente
        try {
            $statement = 'CALL sp_delete_customers(?)';

            // Customer::findOrFail($request['id']);

            $rpta = DB::select($statement, [$request['id']]);

            return response()->json(['Message' => 'Customer deleted', 'data' => $rpta]);
        } catch (\Throwable $th) {

            return response()->json(['Message' => 'Customer not deleted' . $th->getMessage()], 500);
        }
    }

    public function deletePayment(Request $request)
    {
        //eliminar un cliente existente
        try {
            $statement = 'CALL sp_delete_pay_by_id(?)';

            // Customer::findOrFail($request['id']);

            $rpta = DB::select($statement, [$request['id']]);

            return response()->json(['Message' => 'Payment deleted', 'data' => $rpta]);
        } catch (\Throwable $th) {

            return response()->json(['Message' => 'Payment not deleted' . $th->getMessage()], 500);
        }
    }
}
