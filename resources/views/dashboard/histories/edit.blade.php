@extends('main')

@section('custom-css')
@endsection

@section('content')
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center justify-content-center">
        <div class="col-md-6">
          <h2 class="page-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="icon icon-tabler icons-tabler-outline icon-tabler-bell">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
              <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
            </svg>
            Ubah Pengumuman
          </h2>
        </div>
      </div>
    </div>
  </div>

  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards justify-content-center">
        <div class="col-md-6">
          <form action="{{ route('admin.announcements.update', $announcement->id) }}" class="card" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="previous_url" value="{{ getPreviousUrl(route('admin.announcements.index')) }}">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col">
                  <label class="form-label required">Untuk</label>
                  <select class="form-select @error('student_schedule_group_id') is-invalid @enderror"
                    name="student_schedule_group_id">
                    <option value="" disabled selected>Pilih</option>
                    @foreach ($schedule_groups as $group)
                      <option value="{{ $group->id }}"
                        {{ (old('student_schedule_group_id') ?? $announcement->student_schedule_group_id) == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('student_schedule_group_id')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-6">
                  <div class="form-label required">Tanggal Publikasi</div>
                  <div class="input-icon">
                    <span class="input-icon-addon">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="4" y="5" width="16" height="16" rx="2" />
                        <line x1="16" y1="3" x2="16" y2="7" />
                        <line x1="8" y1="3" x2="8" y2="7" />
                        <line x1="4" y1="11" x2="20" y2="11" />
                        <line x1="11" y1="15" x2="12" y2="15" />
                        <line x1="12" y1="15" x2="12" y2="18" />
                      </svg>
                    </span>
                    <input class="form-control @error('published_at') is-invalid @enderror" name="published_at"
                      placeholder="Tanggal jadwal" id="published-input" value="{{ old('published_at') ?? $announcement->published_at }}"
                      autocomplete="off">
                  </div>
                  @error('published_at')
                    <div class="text-danger fs-5 mt-1">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-6">
                  <div class="form-label required">Tanggal Kadaluarsa</div>
                  <div class="input-icon">
                    <span class="input-icon-addon">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="4" y="5" width="16" height="16" rx="2" />
                        <line x1="16" y1="3" x2="16" y2="7" />
                        <line x1="8" y1="3" x2="8" y2="7" />
                        <line x1="4" y1="11" x2="20" y2="11" />
                        <line x1="11" y1="15" x2="12" y2="15" />
                        <line x1="12" y1="15" x2="12" y2="18" />
                      </svg>
                    </span>
                    <input class="form-control @error('expired_at') is-invalid @enderror" name="expired_at"
                      placeholder="Tanggal jadwal" id="expired-input" value="{{ old('expired_at') ?? $announcement->expired_at }}"
                      autocomplete="off">
                  </div>
                  @error('expired_at')
                    <div class="text-danger fs-5 mt-1">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label class="form-label required">Konten</label>
                  <textarea class="form-control @error('content') is-invalid @enderror" name="content" placeholder="Konten pengumuman"
                    rows="3">{{ old('content') ?? $announcement->content }}</textarea>
                  @error('content')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label class="form-label required">Status</label>
                  <select class="form-select @error('is_active') is-invalid @enderror" name="is_active">
                    <option value="" disabled selected>Pilih</option>
                    <option value="1" {{ (old('is_active') ?? $announcement->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ (old('is_active') ?? $announcement->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                  </select>
                  @error('is_active')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="card-footer d-flex">
              <a href="{{ getPreviousUrl(route('admin.announcements.index')) }}" class="btn me-auto">Batal</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('library-js')
    <script src="{{ asset('plugins/tabler/dist/libs/litepicker/dist/litepicker.js?1669759017') }}"></script>
@endsection

@section('custom-js')
  <script>
    window.Litepicker && (new Litepicker({
      element: document.getElementById('published-input'),
      buttonText: {
        previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
      },
    }));
    window.Litepicker && (new Litepicker({
      element: document.getElementById('expired-input'),
      buttonText: {
        previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
      },
    }));
  </script>
@endsection
