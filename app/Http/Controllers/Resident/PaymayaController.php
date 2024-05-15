<?php

namespace App\Http\Controllers\Resident;

use App\Models\User;
use App\Models\Service;
use App\Models\Request as TransactionRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ServicesRequest\ServicesRequest;
use Carbon\Carbon;
use Lloricode\Paymaya\Request\Checkout\Amount\AmountDetail;
use Lloricode\Paymaya\Request\Checkout\Amount\Amount;
use Lloricode\Paymaya\Request\Checkout\Buyer\BillingAddress;
use Lloricode\Paymaya\Request\Checkout\Buyer\Buyer;
use Lloricode\Paymaya\Request\Checkout\Buyer\Contact;
use Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress;
use Lloricode\Paymaya\Request\Checkout\Checkout;
use Lloricode\Paymaya\Request\Checkout\Item;
use Lloricode\Paymaya\Request\Checkout\MetaData;
use Lloricode\Paymaya\Request\Checkout\RedirectUrl;
use Lloricode\Paymaya\Request\Checkout\TotalAmount;
use Illuminate\Support\Facades\Mail;
use App\Services\TextService;
use App\Mail\GeneralUpdate;
use PaymayaSDK;


class PaymayaController extends Controller
{
    /**
     * @var Authenticatable
     */
    protected $user;
    
    public function handle(Request $request)
    {
        $this->user = auth()->user()->resident;
        $this->user['email'] = auth()->user()->email;

        
        $currentTime = Carbon::now();
        $formattedTime = $currentTime->format('YmdHis');
        $referenceNumber = "REF{$formattedTime}_{$this->user->id}";

        $service = Service::find($request['service_id']);

        $checkout = (new Checkout())
            ->setTotalAmount(
                (new TotalAmount())
                    ->setValue((float) $service->fee)
                    ->setDetails(
                        (new AmountDetail())
                            ->setSubtotal((float) $service->fee)
                    )
            )
            ->setBuyer(
                (new Buyer())
                    ->setFirstName($this->user->first_name)
                    ->setMiddleName($this->user->middle_name)
                    ->setLastName($this->user->last_name)
                    ->setBirthday(Carbon::parse($this->user->birth_date))
                    ->setGender($this->user->gender === 'male' ? 'M' : 'F')
                    ->setContact(
                        (new Contact())
                            ->setEmail($this->user->email)
                    )
                    ->setBillingAddress(
                        (new BillingAddress())
                            ->setLine1($this->user->address)
                            ->setCountryCode('PH')
                    )
            )
            ->addItem(
                (new Item())
                    ->setName($service->name)
                    ->setQuantity(1)
                    ->setDescription($service->description)
                    ->setAmount(
                        (new Amount())
                            ->setValue((float) $service->fee)
                            ->setDetails(
                                (new AmountDetail())
                                    ->setSubtotal((float) $service->fee)
                            )
                    )
                    ->setTotalAmount(
                            (new Amount())
                            ->setValue((float) $service->fee)
                            ->setDetails(
                                (new AmountDetail())
                                    ->setSubtotal((float) $service->fee)
                            )
                    )
            )
            ->setRedirectUrl(
                (new RedirectUrl())
                    # Testing only
                    // ->setSuccess('http://sangavino.test/resident/payment-success')
                    ->setSuccess(route('resident.paymaya.processing'))
                    ->setFailure(route('resident.paymaya.failed'))
                    ->setCancel(route('resident.paymaya.cancel'))
            )->setRequestReferenceNumber($referenceNumber)
            ->setMetadata(
                (new MetaData())
                    ->setSMN(config('app.name'))
                    ->setMPC($service->id)
                    ->setMCO('PH')
            );

        $checkoutResponse = PaymayaSDK::checkout()->execute($checkout);

        $request_data = [
            'purpose' => $request['purpose'],
            'service_id' => $request['service_id'],
            'business_name' => null,
            'business_type' => null,
            'business_location' => null,
            'residency_year' => null,
            'resident_type' => null,
            'reference_number' => $referenceNumber,
            'status' => 0,
            'transaction_id' => null,
            'created_at' => now()
        ];

        # checkoutResponse->checkoutId
        session()->put('services_request_form_data', $request_data);

        return redirect()->away($checkoutResponse->redirectUrl);
    }

    public function success(Request $request)
    {

        if (isset($request['status']) && $request['status'] == 'COMPLETED') 
        {
            $processed_request = TransactionRequest::where('reference_number', $request['requestReferenceNumber'])->first();

            // if it is success then execute order || save data to the database
            $processed_request->update([
                'transaction_id' => $request['id']
            ]);

            $this->log_activity(model:$processed_request, event:'updated', model_name:'Service', model_property_name: $processed_request->service->reference_number);

            Mail::to($user->email)->send(new GeneralUpdate($full_name, 'Your transaction is completed and Service Requested Successfully. You will be receiving an email and sms notification once there is an update from your request.'));

            $text_service->custom_send($user, 'Your transaction is completed and Service Requested Successfully. You will be receiving an email and sms notification once there is an update from your request.');

            $processed_request->save();

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
    
    public function failed()
    {
        return redirect()
            ->route('resident.requests.index')
            ->with('error', $response['message'] ?? 'There`s a problem with the transaction.');
    }
    
    public function processing()
    {
        $services_request_form_data = collect(session()->get('services_request_form_data'));  // attach the services_request_form_data session
        
        $new_request = auth()->user()->requests()->create($services_request_form_data->toArray());

        $this->log_activity(model:$new_request, event:'updated a requested', model_name: 'Service', model_property_name: $new_request->service->name);

        return redirect()
            ->route('resident.requests.index')
            ->with('success', $response['message'] ?? 'Your transaction has been processed, please wait while we paymaya process your payment!');
    }

    
    public function webhook_failed(Request $request, TextService $text_service)
    {
        
        $processed_request = TransactionRequest::first();

        $this->log_activity(model:$processed_request, event:'deleted a requested', model_name:'Service', model_property_name: $processed_request->service->reference_number);

        $user = User::with('resident')->find($processed_request->user_id);

        $full_name = $user->resident->first_name . ' ' . $user->resident->last_name;

        Mail::to($user->email)->send(new GeneralUpdate($full_name, 'Your transaction and request has failed and was not processed.'));

        $text_service->custom_send($user, 'Your transaction and request has failed and was not processed.');

        $processed_request = TransactionRequest::where('reference_number', $request['requestReferenceNumber'])->first();

        $processed_request->delete();
    }


}   