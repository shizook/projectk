<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
   public function index(Request $request)
{
    $menus = MenuItem::orderBy('location')->orderBy('display_order')->get();
    
    $menuData = null;
    if ($request->has('edit')) {
        $menuData = MenuItem::find($request->edit);
        
    }

    return view('admin.menus.index', compact('menus', 'menuData'));
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

   public function update(Request $request, MenuItem $menuItem)
   {
    $data = $request->validate([
        'title'         => 'required|max:120',
        'url'           => 'required|max:255',
        'location'      => 'required|in:header,footer',
        'display_order' => 'nullable|integer',
        'visible'       => 'required|boolean'
    ]);

    $data['display_order'] = $data['display_order'] ?? 0;

    // Simpan perubahan ke database menggunakan $menuItem
    $menuItem->update($data);

    // Redirect balik ke index
    return redirect()->route('admin.menus.index')->with('ok', 'Menu item diupdate.');
}

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return back()->with('ok','Menu item dihapus.');
    }
}
