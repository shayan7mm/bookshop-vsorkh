@extends('layouts.app')
@section('title', 'سبد خرید | کاغذوسرخ')

@push('styles')
<style>
.cart-head{background:#fff;border-bottom:1px solid var(--line);padding:36px 0;margin-top:20px}
.cart-head h1{font-size:clamp(1.6rem,3.5vw,2.2rem);margin-bottom:6px}
.cart-head p{color:var(--mut);font-size:.92rem}
.cart-body{padding:36px 0 80px;display:grid;grid-template-columns:1fr 340px;gap:32px;align-items:start}
.cart-list{display:flex;flex-direction:column;gap:14px}
.c-item{background:var(--card);border:1px solid var(--line);border-radius:var(--r);padding:14px;display:grid;grid-template-columns:80px 1fr auto;gap:16px;align-items:center}
.c-item .cv{width:80px}
.c-item .cv .sz{display:none}
.c-item .title{font-size:1rem;margin-bottom:2px}
.c-item .author{color:var(--mut);font-size:.82rem}
.c-item .price{color:var(--red);font-size:.92rem;font-weight:600;margin-top:6px}
.c-item .qty{display:flex;align-items:center;gap:6px;margin-top:10px}
.qty button{width:30px;height:30px;border-radius:8px;border:1px solid var(--line);background:#fff;color:var(--ink);display:grid;place-items:center;font-size:1rem;transition:.2s}
.qty button:hover{border-color:var(--red);color:var(--red)}
.qty input{width:44px;text-align:center;border:1px solid var(--line);border-radius:8px;padding:4px;font:inherit;font-size:.9rem;background:#fff}
.c-item .remove{background:none;color:var(--mut);font-size:.8rem;padding:4px 8px;transition:.2s;margin-top:6px;display:inline-block}
.c-item .remove:hover{color:var(--red)}
.c-item .line-total{font-weight:600;color:var(--red);text-align:left;white-space:nowrap}
.sidebar{position:sticky;top:130px;background:var(--card);border:1px solid var(--line);border-radius:var(--r);padding:24px;box-shadow:0 10px 30px #26231f0d}
.sidebar h3{font-size:1.1rem;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid var(--line)}
.row{display:flex;justify-content:space-between;font-size:.9rem;padding:7px 0;color:var(--mut)}
.row b{color:var(--ink)}
.row.total{border-top:1px solid var(--line);margin-top:12px;padding-top:14px;font-size:1.05rem}
.row.total b{color:var(--red);font-size:1.15rem}
.sidebar .btn{width:100%;margin-top:18px}
.empty{background:var(--card);border:1px dashed var(--line);border-radius:var(--r);padding:80px 20px;text-align:center;color:var(--mut);grid-column:1/-1}
.empty b{display:block;font-size:1.3rem;color:var(--ink);margin-bottom:8px}
@media(max-width:900px){.cart-body{grid-template-columns:1fr}.sidebar{position:static}}
@media(max-width:560px){
  .c-item{grid-template-columns:60px 1fr;gap:12px}
  .c-item .cv{width:60px}
  .c-item .line-total{grid-column:2;text-align:right}
}
</style>
@endpush

@section('content')
<div class="cart-head"><div class="wrap">
  <h1>سبد خرید</h1>
  <p>{{ \App\Services\CartService::count() }} عنوان در سبد شما</p>
</div></div>

<div class="wrap cart-body">
  @if($items->count())
    <div class="cart-list" id="cartList">
      @foreach($items as $it)
        <div class="c-item" data-book="{{ $it->book_id }}" data-price="{{ $it->book->price }}">
          <div class="cv"><img src="{{ asset($it->book->image) }}" alt="{{ $it->book->title }}" onerror="this.remove()"></div>
          <div>
            <div class="title">{{ $it->book->title }}</div>
            <div class="author">{{ $it->book->author }} · {{ ['p'=>'چاپی','a'=>'صوتی','e'=>'PDF'][$it->book->type] }}</div>
            <div class="price">{{ number_format($it->book->price) }} هزار تومان</div>
            <div class="qty">
              <button type="button" data-act="dec">−</button>
              <input type="number" min="1" value="{{ $it->qty }}" data-act="set">
              <button type="button" data-act="inc">+</button>
            </div>
            <button type="button" class="remove" data-act="remove">حذف</button>
          </div>
          <div class="line-total" data-line>{{ number_format($it->book->price * $it->qty) }} هزار</div>
        </div>
      @endforeach
    </div>

    <aside class="sidebar">
      <h3>خلاصه سفارش</h3>
      <div class="row"><span>تعداد اقلام</span><b id="sumQty">{{ $items->sum('qty') }}</b></div>
      <div class="row total"><span>مبلغ کل</span><b id="sumTotal">{{ number_format($total) }} هزار تومان</b></div>
      <a class="btn p" href="{{ route('checkout') }}">ادامه و پرداخت</a>
      <a class="btn g" href="{{ route('shop') }}" style="margin-top:10px">ادامه خرید</a>
    </aside>
  @else
    <div class="empty">
      <b>سبد خرید شما خالی است</b>
      <span>به فروشگاه برگرد و کتاب مورد علاقه‌ات را اضافه کن.</span>
      <div style="margin-top:20px"><a class="btn p" href="{{ route('shop') }}">رفتن به فروشگاه</a></div>
    </div>
  @endif
</div>
@endsection

@push('scripts')
<script>
const csrf = document.querySelector('meta[name="csrf-token"]')?.content || "{{ csrf_token() }}";

async function postJSON(url, data){
  const res = await fetch(url, {
    method:"POST",
    headers:{"Content-Type":"application/json","X-CSRF-TOKEN":csrf,"Accept":"application/json"},
    body: JSON.stringify(data)
  });
  return res.json();
}

document.getElementById("cartList")?.addEventListener("click", async (e)=>{
  const btn = e.target.closest("[data-act]");
  if(!btn) return;
  const row = btn.closest(".c-item");
  const bookId = row.dataset.book;
  const input = row.querySelector('input[data-act="set"]');
  const act = btn.dataset.act;
  let qty = parseInt(input.value) || 1;

  if(act === "inc") qty++;
  else if(act === "dec") qty--;
  else if(act === "remove") qty = 0;

  const res = await postJSON("{{ route('cart.update') }}", {book_id: bookId, qty});
  if(!res.ok) return;

  if(qty <= 0){
    row.remove();
    if(!document.querySelectorAll(".c-item").length) location.reload();
  } else {
    input.value = qty;
    row.querySelector("[data-line]").textContent = (parseInt(row.dataset.price) * qty).toLocaleString("en") + " هزار";
  }

  document.getElementById("cnt").textContent = res.count.toLocaleString("en").replace(/\d/g,d=>"۰۱۲۳۴۵۶۷۸۹"[d]);
  const sumQty = document.getElementById("sumQty");
  const sumTotal = document.getElementById("sumTotal");
  if(sumQty) sumQty.textContent = [...document.querySelectorAll('.c-item input[data-act="set"]')].reduce((s,i)=>s+parseInt(i.value||0),0);
  if(sumTotal) sumTotal.textContent = res.total.toLocaleString("en") + " هزار تومان";
});

document.getElementById("cartList")?.addEventListener("change", async (e)=>{
  const inp = e.target.closest('input[data-act="set"]');
  if(!inp) return;
  const row = inp.closest(".c-item");
  const qty = Math.max(1, parseInt(inp.value)||1);
  const res = await postJSON("{{ route('cart.update') }}", {book_id: row.dataset.book, qty});
  if(res.ok){
    inp.value = qty;
    row.querySelector("[data-line]").textContent = (parseInt(row.dataset.price) * qty).toLocaleString("en") + " هزار";
    document.getElementById("cnt").textContent = res.count.toLocaleString("en").replace(/\d/g,d=>"۰۱۲۳۴۵۶۷۸۹"[d]);
    const sumTotal = document.getElementById("sumTotal");
    if(sumTotal) sumTotal.textContent = res.total.toLocaleString("en") + " هزار تومان";
  }
});
</script>
@endpush