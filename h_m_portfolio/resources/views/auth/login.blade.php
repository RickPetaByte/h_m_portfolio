<x-guest-layout>
    <img src="img/moon.png" class="mr-5 icon">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="card-body">
            <img id="logo" src="{{ asset('img/LogoCircle.png') }}" alt="Logo" class="w-20 h-20 mx-auto imageLoginRegistration">
            <input id="email" class="form-control my-4 py-2 rounded backgroundTransparant" 
                    type="email" 
                    name="email" :value="old('email')" 
                    required autofocus autocomplete="username" placeholder="Enter email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <input id="password" class="form-control my-4 py-2 rounded backgroundTransparant"
                    type="password"
                    name="password"
                    required autocomplete="current-password" placeholder="Enter password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <div class="text-center mt-3">
                <button class="btn btn-primary text-white mb-3 mt-1 loginRegistrationButton">Login <i class="pl-1 text-white fa-solid fa-right-to-bracket"></i></button>
                <a href="{{ route('register') }}" class="nav-link">Don't have a account yet?</a>
            </div>
        </div>
    </form>
</x-guest-layout>
<script>
    document.getElementById('logo').addEventListener('click', function() {
        window.location.href = "{{ route('dashboard') }}";
    });
</script>