@extends('layouts.app')
@section('title','Buat Post')

@section('content')
<h1 class="text-2xl font-bold mb-4">Buat Post</h1>
<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="grid gap-5">
  @csrf
  <input type="text" name="title" placeholder="Judul" required class="w-full px-3 py-2 rounded-lg bg-slate-100 dark:bg-slate-800">
  
  <select name="category_id" class="w-full px-3 py-2 rounded-lg bg-slate-100 dark:bg-slate-800">
    <option value="">Pilih Kategori</option>
    @foreach($categories as $c)
      <option value="{{ $c->id }}">{{ $c->name }}</option>
    @endforeach
  </select>
  
  <div class="quill-wrapper">
    <div class="quill-editor" data-quill data-target="content-input" data-placeholder="Isi konten"></div>
    <textarea id="content-input" name="content" class="hidden" required>{!! old('content') !!}</textarea>
  </div>
  
  <input type="file" name="cover_image" class="w-full">
  
  <select name="status" class="w-full px-3 py-2 rounded-lg bg-slate-100 dark:bg-slate-800">
    <option value="draft">Draft</option>
    <option value="published">Published</option>
  </select>
  
  <button class="px-4 py-2 bg-slate-900 text-white rounded-lg">Simpan</button>
</form>
@endsection

@push('scripts')
@once
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
@endonce
<script>
  const initQuill = () => {
    if (typeof Quill === 'undefined') {
      console.error('Quill gagal dimuat. Pastikan koneksi internet tersedia atau gunakan bundle lokal.');
      return;
    }

    const editors = document.querySelectorAll('[data-quill]:not([data-quill-initialized])');
    editors.forEach((element) => {
      const targetId = element.dataset.target;
      const hiddenInput = document.getElementById(targetId);
      if (!hiddenInput) return;

      const quill = new Quill(element, {
        theme: 'snow',
        placeholder: element.dataset.placeholder || '',
        modules: {
          toolbar: [
            [{ header: [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            ['blockquote', 'code-block'],
            ['link', 'image'],
            [{ color: [] }, { background: [] }],
            [{ align: [] }],
            ['clean']
          ]
        }
      });

      const initialContent = hiddenInput.value;
      if (initialContent) {
        quill.root.innerHTML = initialContent;
      }

      const form = hiddenInput.closest('form');
      const sync = () => { hiddenInput.value = quill.root.innerHTML; };
      quill.on('text-change', sync);
      form?.addEventListener('submit', sync);

      element.dataset.quillInitialized = 'true';
    });
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initQuill);
  } else {
    initQuill();
  }
</script>
@endpush
