<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) return redirect()->route('home');
        return view('auth.login');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'regex:/^09\d{9}$/'],
        ], [
            'phone.required' => 'شماره موبایل الزامی است.',
            'phone.regex'    => 'شماره موبایل باید با 09 شروع شود و ۱۱ رقم باشد.',
        ]);

        $phone = $request->input('phone');

        // کدهای قبلی این شماره رو باطل کن
        Otp::where('phone', $phone)->whereNull('used_at')->update(['used_at' => now()]);

        $code = (string) random_int(10000, 99999);

        Otp::create([
            'phone'      => $phone,
            'code'       => $code,
            'expires_at' => now()->addMinutes(5),
        ]);

        session(['otp_phone' => $phone]);

        return back()
            ->with('ok', 'کد تأیید برای شماره ' . $phone . ' ارسال شد.')
            ->with('demo_otp', $code);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:5'],
        ], [
            'code.required' => 'کد تأیید را وارد کنید.',
            'code.digits'   => 'کد تأیید باید ۵ رقم باشد.',
        ]);

        $phone = session('otp_phone');
        if (!$phone) {
            return redirect()->route('login')->withErrors(['phone' => 'ابتدا شماره موبایل را وارد کنید.']);
        }

        $otp = Otp::where('phone', $phone)
            ->where('code', $request->input('code'))
            ->whereNull('used_at')
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$otp) {
            // کد معتبر نیست یا منقضی شده — یه کد جدید بساز تا کاربر گیر نکنه
            Otp::where('phone', $phone)->whereNull('used_at')->update(['used_at' => now()]);

            $newCode = (string) random_int(10000, 99999);
            Otp::create([
                'phone'      => $phone,
                'code'       => $newCode,
                'expires_at' => now()->addMinutes(5),
            ]);

            return back()
                ->withErrors(['code' => 'کد وارد شده صحیح یا منقضی شده بود. کد جدید ارسال شد.'])
                ->with('demo_otp', $newCode);
        }

        $otp->update(['used_at' => now()]);

        // کاربر جدید هم می‌تونه لاگین کنه (ثبت‌نام خودکار)
       $user = User::firstOrCreate(
            ['phone' => $phone],
            [
                'name'     => 'کاربر ' . substr($phone, -4),
                'email'    => $phone . '@ketab.local',
                'password' => bcrypt(\Illuminate\Support\Str::random(32)),
            ]
        );

        $guestSession = session()->getId();

        Auth::login($user, true);
        $request->session()->regenerate();

        // سبد مهمان رو به کاربر منتقل کن
       $guestItems = Cart::where('session_id', $guestSession)->get();

foreach ($guestItems as $g) {
    $existing = Cart::where('user_id', $user->id)
        ->where('book_id', $g->book_id)
        ->first();

    if ($existing) {
        $existing->increment('qty', $g->qty);
        $g->delete();
    } else {
        $g->update(['user_id' => $user->id, 'session_id' => null]);
    }
}

        session()->forget(['otp_phone', 'demo_otp']);

        return redirect()->intended(route('home'))->with('ok', 'خوش آمدی، ' . $user->name . '!');
    }

    public function resetOtp()
    {
        session()->forget('otp_phone');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}