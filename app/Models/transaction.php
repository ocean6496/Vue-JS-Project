<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class transaction
 * @package App\Models
 * @version December 20, 2018, 4:34 pm UTC
 *
 * @property string name
 * @property int currency_id
 * @property time dated
 * @property int active
 * @property string amount
 */
class transaction extends Model
{
    use SoftDeletes;

    public $table = 'transactions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'currency_id',
        'dated',
        'active',
        'amount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'amount' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'currency_id' => 'required',
        'dated' => 'required',
        'active' => 'required',
        'amount' => 'required'
    ];

    
}
