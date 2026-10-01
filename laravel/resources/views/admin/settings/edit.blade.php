@extends('admin.layouts.app')

@section('title', __('admin.settings_title'))
@section('header_title', __('admin.settings_title'))

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>{{ __('admin.settings_title') }}</h2>
        <p>{{ __('admin.settings_subtitle') }}</p>
    </div>
</div>

@php
    $sections = $schema['sections'] ?? [];
    $firstSectionKey = !empty($sections) ? array_key_first($sections) : '';
@endphp

<div x-data="{ currentTab: '{{ $firstSectionKey }}' }">
    <div class="card">
        <!-- Section Tabs Navigation -->
        <div class="card-header" style="flex-direction: column; align-items: stretch; gap: 14px;">
            <div class="tabs-nav" style="margin-bottom: 0;">
                @foreach($sections as $secKey => $sec)
                    <button type="button" class="tab-btn" :class="{ 'active': currentTab === '{{ $secKey }}' }" @click="currentTab = '{{ $secKey }}'">
                        <span>{{ $sec['title'] ?? $secKey }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="card-body">
            @foreach($sections as $secKey => $sec)
                <div x-show="currentTab === '{{ $secKey }}'" x-data="{
                    restoreSection() {
                        if (confirm('هل أنت متأكد من رغبتك في استعادة القيم الافتراضية لكافة حقول هذا القسم؟')) {
                            const wrappers = $el.querySelectorAll('.field-wrapper');
                            wrappers.forEach(w => {
                                if (w.__x && w.__x.$data && typeof w.__x.$data.restore === 'function') {
                                    w.__x.$data.restore();
                                }
                            });
                        }
                    }
                }">
                    <form action="{{ route('admin.settings.update') }}" method="POST" class="track-dirty">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="_section" value="{{ $secKey }}">
                        <input type="hidden" name="_expected_updated_at" value="{{ $latestUpdatedAt ?? now()->toIso8601String() }}">

                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid var(--color-border); padding-bottom: 10px;">
                            <h3 style="font-size: 16px; font-weight: 700; color: var(--color-primary); margin: 0;">
                                {{ $sec['title'] ?? $secKey }}
                            </h3>

                            <!-- استعادة أصل القسم (Section-level reset) -->
                            <button type="button" class="btn btn-secondary btn-sm" @click="restoreSection()">
                                <i class="fa-solid fa-rotate-left"></i>
                                <span>استعادة أصل القسم</span>
                            </button>
                        </div>

                        <!-- Render All Fields using Universal Field Generator -->
                        @foreach($sec['fields'] ?? [] as $fieldKey => $field)
                            @include('admin.partials.field-generator', ['fieldKey' => $fieldKey, 'field' => $field, 'content' => $settings])
                        @endforeach

                        <div class="card-footer" style="margin: 24px -24px -24px -24px;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>{{ __('admin.save') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
