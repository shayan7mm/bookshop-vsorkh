@extends('layouts.app')
@section('title', 'تسویه حساب | کاغذوسرخ')

@push('styles')
<style>
.co-wrap{padding:36px 0 80px;display:grid;grid-template-columns:1fr 360px;gap:32px;align-items:start}
.co-card{background:var(--card);border:1px solid var(--line);border-radius:var(--r);padding:28px;box-shadow:0 10px 30px #26231f0d}
.co-card h2{font-size:1.3rem;margin-bottom:20px;padding-bottom:14px;border-bottom:1px solid var(--line)}
.co-card label{display:block;font-size:.88rem;color:var(--mut);margin-bottom:6px;margin-top:16px}
.co-card label:first-of-type{margin-top:0}
.co-card textarea,.co-card input{width:100%;padding:12px 16px;border-radius:12px;border:1px solid #26231f26;background:#fff;font:inherit;font-size:.92rem;transition:.2s}
.co-card textarea{min-height:110px;resize:vertical;line-height:1.7}
.co-card textarea:focus,.co-card input:focus{outline:none;border-color:var(--red);box-shadow:0 0 0 3px #ff1f3d1f}
.alert{border-radius:12px;padding:12px 16px;font-size:.88rem;margin-bottom:16px;line-height:1.7}
.alert.err{background:#fdecea;color:#c62828;border:1px solid #f5c6cb}
.alert.ok{background:#e8f5e9;color:#2e7d32;border:1px solid #a5d6a7}
.summary{position:sticky;top:130px;background:var(--card);border:1px solid var(--line);border-radius:var(--r);padding:22px;box-shadow:0 10px 30px #26231f0d}
.summary h3{font-size:1.1rem;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid var(--line)}
.s-item{display:flex;justify-content:space-between;font-size:.86rem;padding:6px 0;color:var(--mut);gap:8px}
.s-item span:first-child{flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.s-item span:last-child{color:var(--ink);font-weight:600;white-space:nowrap}
.s-total{border-top:1px solid var(--line);margin-top:12px;padding-top:14px;display:flex;justify-content:space-between;font-size:1.05rem}
.s-total b{color:var(--red);font-size:1.15rem}
.pay-btn{width:100%;margin-top:20px;padding:14px;border-radius:99px;background:var(--red);color:#fff;font-weight:600;font-size:1rem;transition:.25s}
.pay-btn:hover{transform:translateY(-2px);box-shadow:0 10px 30px #ff1f3d55}
.demo-note{background:#fff8e1;border:1px solid #ffe082;border-radius:10px;padding:10px 14px;font-size:.8rem;color:#8d6e00;margin-top:14px;text-align:center;line-height:1.7}
@media(max-width:900px){.co-wrap{grid-template-columns:1fr}.summary{position:static}}
</style>
@endpush

@section('content')
<div class="wrap co-wrap">
  <form method="POST" action="{{ route('checkout.pay') }}" class="co-card">
    @csrf
    <h2>اطلاعات ارسال</h2>

    @if($errors->any())
      <div class="alert err">{{ $errors->first() }}</div>
    @endif

    <label for="address">آدرس کامل پستی</label>
    <textarea id="address" name="address" required placeholder="استان، شهر، خیابان، کوچه، پلاک، واحد...">{{ old('address', auth()->user()->address ?? '') }}</textarea>

    <label for="phone">شماره تماس</label>
    <input id="phone" name="phone" type="tel" inputmode="numeric" pattern="09[0-9]{9}" maxlength="11" required dir="ltr" placeholder="09123456789" value="{{ old('phone', auth()->user()->phone ?? '') }}">

    <div class="demo-note">
      این یک پرداخت نمایشی است و به درگاه بانکی متصل نیست. با کلیک روی دکمه زیر، سفارش به صورت تستی ثبت می‌شود.
    </div>

    <button type="submit" class="pay-btn" style="margin-top:22px">پرداخت {{ number_format($total) }} هزار تومان</button>
  </form>

  <aside class="summary">
    <h3>خلاصه سفارش</h3>
    @foreach($items as $it)
      <div class="s-item">
        <span>{{ $it->book->title }} × {{ $it->qty }}</span>
        <span>{{ number_format($it->book->price * $it->qty) }} هزار</span>
      </div>
    @endforeach
    <div class="s-total">
      <span>جمع کل</span>
      <b>{{ number_format($total) }} هزار تومان</b>
    </div>
  </aside>
</div>
@endsection