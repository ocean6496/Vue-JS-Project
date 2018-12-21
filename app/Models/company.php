<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class company
 * @package App\Models
 * @version December 20, 2018, 4:30 pm UTC
 *
 * @property string name
 * @property string address
 * @property string description
 * @property string phone
 */
class company extends Model
{

    public $table = 'companies';
    


    public $fillable = [
        'name',
        'address',
        'description',
        'phone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'address' => 'string',
        'description' => 'string',
        'phone' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required | min:6',
        'address' => 'required',
        'description' => 'required',
        'phone' => 'required'
    ];

    
}
