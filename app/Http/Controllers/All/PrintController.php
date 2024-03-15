<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Models\Blotter;
use App\Models\Resident;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function __invoke(Request $request)
    {
        return match($request->records) {
            'blotter' => view('admin.blotter.print', ['blotters' => Blotter::with('official')->get()]),
            'resident' => view('admin.resident.print', ['residents' => Resident::with('purok')->get()]),
        };
    }
}