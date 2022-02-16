<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Mail\NewMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $success = true;

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'msg' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        };

        $new_contact = new Contact();
        $new_contact->fill($data);
        $new_contact->save();

        Mail::to('tavella01@gmail.com')->send(new NewMail($new_contact));
        
        return response()->json(compact('success'));
    }
}
