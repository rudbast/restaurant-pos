<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Access;

class UsersController extends Controller
{
    /**
     * Validation rules.
     *
     * @var array
     */
    protected $rules = [
        'username' => 'required|max:20|unique:users,username',
        'name'     => 'required|max:30',
        'email'    => 'required|email|max:255|unique:users,email',
        'access'   => [ 'array', 'exists:accesses,id' ],
        'password' => 'min:6|confirmed',
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
     * Show the manage account's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.users', [
            'users' => User::with('accesses')->get(),
            'accesses' => Access::pluck('name', 'id')
        ]);
    }

    /**
     * Show details of certain User.
     *
     * @param  User   $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->accesses;
        return response()->json($user);
    }

    /**
     * Store submitted user account details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeRules = $this->rules;
        $storeRules['password'] .= '|required';

        $this->validate($request, $storeRules);

        $user = User::create($request->except(['access']));
        $user->accesses()->sync($request->input('access'));

        return response()->json(['success' => ! empty($user)]);
    }

    /**
     * Update user information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $updateRules = $this->rules;
        $updateRules['username'] .= ',' . $user->id;
        $updateRules['email'] .= ',' . $user->id;

        $this->validate($request, $updateRules);

        try {
            $user->update($request->except(['access']));
            $user->accesses()->sync($request->input('access'));

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            abort(409, $e->getMessage());
        }
    }

    /**
     * Delete user.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id != User::first()->id) {
            $user->delete();
            return response()->json(['success' => true]);
        } else {
            abort(403, 'Action not allowed.');
        }
    }
}
