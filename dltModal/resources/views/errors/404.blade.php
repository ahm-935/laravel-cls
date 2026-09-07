<<<<<<< HEAD
@extends("layouts.single-page")
@section("main")
<div class="text-center">
    <h1 class="h1 mb-3 fw-bold text-danger"> 404</h1>
    <p class="h2 fw-bold">Page not found.</p><br>
    <x-btn href="/"> Back to HomePage</x-btn>
</div>
=======
@extends('admin.layouts.single-master')

@section('title', 'Page Not Found')
@endsection
@section('content')

        <!-- Main centered error card layout -->
        <div class="login-card text-center">
            
            <!-- Brand Identity -->
            <a href="index.html" class="login-brand text-decoration-none">
                <i class="bi bi-asterisk"></i>
                <span>Spark Admin</span>
            </a>
            
            <!-- Giant 404 header with spinning asterisk Zero -->
            <div class="error-title-huge">
                <span>4</span>
                <i class="bi bi-asterisk"></i>
                <span>4</span>
            </div>
            
            <h2 class="error-subtitle">Page Not Found</h2>
            <p class="error-desc">
                The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
            </p>
            
            <div class="error-actions-group">
                <a href="index.html" class="btn-custom btn-custom-primary">
                    <i class="bi bi-house"></i> Back to Dashboard
                </a>
            </div>
            
        </div>

>>>>>>> f5e64f3 (sparkAdmin templating on L13)
@endsection