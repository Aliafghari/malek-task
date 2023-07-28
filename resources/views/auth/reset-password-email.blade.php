<x-guest-layout>

    <div class="mb-4 text-sm text-gray-600">
      Your password reset link has been sent to your email. 
    </div>
  
    <div class="mb-4 text-sm text-gray-600">
      Please check your email to reset your password.
    </div>
  
    <div class="mb-4 text-sm text-gray-600">
      <strong>Email:</strong> {{ $email }}
    </div>
  
    @if($randomNumber)
      <div class="mb-4 text-sm text-gray-600">
        <strong>Random Number:</strong> {{ $randomNumber }} 
      </div>
    @endif
  
    {{-- <div class="mt-4">
      <a href="{{ $appUrl }}">Back to App</a>
    </div> --}}
  
  </x-guest-layout>