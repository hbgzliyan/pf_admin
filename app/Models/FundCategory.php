<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class FundCategory extends Model
{
    protected $table = "fund_category";

    public function getFundCodesAttribute($value)
    {
        return explode(',', $value);
    }

    public function setFundCodesAttribute($value)
    {
        $this->attributes['fund_codes'] = implode(',', $value);
    }
}
