<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Client;
use App\User;
use App\Mail\NewClient;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;


class PaymentsController extends Controller
{
    //

    public function sendEmail(Request $request) {
        $rules = [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|regex:/^[0-9]{9}$/',
            'grain_type' => 'required',
            'address' => 'required',
            'pc' => 'required|regex:/^[0-9]{5}$/',
            'plan_id' => 'required|exists:plans,id',
            'password' => 'required|confirmed'
        ];

        $request->validate($rules);
        $data = $request->all();
        $user = User::create($request->all());
        $user->assignRole(Role::find(2));
        $data['user_id'] = $user->id;
        $client = Client::create($data);
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        Mail::to('alan.desarrollo@gmail.com')->send(new NewClient($request));

        return redirect()->route('clients.profile');
    }

    public function subscribe(Request $request) {
        $rules = [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|regex:/^[0-9]{9}$/',
            'grain_type' => 'required',
            'address' => 'required',
            'pc' => 'required|regex:/^[0-9]{5}$/',
            'plan_id' => 'required|exists:plans,id',
            'password' => 'required|confirmed'
        ];

        $request->validate($rules);
        $data = $request->all();
        $user = User::create($request->all());
        $user->assignRole(Role::find(2));
        $data['user_id'] = $user->id;
        $client = Client::create($data);
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        return redirect()->route('payments.show');
    }

    public function show()
    {
        $user = Auth::user();
        $client = $user->client;

        $request = [
            "zip_from" => "45643",
            "zip_to" => $client->pc,
            "parcel" => [
                "weight" => 10,
                "height" => 10,
                "width" => 10,
                "length" => 10
            ],
        ];

        $delivery = Curl::to('https://api.skydropx.com/v1/quotations')
                        ->withHeader('Authorization: Token token=VtuHdSoKu7RdjaI1PybJbyzmWjmV5Gc099XKuf3zrest')
                        ->withHeader('Content-Type: application/json')
                        ->withData($request)
                        ->asJson()
                        ->post();

        $deliveryOptions = [];
        foreach($delivery as $option) {
            if($option->service_level_code == "ECOEXPRESS" || $option->service_level_code == "FEDEX_EXPRESS_SAVER" || $option->service_level_code == "STANDARD_OVERNIGHT"){
                $deliveryOptions[] = $option;
            }
        }
        // dd($deliveryOptions);
        return view('payments.pay')
        ->with([
            'client' => $client,
            'deliveryOptions' => $deliveryOptions,
        ]);
    }
}
