@extends('layouts.app')
@section('title', 'سفارش‌های من | کاغذوسرخ')

@push('styles')
<style>
.ord-head{background:#fff;border-bottom:1px solid var(--line);padding:36px 0;margin-top:20px}
.ord-head h1{font-size:clamp(1.5rem,3.2vw,2.2rem)}
.ord-head p{color:var(--mut);font-size:.92rem;margin-top:4px}
.ord-body{padding:36px 0 80px}
.ord-list{display:flex;flex-direction:column;gap:14px}
.o-card{background:var(--card);border:1px solid var(--line);border-radius:var(--r);padding:20px;display:grid;grid-template-columns:auto 1fr auto;gap:20px;align-items:center;transition:.25s}
.o-card:hover{border-color:var(--red);box-shadow:0 10px 30px #26231f0d}
.o-id{font-size:1.1rem;font-weight:600}
.o-id small{display:block;color:var(--mut);font-size:.75rem;font-weight:400;margin-top:4px}
.o-meta{color:var(--mut);font-size:.85rem;display:flex;flex-wrap:wrap;gap:16px}
.o-meta b{color:var(--ink)}
.o-total{font-size:1.1rem;font-weight:600;color:var(--red);white-space:nowrap}
.o-status{font-size:.78rem;padding:3px 12px;border-radius:99px;background:#e8f5e9;color:#2e7d32;font-weight:600;display:inline-block;margin-top:6px}
.o-btn{padding:8px 18px;border-radius:99px;background:var(--ink);color:#fff;font-size:.82rem;font-weight:600;white-space:nowrap}
.o-btn:hover{background:var(--red)}
.empty{background:var(--card);border:1px dashed var(--line);border-radius:var(--r);padding:80px 20px;text-align:center;color:var(--mut)}
.empty b{display:block;font-size:1.3rem;color:var(--ink);margin-bottom:8px}
.pager{display:flex;justify-content:center;margin-top:40px;gap:6px;flex-wrap:wrap}
.pager a,.pager span{padding:8px 14px;border-radius:10px;border:1px solid var(--line);background:#fff;font-size:.85rem;color:var(--mut);min-width:36px;text-align:center}
.pager a:hover{border-color:var(--red);color:var(--red)}
.pager .on{background:var(--ink);color:#fff;border-color:var(--ink)}
.pager .disabled{opacity:.4;cursor:not-allowed}
.alert{border-radius:12px;padding:12px 16px;font-size:.88rem;margin-bottom:20px;line-height:1.7}
.alert.ok{background:#e8f5e9;color:#2e7d32;border:1px solid #a5d6a7}
@media(max-width:700px){.o-card{grid-template-columns:1fr;gap:12px;text-align:right}.o-btn{width:100%;text-align:center}}
</style>
@endpush

@section('content')
<div class="ord-head"><div class="wrap">
  <h1>سفارش‌های من</h1>
  <p>تاریخچه‌ی خریدهای شما از کاغذوسرخ</p>
</div></div>

<div class="wrap ord-body">
  @if(session('ok'))
    <div class="alert ok">{{ session('ok') }}</div>
  @endif

  @if($orders->count())
    <div class="ord-list">
      @foreach($orders as $o)
        <div class="o-card">
          <div>
            <div class="o-id">#{{ $o->id }}<small>{{ $o->created_at->format('Y/m/d H:i') }}</small></div>
          </div>
          <div class="o-meta">
            <span><b>{{ $o->items->count() }}</b> عنوان</span>
            <span>تلفن: <b>{{ $o->phone }}</b></span>
            <span class="o-status">{{ $o->status === 'paid' ? 'پرداخت شده' : 'در انتظار پرداخت' }}</span>
          </div>
          <div style="display:flex;gap:14px;align-items:center;justify-content:flex-end;flex-wrap:wrap">
            <span class="o-total">{{ number_format($o->total) }} هزار تومان</span>
            <a class="o-btn" href="{{ route('orders.show', $o) }}">جزئیات</a>
          </div>
        </div>
      @endforeach
    </div>

    @if($orders->hasPages())
      <div class="pager">
        @if($orders->onFirstPage())<span class="disabled">قبلی</span>@else<a href="{{ $orders->previousPageUrl() }}">قبلی</a>@endif
        @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
          @if($page == $orders->currentPage())<span class="on">{{ $page }}</span>@else<a href="{{ $url }}">{{ $page }}</a>@endif
        @endforeach
        @if($orders->hasMorePages())<a href="{{ $orders->nextPageUrl() }}">بعدی</a>@else<span class="disabled">بعدی</span>@endif
      </div>
    @endif
  @else
    <div class="empty">
      <b>هنوز سفارشی ثبت نکردی</b>
      <span>اولین کتابت را از فروشگاه انتخاب کن.</span>
      <div style="margin-top:20px"><a class="btn p" href="{{ route('shop') }}">رفتن به فروشگاه</a></div>
    </div>
  @endif
</div>
@endsection