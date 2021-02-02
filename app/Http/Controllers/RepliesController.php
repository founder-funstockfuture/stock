<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;


class RepliesController extends Controller
{
    public function store(ReplyRequest $request, Reply $reply)
    {
        // 檢查是否是已發佈的文章
        $topic = Topic::published()->findOrFail($request->topic_id);
        
        $reply->content = $request->content;
        $reply->user_id = Auth::id();
        $reply->topic_id = $topic->id;
        $reply->save();

        return redirect()->to($reply->topic->link())->with('success', '留言建立成功！');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('destroy', $reply);

        $reply->delete();

        activity(class_basename(get_class($reply)))
        ->causedBy(Auth::user())
        ->performedOn($reply)
        ->withProperties(['owner' => $reply->user_id])
        ->log(__METHOD__);

        return redirect()->to($reply->topic->link())->with('success', '評論刪除成功！');
    }
}