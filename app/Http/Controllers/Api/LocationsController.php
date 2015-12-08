<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Languaje;
use App\Location;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lang = Languaje::where('code', '=', App::getLocale())->first();
        if(isset($request->q)) {
            $locations = Location::where('languaje_id', '=', $lang->id)
                ->where('id_region', '=', $request->q)
                ->where('active', '=', 1)->get();
            foreach ($locations as $location) {
                $location->name = html_entity_decode($location->name);
            }
            return compact('locations');
        };
        if(isset($request->id)){
            $locations = Location::where('active', '=', 1)
                ->where('languaje_id', '=', $lang->id)
                ->where('id_location', '=', $request->id)
                ->first();
            return response()->json($locations);
        }
    }
}
