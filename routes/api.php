<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \Mailjet\Resources;
use Illuminate\Support\Facades\Mail;
use App\Mail\defaultMailable;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('/mailjet', function (Request $request) {
    $variables = [
        'from_email' => null,
        'from_name' => null,
        'to_name' => null,
        'to_email' => null,
        'subject' => null,
        'template_id' => null,
        'message_text' => null,
        'message_html' => null,
        'variables' => []
    ];
    foreach ($variables as $key => $value) {
        if (getenv('TESTING') == 'yes') {
            $valueVariable = getenv('TESTING_'.strtoupper($key));
        } else {
            $valueVariable = $value;
        }
        ${$key} = $request->input($key, $valueVariable);
    }

    $has_template_id = (isset($template_id) && $template_id != null) ? true : false;

    $mj = new \Mailjet\Client(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => $from_email,
                    'Name' => $from_name
                ],
                'To' => [
                    [
                        'Email' => $to_name,
                        'Name' => $to_email
                    ]
                ],
                'TemplateID' => $has_template_id ? $template_id : null,
                "TemplateLanguage" => true,
                "Subject" => $subject,
                "TextPart" => $message_text,
                "HTMLPart" => $message_html,
                "Variables" => $variables,
            ]
        ]
    ];
    //dd($body);
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    $response->success();
    dd($response->getData());
});
