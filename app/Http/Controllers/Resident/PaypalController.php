<?php

namespace App\Http\Controllers\Resident;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServicesRequest\ServicesRequest;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalController extends Controller
{
    public function handle(ServicesRequest $request)
    {
        $provider = new PaypalClient;
        
        $provider->setApiCredentials(config('paypal'));

        $paypalToken = $provider->getAccessToken();
        
        $service = Service::find($request['service_id']);

        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'items' => [
                        [
                            'name' => $service->name,
                            'quantity' => 1,
                            'description' => $service->name,
                            'sku' => mt_rand(12345, 12345),
                            'category' => 'PHYSICAL_GOODS',
                            'unit_amount' => [
                                'currency_code' => 'PHP',
                                'value' => strval($service->fee),
                            ],
                        ],
                    ],
                    'amount' => [
                        'currency_code' => config('paypal.currency'),
                        'value' => strval($service->fee),
                        'breakdown' => [
                            'item_total' => [
                                'currency_code' => config('paypal.currency'),
                                'value' => strval($service->fee),
                            ],
                        ],
                    ],
                    'shipping' => [
                        'name' => [
                            'full_name' => auth()->user()->resident->full_name,
                        ],
                        'address' => [
                            'address_line_1' => auth()->user()->resident->address,
                            'admin_area_2' => 'Victoria',
                            'admin_area_1' => 'Tarlac',
                            'postal_code' => '8000',
                            'country_code' => 'PH',
                        ],
                    ],
                ],
            ],
            'application_context' => [
                'brand_name' => config('app.name'),
                'return_url' => route('resident.paypal.success'),
                'cancel_url' => route('resident.paypal.cancel'),
                'shipping_preference' => 'NO_SHIPPING',
            ],
            'payer' => [
                'name' => [
                    'given_name' => auth()->user()->resident->first_name,
                    'surname' => auth()->user()->resident->last_name,
                ],
                // 'address' => [
                //     'address_line_1' => auth()->user()->resident->address,
                //     'admin_area_2' => auth()->user()->resident->address,
                //     'admin_area_1' => auth()->user()->resident->address,
                //     'postal_code' => '8000',
                //     'country_code' => 'PH',
                // ],
            ],
        ]);

        // Continue with your code for handling the PayPal response...

         if (isset($response['id']) && $response['id'] != null) 
        {
            foreach ($response['links'] as $links) 
            {
                if ($links['rel'] == 'approve') 
                {
                    //dd($request->validated());

                    session()->put('services_request_form_data', $request->validated()); // attached the validated data to the session 

                    return redirect()->away($links['href']);
                    // return $links['href'];
                }
            }

            return redirect()
                ->route('resident.paypal.cancel')
                ->with('error', 'Something went wrong.');
        } 
        else 
        {
            return redirect()
                ->route('resident.requests.index')
                ->with('error', $response['error']['message'] ?? 'Something went wrong.');
        }
    
    }
    
    public function success(Request $request)
    {
        $services_request_form_data = collect(session()->get('services_request_form_data'));  // attach the services_request_form_data session

        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));
        
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') 
        {
            $services_request_form_data['paypal_transaction_id'] = $response['id']; // add new item from the collection array

            // if it is success then execute order || save data to the database

            $new_request = auth()->user()->requests()->create($services_request_form_data->toArray());

            $this->log_activity(model:$new_request, event:'requested', model_name: 'Service', model_property_name: $new_request->service->name);

            return to_route('resident.requests.index')->with(['success' => 'Service Requested Successfully. You will be receiving an email and sms notification once there is an update from your request.']);
        } 
        else 
        {
            return redirect()
                ->route('resident.requests.index')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function cancel()
    {
        return redirect()
            ->route('resident.requests.index')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}   