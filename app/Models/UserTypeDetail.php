<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTypeDetail extends Model
{
    protected $guarded=[];  
    use SoftDeletes,HasFactory;

    public function user_type()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function menus()
    {
        return $this->belongsTo(Menu::class,'menu_id');
    }


   /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status;
    }

    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeActive($query, $status = true)
    {
        return $query->where('active', $status);
    }
}
