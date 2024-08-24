<section>
	<header>
		<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
				<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
			</svg>
			<strong class="ml-2">{{ __('Informações do Perfil') }}</strong>
		</h2>

		<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
			{{ __("Atualize as informações de perfil e endereço de e-mail da sua conta.") }}
		</p>
	</header>

	<form id="send-verification" method="post" action="{{ route('verification.send') }}">
		@csrf
	</form>

	<form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
		@csrf
		@method('patch')

		<div>
			<x-input-label for="name" :value="__('Nome')" />
			<x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
			<x-input-error class="mt-2" :messages="$errors->get('name')" />
		</div>

		<div class="mt-5 mb-5">
			<x-input-label for="email" :value="__('Email')" />
			<x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
			<x-input-error class="mt-2" :messages="$errors->get('email')" />

			@if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
				<div>
					<p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
						{{ __('Seu endereço de e-mail não foi verificado.') }}

						<button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
							{{ __('Clique aqui para reenviar o e-mail de verificação.') }}
						</button>
					</p>

					@if (session('status') === 'verification-link-sent')
						<p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
							{{ __('Um novo link de verificação foi enviado para seu endereço de e-mail.') }}
						</p>
					@endif
				</div>
			@endif
		</div>

		<div class="flex items-center gap-4">
			<x-primary-button>{{ __('Save') }}</x-primary-button>

			@if (session('status') === 'profile-updated')
				<p
					x-data="{ show: true }"
					x-show="show"
					x-transition
					x-init="setTimeout(() => show = false, 2000)"
					class="text-sm text-gray-600 dark:text-gray-400"
				>{{ __('Saved.') }}</p>
			@endif
		</div>
	</form>
</section>
