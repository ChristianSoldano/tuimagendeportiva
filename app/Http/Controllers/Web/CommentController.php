<?php

namespace App\Http\Controllers\Web;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Reply;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\ReplyStoreRequest;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function comment(CommentStoreRequest $request)
    {
        $commentary = Comment::create($request->all());

        return redirect()->back();
    }

    public function reply(ReplyStoreRequest $request)
    {
        Reply::create($request->all());
        return redirect()->back();
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $this->authorize('pass', $comment);
        $comment->delete();
        return redirect()->back();
    }

    public function destroyReply($id)
    {
        $reply = Reply::find($id);
        $this->authorize('pass', $reply);
        $reply->delete();
        return redirect()->back();
    }
}
