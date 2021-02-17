<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\TopicCategory;
use Auth;
use App\Handlers\ImageUploadS3Handler;
use Carbon\Carbon;
use App\Exceptions\InvalidRequestException;


class TopicsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request, Topic $topic)
    {
        $topic = $topic->published();

        // 篩選 tag
        if ($tag = $request->input('tag', '')) {
            $topics = $topic->withTag($tag);
        }

        $topics = $topic->withOrder($request->order)
                        ->with('user', 'category')
                        ->paginate(20);

        return view('topics.index', compact('topics'));
    }

    public function show(Topic $topic)
    {
        /*URL 矯正
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }*/
        if($topic->user_id == Auth::id()){
            $topic = Topic::findOrFail($topic->id);
        }else{
            $topic = Topic::published()->findOrFail($topic->id);
        }

        $replies = $topic->replies()->with('user')->get();
        
        return view('topics.show', compact('topic','replies'));
    }

	public function create()
	{
        $categories = TopicCategory::all();
        return view('topics.create', compact('categories'));
	}

	public function store(TopicRequest $request, Topic $topic)
	{
        // 移除 a tag 的所有內容
        $request->merge([
            'body' => remove_tag_cotent($request->body, '<a', '</a>'),
        ]);

        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();

        return redirect()->to(route('users.show',[$topic->user]))->with('success', '文章創建成功！');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);

        $categories = TopicCategory::all();

		return view('topics.edit', compact('topic','categories'));
	}

    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        // 移除 a tag 的所有內容
        $request->merge([
            'body' => remove_tag_cotent($request->body, '<a', '</a>'),
        ]);
        
        $topic->update($request->all());

        return redirect()->to($topic->link())->with('success', '更新成功！');
    }
    
    public function destroy(Topic $topic)
    {
        $this->authorize('destroy', $topic);
        $topic->delete();

        activity(class_basename(get_class($topic)))
        ->causedBy(Auth::user())
        ->performedOn($topic)
        ->withProperties(['owner' => $topic->user_id])
        ->log(__METHOD__);
        
        return redirect()->route('topics.index')->with('success', '成功刪除！');
    }
    
    public function uploadImage(Request $request, ImageUploadS3Handler $uploader)
    {
        // 初始化返回數據，默認是失敗的
        $data = [
            'success'   => false,
            'msg'       => '上傳失敗!',
            'file_path' => ''
        ];
        // 判斷是否有上傳文件，並賦值給 $file
        if ($file = $request->upload_file) {
            // 保存圖片
            $result = $uploader->save($file, 'topics', \Auth::id(), 1024);
            // 圖片保存成功
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上傳成功!";
                $data['success']   = true;
            }
        }

        return $data;
    }

    public function favor(Topic $topic, Request $request)
    {
        $user = $request->user();
        if ($user->favoriteTopics()->find($topic->id)) {
            return [];
        }

        $user->favoriteTopics()->attach($topic);

        return [];
    }

    public function disfavor(Topic $topic, Request $request)
    {
        $user = $request->user();
        $user->favoriteTopics()->detach($topic);

        return [];
    }


    public function subscribe(Topic $topic, Request $request)
    {
        $user = $request->user();
        if ($user->subscribeTopics()->find($topic->id)) {
            return [];
        }

        $user->subscribeTopics()->attach($topic);

        return [];
    }

    public function unsubscribe(Topic $topic, Request $request)
    {
        $user = $request->user();
        $user->subscribeTopics()->detach($topic);

        return [];
    }




}