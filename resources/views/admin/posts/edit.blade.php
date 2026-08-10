@extends('layouts.app')
@section('title','Edit Post')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Post</h1>

<form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" class="grid gap-5">
  @csrf
  @method('PUT')

  <div>
    <input type="text" name="title" value="{{ old('title', $post->title) }}" placeholder="Judul" required class="w-full px-4 py-3 rounded-lg bg-slate-100 dark:bg-slate-800 text-sm">
  </div>

  <div class="rounded-xl border border-slate-200 dark:border-slate-800 p-4 bg-slate-900/40">
    <label class="block mb-3 text-xs font-bold uppercase tracking-wider text-slate-400">
      FOTO SAMPUL <span class="text-rose-500">*</span>
    </label>

    @php $hasCover = (bool) $post->cover_image; @endphp

    <label for="cover-image-input" id="cover-dropzone"
           style="position:relative; display:flex; cursor:pointer; flex-direction:column; align-items:center; justify-content:center; gap:0.5rem; border-radius:0.75rem; border:2px dashed rgba(255,255,255,0.15); background:rgba(2,6,23,0.4); padding:2.5rem 1.5rem; text-align:center;">

      <div id="cover-placeholder" class="{{ $hasCover ? 'hidden' : '' }}" style="flex-direction:column; align-items:center; gap:0.5rem;">
        <svg xmlns="http://www.w3.org/2000/svg" style="height:2.5rem; width:2.5rem; color:#64748b;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M6 18h12a1.5 1.5 0 001.5-1.5V6.75A1.5 1.5 0 0018 5.25H6A1.5 1.5 0 004.5 6.75v9.75A1.5 1.5 0 006 18z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 9.75a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
        </svg>
        <p style="font-size:0.875rem; color:#94a3b8;">
          Ukuran foto tidak dilimit namun pastikan sizenya kurang dari 2 mb<br>
          Format: jpg, jpeg, png
        </p>
        <span style="margin-top:0.25rem; font-size:0.875rem; font-weight:600; color:#fff; text-decoration:underline;">Upload Foto</span>
      </div>

    
      <div id="cover-filled" class="{{ $hasCover ? '' : 'hidden' }}" style="width:100%;">
        <img id="cover-image-preview" src="{{ $hasCover ? asset('storage/'.$post->cover_image) : '' }}" alt="Preview" style="margin:0 auto; max-height:16rem; width:auto; max-width:100%; border-radius:0.5rem; object-fit:contain; display:block;">
        <span style="margin-top:0.75rem; display:inline-block; font-size:0.875rem; font-weight:600; color:#fff; text-decoration:underline;">Ganti Foto</span>
      </div>

      <input type="file" name="cover_image" id="cover-image-input" accept="image/jpeg,image/png,image/gif,image/heic"
             style="position:absolute; inset:0; height:100%; width:100%; cursor:pointer; opacity:0;">
    </label>

    <!-- Sumber Foto -->
    <input type="text" id="cover-image-source" name="cover_image_source" value="{{ old('cover_image_source', $post->cover_image_source ?? $post->cover_source ?? $post->image_source ?? '') }}" placeholder="Source foto" class="mt-3 w-full px-4 py-3 rounded-lg bg-slate-100 dark:bg-slate-800 text-sm">
  </div>

  <select name="category_id" class="w-full px-4 py-3 rounded-lg bg-slate-100 dark:bg-slate-800 text-sm">
    <option value="">Pilih Kategori</option>
    @foreach($categories as $c)
      <option value="{{ $c->id }}" @selected(old('category_id', $post->category_id) == $c->id)>{{ $c->name }}</option>
    @endforeach
  </select>

  <div class="quill-wrapper">
    <div class="quill-editor" data-quill data-target="content-input" data-placeholder="Isi konten"></div>
    <textarea id="content-input" name="content" class="hidden" required>{!! old('content', $post->content) !!}</textarea>
  </div>

  <select name="status" class="mt-10 w-full px-4 py-3 rounded-lg bg-slate-100 dark:bg-slate-800 text-sm">
    <option value="draft" @selected(old('status', $post->status) === 'draft')>Draft</option>
    <option value="published" @selected(old('status', $post->status) === 'published')>Published</option>
  </select>

  <button type="submit" class="w-full py-3 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-lg transition">
    Update
  </button>
</form>
@endsection

@push('scripts')
@once
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

<style>
.ql-snow .ql-picker.ql-size .ql-picker-label[data-value="10px"]::before,
.ql-snow .ql-picker.ql-size .ql-picker-item[data-value="10px"]::before { content: '10px'; }
.ql-snow .ql-picker.ql-size .ql-picker-label[data-value="12px"]::before,
.ql-snow .ql-picker.ql-size .ql-picker-item[data-value="12px"]::before { content: '12px'; }
.ql-snow .ql-picker.ql-size .ql-picker-label[data-value="14px"]::before,
.ql-snow .ql-picker.ql-size .ql-picker-item[data-value="14px"]::before { content: '14px'; }
.ql-snow .ql-picker.ql-size .ql-picker-label[data-value="16px"]::before,
.ql-snow .ql-picker.ql-size .ql-picker-item[data-value="16px"]::before { content: '16px'; }
.ql-snow .ql-picker.ql-size .ql-picker-label[data-value="18px"]::before,
.ql-snow .ql-picker.ql-size .ql-picker-item[data-value="18px"]::before { content: '18px'; }
.ql-snow .ql-picker.ql-size .ql-picker-label[data-value="20px"]::before,
.ql-snow .ql-picker.ql-size .ql-picker-item[data-value="20px"]::before { content: '20px'; }
.ql-snow .ql-picker.ql-size .ql-picker-label[data-value="24px"]::before,
.ql-snow .ql-picker.ql-size .ql-picker-item[data-value="24px"]::before { content: '24px'; }
.ql-snow .ql-picker.ql-size .ql-picker-label[data-value="32px"]::before,
.ql-snow .ql-picker.ql-size .ql-picker-item[data-value="32px"]::before { content: '32px'; }
.ql-snow .ql-picker.ql-size .ql-picker-label[data-value="48px"]::before,
.ql-snow .ql-picker.ql-size .ql-picker-item[data-value="48px"]::before { content: '48px'; }

.ql-snow .ql-picker-options .ql-picker-item::before,
.ql-snow .ql-picker-options .ql-picker-item {
    color: #1e293b !important;
}

#cover-dropzone .hidden {
    display: none !important;
}
</style>
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
@endonce

<script>
  const initQuill = () => {
    if (typeof Quill === 'undefined') {
      console.error('Quill gagal dimuat.');
      return;
    }

    const Size = Quill.import('attributors/style/size');
    Size.whitelist = ['10px', '12px', '14px', '16px', '18px', '20px', '24px', '32px', '48px'];
    Quill.register(Size, true);

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
                    [{ header: [1, 2, 3, false] }, { size: ['10px', '12px', '14px', '16px', '18px', '20px', '24px', '32px', '48px'] }],
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

  const coverInput = document.getElementById('cover-image-input');
  const coverPreview = document.getElementById('cover-image-preview');
  const coverPlaceholder = document.getElementById('cover-placeholder');
  const coverFilled = document.getElementById('cover-filled');

  coverInput?.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
      coverPreview.src = URL.createObjectURL(file);
      coverPlaceholder.classList.add('hidden');
      coverFilled.classList.remove('hidden');
      coverFilled.style.display = 'block';
    }
  });

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initQuill);
  } else {
    initQuill();
  }
</script>
@endpush