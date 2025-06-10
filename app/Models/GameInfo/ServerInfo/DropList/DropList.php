<?php

namespace App\Models\GameInfo\ServerInfo\DropList;
use Illuminate\Database\Eloquent\Model;

class DropList extends Model
{
    protected $table = 'drop_list';

    public function DropOnHq()
    {
        return $this->hasMany(DropOnHq::class, 'drop_list_id'); // sesuaikan foreign key
    }
}

