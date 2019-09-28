@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
          </div>
          
          @if (Auth::user()->hasVerifiedEmail())
            <div id='news-feed'></div>
          @else
            <p>Must verify e-mail! Go <a href="/email/verify">here</a> to resend verification link.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

@if (Auth::user()->hasVerifiedEmail())
  @push('scripts')
    <script src="{{ asset('js/load_news.js') }}" defer></script>
  @endpush
@endif
