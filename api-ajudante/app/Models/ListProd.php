<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListProd extends Model
{
    use HasFactory;
    protected $table = "list_prods";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'slug',
    ];

    public function products_for_list()
    {
        return $this->hasMany(ProductForList::class, 'list_prods_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
