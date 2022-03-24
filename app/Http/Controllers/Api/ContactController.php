<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Mail\SendNewMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $newContact = new Contact();
        $newContact->fill($data);
        $newContact->save();
        
        Mail::to('admin@gmail.com')->send(new SendNewMail($newContact));

        return response()->json($newContact);
    }
}
