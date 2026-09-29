@extends('admin.layouts.app')

@section('title', __('admin.editing_page') . ' ' . $pageMeta['title'])
@section('header_title', __('admin.content_title'))

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
            <a href="{{ route('admin.content.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-right"></i>
                <span>{{ __('admin.back') }}</span>
            </a>
            <h2>{{ __('admin.editing_page') }} {{ $pageMeta['title'] }}</h2>
        </div>
        <p>{{ $pageMeta['desc'] }}</p>
    </div>
</div>

<form action="{{ route('admin.content.update', $page) }}" method="POST">
    @csrf
    @method('PUT')

    @php
        $sections = $schema['sections'] ?? [];
        $firstSectionKey = !empty($sections) ? array_key_first($sections) : '';
    @endphp

    <div class="card" x-data="{ currentTab: '{{ $firstSectionKey }}' }">
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
                <div x-show="currentTab === '{{ $secKey }}'">
                    <h3 style="font-size: 16px; font-weight: 700; color: var(--color-primary); margin-bottom: 20px; border-bottom: 1px solid var(--color-border); padding-bottom: 8px;">
                        {{ $sec['title'] ?? $secKey }}
                    </h3>

                    @foreach($sec['fields'] ?? [] as $fieldKey => $field)
                        @php
                            $fieldType = $field['type'] ?? 'text';
                            $fieldLabel = $field['label'] ?? $fieldKey;
                            $currentValue = $content[$fieldKey] ?? ($field['default'] ?? '');
                        @endphp

                        @if($fieldType === 'text' || $fieldType === 'url' || $fieldType === 'fa-icon')
                            <div class="form-group">
                                <label class="form-label">{{ $fieldLabel }}</label>
                                <input type="text" name="{{ $fieldKey }}" class="form-control" value="{{ old($fieldKey, $currentValue) }}">
                            </div>

                        @elseif($fieldType === 'image')
                            <div class="form-group">
                                <label class="form-label">{{ $fieldLabel }}</label>
                                <div style="display: flex; gap: 12px; align-items: center;">
                                    <input type="text" name="{{ $fieldKey }}" class="form-control" value="{{ old($fieldKey, $currentValue) }}" placeholder="https://..." dir="ltr">
                                </div>
                                @if(!empty($currentValue))
                                    <div style="margin-top: 8px; width: 120px; height: 80px; border-radius: 6px; overflow: hidden; border: 1px solid var(--color-border);">
                                        <img src="{{ $currentValue }}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @endif
                            </div>

                        @elseif($fieldType === 'textarea')
                            <div class="form-group">
                                <label class="form-label">{{ $fieldLabel }}</label>
                                <textarea name="{{ $fieldKey }}" class="form-control" rows="3">{{ old($fieldKey, $currentValue) }}</textarea>
                            </div>

                        @elseif($fieldType === 'repeater')
                            @php
                                $repeaterSchema = $field['schema'] ?? [];
                                $items = old($fieldKey, !empty($currentValue) ? $currentValue : ($field['default'] ?? []));
                                if (!is_array($items)) {
                                    $items = [];
                                }
                            @endphp

                            <div class="form-group" x-data="{
                                items: {{ json_encode($items) }},
                                schemaTemplate: {{ json_encode(array_fill_keys(array_keys($repeaterSchema), '')) }},
                                addItem() {
                                    this.items.push(Object.assign({}, this.schemaTemplate));
                                },
                                removeItem(index) {
                                    this.items.splice(index, 1);
                                }
                            }">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <label class="form-label" style="margin-bottom: 0;">{{ $fieldLabel }}</label>
                                    <button type="button" class="btn btn-secondary btn-sm" @click="addItem()">
                                        <i class="fa-solid fa-plus"></i>
                                        <span>{{ __('admin.add_item') }}</span>
                                    </button>
                                </div>

                                <div class="repeater-container" id="repeater-{{ $fieldKey }}">
                                    <template x-for="(item, index) in items" :key="index">
                                        <div class="repeater-item">
                                            <div class="repeater-item-header">
                                                <div style="display: flex; align-items: center; gap: 8px;">
                                                    <span class="sortable-handle" title="{{ __('admin.drag_hint') }}">
                                                        <i class="fa-solid fa-grip-vertical"></i>
                                                    </span>
                                                    <strong style="color: var(--color-primary); font-size: 13px;" x-text="'عنصر #' + (index + 1)"></strong>
                                                </div>
                                                <button type="button" class="btn btn-danger btn-sm" @click="removeItem(index)">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                    <span>{{ __('admin.remove_item') }}</span>
                                                </button>
                                            </div>

                                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 14px;">
                                                @foreach($repeaterSchema as $subKey => $subField)
                                                    @php
                                                        $subType = $subField['type'] ?? 'text';
                                                        $subLabel = $subField['label'] ?? $subKey;
                                                    @endphp
                                                    <div class="form-group" style="margin-bottom: 0;">
                                                        <label class="form-label" style="font-size: 12.5px;">{{ $subLabel }}</label>
                                                        @if($subType === 'textarea')
                                                            <textarea :name=\"'{{ $fieldKey }}[' + index + '][{{ $subKey }}]'\" x-model=\"item.{{ $subKey }}\" class=\"form-control\" rows=\"2\"></textarea>
                                                        @else
                                                            <input type=\"text\" :name=\"'{{ $fieldKey }}[' + index + '][{{ $subKey }}]'\" x-model=\"item.{{ $subKey }}\" class=\"form-control\">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>{{ __('admin.save') }}</span>
            </button>
        </div>
    </div>
</form>
@endsection
