<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Menu;
use App\Category;

class MenusController extends Controller
{
    /**
     * Validation rules.
     *
     * @var array
     */
    protected $rules = [
        'name'     => 'required',
        'category' => 'required|exists:categories,id',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('can:admin');
    }

    /**
     * Show the manage menus' page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.menus', [
            'menus'      => Menu::with('category')->get(),
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    /**
     * Show details of certain Menu.
     *
     * @param  Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        $menu->category;
        return response()->json($menu);
    }

    /**
     * Store submitted menu details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $category = Category::findOrFail($request->input('category'));

        $menu = new Menu($request->except(['category']));
        $menu->category()->associate($category);
        $menu->save();

        return response()->json(['success' => ! empty($menu)]);
    }

    /**
     * Update menu information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $this->validate($request, $this->rules);
        $category = Category::findOrFail($request->input('category'));

        try {
            $menu->update($request->except('category'));
            $menu->category()->associate($category);
            $menu->save();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            abort(409, $e->getMessage());
        }
    }

    /**
     * Delete user.
     *
     * @param  Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        return response()->json(['success' => $menu->delete()]);
    }
}
