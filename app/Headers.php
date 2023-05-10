<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Headers extends Model
{
	protected $table = 'headers_generate';

	protected $fillable=['id','name','value','content'];

}
