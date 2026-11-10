@extends('layouts.app')
@section('title', 'سفارش #' . $order->id . ' | کاغذوسرخ')

@push('styles')
<style>
.os-wrap{padding:36px 0 80px}
.crumbs{font-size:.82rem;color:var(--mut);margin-bottom:22px}
.crumbs a:hover{color:var(--red)}
.os-grid{display:grid;grid-template-columns:1fr 340px;gap:32px;align-items:start}
.os-card{background:var(--card);border:1px solid var(--line);border-radius:var(--r);padding:24px;box-shadow:0 10px 30px #26231f0d}
.os-card h2{font-size:1.2rem;margin-bottom:18px;padding-bottom:12px;border-bottom:1px solid var(--line)}
.os-item{display:grid;grid-template-columns:60px 1fr auto;gap:14px;align-items:center;padding:12px 0;border-bottom:1px solid var(--line)}
.os-item:last-child{border-bottom:0}
.os-item .cv{width:60px}
.os-item .cv .sz{display:none}
.os-item .title{font-size:.95rem}
.os-item .meta{color:var(--mut);font-size:.8rem;margin-top:2px}
.os-item .price{font-weight:600;color:var(--red);white-space:nowrap}
.info-row{display:flex;justify-content:space-between;padding:8px 0;font-size:.88rem;color:var(--mut)}
.info-row b{color:var(--ink);text-align:left;max-width:60%}
.info-total{border-top:1px solid var(--line);margin-top:12px;padding-top:14px;display:flex;justify-content:space-between;font-size:1.05rem}
.info-total b{color:var(--red);font-size:1.15rem}
.status-badge{display:inline-block;font-size:.78rem;padding:3px 12px;border-radius:99px;background:#e8f5e9;color:#2e7d32;font-weight:600}
@media(max-width:900px){.os-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
<div class="wrap os-wrap">
  <div class="crumbs">
    <a href="{{ route('home') }}">خانه</a> /
    <a href="{{ route('orders') }}">سفارش‌های من</a> /
    <span>سفارش #{{ $order->id }}</span>
  </div>

  <div class="os-grid">
    <div class="os-card">
      <h2>اقلام سفارش</h2>
      @foreach($order->items as $it)
        <div class="os-item">
          <div class="cv"><img src="{{ asset($it->book->image) }}" alt="{{ $it->book->title }}" onerror="this.remove()"></div>
          <div>
            <div class="title">{{ $it->book->title }}</div>
            <div class="meta">{{ $it->book->author }} · تعداد: {{ $it->qty }}</div>
          </div>
          <div class="price">{{ number_format($it->price * $it->qty) }} هزار</div>
        </div>
      @endforeach
    </div>

    <aside class="os-card">
      <h2>خلاصه</h2>
      <div class="info-row"><span>شماره سفارش</span><b>#{{ $order->id }}</b></div>
      <div class="info-row"><span>تاریخ</span><b>{{ $order->created_at->format('Y/m/d H:i') }}</b></div>
      <div class="info-row"><span>وضعیت</span><b><span class="status-badge">{{ $order->status === 'paid' ? 'پرداخت شده' : 'در انتظار' }}</span></b></div>
      <div class="info-row"><span>تلفن</span><b dir="ltr">{{ $order->phone }}</b></div>
      <div class="info-row"><span>آدرس</span><b style="font-size:.82rem;line-height:1.6">{{ $order->address }}</b></div>
      <div class="info-total"><span>مبلغ کل</span><b>{{ number_format($order->total) }} هزار تومان</b></div>
    </aside>
  </div>
</div>
@endsection