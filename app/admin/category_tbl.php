<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class category_tbl extends Model
{
    
    protected $table='category_tbl';
    protected $primaryKey='id';
    protected $fillable=['parent_id','name','description','status'];
	public $timestamps = false;
}
