<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myclasses\Management\ManagementView;


class ManagementController extends Controller
{
   public function reserve_management(Request $request)
   {
      $management = new ManagementView();
      return view('management.index', ['management' => $management]);
   }
}
