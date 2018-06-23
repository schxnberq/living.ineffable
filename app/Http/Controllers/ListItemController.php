<?php

namespace App\Http\Controllers;

use App\ListItems;
use Illuminate\Http\Request;

class ListItemController extends Controller
{
    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
        	"link" => "required|string|min:4",
        	"description" => "required|string|min:4"
        ]);
        // add Item
        $listItem = ListItems::create([
        	'user_id' => auth()->id(), 
        	"list_id" => $request->id, 
        	"item" => $request->link, 
        	"description" => $request->description,
        	"created_at" => now()
        ]);
    }
}
