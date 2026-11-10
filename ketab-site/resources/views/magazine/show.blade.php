@extends('layouts.app')
@section('title', $magazine->title . ' | مجله‌ی کاغذوسرخ')

@push('styles')
<style>
.mag-show{padding:40px 0 60px}
.crumbs{font-size:.82rem;color:var(--mut);margin-bottom:22px}
.crumbs a:hover{color:var(--red)}
.article{max-width:780px;margin:auto}
.article .cat-label{color:var(--red);font-size:.82rem;letter-spacing:1px;display:block;margin-bottom:8px}
.article h1{font-size:clamp(1.5rem,3.5vw,2.4rem);line-height:1.4;margin-bottom:14px}
.article .meta{color:var(--mut);font-size:.85rem;margin-bottom:24px;display:flex;gap:18px;flex-wrap:wrap}
.article .hero-img{aspect-ratio:16/10;border-radius:var(--r);overflow:hidden;margin-bottom:32px;position:relative;background:repeating-linear-gradient(135deg,#f2eee7 0 12px,#ece7de 12px 24px);display:grid;place-items:center}
.article .hero-img img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:2}
.article .hero-img .sz{font-size:.7rem}
.article .body{font-size:1.02rem;line-height:2;color:#3a342d}
.article .body p{margin-bottom:20px}
.article .excerpt{background:#fdf3f4;border:1px solid var(--line);border-radius:var(--r);padding:22px 26px;margin-bottom:28px;font-size:1.05rem;line-height:1.9;color:#4a423a;border-right:4px solid var(--red)}
.related{padding:40px 0 80px}
@media(max-width:640px){.article .body{font-size:.95rem}.article .excerpt{padding:18px 20px;font-size:.98rem}}
</style>
@endpush

@section('content')
<div class="wrap mag-show">
  <div class="crumbs">
    <a href="{{ route('home') }}">خانه</a> /
    <a href="{{ route('magazine.index') }}">مجله</a> /
    <span>{{ $magazine->title }}</span>
  </div>

  <article class="article">
    <span class="cat-label">{{ $magazine->category_label }}</span>
    <h1>{{ $magazine->title }}</h1>
    <div class="meta">
      <span>{{ $magazine->published_label }}</span>
      <span>{{ $magazine->read_time }}</span>
    </div>

    <div class="hero-img">
      <span class="sz"><em>۸۰۰ × ۵۰۰</em>تصویر مقاله</span>
      <img src="{{ asset($magazine->image) }}" alt="{{ $magazine->title }}" onerror="this.remove()">
    </div>

    @if($magazine->excerpt)
      <div class="excerpt">{{ $magazine->excerpt }}</div>
    @endif

    <div class="body">
      {!! nl2br(e($magazine->body ?: $magazine->excerpt)) !!}
    </div>
  </article>
</div>

@if($related->count())
<section class="related"><div class="wrap">
  <div class="sh"><div><small>RELATED</small><h2>مقالات مرتبط</h2></div></div>
  <div class="mg">
    @foreach($related as $r)
      <a class="ar" href="{{ route('magazine.show', $r) }}">
        <div class="ph"><span class="sz"><em>۸۰۰ × ۵۰۰</em>تصویر مقاله</span><img src="{{ asset($r->image) }}" alt="{{ $r->title }}" onerror="this.remove()"></div>
        <div>
          <small>{{ $r->category_label }}</small>
          <h3>{{ $r->title }}</h3>
          <p>{{ $r->excerpt }}</p>
          <div class="meta">{{ $r->published_label }} · {{ $r->read_time }}</div>
        </div>
      </a>
    @endforeach
  </div>
</div></section>
@endif
@endsection

@push('styles')
<style>
.mg{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
.ar{border-radius:var(--r);background:var(--card);border:1px solid var(--line);overflow:hidden;transition:.3s;box-shadow:0 10px 30px #26231f0d;display:block}
.ar:hover{transform:translateY(-6px)}
.ar .ph{aspect-ratio:16/10}
.ar div:last-child{padding:18px 20px}
.ar small{color:var(--red);font-size:.75rem}
.ar h3{margin:4px 0 8px;font-size:1.05rem;line-height:1.5}
.ar p{color:var(--mut);font-size:.82rem;line-height:1.7;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.ar .meta{color:var(--mut);font-size:.75rem;margin-top:10px}
@media(max-width:900px){.mg{grid-template-columns:repeat(2,1fr)}}
@media(max-width:560px){.mg{grid-template-columns:1fr}}
</style>
@endpush