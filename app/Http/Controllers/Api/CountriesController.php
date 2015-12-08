<?php

namespace App\Http\Controllers\Api;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Languaje;

class CountriesController extends Controller
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
        if(isset($request->q)){
            $countries = Country::where('active', '=', 1)
                ->where('languaje_id', '=', $lang->id)
                ->whereRaw("lower(name) like '%" . $request->q . "%'")
                ->take(10)
                ->get();
            foreach ($countries as $country) {
                $country->name = html_entity_decode($country->name);
            }
            return response()->json(['countries' => $countries]);
        };
        if(isset($request->id)){
            $countries = Country::where('active', '=', 1)
                ->where('languaje_id', '=', $lang->id)
                ->where('id_country', '=', $request->id)
                ->first();
            return response()->json($countries);
        }
    }
}
