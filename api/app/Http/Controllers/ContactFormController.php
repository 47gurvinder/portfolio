<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactFormController extends Controller
{
    public function store(Request $request)
    {

        // Validate CAPTCHA token here
        $captchaToken = $request->input('captcha_token');
        $captchaSecret = env('CAPTCHA_SECRET_KEY'); // Make sure to set this in your .env file

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $captchaSecret,
            'response' => $captchaToken,
        ]);

        $captchaValidation = json_decode($response->body());

        if (!$captchaValidation->success) {
            return response()->json(['message' => 'Captcha validation failed'], 422);
        }


        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'origin' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create a new contact form record
        $contactForm = ContactForm::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'website' => $request->origin,
        ]);

         // Send email to admin
         Mail::to('hire@gurwinder.me')->send(new ContactFormSubmitted($contactForm));


        // Return a successful response
        return response()->json([
            'message' => 'Contact form submitted successfully',
            'data' => $contactForm
        ], 200);
    }
}
