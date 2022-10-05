<?php

namespace App\Http\Controllers;

use App\Models\Stationary;
use App\Models\Category;
use Illuminate\Http\Request;

class StationaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $stationaries = Stationary::latest()->paginate(5);

        $stationaries = Stationary::select([
            's.id',
            's.name',
            's.price',
            's.detail',
            's.user_id',
            'u.name as user_name',
            'c.str as category',
        ])
        ->from('stationaries as s')
        ->join('categories as c', function($join) {
            $join->on('s.category', '=', 'c.id');
        })
        ->join('users as u', function($join) {
            $join->on('s.user_id', '=', 'u.id');
        })
        ->orderBy('s.id', 'DESC')
        ->paginate(5);

        if (isset(\Auth::user()->name)) {
            return view('index', compact('stationaries'))
                ->with('user_name', \Auth::user()->name)
                ->with('page_id',request()->page)
                ->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            return view('index', compact('stationaries'))
                ->with('page_id', request()->page)
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20',
            'price' => 'required|integer',
            'category' => 'required|integer',
            'detail' => 'required|max:140',
        ]);

        $stationary = new Stationary;
        $stationary->name = $request->input(['name']);
        $stationary->price = $request->input(['price']);
        $stationary->category = $request->input(['category']);
        $stationary->detail = $request->input(['detail']);
        $stationary->user_id = \Auth::user()->id;
        $stationary->save();

        return redirect()->route('stationaries.index')->with('success', '文房具を登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function show(Stationary $stationary)
    {
        $categories = Category::all();
        return view('show', compact('stationary'))
            ->with('page_id', request()->page_id)
            ->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function edit(Stationary $stationary)
    {
        $categories = Category::all();
        return view('edit', compact('stationary'))
            ->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stationary $stationary)
    {
        $request->validate([
            'name' => 'required|max:20',
            'price' => 'required|integer',
            'category' => 'required|integer',
            'detail' => 'required|max:140',
        ]);

        $stationary->name = $request->input(['name']);
        $stationary->price = $request->input(['price']);
        $stationary->category = $request->input(['category']);
        $stationary->detail = $request->input(['detail']);
        $stationary->user_id = \Auth::user()->id;
        $stationary->save();

        return redirect()->route('stationaries.index')->with('success', '文房具を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stationary $stationary)
    {
        $stationary->delete();
        return redirect()->route('stationaries.index')
                            ->with('success', '文房具'. $stationary->name. 'を削除しました');
    }
}
