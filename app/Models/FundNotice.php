<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FundNotice extends Model
{
    protected $table = "fund_notice";


    public function getCodeAttribute($value)
    {
        return explode(',', $value);
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = implode(',', $value);
    }
}
