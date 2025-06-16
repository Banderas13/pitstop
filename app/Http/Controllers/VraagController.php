<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VraagIngediend;

class VraagController extends Controller
{
    public function verstuur(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'vraag' => 'required|string|max:1000',
        ]);

        Mail::to('admin@pitstop.com')
            ->send(new VraagIngediend($request->email, $request->vraag));

        return redirect()->back()->with('success', 'Uw vraag is verzonden!');
    }
}