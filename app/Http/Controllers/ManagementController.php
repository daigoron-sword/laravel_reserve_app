<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myclasses\Management\ManagementView;


/**
 * 試験
 */
use App\Models\NumberOfUser;



class ManagementController extends Controller
{
   public function reserve_management(Request $request)
   {
      /**
       * 試験
      */
      $results = NumberOfUser::with('type')->where('reserve_id', 3)->get();
      return dump($results);
      foreach($results as $result)
      {
         $i[] = $result->type->price;
      }


      $management = new ManagementView();
      return view('management.index', ['management' => $management]);
   }
}
