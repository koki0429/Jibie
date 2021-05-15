<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('名前') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="sex" value="{{ __('性別') }}" />
                <select id="sex" class="block mt-1 w-full" name="sex" required style="opacity: 0.7;">
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('メールアドレス') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('パスワード') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('パスワード（確認用）') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="zipcode" value="{{ __('郵便番号(※ハイフン必要,半角)') }}" />
                <x-jet-input id="zipcode" class="block mt-1 w-full" type="text" name="zipcode" :value="old('zipcode')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="prefecture" value="{{ __('都道府県') }}" />
                <x-jet-input id="prefecture" class="block mt-1 w-full" type="text" name="prefecture" :value="old('prefecture')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="city" value="{{ __('市区町村') }}" />
                <x-jet-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('町名・番地') }}" />
                <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="phone" value="{{ __('電話番号(※ハイフン必要,半角)') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="birth" value="{{ __('お誕生日') }}" />
                <x-jet-input id="birth" class="block mt-1 w-full" type="date" name="birth" :value="old('birth')" required />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('アカウントを持っていますか？') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('登録する') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
