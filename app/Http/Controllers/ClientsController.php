<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientsController extends Controller
{
    //
    public function show()
    {
        $user = \Auth::user();
        return view('clients.show')
                ->with([
                    'user' => $user,
                ]);
    }

    public function cancel()
    {
        $user = \Auth::user();
        \Auth::logout();
        $payPalId = $user->client->paypal_agreement_id;
        $user->client()->delete();
        $user->delete();
        return redirect()->route('home');
    }
}
