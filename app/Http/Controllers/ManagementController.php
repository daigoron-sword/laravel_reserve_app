<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myclasses\Management\ManagementView;
use App\Models\Reservation;


class ManagementController extends Controller
{
   public function reserve_management(Request $request)
   {
      $management = new ManagementView();
      return view('management.index', ['management' => $management]);
   }

   public function edit(Request $request)
   {
      $reservation = Reservation::with('room')->find($request->id);
      return dump($reservation);
      return view('edit');
   }
}
