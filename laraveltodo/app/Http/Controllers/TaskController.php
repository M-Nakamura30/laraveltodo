<?php

//「タスクを追加する」の箇所を処理するファイル

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\EditTask;
//バリデート
use App\Http\Requests\CreateTask;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
	public function index(int $id)
	{
		//全てのフォルダお取得
		// $folders = Folder::all();

		//ユーザーのフォルダを取得
		$folders = Auth::user()->folders()->get();

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

	public function showCreateForm(int $id)
	{
    return view('tasks/create', [
        'folder_id' => $id
    	]);
	}

	public function create(int $id, CreateTask $request)
	{
    	$current_folder = Folder::find($id);

    	$task = new Task();
    	$task->title = $request->title;
    	$task->due_date = $request->due_date;

    	$current_folder->tasks()->save($task);

    	return redirect()->route('tasks.index', [
        	'id' => $current_folder->id,
    	]);
	}

	public function showEditForm(int $id, int $task_id)
	{
		$task = Task::find($task_id);

		return view('tasks/edit', [
			'task' => $task,
		]);
	}

	public function edit(int $id, int $task_id, EditTask $request)
	{
		//1
		//データの取得。取得したものが編集対象
		$task = Task::find($task_id);

		//2
		//編集対象のタスクデータに入力値を設定
		$task->title = $request->title;
		$task->status = $request->status;
		$task->due_date = $request->due_date;
		$task->save();

		//3
		return redirect()->route('tasks.index', [
			'id' => $task->folder_id,
		]);

	}
}
