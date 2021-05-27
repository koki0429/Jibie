<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SpreadSheet;
use App\Models\kart;
use App\Models\User;
use App\Models\Product;

class SpreadSheetController extends Controller
{
    public function manager(){
        $spread_sheet = new SpreadSheet();

        $karts = Kart::whereBetween('updated_at', ['2021-05-22 00:00:00', '2021-05-22 23:59:59'])->where('del_flag', 1)->get();

        foreach($karts as $kart){
            $user = User::where('id', $kart->user_id)->first();
            $product = Product::where('id', $kart->product_id)->first();
            $insert_datas[] = [
                'name' => $user->name,
                'product' => $product->name,
                'quantity' => $kart->quantity,
                'date' => $kart->date,
                'time' => $kart->time
            ];
        }

        $spread_sheet->insert_spread_sheet($insert_datas);

        return response('格納に成功！', 200);
    }
}
