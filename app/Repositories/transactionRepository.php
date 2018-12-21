<?php

namespace App\Repositories;

use App\Models\transaction;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class transactionRepository
 * @package App\Repositories
 * @version December 20, 2018, 4:34 pm UTC
 *
 * @method transaction findWithoutFail($id, $columns = ['*'])
 * @method transaction find($id, $columns = ['*'])
 * @method transaction first($columns = ['*'])
*/
class transactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'currency_id',
        'dated',
        'active',
        'amount'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return transaction::class;
    }
}
