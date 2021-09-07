<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;
use App\Message;


class MessageController extends Controller
{
    public function store(Request $request){
        $data=$request->all();
        //1.Validation
        $validator = Validator::make($data, [
            'appartment_id' => 'required',
            'name'=>'required',
            'email'=> 'required',
            'message'=>'required',
             //aggiungendo un altro array in formato: 'name.requred'=>'Qui personalizzo il messaggio di errore'
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()
            ]);
        };
        //2. Salvo i dati inseriti nel DB
            //a. Creo un istanza
            $message = new Message();
            //b. Assegno i valori con l'aiuto di fillable
            $message->fill($data);
            //c. Salvo i dati
            $message->save();

        //3. Invio mail ad admin
        Mail::to('admin@sito.it')->send(new ContactMessage($message));//Here you define email adress to which all emails will be send

        return response()->json([
            'success'=>true,
            'message'=>$message,

        ]);
    }
}
