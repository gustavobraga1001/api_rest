<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;

class PostsController extends Controller

{

    public function index()
    {
        return Posts::all();

    }


    public function store(Request $request)
    {
        Posts::create($request->all());
        return $response = json_encode([
            "error" => false,
            "mensage" => "Post publicado com successo"
        ]);
    }


    public function show($id)
    {
        return Posts::findOrFail($id, ['id','title','description']);
    }

    public function update(Request $request, $id)
    {
        $post = Posts::findOrFail($id);
        $post->update($request->all());
        return $response = json_encode([
            "error" => false,
            "mensage" => "Post atualizado com sucesso!"
        ]);
    }


    public function destroy($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();
        return $response = json_encode([
            "error" => false,
            "mensage" => "Post deletado com sucesso!"
        ]);
    }
}

