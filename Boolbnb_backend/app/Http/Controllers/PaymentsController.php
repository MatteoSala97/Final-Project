<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\Ad;
use Braintree;
use Braintree\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentsController extends Controller
{
    public function process(Request $request)
    {

        $paymentNonce = $request->input('payment_method_nonce');
        $accomodation_id = $request->input('accommodation_id');
        $selected_accommodation = Accomodation::find($accomodation_id);
        $ad_name = $request->input('selected_plan_name');
        $selected_ad = Ad::where('name', $ad_name)->first();
        $ad_id = $selected_ad->id;
        $duration = $selected_ad->duration;
        $pricePerDay = $selected_ad->price_per_day;

        $totalAmount = $duration * $pricePerDay;

        try {

            $gateway = new Braintree\Gateway([
                'environment' => config('services.braintree.environment'),
                'merchantId' => config('services.braintree.merchantId'),
                'publicKey' => config('services.braintree.publicKey'),
                'privateKey' => config('services.braintree.privateKey')
            ]);

            $result = $gateway->transaction()->sale([
                'amount' => $totalAmount,
                'paymentMethodNonce' => $paymentNonce,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);



            if ($result->success) {
                $expirationDate = now();
                $existingAds = $selected_accommodation->ads;
                foreach ($existingAds as $ad) {
                    $expirationDate = max($expirationDate, $ad->pivot->expiration_date);
                }
                $expirationDate = Carbon::parse($expirationDate)->addDays($duration);

                $selected_accommodation->ads()->attach($ad_id, [
                    'created_at' => now(),
                    'updated_at' => now(),
                    'expiration_date' => $expirationDate
                ]);


                return redirect()->route('dashboard.accomodations.advertisement')->with('success', true);
            } else {

                return redirect()->route('dashboard.accomodations.advertisement')->with('success', false);
            }
            // return response()->json($result);
        } catch (\Exception $e) {
            return redirect()->route('dashboard.accomodations.advertisement')->with('success', false);
        }
    }
}
