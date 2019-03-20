<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Fund extends Model
{
    protected $table = "fund";

    public function getFandManagerIdsAttribute($value)
    {
        return explode(',', $value);
    }

    public function setFandManagerIdsAttribute($value)
    {
        $this->attributes['fand_manager_ids'] = implode(',', $value);
    }

}
