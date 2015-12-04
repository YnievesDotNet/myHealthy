<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Languaje;
use App\Region;

class RegionsController extends Controller
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
        $regions = Region::where('languaje_id', '=', $lang->id)
            ->where('id_country', '=', $request->q)
            ->where('active', '=', 1)->get();
        foreach ($regions as $region) {
            $region->name = html_entity_decode($region->name);
        }
        return compact('regions');
    }
}
