<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Notifications\StoreReceiveNewOrder;

class Store extends Model
{ 
    use HasSlug;
    
    protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'];

    /**
     * 
     * Get the option for generating the slug
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                            ->generateSlugsFrom('name')
                            ->saveSlugsTo('slug');
    }

    // em caso de se usar um nome de tabela diferente
    // protected $table = 'nome do arquivo';
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        // return $this->belongsToMany(UserOrder::class);
        return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id');
    }

    // public function getSlugOptions() : SlugOptions
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom('name')
    //         ->saveSlugsTo('slug');
    // }

    /**
     *
     */
    public function notifyStoreOwers(array $storesId = [])
    {
        $stores = $this::whereIn('id', $storesId)->get();

        return $stores->map(function($store){
            return $store->user;
        })->each->notify(new StoreReceiveNewOrder());
    }
}
