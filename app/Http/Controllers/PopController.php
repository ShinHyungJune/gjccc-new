<?php

namespace App\Http\Controllers;

use App\Models\Pop;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PopController extends Controller
{
    public function update(Request $request, Pop $pop)
    {
        $hideAt = $request->today
            ? Carbon::now()->endOfDay()
            : Carbon::now()->addSeconds(30);

        $pop->update([
            "hide_at" => $hideAt
        ]);

        return redirect()->back();
    }
}
