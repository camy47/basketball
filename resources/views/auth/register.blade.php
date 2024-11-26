@extends('layout')

@section('styles')
<style>
    .auth-container {
        background-color: white;
        max-width: 400px;
        margin: 2rem auto;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .auth-title {
        text-align: center;
        color: #333;
        margin-bottom: 2rem;
        font-size: 1.75rem;
        font-weight: 600;
    }

    .error-container {
        background-color: #fee2e2;
        border: 1px solid #fecaca;
        color: #dc2626;
        padding: 1rem;
        border-radius: 6px;
        margin-bottom: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 1.25rem;
    }

    .form-label {
        color: #374151;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .form-input {
        padding: 0.75rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 6px;
        transition: border-color 0.15s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #f85f00;
        box-shadow: 0 0 0 3px rgba(248, 95, 0, 0.1);
    }

    .submit-button {
        background-color: #f85f00;
        color: white;
        padding: 0.875rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
        transition: background-color 0.15s ease;
    }

    .submit-button:hover {
        background-color: #e55600;
    }

    .login-link {
        text-align: center;
        margin-top: 1.5rem;
    }

    .login-link a {
        color: #f85f00;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.15s ease;
    }

    .login-link a:hover {
        color: #e55600;
    }
</style>
@endsection

@section('content')
    <div class="auth-container">
        <h2 class="auth-title">Register</h2>
        
        @if ($errors->any())
            <div style="background-color: #fee2e2; border: 1px solid #ef4444; color: #dc2626; padding: 1rem; border-radius: 4px; margin-bottom: 1rem;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       required 
                       autocomplete="name"
                       class="form-input">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       required 
                       autocomplete="email"
                       class="form-input">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required 
                       autocomplete="new-password"
                       class="form-input">
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password"
                       class="form-input">
            </div>

            <button type="submit" class="submit-button">
                Register
            </button>
        </form>

        <div class="login-link">
            <a href="{{ route('login') }}">
                Already have an account? Login here
            </a>
        </div>
    </div>
@endsection