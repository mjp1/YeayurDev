<?php

namespace Yeayurdev\Http\Controllers;

use Illuminate\Http\Request;

use Yeayurdev\Http\Requests;

class ContactController extends Controller
{
    public function getContact()
    {
    	return view('contact.index');
    }
}
