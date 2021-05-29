<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myclasses\Management\ManagementView;


/**
 * 試験
 */
use App\Models\NumberOfUser;
use App\Models\Reservation;



class ManagementController extends Controller
{
   public function reserve_management(Request $request)
   {
      /**
       * 試験
      */
      // $number_of_users = NumberOfUser::where('reserve_id', 5)->get();
      // foreach($number_of_users as $number_of_user)
      // {
      //    $user[] = $number_of_user->number_of_person;
      // }
      // $sum = array_sum($user);
      // return dump($sum);

      $management = new ManagementView();
      return view('management.index', ['management' => $management]);
   }
}
