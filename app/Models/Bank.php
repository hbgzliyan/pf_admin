<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;


class Bank extends Model
{
    protected $table = 'bank';

    public function delete()
    {
        $this->status = 0;
        return $this->save();
    }
}
