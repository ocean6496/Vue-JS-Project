<?php

namespace App\Repositories;

use App\Models\company;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class companyRepository
 * @package App\Repositories
 * @version December 20, 2018, 4:30 pm UTC
 *
 * @method company findWithoutFail($id, $columns = ['*'])
 * @method company find($id, $columns = ['*'])
 * @method company first($columns = ['*'])
*/
class companyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'address',
        'description',
        'phone'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return company::class;
    }
}
