<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompletedTask as CompletedTaskModel;

class CompletedTaskController extends Controller
{
    /**
     * 完了タスク一覧ページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function list(){
        
        // 1Page辺りの表示アイテム数を設定
        $per_page = 2;
        
        // 一覧の取得
        $list = $this->getListBuilder()
                     ->paginate($per_page);
        
        return view('task/completed_list', ['list' => $list]);
    }
    
    /**
     * 一覧用の Illuminate\Database\Eloquent\Builder インスタンスの取得
     */
    protected function getListBuilder()
    {
        return CompletedTaskModel::where('user_id', Auth::id())
                     ->orderBy('priority', 'DESC')
                     ->orderBy('period')
                     ->orderBy('created_at');
    }
}
