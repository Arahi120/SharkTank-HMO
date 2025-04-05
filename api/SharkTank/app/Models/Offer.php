<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model

{

    use HasFactory;



    protected $table = 'offers';



    protected $fillable = [

        'post_id',

        'investor_id',

        'offer',

    ];

    public function post()

    {

        return $this->belongsTo(Post::class);

    }



    // En el modelo Offer (Offer.php)
public function investor()
{
    return $this->belongsTo(Investor::class);  // Verifica que esté correctamente definido
}
}
