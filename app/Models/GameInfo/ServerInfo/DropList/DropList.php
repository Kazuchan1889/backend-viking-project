<?php

namespace App\Models\GameInfo\ServerInfo\DropList;

use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\ServerInfo\DropList\DropOnHq;
use App\Models\GameInfo\ServerInfo\DropList\ElanPlateau;
use App\Models\GameInfo\ServerInfo\DropList\ElfLand;
use App\Models\GameInfo\ServerInfo\DropList\EtherPlatform;
use App\Models\GameInfo\ServerInfo\DropList\OutcastLand;
use App\Models\GameInfo\ServerInfo\DropList\SetteDesert;
use App\Models\GameInfo\ServerInfo\DropList\VolcanicCauldron;
use App\Models\GameInfo\ServerInfo\DropList\PitbossDrop;
use App\Models\GameInfo\ServerInfo\DropList\Cragmine;



class DropList extends Model
{
    protected $fillable = ['title'];

    public function droponhq()
    {
        return $this->hasMany(related: DropOnHq::class);
    }

    public function elanplateau()
    {
        return $this->hasMany(ElanPlateau::class);
    }

    public function settedesert()
    {
        return $this->hasMany(SetteDesert::class);
    }

    public function volcaniccauldron()
    {
        return $this->hasMany(VolcanicCauldron::class);
    }

    public function elfland()
    {
        return $this->hasMany(ElfLand::class);
    }

    public function etherplatform()
    {
        return $this->hasMany(EtherPlatform::class);
    }

    public function outcastland()
    {
        return $this->hasMany(OutcastLand::class);
    }

    public function pitbossdrop()
    {
        return $this->hasMany(PitbossDrop::class);
    }

    public function cragmine()
    {
        return $this->hasMany(Cragmine::class);
    }
    
}

