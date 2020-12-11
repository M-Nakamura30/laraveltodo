<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public function tasks()
    {
    	return $this->hasMany('App\Task');
    	//省略無し
    	// $this->hasMany('App\Task', 'folder_id', 'id');

    	//第一引数・・・関連するモデル名（名前空間も含む）
    	//第二引数・・・関連するテーブルが持つ外部キーカラム名
    	//第三引数・・・モデルに hasMany が定義されている側のテーブルが持つ、外部キーに紐づけられたカラム

    }
}
