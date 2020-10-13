<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class FrontendTextLanguage extends Model{
	protected $table = 'frontend_text_language';
	public function langname(){
		return $this->hasOne('App\Models\Languages','id','language_id');
	}
	public function parentname(){
		return $this->hasOne('App\Models\FrontendText','id','parent_id');
	}
}
?>