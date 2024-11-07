@extends('dashboard.main')

@section('custom-css')
  <style>
    .btn-action-delete:hover {
      background-color: #f44336;
      color: white;
      transition: 0.3s;
    }

    .user-photo:hover {
      opacity: 0.8;
      transition: 0.3s;
      cursor: pointer;
    }
  </style>
@endsection

@section('content')
  {{-- Page Header --}}
  <div class="page-header d-print-none mt-2">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h3 class="page-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="icon icon-tabler icons-tabler-outline icon-tabler-history">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M12 8l0 4l2 2" />
              <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" />
            </svg>
            {{ $title }}
          </h3>
        </div>
      </div>
      <div class="row g-2 align-items-center">
        <div class="col-12 col-sm-8 col-md-6 col-xl-4 mt-3">
          <div class="input-icon" bis_skin_checked="1">
            <input type="text" value="" class="form-control form-control-rounded" placeholder="Search..."
              id="searchInput">
            <span class="input-icon-addon">
              <!-- Download SVG icon from http://tabler-icons.io/i/search -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                <path d="M21 21l-6 -6"></path>
              </svg>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="table-responsive">
              <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Saved At</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Language</th>
                    <th class="text-center">Option</th>
                  </tr>
                </thead>
                <tbody id="tableBody">
                  @foreach ($histories as $history)
                    <tr>
                      <td class="text-muted">{{ $loop->iteration }}</td>
                      <td class="text-muted">
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
                        {{ formatDate($history->created_at, 'd F Y H:i') }}
                      </td>
                      <td class="text-muted">
                        <span {{ add_title_tooltip($history->title, 30) }}>
                          {{ mb_strimwidth($history->title ?? '-', 0, 30, '...') }}
                        </span>
                      </td>
                      <td class="text-muted">
                        <span {{ add_title_tooltip($history->original_text ?? '-', 50) }}>
                          {{ mb_strimwidth($history->original_text ?? '-', 0, 50, '...') }}
                        </span>
                      </td>
                      <td class="text-muted">
                        <span {{ add_title_tooltip($history->language ?? '-', 30) }}>
                          {{ mb_strimwidth($history->language ?? '-', 0, 30, '...') }}
                        </span>
                      </td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <a class="btn btn-icon btn-pill bg-primary-lt"
                            href="{{ route('dashboard.histories.show', $history->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"
                              class="icon icon-tabler icons-tabler-outline icon-tabler-file-text">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                              <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                              <path d="M9 9l1 0" />
                              <path d="M9 13l6 0" />
                              <path d="M9 17l6 0" />
                            </svg>
                          </a>
                          <button class="btn btn-icon btn-pill bg-danger-lt ms-2"
                            data-action="{{ route('dashboard.histories.destroy', $history->id) }}" data-bs-toggle="modal"
                            data-bs-target="#modalDelete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24"
                              viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                              stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <line x1="4" y1="7" x2="20" y2="7" />
                              <line x1="10" y1="11" x2="10" y2="17" />
                              <line x1="14" y1="11" x2="14" y2="17" />
                              <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                              <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                          </button>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                  @if ($histories->isEmpty())
                    <tr class="text-center">
                      <td colspan="99">
                        <div class="empty bg-transparent" style="height: 500px;">
                          <div class="empty-img"><img src="{{ asset('img\error\undraw_quitting_time_dm8t.svg') }}"
                              height="128">
                          </div>
                          <p class="empty-title">History not found</p>
                          <p class="empty-subtitle text-muted">
                            Please try another keyword or filter to find the history you are looking for.
                          </p>
                        </div>
                      </td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal delete --}}
  <div class="modal modal-blur fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-danger"></div>
        <div class="modal-body text-center py-4">
          <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 9v2m0 4v.01" />
            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
          </svg>
          <h3>Are you sure?</h3>
          <div class="text-muted">This history will be permanently removed from the system.</div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                  Cancel
                </a></div>
              <div class="col">
                <form method="post" id="formDelete">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger w-100" id="btnDelete">
                    Yes, delete
                  </button>
                </form>
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
  <script>
    const modalDelete = document.getElementById('modalDelete');

    modalDelete.addEventListener('show.bs.modal', function(event) {
      formDelete.action = event.relatedTarget.dataset.action;
    });

    // Fungsi untuk membuat tabel karakter buruk (bad character table)
    function buildBadCharTable(pattern) {
      const badCharTable = new Array(256).fill(-1);
      for (let i = 0; i < pattern.length; i++) {
        badCharTable[pattern.charCodeAt(i)] = i;
      }
      return badCharTable;
    }

    // Fungsi Boyer-Moore untuk pencarian substring dalam teks
    function boyerMooreSearch(text, pattern) {
      text = text.toLowerCase();
      pattern = pattern.toLowerCase();
      const m = pattern.length;
      const n = text.length;

      if (m > n) {
        return false; // Jika pola lebih panjang dari teks, tidak mungkin ditemukan
      }

      const badCharTable = buildBadCharTable(pattern);
      let s = 0; // Posisi di mana pola akan digeser pada teks

      while (s <= (n - m)) {
        let j = m - 1;

        // Cocokkan pola dari kanan ke kiri
        while (j >= 0 && pattern[j] === text[s + j]) {
          j--;
        }

        // Jika pola cocok sepenuhnya
        if (j < 0) {
          return true; // Pola ditemukan, kembali true
        } else {
          // Geser pola sesuai tabel karakter buruk
          s += Math.max(1, j - badCharTable[text.charCodeAt(s + j)]);
        }
      }

      return false; // Pola tidak ditemukan
    }

    // Fungsi pencarian pada array of objects
    function searchInArrayOfObjects(arrayOfObj, pattern) {
      const results = [];

      arrayOfObj.forEach((obj, index) => {
        if (boyerMooreSearch(obj.title, pattern) || boyerMooreSearch(obj.original_text, pattern)) {
          results.push({
            index,
            ...obj
          });
        }
      });

      return results;
    }

    function add_title_tooltip(string, limit = 20) {
      if (string.length > limit) {
        return `data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="${string}"`;
      }
      return '';
    }

    function mb_strimwidth(string, start, width, trimmarker = '...') {
      if (string.length > width) {
        return string.substring(start, width) + trimmarker;
      }
      return string;
    }

    function formatDate(date) {
      return new Date(date).toLocaleDateString('en-GB', {
        day: '2-digit',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      }).replace(' at', '');
    }

    const histories = @json($histories);
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');

    searchInput.addEventListener('keyup', function() {
      console.log(this.value);

      const pattern = this.value.trim();
      const searchResults = searchInArrayOfObjects(histories, pattern);

      let html = '';
      searchResults.forEach((result, index) => {
        html += `
          <tr>
            <td class="text-muted">${index + 1}</td>
            <td class="text-muted">
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
              ${formatDate(result.created_at)}
            </td>
            <td class="text-muted">
              <span ${add_title_tooltip(result.title, 27)}>
                ${mb_strimwidth(result.title ?? '-', 0, 27, '...')}
              </span>
            </td>
            <td class="text-muted">
              <span ${add_title_tooltip(result.original_text, 47)}>
                ${mb_strimwidth(result.original_text ?? '-', 0, 47, '...')}
              </span>
            </td>
            <td class="text-muted">
              <span ${add_title_tooltip(result.language, 30)}>
                ${mb_strimwidth(result.language ?? '-', 0, 30, '...')}
              </span>
            </td>
            <td>
              <div class="d-flex justify-content-center">
                <a class="btn btn-icon btn-pill bg-primary-lt"
                  href="${getDetailUrl(result.id)}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-file-text">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                    <path d="M9 9l1 0" />
                    <path d="M9 13l6 0" />
                    <path d="M9 17l6 0" />
                  </svg>
                </a>
                <button class="btn btn-icon btn-pill bg-danger-lt ms-2"
                  data-action="${getDeleteUrl(result.id)}" data-bs-toggle="modal"
                  data-bs-target="#modalDelete">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="4" y1="7" x2="20" y2="7" />
                    <line x1="10" y1="11" x2="10" y2="17" />
                    <line x1="14" y1="11" x2="14" y2="17" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                  </svg>
                </button>
              </div>
            </td>
          </tr>
        `;
      });

      if (searchResults.length == 0) {
        html = `
          <tr class="text-center">
            <td colspan="99">
              <div class="empty bg-transparent" style="height: 500px;">
                <div class="empty-img"><img src="{{ asset('img/error/undraw_quitting_time_dm8t.svg') }}"
                    height="128">
                </div>
                <p class="empty-title">History not found</p>
                <p class="empty-subtitle text-muted">
                  Please try another keyword or filter to find the history you are looking for.
                </p>
              </div>
            </td>
          </tr>
        `;
      }

      tableBody.innerHTML = html;

      // Initialize tooltip
      $('[data-bs-toggle="tooltip"]').tooltip();

      // Initialize dropdown
      var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
      dropdownElementList.map(function(dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl);
      });

    });

    function getDeleteUrl(id) {
      return `{{ route('dashboard.histories.destroy', ':id') }}`.replace(':id', id);
    }

    function getDetailUrl(id) {
      return `{{ route('dashboard.histories.show', ':id') }}`.replace(':id', id);
    }
  </script>
@endsection
