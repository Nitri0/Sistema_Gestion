<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permisologia extends Model
{
	protected $connection = 'permisologia';
	protected $table = 't_permisologia';
	protected $primaryKey = "id_permisologia";
	protected $fillable = [];
	public $timestamps = false;

}
