<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
    	//ログインユーザーを取得
    	$user = Auth::user();

    	//ログインユーザーに基づくフォルダを一つ取得
    	$folder = $user->folders()->first();

    	//一つもフォルダを作っていなければホームページをレスポンスする
    	if (is_null($folder)) {
    		return view('home');
    	}

    	//フォルダがあればそのフォルダのタスク一覧にリダイレクトする
    	return redirect()->route('tasks.index', [
    		'id'=> $folder->id,
    	]);
    }
}
