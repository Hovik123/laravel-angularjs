<?php

namespace App\Http\Controllers;

use App\Posts;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


use Symfony\Component\HttpFoundation\Response;


class PostController extends Controller
{
    /**
     * run app
     */
    public function run()
    {
        return View::make('post.index', ['name' => 'Rishabh'])->render();
    }

    /**
     * get all items
     * @return mixed
     */

    public function index()
    {
        try {
            $statusCode = 200;
            $response = [];

            $posts = Posts::all();
            if ($posts != null) {
                foreach ($posts as $post) {

                    $response['posts'][] = [
                        'id' => $post->id,
                        'title' => $post->title,
                        'description' => $post->description,
                        'content' => $post->content,
                        'published' => $post->published
                    ];
                }
                $statusCode = 200;
            } else {
                $statusCode = 404;
            }
        } catch (Exception $e) {
            $statusCode = 400;
        } finally {

            return \Response::json($response, $statusCode);
        }
    }


    /**
     * get item by id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        try {
            $statusCode = 200;

            $response = [];

            $post = Posts::find($id);
            if ($post != null) {
                $response['post'] = [
                    'id' => $post->id,
                    'title' => $post->title,
                    'description' => $post->description,
                    'content' => $post->content,
                    'published' => $post->published
                ];
                $statusCode = 200;
            } else {
                $statusCode = 400;
            }
            $response['status'] = $statusCode;

        } catch (Exeption $e) {
            $statusCode = 400;
        } finally {

            return \Response::json($response, $statusCode);
        }
    }

    public function update($id)
    {
        try {
            $statusCode = 200;

            $response = [];
            $message = "";
            $data = json_decode(file_get_contents('php://input'));
            $title = $data->title;
            $description = $data->description;
            $content = $data->content;
            $published = $data->published;
            DB::table('posts')
                ->where('id', $id)
                ->update(['title' => $title, 'description' => $description, 'content' => $content, 'published' => $published]);
            $statusCode = 200;
            $message = "Post updated successfully";
            $response['posts'] = Posts::all();

        } catch (Exeption $e) {
            $statusCode = 400;
            $message = $e->getMessage();
        } finally {
            $response['status'] = $statusCode;
            $response['message'] = $message;
            return \Response::json($response, $statusCode);
        }
    }

    /**
     * delete item by id
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        try {
            $statusCode = 200;

            $response = [];

            if (Posts::where(["id" => $id])->delete()) {
                $statusCode = 200;
                $message = "Post deleted success";
                $response['posts'] = Posts::all();
            } else {
                $message = "Post not found";
                $statusCode = 404;
            }
            $response['status'] = $statusCode;
            $response['message'] = $message;

        } catch (Exeption $e) {
            $statusCode = 400;
        } finally {

            return \Response::json($response, $statusCode);
        }
    }

    /**
     * @return mixed
     */
    public function add()
    {
        $response = [];
        $message = "Inserted ok";
        $statusCode = 200;
        $data = json_decode(file_get_contents('php://input'));

        if (!empty($data)) {
            try {
                $title = $data->title;
                $description = $data->description;
                $content = $data->content;
                $published = $data->published;
                DB::table('posts')->insert([
                    [
                        'title' => $title,
                        'description' => $description,
                        'content' => $content,
                        'published' => $published
                    ],
                ]);
                $response['posts'] = Posts::all();
                $statusCode = 200;
            } catch (Exception $e) {
                $message = $e->getMessage();
                $statusCode = 400;
            } finally {
                $response['status'] = $statusCode;
                $response['message'] = $message;

            }
        } else {
            $statusCode = 400;
        }
        return \Response::json($response, $statusCode);

    }
}