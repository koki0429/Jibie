<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpreadSheet extends Model
{
    use HasFactory;

    static function insert_spread_sheet($insert_datas){
        $sheets = SpreadSheet::instance();

        $sheet_id = '17G4tTIxLQf5nian29wqPn0ySkWa9OnR-AyZRQCDDABY';
        $range = 'B1:B';
        $response = $sheets->spreadsheets_values->get($sheet_id, $range);

        if(is_array($response->getValues())){
            $row = count($response->getValues()) + 1;
        }else{
            $row = 1;
        }

        foreach($insert_datas as $insert_data){
            $contact[] = [
                $insert_data['name'],
                $insert_data['product'],
                $insert_data['quantity'],
                $insert_data['date'],
                $insert_data['time']
            ];
        }

        $values = new \Google_Service_Sheets_ValueRange([
            'values' => $contact
        ]);

        $sheets->spreadsheets_values->append(
            $sheet_id,
            'A' . $row,
            $values,
            ["valueInputOption" => 'USER_ENTERED']
        );

        return true;
    }

    public static function instance(){
        $credentials_path = storage_path('app/json/credentials.json');
        $client = new \Google_Client();
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAuthConfig($credentials_path);
        return new \Google_Service_Sheets($client);
    }
}
