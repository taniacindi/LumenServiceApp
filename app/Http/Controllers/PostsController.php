<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml') {
            $posts = Post::orderBy("id", "DESC")->paginate(10);

            if ($acceptHeader === 'application/json') {
                return response()->json($posts->items(), 200);
            } else {
                $xml = new \SimpleXMLElement('<posts/>');

                foreach ($posts->items() as $item) {
                    $xmlItem = $xml->addChild('post');

                    foreach ($item->getAttributes() as $key => $value) {
                        $xmlItem->addChild(
                            $key,
                            htmlspecialchars((string) $value, ENT_XML1, 'UTF-8')
                        );
                    }
                }

                return response($xml->asXML(), 200)
                    ->header('Content-Type', 'application/xml');
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }
    public function store(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml') {
            $contentTypeHeader = $request->header('Content-Type');

            if ($contentTypeHeader === 'application/json') {
                $input = $request->all();
                $post = Post::create($input);

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
            } else {
                return response('Unsupported Media Type', 415);
            }
        } else {
            return response('Not Acceptable!', 406);
        }
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
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader !== 'application/json' && $acceptHeader !== 'application/xml') {
            return response('Not Acceptable!', 406);
        }

        $contentTypeHeader = $request->header('Content-Type');

        if ($contentTypeHeader !== 'application/json') {
            return response('Unsupported Media Type', 415);
        }

        $post = Post::find($id);

        if (!$post) {
            abort(404);
        }

        $input = $request->all();

        $post->fill($input);
        $post->save();

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

