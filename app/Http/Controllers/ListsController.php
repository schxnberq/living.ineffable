<?php

namespace App\Http\Controllers;

use App\ListItems;
use App\Lists;
use App\User;
use Illuminate\Http\Request;

class ListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    public function getList()
    {
        // $list = User::find(auth()->id())->lists()->orWhere('shared_with', 'LIKE', '%'.auth()->id().'%')->get();
        $shared_lists = Lists::where('shared_with', 'LIKE', '%' . auth()->id() . '%')->with('user')->orderBy('updated_at', "desc")->get();

        $own_lists = Lists::where('user_id', auth()->id())->with('user')->orderBy('updated_at', "desc")->get();

        // where('shared_with', 'LIKE', '%'.auth()->id().'%');

        return compact("own_lists", "shared_lists");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $this->validate($request, ["name" => "required|string|min:4", 'items' => 'string', 'img' => 'string', 'shared_with' => 'string']);

        // create the list
        $list = User::find(auth()->id())->lists()->create($request->only(["name", 'items', 'img', 'shared_with']));

        // dd($list);

        // return it
        return redirect()->route('user.index', $list->load("user"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $list  = Lists::where('id', $request->id)->get();
        $users = $list->pluck("shared_with");
        $get   = explode(",", $users[0]);

        $shared_with[] = User::whereIn('id', $get)->get();

        // $items = $list->pluck("shared_with");
        // $getItems   = explode(",", $items[0]);

        // $item_fin[] = ListItems::whereIn('id', $getItems)->with("user")->get();

        // var_dump($item_fin->pluck("id"));

        $list_items = ListItems::where("list_id", $request->id)->with("user")->get();
        // $items      = explode(";;", $list_items->pluck("items")[0]);

        // dd($list_items);

        $fin_imgs = [];
        $img = null;

        foreach($list_items->pluck("item") as $key => $url) {
            $user = $list_items->pluck("user")[$key]->username;
            $created_at = nice_date($list_items->pluck("created_at")[$key]);
            $description = $list_items->pluck("description")[$key];
            $image = doTheDamnThang($url, $img);
            $array = [
                "image" => $image, 
                "description" => $description,
                "created_by" => $user, 
                "created_at" => $created_at
            ];
            // var_dump($array);
            array_push($fin_imgs, $array);
        }
        // $fin_img = doTheDamnThang($items[0], $item_imgs);

        $res = [
            "list" => $list->load("user"),
            "shared_with" => $shared_with,
            "items" => $fin_imgs
        ];
        // dd($fin_imgs);

        return $res;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function edit(Lists $lists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lists $lists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lists::find($id)->delete();
        // return redirect()->route("user.index")->with("success", "List deleted!");
    }
}
