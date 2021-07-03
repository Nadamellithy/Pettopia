<?php

namespace App\Http\Controllers;

use App\Models\Ppet;
use App\Puser;
use App\Models\Ppost;
use App\Pcomment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Like;

class PostController extends Controller
{

    public function storecomment(Request $request)
    {
        //  $Pusers = Puser::find($id);
        $Validator = Validator::make($request->all(), [
            'comment' => 'required',
            'post_id' => 'requird|exists:Pposts,id']);
        $Ppost = Ppost::find($request->post_id);
        $Pcomments = new Pcomment($request);
        $Pcomments->comment = $request->get('comment');
        return response()->json($Pcomments);

    }

        public function isLikedByMe($id)
    {
        $Ppost = Ppost::find($id);
        if (Like::where($Ppost->id)->exists()){
            return 'true';
        }
        return 'false';
    }

        public function like(Post $post)
        {
            $existing_like = Like::withTrashed()->wherePostId($post->id)->whereUserId(Auth::id())->first();

if (is_null($existing_like)) {
    Like::create([
        'post_id' => $post->id,
        'user_id' => Auth::id()
    ]);
}
else
{
    if (is_null($existing_like->deleted_at)) {
        $existing_like->delete();
    } else {
        $existing_like->restore();
    }
}
}}



