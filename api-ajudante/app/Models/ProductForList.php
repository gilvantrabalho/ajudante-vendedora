<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductForList extends Model
{
    use HasFactory;
    protected $table = "products_for_list";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'list_prods_id',
        'name',
        'status',
    ];

    public function list_prods()
    {
        return $this->belongsTo(ListProd::class);
    }
}
