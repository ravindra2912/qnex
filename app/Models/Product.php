<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
	public $table = 'products';
    public $primaryKey = 'id';
	
	public $timestamps = true;

    protected $appends = ['imageurl'];
	
	protected $fillable = ['user_id'];

    public function getImageUrlAttribute()
    {
        $imgs = ProductImages::where('product_id', $this->id)->first();
        if($imgs){
            return getImage($imgs->image);
        }
        return getImage('');
    }

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public function category_data(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function sub_category_data(){
        return $this->hasOne(Category::class, 'id', 'sub_category_id');
    } 

	public function sub_category2_data(){
        return $this->hasOne(Category::class, 'id', 'sub_category2_id');
    } 
	public function images_data(){
        return $this->hasMany(ProductImages::class, 'product_id', 'id')->orderBy('id', 'asc');
    } 
	
	public function variants_data(){
        return $this->hasMany(ProductVariants::class, 'product_id', 'id')->orderBy('id', 'asc');
    } 

    public function getFavourite(){
        return $this->hasOne(Wishlist::class, 'product_id', 'id')->where('user_id', getUserId());
    }
	
	
}
