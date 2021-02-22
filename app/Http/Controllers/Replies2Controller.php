<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Reply;
use App\Models\Reply2;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;


class Replies2Controller extends Controller
{
    public function store(ReplyRequest $request, Reply2 $reply2)
    {
        // 檢查是否是已發佈的文章
        $reply = Reply::findOrFail($request->reply_id);
        
        $reply2->content = $request->content;
        $reply2->user_id = Auth::id();
        $reply2->reply_id = $reply->id;
        $reply2->save();

        //return redirect()->to($reply->topic->link())->with('success', '留言建立成功！');
        return back()->with('success', '回覆留言成功！');
    }

    public function destroy(Reply2 $reply2)
    {
        $this->authorize('destroy', $reply2);

        $reply2->delete();

        activity(class_basename(get_class($reply2)))
        ->causedBy(Auth::user())
        ->performedOn($reply2)
        ->withProperties(['owner' => $reply2->user_id])
        ->log(__METHOD__);

        //return redirect()->to($reply2->reply->topic->link())->with('success', '評論刪除成功！');
        return back()->with('success', '回覆刪除成功！');
    }
}