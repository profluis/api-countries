<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function list() {

        $countries = Country::where('status', 1)->orderBy('name', 'asc')->get();

        $list = [];

        foreach ($countries as $country) {

            $object = [
                'id' => $country->id,
                'continent' => $this->getContinentName($country),
                'population' => $country->population,
                'language' => $country->language,
                'currency' => $country->currency,
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function deletedList() {

        $countries = Country::where('status', 0)->orderBy('name', 'asc')->get();

        $list = [];

        foreach ($countries as $country) {

            $object = [
                'id' => $country->id,
                'continent' => $this->getContinentName($country),
                'population' => $country->population,
                'language' => $country->language,
                'currency' => $country->currency,
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id) {

        $story = Story::where('status', 1)->where('id', '=', $id)->first();

        $object = [
            'id' => $story->id,
            'user' => $story->user,
            'image' => $story->image,
            'isFile' => $story->isFile,
            'profile' => $story->user->profile,
            'caption' => $story->caption,
            'expires_on' => $story->expires_on,
            'created_at' => $story->created_at->diffForHumans(),
            'updated_at' => $story->updated_at,
        ];

        return response()->json($object);
    }

    public function create(Request $request) {

        $data = $request->validate([
            'continent' => 'required|numeric',
            'population' => 'required',
            'language' => 'required',
            'currency' => 'required',
        ]);

        $country = Country::create([
            'continent' => $data['continent'],
            'population' => $data['population'],
            'language' => $data['language'],
            'currency' => $data['currency'],
        ]);

        if($country) {

            $response = [
                'response' => 1,
                'message' => 'country created successfully',
                'country' => $country
            ];

            return response()->json($response);
        } else {
            $response = [
                'response' => 0,
                'message' => 'There was an error saving data',
            ];
        }
    }

    public function update(Request $request) {

        $data = $request->validate([
            'id' => 'required|numeric',
            'continent' => 'required|numeric',
            'population' => 'required',
            'language' => 'required',
            'currency' => 'required',
        ]);

        $country = Country::where('id', '=', $data['id'])->first();

        $country->continent = $data['continent'];
        $country->population = $data['population'];
        $country->language = $data['language'];
        $country->currency = $data['currency'];

        if($country->save()) {

            $country->refresh();

            $response = [
                'response' => 1,
                'message' => 'country updated successfully successfully',
                'country' => $country
            ];

            return response()->json($response);
        } else {
            $response = [
                'response' => 0,
                'message' => 'There was an error saving data',
            ];
        }
    }

    public function logicStatus(Request $request) {

        $data = $request->validate([
            'id' => 'required|numeric',
            'status' => 'required|numeric'
        ]);

        $item = Country::where('id', '=', $data['id'])->first();

        if($item) {

            if($data['status'] == 1) {

                $item->status = 0;
                $item->save();
                $item->refresh();

                $response = [
                    'response' => 1,
                    'message' => 'country deactivated successfully',
                    'country' => $country
                ];

                return response()->json($response);


            } else {

                $item->status = 1;
                $item->save();
                $item->refresh();

                $response = [
                    'response' => 1,
                    'message' => 'country reactivated successfully',
                    'country' => $country
                ];

                return response()->json($response);
            }
        } else {

            return error
        }
    }

    public function getContinentName($country) {

        switch ($country->continent) {
            case 1:
                $continent_name = 'África';
                break;
            case 2:
                $continent_name = 'Antartida';
                break;
            case 3:
                $continent_name = 'Norteamérica';
                break;
            case 4:
                $continent_name = 'Sudamérica';
                break;
            case 5:
                $continent_name = 'Asia';
                break;
            case 6:
                $continent_name = 'Europa';
                break;
            case 7:
                $continent_name = 'Oceanía';
                break;
            default:
                $continent_name = 'Pangea';
                break;
        }

        return $continent_name;
    }
}
