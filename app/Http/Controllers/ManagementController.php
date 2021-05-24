<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementController extends Controller
{
   public function lodging_management()
   {
        return view('management.index');
   }
}
