<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Message;

class InboxController extends Controller
{
    public function index() {
        $messages = Message::where('user_id',Auth::user()->id)->paginate(8);
        $singleAppartmentsMessagges = $messages->where('appartment_id');

        return view('admin.inbox.index', compact('singleAppartmentsMessagges','messages'));
    }
}
