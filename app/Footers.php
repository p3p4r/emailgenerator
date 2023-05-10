<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footers extends Model

{
	protected $table = 'footer_template';

	protected $fillable=['id','name','value','content'];

}


