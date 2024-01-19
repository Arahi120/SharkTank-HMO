<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function list () {

        $offers = Offer::all();

        $list = [];

        foreach($offers as $offer){

            $object = [

            "id" => $offer->id,
            "post_id" => $offer->post_id,
            "investor_id" => $offer->investor_id,
            "offer" => $offer->offer,
            "created" => $offer->created_at, 
            "updated" => $offer->updated_at

            ];

            array_push($list,$object);
        }

        return response()->json($list);
    }

    public function item ($id) {

        $offer = Offer::where('id','=', $id )->first();

            $object = [

                "id" => $offer->id,
                "post_id" => $offer->post_id,
                "investor_id" => $offer->investor_id,
                "offer" => $offer->offer,
                "created" => $offer->created_at, 
                "updated" => $offer->updated_at
    

            ];

        

        return response()->json($object); 
    }

}
