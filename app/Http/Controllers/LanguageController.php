<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LanguageController extends Controller
{
    /**
     * Select language locale.
     *
     * @param  string $lang
     * @return \Illuminate\Http\Response
     */
    public function select($lang)
    {
        session()->put('locale', $lang);

        return redirect()->back();
    }
}
