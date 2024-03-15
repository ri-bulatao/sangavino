<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Official;
use Illuminate\Http\Request;

class OfficialController extends Controller
{
    public function __invoke()
    {
        return view('guest.official.index', ['officials' => Official::with('position', 'media')->get()]);
    }
}