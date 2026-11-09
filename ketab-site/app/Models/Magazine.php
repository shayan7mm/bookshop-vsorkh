<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model {
    protected $fillable = ['title','slug','category_label','excerpt','body','image','read_time','published_label'];
}