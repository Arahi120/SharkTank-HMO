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
    public function create(Request $request) {
        $data = $request->validate([
            'post_id'=> 'required|min:3,max:20',
            'investor_id'=> 'required|min:3,max:20',
            'offer'=> 'required|min:3,max:20'
            
        ]);
            
        $offer = Offer::create([
            'post_id'=> $data['post_id'],
            'investor_id'=> $data['investor_id'],
            'offer'=> $data['offer']
                
        ]);
    
        if ($offer) {
            $object = [
    
                "response" => 'Succes.Item saved correctly.',
                "data" => $offer
        
            ];
        
            return response()->json($object);
        }else {
            $object = [

                "response" => 'Error:Something went wrong, please try again.',
        
            ];
        
        return response()->json($object);
        }
    }
    public function update(Request $request) {
        $data = $request->validate([
            'id' => 'required|integer|min:1',
            'post_id'=> 'required|min:3,max:20',
            'investor_id'=> 'required|min:3,max:20',
            'offer'=> 'required|min:3,max:20'
            
        ]);

        $offer = offer::where('id', '=', $data['id'])->first();
            
        $offer->post_id = $data['post_id'];
        $offer->investor_id = $data['investor_id'];
        $offer->offer = $data['offer'];
        
        if ($offer->update()) {
            $object = [
    
                "response" => 'Succes.Item updated correctly.',
                "data" => $offer
        
            ];
        
            return response()->json($object);
        }else {
            $object = [

                "response" => 'Error:Something went wrong, please try again.',
        
            ];
        
            return response()->json($object);

        }
    }
}
