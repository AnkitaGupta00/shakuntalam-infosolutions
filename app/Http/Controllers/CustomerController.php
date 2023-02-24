<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function all(){

    }
    public function store(Request $request){

        return response(['message' => 'Welcome to Shakuntalam Infosolutions'], 200);
    }

    public  function create(Request $request ){

        DB::beginTransaction();
        $file = $request->file('document');
        try {
            $mac_address = exec('getmac');
            $mac_address = strtok($mac_address, ' ');

            $name = $request['fname'] . $request['lname'];
            $customer = new Customer;
            $customer->name = $name;
            $customer->contact_no = $request['mobile'];
            $customer->email = $request['email'];
            $customer->address = $request['address'];
            $customer->pin_code = $request['pincode'];
            $customer->city = $request['city'];
            $customer->state = $request['state'];
            $customer->demat = $request['demat'] ? 1 : 0;
            $customer->ip_address = $request['ip'];
            if($request['broker']) {
                $customer->broker = $request['broker'];
            }
            if($request['openBroker'] != 'null') {
                $customer->other_broker = $request['openBroker'];
            }
            if($file){
               $customer->id_proof =  Str::slug($file->getClientOriginalName());
                $file->move(storage_path("app/public/uploads/customers"));
            }
            $customer->save();
            DB::commit();
            return response(['customer' => $customer], 200);
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            report($exception);
            return response(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }
}
