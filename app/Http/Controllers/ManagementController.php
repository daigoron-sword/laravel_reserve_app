<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myclasses\Management\ManagementView;
use App\Models\Reservation;


class ManagementController extends Controller
{
   public function reserveManagement(Request $request)
   {
      $management = new ManagementView();
      return view('management.index', ['management' => $management]);
   }

   public function edit(Request $request)
   {
      $reservation = Reservation::with('customer')->find($request->id);
      return view('management.edit', ['reservation' => $reservation]);
   }

   public function editRoom(Request $request)
   {
      $reservation = Reservation::find($request->id);
      return view('management.editRoom', ['reservation' => $reservation]);
   }

   public function finishRoom(Request $request)
   {
      $validate_rule =['room_id' => 'required']; //；部屋選択のバリデーションルール
      $this->validate($request, $validate_rule);
      $reservation = Reservation::find($request->id);
      $reservation->room_id = $request->room_id;
      $reservation->save();
      // return redirect()->route('editRoom', ['reservation' => $reservation]);
      return view('management.editRoom', ['reservation' => $reservation]);
   }
}
