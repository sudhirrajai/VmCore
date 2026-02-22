<?php

namespace App\Http\Controllers\Admin\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\AdminPasswordReset;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('admin.authentications.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        // Always return the same success message to prevent email enumeration
        if ($user) {
            // Check if there is already a very recent token to prevent spam
            $existing = DB::table('password_reset_tokens')->where('email', $request->email)->first();
            if ($existing && Carbon::parse($existing->created_at)->addMinutes(5)->isFuture()) {
                return back()->with('success', 'If an account with that email exists, we have sent a password reset link.');
            }

            $token = Str::random(60);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $request->email],
                [
                    'token' => Hash::make($token),
                    'created_at' => Carbon::now()
                ]
            );

            try {
                Mail::to($user->email)->send(new AdminPasswordReset($token, $user->email));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Mail sending failed: ' . $e->getMessage());
                return back()->with('error', 'There was an issue sending the email. Ensure SMTP settings are correct in the Admin Panel or environment configuration.');
            }
        }

        return back()->with('success', 'If an account with that email exists, we have sent a password reset link.');
    }
}
