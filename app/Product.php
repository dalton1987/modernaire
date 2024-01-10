<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['category', 'product_title', 'slug', 'short_description', 'description', 'additional_information', 'price', 'discount', 'image', 'file', 'is_featured', 'is_custom','type','pdf', 'model', 'designed_by' , 'sizes' , 'instruction_file', 'dealer_price', 'standard_sizes', 'motor_options', 'finishes', 'chrome_knob', 'chrome_knob_image', 'led_lighting', 'led_lighting_image', 'baffle_filters', 'baffle_filters_image', 'implemented_underside', 'implemented_underside_image'];

    
}
