<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller{

    public function index(){
        return view('posts-index');
    }
    public function store(){
    
    }
    public function create(){

    }
    public function edit(string $id){
        
    }
}