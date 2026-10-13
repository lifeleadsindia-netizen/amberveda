<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function aboutus()
    {
        return view('frontend.about');
    }

    public function terms()
    {
        return view('frontend.terms-conditions');
    }

    public function privacy()
    {
        return view('frontend.privacy-policy');
    }

    public function contactus()
    {
        return redirect()->to('/#contact');
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^(?=.*[\p{L}])[\p{L}\p{M}\s\.\'\-]+$/u'],
            'email' => ['required', 'string', 'email:rfc,filter', 'max:255'],
            'phone' => ['required', 'numeric', 'digits:10'],
            'subject' => ['required', 'string'],
            'message' => ['required', 'string', 'regex:/[^\s]/'],
        ], [
            'name.required' => 'Please enter your name.',
            'name.regex' => 'Please enter a valid name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your phone number.',
            'phone.numeric' => 'Please enter a valid 10-digit phone number.',
            'phone.digits' => 'Please enter a valid 10-digit phone number.',
            'subject.required' => 'Please select a subject.',
            'message.required' => 'Please enter your message.',
            'message.regex' => 'Please enter your message.',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'],
            'contactMessage' => $validated['message'],
        ];

        $mailHost = config('mail.mailers.smtp.host');
        $mailUsername = config('mail.mailers.smtp.username');
        $mailPassword = config('mail.mailers.smtp.password');

        $failureMessage = 'Your message could not be sent at the moment. Please try again later or contact us directly at <a href="mailto:info@ambervedawellness.com" class="alert-link text-decoration-underline" style="color: inherit; font-weight: 600;">info@ambervedawellness.com</a>';

        if (empty($mailHost) || empty($mailUsername) || empty($mailPassword)) {
            return redirect('/#contact')
                ->withInput()
                ->with('errorMsg', $failureMessage);
        }

        try {
            Mail::send(
                'frontend.email.contact-mail',
                $data,
                function ($message) use ($data) {
                    $message->to('info@ambervedawellness.com');
                    $message->subject('New Contact Enquiry - ' . $data['subject']);
                    $message->replyTo($data['email'], $data['name']);
                }
            );

            return redirect('/#contact')->with('successMsg', 'Thank you! Your message has been sent successfully.');
        } catch (\Throwable $e) {
            Log::error('Contact form email sending failed: ' . $e->getMessage());

            return redirect('/#contact')
                ->withInput()
                ->with('errorMsg', $failureMessage);
        }
    }

    public function regis($id)
    {
        $result['country'] = Country::all();
        $result['sdata'] = $id;
        return view('member.signup')->with($result);
    }
}
