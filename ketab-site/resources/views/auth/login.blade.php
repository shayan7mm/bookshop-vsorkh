@extends('layouts.app')
@section('title', 'ورود / ثبت‌نام | کاغذوسرخ')

@push('styles')
<style>
.auth-wrap{min-height:calc(100vh - 200px);padding:50px 0 80px;display:grid;place-items:center}
.auth-box{background:var(--card);border:1px solid var(--line);border-radius:var(--r);padding:36px;width:min(460px,100%);box-shadow:0 20px 60px #26231f14}
.auth-box h1{font-size:1.8rem;text-align:center;margin-bottom:8px}
.auth-box .sub{text-align:center;color:var(--mut);font-size:.9rem;margin-bottom:26px}
.auth-box label{display:block;font-size:.85rem;color:var(--mut);margin-bottom:6px;margin-top:14px}
.auth-box input{width:100%;padding:13px 18px;border-radius:14px;border:1px solid #26231f26;background:#fff;font:inherit;font-size:.95rem;transition:.2s;text-align:center;letter-spacing:.05em}
.auth-box input:focus{outline:none;border-color:var(--red);box-shadow:0 0 0 4px #ff1f3d1f}
.auth-box .btn{width:100%;margin-top:22px;padding:14px}
.alert{border-radius:12px;padding:12px 16px;font-size:.88rem;margin-bottom:16px;line-height:1.7}
.alert.ok{background:#e8f5e9;color:#2e7d32;border:1px solid #a5d6a7}
.alert.err{background:#fdecea;color:#c62828;border:1px solid #f5c6cb}
.alert.demo{background:#fff8e1;color:#8d6e00;border:1px solid #ffe082;font-size:.95rem}
.alert.demo b{font-size:1.2rem;letter-spacing:.15em;color:#b45f00;display:inline-block;margin-right:4px;direction:ltr}
.change-phone{display:block;text-align:center;font-size:.82rem;color:var(--mut);margin-top:16px}
.change-phone a{color:var(--red)}
.otp-note{font-size:.8rem;color:var(--mut);text-align:center;margin-top:14px;line-height:1.8}
@media(max-width:560px){.auth-box{padding:26px 22px}.auth-box h1{font-size:1.5rem}}
</style>
@endpush

@section('content')
<div class="wrap auth-wrap">
  <div class="auth-box">
    @if(session('ok'))
      <div class="alert ok">{{ session('ok') }}</div>
    @endif

    @if($errors->any())
      <div class="alert err">{{ $errors->first() }}</div>
    @endif

    @if(!session('otp_phone'))
      <h1>ورود / ثبت‌نام</h1>
      <p class="sub">شماره موبایلت را وارد کن تا کد تأیید بفرستیم</p>

      <form method="POST" action="{{ route('otp.send') }}">
        @csrf
        <label for="phone">شماره موبایل</label>
        <input id="phone" name="phone" type="tel" inputmode="numeric" pattern="09[0-9]{9}" maxlength="11" placeholder="۰۹۱۲۳۴۵۶۷۸۹" value="{{ old('phone') }}" required autofocus dir="ltr">
        <button class="btn p" type="submit">ارسال کد تأیید</button>
      </form>
    @else
      <h1>کد تأیید را وارد کن</h1>
      <p class="sub">کد ۵ رقمی به شماره {{ session('otp_phone') }} ارسال شد</p>

     @php($demoCode = session('demo_otp') ?? \App\Models\Otp::where('phone', session('otp_phone'))->whereNull('used_at')->latest()->value('code'))
@if($demoCode)
  <div class="alert demo">
    حالت نمایشی: کد تأیید شما <b dir="ltr">{{ $demoCode }}</b> است
  </div>
@endif

      <form method="POST" action="{{ route('otp.verify') }}">
        @csrf
        <label for="code">کد تأیید</label>
        <input id="code" name="code" type="text" inputmode="numeric" pattern="[0-9]{5}" maxlength="5" placeholder="۱۲۳۴۵" required autofocus dir="ltr">
        <button class="btn p" type="submit">تأیید و ورود</button>
      </form>

      <p class="otp-note">کد را دریافت نکردی؟ <form method="POST" action="{{ route('otp.reset') }}" style="display:inline">
  @csrf
  <button type="submit" style="background:none;color:var(--red);font-size:.82rem;padding:0">تغییر شماره</button>
</form></p>
    @endif
  </div>
</div>
@endsection