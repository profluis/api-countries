<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function list() {

        $states = State::orderBy('name', 'asc')->get();

        $list = [];

        foreach ($states as $state) {

            $object = [
                'id' => $state->id,
                'name' => $state->name,
                'country' => $state->country,
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }
}
