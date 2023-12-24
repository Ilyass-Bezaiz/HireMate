<x-guest-layout>
  <x-authentication-card>
    <x-slot name="logo">
      <x-authentication-card-logo />
    </x-slot>

    <x-validation-errors class="mb-4" />

    <form method="POST" action="{{ route('register') }}" id="form">
      @csrf
      <div class="step-1">
        <div>
          <x-label for="name" value="{{ __('Name') }}" />
          <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus
            autocomplete="name" />
        </div>

        <div class="mt-4">
          <x-label for="email" value="{{ __('Email') }}" />
          <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
            autocomplete="username" />
        </div>

        <div class="flex mt-4 items-center content-center gap-1">
          <div class=" w-1/2">
            <x-label for="phone" value="{{ __('Phone') }}" />
            <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required
              autocomplete="phone" />
          </div>
          <div class="w-1/2">
            <x-label for="user_role" value="{{ __('Choose your role') }}" />
            <select name="user_role" id="role"
              class="block mt-1 w-full rounded-md dark:bg-gray-900 bg-white focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-400">
              <option value="job_seeker" selected>Job seeker</option>
              <option value="employer">Employer</option>
            </select>
          </div>
        </div>

        <div class="mt-4">
          <x-label for="password" value="{{ __('Password') }}" />
          <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
            autocomplete="new-password" />
        </div>

        <div class="mt-4">
          <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
          <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
            required autocomplete="new-password" />
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div class="mt-4">
          <x-label for="terms">
            <div class="flex items-center">
              <x-checkbox name="terms" id="terms" required />
              <div class="ms-2">
                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                  class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800">'.__('Terms
                  of Service').'</a>',
                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                  class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800">'.__('Privacy
                  Policy').'</a>',
                ]) !!}
              </div>
            </div>
          </x-label>
        </div>
        @endif
      </div>
      <div class="step-2 hidden" id="candidate">
        <div>
          <x-label for="age" value="{{ __('Age') }} (optional)" />
          <x-input id="age" class="block mt-1 w-full" type="number" style="appearance: none;" name="age" min="1"
            max="90" :value="old('age')" required autofocus autocomplete="age" />
        </div>

        <div class="mt-4">
          <x-label for="gender" value="{{ __('Choose your gnder') }} (optional)" />
          <select name="gender" id="gender"
            class="block mt-1 w-full rounded-md dark:bg-gray-900 bg-white focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-400">
            <option value="male" selected>Male</option>
            <option value="female">Female</option>
          </select>
        </div>

        <div class="mt-4">
          <x-label for="jobPreferences" value="{{ __('Job Preferences') }} (optional)" />
          <x-input id="jobPreferences" class="block mt-1 w-full" type="text" name="jobPreferences"
            :value="old('jobPreferences')" required autofocus autocomplete="jobPreferences" />
        </div>
      </div>

      <div class="step-2 hidden" id="employer">
        <div>
          <x-label for="companyName" value="{{ __('Company Name') }} (optional)" />
          <x-input id="companyName" class="block mt-1 w-full" type="text" name="companyName" :value="old('companyName')"
            required autofocus autocomplete="companyName" />
        </div>

        <div>

        </div>
        <div class="flex mt-4 items-center content-center gap-1">
          <div class=" w-1/2">
            <x-label for="country" value="{{ __('Country')}} (optional)" />
            <select name="country"
              class="block mt-1 w-full rounded-md dark:bg-gray-900 bg-white focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-400">
              @foreach(App\DataProviders\CountryDataProvider::data() as $country)
              <option value="{{ $country['id'] }}"> {{ $country['name'] }} </option>
              @endforeach
            </select>
          </div>
          <div class="w-1/2">
            <x-label for="city" value="{{ __('City') }} (optional)" />
            <select name="city"
              class="block mt-1 w-full rounded-md dark:bg-gray-900 bg-white focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-400">
              <option value="test" selected>test</option>
              <!-- @foreach(App\DataProviders\CityDataProvider::data() as $city) -->
              <!-- <option value="{{ $city['id'] }}"> {{ $city['name'] }} </option> -->
              <!-- @endforeach -->
            </select>
          </div>
        </div>
        <div class="mt-4">
          <x-label for="zip" value="{{ __('Zip') }} (optional)" />
          <x-input id="zip" class="block mt-1 w-full" type="number" min="0" name="zip" :value="old('zip')" required
            autofocus autocomplete="zip" />
        </div>
        <div class="mt-4">
          <x-label for="industry" value="{{ __('Industry') }} (optional)" />
          <x-input id="industry" class="block mt-1 w-full" type="text" name="industry" :value="old('industry')" required
            autofocus autocomplete="industry" />
        </div>
        <div class="mt-4">
          <x-label for="employeeCount" value="{{ __('Employee Count') }} (optional)" />
          <x-input id="employeeCount" class="block mt-1 w-full" type="number" min="0" name="employeeCount"
            :value="old('employeeCount')" required autofocus autocomplete="employeeCount" />
        </div>
      </div>

      <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800"
          href="{{ route('login') }}">
          {{ __('Already registered?') }}
        </a>
        <x-button class="ms-4" id='sub'>
          {{ __('Register') }}
        </x-button>
      </div>
    </form>
    <script>
    const btn = document.getElementById('sub');
    const Form = document.getElementById('form');
    const userForm = document.getElementsByClassName('step-1');
    const candidateForm = document.getElementById('candidate');
    const employerForm = document.getElementById('employer');
    const role = document.getElementById('role');
    let inputs = document.querySelectorAll('.step-1 input');

    let i = 1;
    btn.addEventListener("click", function(event) {
      if (i == 1) {
        event.preventDefault();
        inputs.forEach(function(inp) {
          if (!inp.value) {
            form.submit();
          }
        });
        userForm[0].style.display = 'none';
        role.value === "job_seeker" ? candidateForm.style.display = "block" : employerForm.style.display = "block";
      } else {
        form.submit();
      }
      i++;
    });
    </script>
  </x-authentication-card>
</x-guest-layout>