<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CommonTrait;

class AdminController extends Controller
{
    use CommonTrait;

    public function dashboard()
    {
        $customers = \App\Models\Customer::paginate(10);
        return view('dashboard', [
            'customers' => $customers
        ]);
    }

    public function exportCustomerCsv(Request $request)
    {
        $fileName = 'customers.csv';
        $customers = \App\Models\Customer::get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Id', 'Name', 'Phone Number', 'Email');

        $callback = function() use($customers, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($customers as $customer) {
                $row['Id']              = $customer->id;
                $row['Name']            = $customer->name;
                $row['Phone Number']    = $customer->phone_number;
                $row['Email']           = $customer->email;
                fputcsv($file, array($row['Id'], $row['Name'], $row['Phone Number'], $row['Email']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function createWPUser(Request $request)
    {
        $customer = \App\Models\Customer::where('id', $request->id)->first();

        if(!$customer){
            $response = [
                'code' => 'error',
                'message' => 'Customer Does Not Exist'
            ];
            $response = json_encode($response);
        }
        else if($customer->wordpress_profile_status == 1){
            $response = [
                'code' => 'error',
                'message' => 'A user for this customer is already created in WordPress Site'
            ];
            $response = json_encode($response);
        }
        else
        {
            $wp_url = config('app.wp_authentication.home_page_url');
            
            $new_wp_user = [
                'username'  => $customer->email, 
                'email'     => $customer->email,
                'password'  => rand(4, 10),
                'name'      => $customer->name,
                'roles'     => 'subscriber',
                'laravel_profile_status' => 1
            ];

            $curl = curl_init();

            curl_setopt_array($curl, 
            array(
                CURLOPT_URL => $wp_url.'/wp-json/wp/v2/users',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $new_wp_user,
                CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic '. base64_encode( config('app.wp_authentication.username') . ':' . config('app.wp_authentication.password') )
                    ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $customer = \App\Models\Customer::where('id', $request->id)->update(['wordpress_profile_status' => 1]);
        }
        return response()->json(['response' => $response]);
    }

    public function showCustomerProfile(Request $request, $id)
    {
        if(is_numeric($id)){
            $customer =  \App\Models\Customer::where('id', $id)->first();
        }
        else
        {
            $id         = base64_decode($id);
            $email      = $this->decrypt_string($id);  
            $customer   =  \App\Models\Customer::where('email', $email)->first();
        }
        return view('customer-profile', [
            'customer' => $customer
        ]);
    }
}
