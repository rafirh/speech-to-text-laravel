@extends('dashboard.main')

@section('custom-css')
@endsection

@section('content')
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center justify-content-center">
        <div class="col-xl-10">
          <div class="row">
            <div class="col">
              <h2 class="page-title">
                Detail History
              </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list d-flex">
                <a href="{{ getPreviousUrl(route('dashboard.histories.index')) }}"
                  class="btn btn-outline-primary d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l14 0"></path>
                    <path d="M5 12l6 6"></path>
                    <path d="M5 12l6 -6"></path>
                  </svg>
                  Back
                </a>
                <a href="{{ getPreviousUrl(route('dashboard.histories.index')) }}"
                  class="btn btn-outline-primary d-sm-none btn-icon" aria-label="Back">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l14 0"></path>
                    <path d="M5 12l6 6"></path>
                    <path d="M5 12l6 -6"></path>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards justify-content-center">
        <div class="col-xl-10">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6 col-md-4 col-12">
                  <div class="mb-3">
                    <label class="form-label">Recording Title</label>
                    <div class="form-control-plaintext">{{ $history->title }}</div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-12">
                  <div class="mb-3">
                    <label class="form-label">Language</label>
                    <div class="form-control-plaintext">
                      <span {{ add_title_tooltip($history->name ?? '-', 30) }}>
                        {{ mb_strimwidth($history->name ?? '-', 0, 30, '...') }}
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-12">
                  <div class="mb-3">
                    <label class="form-label">Saved At</label>
                    <div class="form-control-plaintext">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-time"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4"></path>
                        <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                        <path d="M15 3v4"></path>
                        <path d="M7 3v4"></path>
                        <path d="M3 11h16"></path>
                        <path d="M18 16.496v1.504l1 1"></path>
                      </svg>
                      {{ $history->created_at->format('d M Y H:i:s') }}
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label">Original Content</label>
                    <div class="form-control-plaintext">
                      {!! $history->original_text ?? '-' !!}
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label">Paraphrased Content</label>
                    <div class="form-control-plaintext">
                      {!! $history->translated_text ?? '-' !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('library-js')
@endsection

@section('custom-js')
@endsection
