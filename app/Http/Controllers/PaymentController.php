<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    private $secretKey = 'wcOrZ1onDFjaFoq';
    private $id_shop = 459474;


    public function result(Request $request) {

// чтение полученных параметров
        $in_userName = $request->get("userName");
        $in_userEmail = $request->get("userEmail");

        $in_eshopId = $request->get("eshopId");
        $in_orderId = $request->get("orderId");
        $in_serviceName = $request->get("serviceName");
        $in_eshopAccount = $request->get("eshopAccount");
        $in_recipientAmount = $request->get("recipientAmount");
        $in_recipientCurrency = $request->get("recipientCurrency");
        $in_paymentStatus = $request->get("paymentStatus");
        $in_paymentData = $request->get("paymentData");

        $in_hash = strtoupper($request->get("hash"));	// контрольная подпись со стороны IntellectMoney - основной способ
        // удостовериться что данные пришли именно от IntellectMoney


        $for_hash =
            $in_eshopId."::".
            $in_orderId."::".
            $in_serviceName."::".
            $in_eshopAccount."::".
            $in_recipientAmount."::".
            $in_recipientCurrency."::".
            $in_paymentStatus."::".
            $in_userName."::".
            $in_userEmail."::".
            $in_paymentData."::".
            $this->secretKey; // Очень ВАЖНО проверять подпись используя свой секретный ключ, а не тот что пришел в запросе
// Получаем наш вариант контрольной подписи
        $my_hash = strtoupper(md5($for_hash));

        if ($my_hash == $in_hash)
        {
            $checksum = true;
        }
        else
        {
            $checksum = false;
        }

        if (!$checksum)
        {
            echo "bad sign\n";
            exit();
        }

// Символический вывод подтверждающий успешность получения информации и совпадения подписей
        echo "OK\n";

        if ($in_paymentStatus == 5) {
            $user = User::where('username', $in_userName)->first();
            DB::beginTransaction();

            try {
                $user->update([
                    'balance' => DB::raw('balance + ' . $in_recipientAmount),
                ]);

                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                throw new \Exception($exception->getMessage(), 500);
            }
        }
    }
}
