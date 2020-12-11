<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
	public function index(int $id)
	{
		//全てのフォルダお取得
		$folders = Folder::all();

		//プライマリキーのカラムを条件として一行分のデータを取得
		$current_folder = Folder::find($id);

		//選ばれたフォルダに基づくタスクを取得
		//whereメソッドはデータの取得条件を表し、SQLのWHERE句にあたる。
		//第一引数がカラム名、第二引数が比較する値。
		// $tasks = Task::where('folder_id', $current_folder->id)->get();

		//上記を下記の方法で短く記述
		//tasksテーブルからデータを取得
		$tasks = $current_folder->tasks()->get();

		return view('tasks/index', [
			'folders' => $folders,
			'current_folder_id' => $current_folder->id,
			'tasks' => $tasks,
		]);
	}
}
