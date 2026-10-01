@extends('admin.layouts.app')

@section('title', __('admin.media_title'))
@section('header_title', __('admin.media_title'))

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>{{ __('admin.media_title') }}</h2>
        <p>{{ __('admin.media_subtitle') }}</p>
    </div>
</div>

<!-- Upload Section -->
<div class="card">
    <div class="card-header">
        <h3><i class="fa-solid fa-cloud-arrow-up"></i> {{ __('admin.upload_new_file') }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; gap: 16px; align-items: center; flex-wrap: wrap;">
            @csrf
            <div style="flex: 1; min-width: 260px;">
                <input type="file" name="file" class="form-control" required accept="image/*,.pdf,video/*">
                <div class="form-hint">{{ __('admin.upload_supported_formats') }}</div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-upload"></i>
                <span>{{ __('admin.upload') }}</span>
            </button>
        </form>
    </div>
</div>

<!-- Media Library Grid -->
<div class="card">
    <div class="card-header" style="flex-wrap: wrap; gap: 14px;">
        <h3><i class="fa-solid fa-images"></i> {{ __('admin.media_title') }}</h3>
        
        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <a href="{{ route('admin.media.index') }}" class="btn btn-sm {{ !request('type') ? 'btn-primary' : 'btn-secondary' }}">{{ __('admin.media_all_types') }}</a>
            <a href="{{ route('admin.media.index', ['type' => 'image']) }}" class="btn btn-sm {{ request('type') === 'image' ? 'btn-primary' : 'btn-secondary' }}">{{ __('admin.media_images') }}</a>
            <a href="{{ route('admin.media.index', ['type' => 'document']) }}" class="btn btn-sm {{ request('type') === 'document' ? 'btn-primary' : 'btn-secondary' }}">{{ __('admin.media_documents') }}</a>
        </div>
    </div>

    <div class="card-body">
        <div class="media-grid">
            @forelse($media as $item)
                @php
                    $isImage = str_starts_with($item->mime ?? '', 'image/');
                    $url = $item->url;
                @endphp
                <div class="media-item" x-data="{ copied: false }">
                    <div class="media-thumb">
                        @if($isImage)
                            <img src="{{ $url }}" alt="{{ $item->original_name }}">
                        @else
                            <i class="fa-solid fa-file-pdf" style="font-size: 40px; color: var(--color-danger);"></i>
                        @endif
                    </div>
                    <div class="media-info">
                        <div class="media-name" title="{{ $item->original_name }}">{{ $item->original_name }}</div>
                        <div style="color: var(--color-text-muted); font-size: 11px; margin-bottom: 8px;">
                            {{ number_format(($item->size ?? 0) / 1024, 1) }} KB
                        </div>

                        <div style="display: flex; gap: 6px; justify-content: space-between; align-items: center;">
                            <button type="button" class="btn btn-secondary btn-sm" style="flex: 1;" @click="navigator.clipboard.writeText('{{ $url }}'); copied = true; setTimeout(() => copied = false, 2000)">
                                <i class="fa-solid" :class="copied ? 'fa-check' : 'fa-copy'"></i>
                                <span x-text="copied ? '{{ __('admin.copied') }}' : '{{ __('admin.copy_url') }}'"></span>
                            </button>

                            <form action="{{ route('admin.media.destroy', $item->id) }}" method="POST" onsubmit="return confirm('{{ __('admin.confirm_delete') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="{{ __('admin.delete') }}" style="padding: 6px 10px;">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; color: var(--color-text-muted); padding: 40px;">
                    <i class="fa-solid fa-folder-open" style="font-size: 42px; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
                    {{ __('admin.no_media_found') }}
                </div>
            @endforelse
        </div>

        @if($media->hasPages())
            <div style="margin-top: 24px;">
                {{ $media->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
