<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenerateHtml extends Model
{
    protected $table = 'generate_html';
    protected $fillable=['name'];

    public function row_html() {
    	return $this->hasMany('App\RowHtml');
    }
    
}
