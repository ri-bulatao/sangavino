<?php 

namespace App\Services;

use App\Models\Official;

class TextService {

    public function send($request)
    {   
        $resident = $request->user->resident;
        $service = $request->service->name;
        $route = route('resident.requests.index');

        $message = match($request->status) {
            "1" => "Hi! $resident->full_name, your request $service has been approved and it's ready for pick-up. For more info visit the link $route - Barangay San Gavino",
            "2" => "Hi! $resident->full_name, unfortunately your request $service has been declined. For more info visit the link $route - Barangay San Gavino",
        };

        $ch = curl_init();
        $parameters = array(
            'apikey' => '98601ec71e719e2f4144ad33da091bab', //Your API KEY
            'number' => $resident->contact,
            'message' => $message,
            'sendername' => 'SEMAPHORE'
        );

        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        \Log::error($output);
        \Log::error('SENT');

        return $output;

    }


    public function send_announcement_sms($announcement)
    {   
        $official_contacts = Official::pluck('contact')->implode(',');

        $ch = curl_init();
        $parameters = array(
            'apikey' => '98601ec71e719e2f4144ad33da091bab', //Your API KEY
            'number' => $official_contacts,
            'message' => $announcement,
            'sendername' => 'SEMAPHORE'
        );

        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        return $output;

    }

    
    public function custom_send($user, $message)
    {   
        $resident = $user;
        $route = route('resident.requests.index');

        $ch = curl_init();
        $parameters = array(
            'apikey' => '98601ec71e719e2f4144ad33da091bab', //Your API KEY
            'number' => $resident->contact,
            'message' => $message,
            'sendername' => 'SEMAPHORE'
        );

        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        \Log::error($output);
        \Log::error('SENT');

        return $output;

    }
}