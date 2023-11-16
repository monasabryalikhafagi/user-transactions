<?php
namespace App\Http\Traits;
use Illuminate\Support\Facades\Http;

trait BrevoSmsMail
{
    public function sendMail($to, $message)
    {
        $json = array(
            "sender"  => array(
               "name"   => "Alrayah",
               "email"  => "lamiaa.elmansy@appssquare.com"
            ),
            "to"  => array(
               "name"   => "",
               "email"  => $to
            ),
            "subject"     => "Verification Code",
            "htmlContent" => "<html><body>" .$message."</body></html>"
        );

        $headers = array(
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "api-key" => "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",
        );

        $response = Http::withHeaders($headers)
            ->post('https://api.brevo.com/v3/smtp/email',
                $json
            );

        return $response;
    }

    

    public function sendSms($to, $message)
    {
        
    }

}