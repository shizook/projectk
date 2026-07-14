<div>
  <h3 class="text-lg font-semibold mb-3">Rilisan Terbaru</h3>
  <div class="space-y-3">
    @foreach($latest as $lp)
      <a class="block hover:underline" href="{{ route('post.show',$lp->slug) }}">{{ $lp->title }}</a>
    @endforeach
  </div>
</div>