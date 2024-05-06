<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function store(Request $request)
    {
        $ip_address = $request->query('ip_address');
        $accomodation_id = $request->query('accomodation_id');
        $data = $request->all();
        $rules = [
            'accomodation_id' => 'required|exists:accomodations,id',
            'ip_address' => 'required|ip',
        ];

        $validated_data = $request->validate($rules);

        $existing_view = View::where('ip_address', $validated_data['ip_address'])
            ->where('accomodation_id', $validated_data['accomodation_id'])
            ->first();

        // If no record found, create a new view record
        if (!$existing_view) {
            View::create($validated_data);
        }
    }
}
