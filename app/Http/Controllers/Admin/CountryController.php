<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\State;

use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function getStates(Request $request) {
        if($request->has('country_id')) {
            $states = State::where('country_id',$request->country_id)->orderBy('name')->get();
            return response()->json(['status' => true, 'states' => $states]);
        }
    }
}
?>