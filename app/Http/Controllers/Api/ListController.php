<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Ride;
use App\Http\Resources\Ride as RideCollection;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ListController extends Controller
{
    public function getList()
		{
			$rides=Ride::with('users')->whereDate('created_at',Carbon::today())->get();
			return response()->json([
		            'success' => true,
		            'Message' =>'Rides Fetch Successfully',
		            'rides' =>RideCollection::collection($rides),
		        ]);
		}
		public function findRoute(Request $request)
		{
			$rides=Ride::with('users')->where('from_place',$request->from_place)->where('to_place',$request->to_place)->whereDate('rides_DateTime',Carbon::parse($request->date." " .$request->time)->format('Y-m-d'))->get();
			if(count($rides)>0){
				return response()->json([
		            'success' => true,
		            'Message' =>'Rides Fetch Successfully',
		            'rides' =>RideCollection::collection($rides),
		        ]);

			}
			return response()->json([
		            'success' => false,
		            'Message' =>'Sorry No Route Founds',
		        ]);
		}
}
