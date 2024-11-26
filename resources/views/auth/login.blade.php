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

    .register-link {
        text-align: center;
        margin-top: 1.5rem;
    }

    .register-link a {
        color: #f85f00;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.15s ease;
    }

    .register-link a:hover {
        color: #e55600;
    }
</style>
@endsection

@section('content')
    <div class="auth-container">
        <h2 class="auth-title">Login</h2>
        
        @if (session('success'))
            <div style="background-color: #dcfce7; border: 1px solid #22c55e; color: #16a34a; padding: 1rem; border-radius: 4px; margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-container">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
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
                       autocomplete="current-password"
                       class="form-input">
            </div>

            <button type="submit" class="submit-button">
                Login
            </button>
        </form>

        <div class="register-link">
            <a href="{{ route('register') }}">
                Don't have an account? Register here
            </a>
        </div>
    </div>
@endsection 