<?php

namespace Yeayurdev\Http\Controllers;

use Illuminate\Http\Request;

use Yeayurdev\Http\Requests;

class MiscController extends Controller
{
    public function getTermsofService()
    {
    	return view('templates.partials.termsofservice');
    }

    public function getPrivacypolicy()
    {
    	return view('templates.partials.privacypolicy');
    }
}
