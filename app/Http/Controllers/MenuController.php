<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = MenuItem::orderBy('location')->orderBy('display_order')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|max:120',
            'url'=>'required|max:255',
            'location'=>'required|in:header,footer',
            'display_order'=>'required|integer',
            'visible'=>'required|boolean'
        ]);

        MenuItem::create($data);
        return back()->with('ok','Menu item dibuat.');
    }

    public function update(MenuItem $menuItem, Request $request)
    {
        $data = $request->validate([
            'title'=>'required|max:120',
            'url'=>'required|max:255',
            'location'=>'required|in:header,footer',
            'display_order'=>'required|integer',
            'visible'=>'required|boolean'
        ]);

        $menuItem->update($data);
        return back()->with('ok','Menu item diupdate.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return back()->with('ok','Menu item dihapus.');
    }
}
