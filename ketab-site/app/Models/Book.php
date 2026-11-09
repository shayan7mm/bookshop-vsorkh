<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    protected $fillable = ['title','slug','author','price','old_price','type','tag','description','image','category_id','publisher_id'];
    protected $casts = ['price'=>'integer','old_price'=>'integer'];

    public function category() { return $this->belongsTo(Category::class); }
    public function publisher() { return $this->belongsTo(Publisher::class); }
    public function scopeOnSale($q) { return $q->whereNotNull('old_price'); }
}