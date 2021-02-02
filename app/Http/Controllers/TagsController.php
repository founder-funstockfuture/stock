<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
//use App\Exceptions\InvalidRequestException;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        return view('tags.index', [
            'tags' => $request->user()->tags()
        ]);
    }
	
    public function create()
    {
        return view('tags.create', ['tags' => new Tag()]);
    }
	
    public function store(TagRequest $request)
    {
        $request->user()->tags()->create($request->only([
            'tag_name'
        ]));

        return redirect()->route('tags.index')->with('success', '資料新增成功！');
    }

    public function edit(Tag $tags)
    {
		$this->authorize('own', $tags);
		
        return view('tags.edit', ['tags' => $tags]);
    }

    public function update(Tag $tags, TagRequest $request)
    {
		$this->authorize('own', $tags);
		
        $tags->update($request->only([
            'tag_name',
        ]));

        return redirect()->route('tags.index')->with('success', '資料更新成功！');
    }

    public function destroy(Tag $tags)
    {
		$this->authorize('own', $tags);
		
        $tags->delete();

        return redirect()->route('tags.index')->with('success', '成功刪除！');
    }


    // 發佈前，取得標籤
    public function userTags(Request $request)
    {
        $tags = $request->user()->tags()->get();

        return response()->json($tags);
    }

    
}
