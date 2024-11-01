<link rel="stylesheet" href="{{ asset('user/assets/css/floating-contact-button/floating-contact-button.css') }}">
<div class="fab-container">
				{{-- <div class="fab shadow">
								<div class="fab-content">
												<a href="{{ $settingsContact->where('setting_key', 'contact_messenger')->first()->plain_value }}"
																target="_blank">
																<i class="fa-brands fa-facebook-messenger fs-3 text-white"></i>
												</a>
								</div>
				</div> --}}
				<div class="sub-button fs-3 shadow">
								<a href="{{ $settingsContact->where('setting_key', 'contact_facebook')->first()->plain_value }}" target="_blank">
												<i class="fa-brands fa-facebook text-white"></i>
								</a>
				</div>
				<div class="sub-button shadow">
								<a href="{{ $settingsContact->where('setting_key', 'contact_zalo')->first()->plain_value }}" target="_blank">
												<span class="bold-text text-white">Zalo</span>
								</a>
				</div>
				<div class="sub-button fs-3 shadow">
								<a href="{{ $settingsContact->where('setting_key', 'contact_phone')->first()->plain_value }}" target="_blank">
												<i class="fa fa-phone text-white"></i>
								</a>
				</div>
</div>
