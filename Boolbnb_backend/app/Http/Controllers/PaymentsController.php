<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\Ad;
use Braintree;
use Braintree\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentsController extends Controller
{
    public function process(Request $request)
    {

        $paymentNonce = $request->input('payment_method_nonce');
        $accomodation_id = $request->input('accommodation_id');
        $selected_accommodation = Accomodation::find($accomodation_id);
        $ad_id = $request->input('selected_plan_id');
        $selected_ad = Ad::find($ad_id);
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

                $selected_accommodation->ads()->attach($ad_id, ['created_at' => now(), 'updated_at' => now()]);


                return redirect()->route('dashboard.accomodations.advertisement')->with('success', true);
            } else {

                return redirect()->route('dashboard.accomodations.advertisement')->with('success', false);
            }
            // return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the payment. Please try again later.'
            ], 500);
        }
    }
}
