<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JsonController extends Controller
{
    public function getTaskData() {
    	$path = storage_path() . '/app/taskdb.json';
	    $content = json_decode(file_get_contents($path), true);

	    if ($content == []) {
	    	// Empty json file returns one blank task object
	    	return response('[{"text":"Enter task here!","completed": "false"}]');
	    } else {
	    	// Else returns json data
	    	return response()->json($content);
	    }
    }

    public function writeTaskData(Request $req) {
    	$path = storage_path() . '/app/taskdb.json';
	    $content = $req->getContent();
	    file_put_contents($path, $content);

	    return response('Success', 200);
    }

    public function getTimestamp() {
    	$path = storage_path() . '/app/timestamp.json';
    	$content = json_decode(file_get_contents($path), true);

    	return response()->json($content);
    }

    public function setTimestamp(Request $req) {
    	$path = storage_path() . '/app/timestamp.json';
	    $content = $req->getContent();
	    file_put_contents($path, $content);

	    return response('Success', 200);
    }
}
