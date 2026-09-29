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

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card" x-data="{ currentTab: 'identity' }">
        <div class="card-header" style="flex-direction: column; align-items: stretch; gap: 14px;">
            <div class="tabs-nav" style="margin-bottom: 0;">
                <button type="button" class="tab-btn" :class="{ 'active': currentTab === 'identity' }" @click="currentTab = 'identity'">
                    <i class="fa-solid fa-id-card"></i>
                    <span>{{ __('admin.tab_identity') }}</span>
                </button>
                <button type="button" class="tab-btn" :class="{ 'active': currentTab === 'contact' }" @click="currentTab = 'contact'">
                    <i class="fa-solid fa-address-book"></i>
                    <span>{{ __('admin.tab_contact') }}</span>
                </button>
                <button type="button" class="tab-btn" :class="{ 'active': currentTab === 'social' }" @click="currentTab = 'social'">
                    <i class="fa-solid fa-share-nodes"></i>
                    <span>{{ __('admin.tab_social') }}</span>
                </button>
                <button type="button" class="tab-btn" :class="{ 'active': currentTab === 'bank' }" @click="currentTab = 'bank'">
                    <i class="fa-solid fa-building-columns"></i>
                    <span>{{ __('admin.tab_bank') }}</span>
                </button>
                <button type="button" class="tab-btn" :class="{ 'active': currentTab === 'embeds' }" @click="currentTab = 'embeds'">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>{{ __('admin.tab_embeds') }}</span>
                </button>
            </div>
        </div>

        <div class="card-body">
            <!-- Tab: Identity -->
            <div x-show="currentTab === 'identity'">
                <div class="form-group">
                    <label class="form-label">{{ __('admin.setting_association_name') }} <span class="required">*</span></label>
                    <input type="text" name="associationName" class="form-control" value="{{ old('associationName', $settings['associationName'] ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('admin.setting_license_number') }}</label>
                    <input type="text" name="licenseNumber" class="form-control" value="{{ old('licenseNumber', $settings['licenseNumber'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('admin.setting_site_title') }}</label>
                    <input type="text" name="siteTitle" class="form-control" value="{{ old('siteTitle', $settings['siteTitle'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('admin.setting_site_description') }}</label>
                    <textarea name="siteDescription" class="form-control" rows="3">{{ old('siteDescription', $settings['siteDescription'] ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('admin.setting_footer_description') }}</label>
                    <textarea name="footerDescription" class="form-control" rows="3">{{ old('footerDescription', $settings['footerDescription'] ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('admin.setting_logo_url') }}</label>
                    <input type="text" name="logoUrl" class="form-control" value="{{ old('logoUrl', $settings['logoUrl'] ?? '') }}" placeholder="https://...">
                    <div class="form-hint">{{ __('admin.setting_logo_help') }}</div>
                </div>
            </div>

            <!-- Tab: Contact -->
            <div x-show="currentTab === 'contact'">
                <div class="form-group">
                    <label class="form-label">{{ __('admin.setting_phone') }}</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $settings['phone'] ?? '') }}" dir="ltr">
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('admin.setting_whatsapp') }}</label>
                    <input type="text" name="phoneDisplay" class="form-control" value="{{ old('phoneDisplay', $settings['phoneDisplay'] ?? '') }}" dir="ltr">
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('admin.setting_email') }}</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $settings['email'] ?? '') }}" dir="ltr">
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('admin.setting_address') }}</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $settings['address'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('admin.setting_working_hours') }}</label>
                    <input type="text" name="workingHours" class="form-control" value="{{ old('workingHours', $settings['workingHours'] ?? '') }}">
                </div>
            </div>

            <!-- Tab: Social Media -->
            <div x-show="currentTab === 'social'">
                <div class="form-group">
                    <label class="form-label"><i class="fa-brands fa-x-twitter"></i> {{ __('admin.setting_social_twitter') }}</label>
                    <input type="text" name="twitter" class="form-control" value="{{ old('twitter', $settings['twitter'] ?? '') }}" placeholder="https://x.com/..." dir="ltr">
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fa-brands fa-instagram"></i> {{ __('admin.setting_social_instagram') }}</label>
                    <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $settings['instagram'] ?? '') }}" placeholder="https://instagram.com/..." dir="ltr">
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fa-brands fa-youtube"></i> {{ __('admin.setting_social_youtube') }}</label>
                    <input type="text" name="youtube" class="form-control" value="{{ old('youtube', $settings['youtube'] ?? '') }}" placeholder="https://youtube.com/..." dir="ltr">
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fa-brands fa-snapchat"></i> {{ __('admin.setting_social_snapchat') }}</label>
                    <input type="text" name="snapchat" class="form-control" value="{{ old('snapchat', $settings['snapchat'] ?? '') }}" placeholder="https://snapchat.com/..." dir="ltr">
                </div>
            </div>

            <!-- Tab: Bank Accounts -->
            <div x-show="currentTab === 'bank'" x-data="{
                accounts: {{ json_encode(old('bankAccounts', $settings['bankAccounts'] ?? [])) }},
                addAccount() {
                    this.accounts.push({ bankName: '', accountName: '', iban: '', accountNumber: '' });
                },
                removeAccount(index) {
                    this.accounts.splice(index, 1);
                }
            }">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <h4>{{ __('admin.tab_bank') }}</h4>
                    <button type="button" class="btn btn-secondary btn-sm" @click="addAccount()">
                        <i class="fa-solid fa-plus"></i>
                        <span>{{ __('admin.add_item') }}</span>
                    </button>
                </div>

                <div class="repeater-container">
                    <template x-for="(acc, index) in accounts" :key="index">
                        <div class="repeater-item">
                            <div class="repeater-item-header">
                                <span style="font-weight: 700; color: var(--color-primary);" x-text="'حساب #' + (index + 1)"></span>
                                <button type="button" class="btn btn-danger btn-sm" @click="removeAccount(index)">
                                    <i class="fa-solid fa-trash-can"></i>
                                    <span>{{ __('admin.remove_item') }}</span>
                                </button>
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px;">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label class="form-label">{{ __('admin.setting_bank_name') }}</label>
                                    <input type="text" :name="'bankAccounts[' + index + '][bankName]'" x-model="acc.bankName" class="form-control">
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label class="form-label">{{ __('admin.setting_account_name') }}</label>
                                    <input type="text" :name="'bankAccounts[' + index + '][accountName]'" x-model="acc.accountName" class="form-control">
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label class="form-label">{{ __('admin.setting_iban') }}</label>
                                    <input type="text" :name="'bankAccounts[' + index + '][iban]'" x-model="acc.iban" class="form-control" dir="ltr" placeholder="SA...">
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label class="form-label">{{ __('admin.setting_account_number') }}</label>
                                    <input type="text" :name="'bankAccounts[' + index + '][accountNumber]'" x-model="acc.accountNumber" class="form-control" dir="ltr">
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Tab: Embeds & External Links -->
            <div x-show="currentTab === 'embeds'">
                <div class="form-group">
                    <label class="form-label">{{ __('admin.setting_map_embed_url') }}</label>
                    <textarea name="mapEmbedUrl" class="form-control" rows="3" dir="ltr">{{ old('mapEmbedUrl', $settings['mapEmbedUrl'] ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('admin.setting_volunteer_url') }}</label>
                    <input type="text" name="volunteerPlatformUrl" class="form-control" value="{{ old('volunteerPlatformUrl', $settings['volunteerPlatformUrl'] ?? '') }}" placeholder="https://..." dir="ltr">
                </div>
            </div>
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
