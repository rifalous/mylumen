<?php 
namespace App;
use Illuminate\Database\Eloquent\Model; 

class Product extends Model {     
    protected $fillable = ['name','category_id','slug','price','weight','description'];     
    protected $dates = [];   
} 