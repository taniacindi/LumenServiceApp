<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::OrderBy("id", "DESC")->paginate(2)->toArray();
        $response = [
            "total_count" => $posts["total"],
            "limit" => $posts["per_page"],
            "pagination" => [
                "next_page" => $posts["next_page_url"],
                "current_page" => $posts["current_page"]
            ],
            "data" => $posts["data"],
        ];

        return response()->json($response, 200);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $validationRules = [
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'status' => 'required|in:draft,published',
            'user_id' => 'required|exists:users,id'
        ];

        $validator = \Validator::make($input, $validationRules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $post = Post::create($input);
        return response()->json($post, 200);
    }
    public function show(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader !== 'application/json' && $acceptHeader !== 'application/xml') {
            return response('Not Acceptable!', 406);
        }

        $post = Post::find($id);

        if (!$post) {
            abort(404);
        }

        if ($acceptHeader === 'application/json') {
            return response()->json($post, 200);
        } else {
            $xml = new \SimpleXMLElement('<post/>');

            foreach ($post->getAttributes() as $key => $value) {
                $xml->addChild(
                    $key,
                    htmlspecialchars((string) $value, ENT_XML1, 'UTF-8')
                );
            }

            return response($xml->asXML(), 200)
                ->header('Content-Type', 'application/xml');
        }
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $post = Post::find($id);

        if(!$post) {
            abort(404);
        }

        // validation
        $validationRules = [
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'status' => 'required|in:draft,published',
            'user_id' => 'required|exists:users,id'
        ];

        $validator = \Validator::make($input, $validationRules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // validation end

        $post->fill($input);
        $post->save();

        return response()->json($post, 200);
    }   
        public function destroy(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader !== 'application/json' && $acceptHeader !== 'application/xml') {
            return response('Not Acceptable!', 406);
        }

        $post = Post::find($id);

        if (!$post) {
            abort(404);
        }

        $post->delete();

        $message = [
            'message' => 'deleted successfully',
            'post_id' => $id
        ];

        if ($acceptHeader === 'application/json') {
            return response()->json($message, 200);
        } else {
            $xml = new \SimpleXMLElement('<response/>');

            foreach ($message as $key => $value) {
                $xml->addChild(
                    $key,
                    htmlspecialchars((string) $value, ENT_XML1, 'UTF-8')
                );
            }

            return response($xml->asXML(), 200)
                ->header('Content-Type', 'application/xml');
        }
    }
}

