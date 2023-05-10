<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RowHtml extends Model
{

	const HEADER_TYPE = 'hd'; // hd -> header
	const CONTENT_TYPE = 'ct'; // ct -> header
	const FOOTER_TYPE = 'ft'; // ct -> header

	protected $table = 'rows_html';

    protected $fillable=['html_id','content','styles','align','type','template_id'];

     public function singleHtml(){
    	return $this->belongsTo('App\GenerateHtml', 'id', 'html_id');
    }

    public function singleTemplate(){
    	return $this->belongsTo('App\RowsTemplate', 'id', 'template_id');
    }

}
