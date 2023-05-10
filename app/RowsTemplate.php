<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RowsTemplate extends Model
{
	protected $table = 'rows_template';

    protected $fillable=['name','image','caption'];

    public function row_template() {
		return $this->hasMany('App\RowHtml');
	}
   

}
