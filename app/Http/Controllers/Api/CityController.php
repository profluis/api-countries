<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function create(Request $request) {

        $data = $request->validate([
            'name' => 'required',
            'state_id' => 'required|numeric',
            'isCapital' => 'nullable|numeric',
        ]);

        if($data['isCapital'] > 0) {
            $city = City::create([
                'name' => $data['name'],
                'state_id' => $data['state_id'],
                'isCapital' => $data['isCapital'],
            ]);
        } else {
            $city = City::create([
                'name' => $data['name'],
                'state_id' => $data['state_id'],
            ]);
        }

        if($city) {

            $response = [
                'response' => 1,
                'message' => 'City created successfully',
                'city' => $city
            ];

            return response()->json($response);
        } else {
            $response = [
                'response' => 0,
                'message' => 'There was an error saving data',
            ];
        }
    }
}
