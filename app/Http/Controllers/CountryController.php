<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller {
    
    public function index() {

        $countries = Country::where('status', '=', '1')->paginate(1);

        return view('countries.index', compact('countries'));
    }

    public function item($id) {

        $country = Country::where('status', '=', '1')->where('id', '=', $id)->first();

        return view('countries.item', compact('country'));
    }

    public function create(Request $request) {


    }

    public function update(Request $request) {


    }

    public function status(Request $request) {


    }
}
