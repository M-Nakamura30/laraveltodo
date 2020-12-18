<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;
use Illuminate\Support\Facades\Auth;


// フォルダに登録
class FolderController extends Controller
{
    public function showCreateForm()
    {
    	return view('folders/create');
    }

//コントローラーメソッドが呼び出されるときに Laravel がリクエストの情報を Request クラスのインスタンス $request に詰めて引数として渡してくれる
//create メソッドの引数の型名を CreateFolder に変更します。FormRequest クラスは先ほどまで指定していた Request クラスと互換性があります。そのためここに独自の FormRequest クラスを指定することで、入力値の取得などの Request クラスの機能はそのままに、バリデーションチェックを追加することができる
    public function create(CreateFolder $request)
    {

	//データベースの書き込み
	// モデルクラスのインスタンスを作成する。
	// インスタンスのプロパティに値を代入する。
	// save メソッドを呼び出す。

    	//フォルダモデルのインスタンスを作成
    	$folder = new Folder();

    	//タイトルに入力値を代入する
    	//プロパティとして取得
    	$folder->title = $request->title;

        //ユーザーに紐づけ
        Auth::user()->folders()->save($folder);

    	//インスタンスの状態をデータベースに保存
    	// $folder->save();

    	//リダイレクト先を指定するために、redirect メソッドに続いて route メソッドを呼び出し
    	return redirect()->route('tasks.index', [
    		'id' => $folder->id,
    	]);
    }
}
