<?php

namespace App\Http\Controllers;

use App\Models\Click;
use Illuminate\Http\Request;

class ClickController extends Controller
{
    public function trackClick(Request $request)
    {


        $clickRecord = new Click();

        // Update the click count and last click time
        $clickRecord->click_count++;
        $clickRecord->last_click_time = now();
        $clickRecord->save();

        return response()->json(['message' => 'Button click tracked successfully']);

    }
}
