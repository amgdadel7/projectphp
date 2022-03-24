<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use Illuminate\Http\Request;

class RelastionsContoroller extends Controller
{
   public function hasOneRelation(){
       $user = \App\User::with(['phone'=> function($q){
         $q -> select('code','phone','user_id');
       }])->find(1);
//      return $user -> phone ->code;
//        $user -> phone;
       //$phone=$user -> phone;
       return response() -> json($user);
   }
   public function hasOneRelationReverse(){
      $phone= Phone::find(1);

      //make some attribute visible
       $phone -> make
   }
}
