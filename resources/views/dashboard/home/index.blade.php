@extends('dashboard.main')

@section('custom-css')
  <style>
    /* make it big */
    .result {
      font-size: 1.5rem;
      padding: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      min-height: 200px;
      overflow-y: auto;
    }
  </style>
@endsection

@section('content')
  {{-- Page Header --}}
  {{-- <div class="page-header d-print-none mt-2">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h3 class="page-title">
            {{ $title }}
          </h3>
        </div>
      </div>
    </div>
  </div> --}}

  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
        <div class="col-12">
          <div class="alert alert-info">
            <p>
              This is a simple speech to text converter. Click on the start listening button and start speaking. The text
              will be shown in the result box. You can also download the text by clicking on the download button.
            </p>
          </div>
          <div class="row mb-3">
            <div class="col-md-4 mb-2">
              <select class="form-select" id="language"></select>
            </div>
          </div>
          <div class="mb-3">
            <div class="result bg-light" spellcheck="false" placeholder="Text will be shown here" id="result">
              <p class="interim">
                @if (old('original_text'))
                  {{ old('original_text') }}
                @else
                  <span class="text-muted">
                    Text will be shown here
                  </span>
                @endif
              </p>
            </div>
          </div>
          {{-- button record --}}
          <div class="mb-3">
            <button class="btn btn-primary w-100 record" id="record">
              <span id="record-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="icon icon-tabler icons-tabler-outline icon-tabler-microphone">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M9 2m0 3a3 3 0 0 1 3 -3h0a3 3 0 0 1 3 3v5a3 3 0 0 1 -3 3h0a3 3 0 0 1 -3 -3z" />
                  <path d="M5 10a7 7 0 0 0 14 0" />
                  <path d="M8 21l8 0" />
                  <path d="M12 17l0 4" />
                </svg>
              </span>
              <span id="record-text">
                Start Listening
              </span>
            </button>
          </div>
          <div class="row">
            <div class="col-md-4 mb-2">
              <button class="btn btn-danger w-100" id="clear">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M4 7l16 0" />
                  <path d="M10 11l0 6" />
                  <path d="M14 11l0 6" />
                  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                </svg>
                Clear
              </button>
            </div>
            <div class="col-md-4 mb-2">
              <button class="btn btn-azure w-100" id="save" data-bs-toggle="modal" data-bs-target="#modalAdd" @if (old('original_text') == null) disabled @endif>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                  <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M14 4l0 4l-6 0l0 -4" />
                </svg>
                Save
              </button>
            </div>
            <div class="col-md-4 mb-2">
              <button class="btn btn-primary w-100" id="download" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                  <path d="M7 11l5 5l5 -5" />
                  <path d="M12 4l0 12" />
                </svg>
                Download
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal add --}}
  <div class="modal modal-blur fade" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Save to History</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('dashboard.histories.store') }}" method="post" enctype="multipart/form-data" id="formAdd">
          @csrf
          <input type="hidden" name="original_text" id="originalText" value="{{ old('original_text') }}">
          <input type="hidden" name="language" value="{{ old('language') }}" id="inputLanguage">
          <div class="modal-body">
            <div class="row mb-3">
              <div class="col">
                <label class="form-label required">Recording Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                  placeholder="Type the recording title here" value="{{ old('title') }}" required>
                @error('title')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="modal-footer pt-2" style="border-top: 1px solid #e9ecef;">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="btnSubmit">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M14 4l0 4l-6 0l0 -4" />
              </svg>
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('library-js')
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="{{ asset('js/languages.js') }}"></script>
@endsection

@section('custom-js')
  <script>
    const recordBtn = document.querySelector("#record"),
      result = document.querySelector("#result"),
      downloadBtn = document.querySelector("#download"),
      inputLanguage = document.querySelector("#language"),
      clearBtn = document.querySelector("#clear"),
      recordIcon = document.querySelector("#record-icon"),
      saveBtn = document.querySelector("#save"),
      modalAdd = document.querySelector("#modalAdd");

    let SpeechRecognition =
      window.SpeechRecognition || window.webkitSpeechRecognition,
      recognition,
      recording = false;

    function populateLanguages() {
      languages.forEach((lang) => {
        const option = document.createElement("option");
        option.value = lang.code;
        option.innerHTML = lang.name;
        inputLanguage.appendChild(option);
      });
    }

    populateLanguages();

    function speechToText() {
      try {
        recognition = new SpeechRecognition();
        recognition.lang = inputLanguage.value;
        recognition.interimResults = true;
        changeRecordButton();
        recognition.start();
        recognition.onresult = (event) => {
          const speechResult = event.results[0][0].transcript;
          //detect when intrim results
          if (event.results[0].isFinal) {
            result.innerHTML += " " + speechResult;
            result.querySelector("p").remove();
          } else {
            //creative p with class interim if not already there
            if (!document.querySelector(".interim")) {
              const interim = document.createElement("p");
              interim.classList.add("interim");
              result.appendChild(interim);
            }
            //update the interim p with the speech result
            document.querySelector(".interim").innerHTML = " " + speechResult;
          }
          downloadBtn.disabled = false;
          saveBtn.disabled = false;
        };
        recognition.onspeechend = () => {
          speechToText();
        };
        recognition.onerror = (event) => {
          console.log(event.error);

          if (event.error === "no-speech") {
            if (recording) {
              speechToText();
              changeRecordButton();
            } else {
              stopRecording();
            }
          } else if (event.error === "audio-capture") {
            changeRecordButton();
            alert(
              "No microphone was found. Ensure that a microphone is installed."
            );
            stopRecording();
          } else if (event.error === "not-allowed") {
            alert("Permission to use microphone is blocked.");
            stopRecording();
            changeRecordButton();
          } else if (event.error === "aborted") {
            if (recording) {
              speechToText();
              changeRecordButton();
            } else {
              stopRecording();
            }
          } else {
            alert("Error occurred in recognition: " + event.error);
            stopRecording();
            changeRecordButton();
          }
        };
      } catch (error) {
        recording = false;

        console.log(error);
      }
    }

    recordBtn.addEventListener("click", () => {
      if (!recording) {
        speechToText();
        recording = true;
        changeRecordButton();
      } else {
        stopRecording();
        changeRecordButton();
      }
    });

    function stopRecording() {
      recognition.stop();
      recording = false;
    }

    function download() {
      const text = result.innerText;
      const filename = "speech.txt";

      const element = document.createElement("a");
      element.setAttribute(
        "href",
        "data:text/plain;charset=utf-8," + encodeURIComponent(text)
      );
      element.setAttribute("download", filename);
      element.style.display = "none";
      document.body.appendChild(element);
      element.click();
      document.body.removeChild(element);
    }

    function changeRecordButton() {
      if (recording) {
        recordBtn.querySelector("#record-text").innerHTML = "Stop";
        recordBtn.classList.remove("btn-primary");
        recordBtn.classList.add("btn-danger");
        recordIcon.innerHTML =
          `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-player-pause">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M6 5m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v12a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
            <path d="M14 5m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v12a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
          </svg>`;
      } else {
        recordBtn.querySelector("#record-text").innerHTML = "Start Listening";
        recordBtn.classList.remove("btn-danger");
        recordBtn.classList.add("btn-primary");
        recordIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
									stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
									class="icon icon-tabler icons-tabler-outline icon-tabler-microphone">
									<path stroke="none" d="M0 0h24v24H0z" fill="none" />
									<path d="M9 2m0 3a3 3 0 0 1 3 -3h0a3 3 0 0 1 3 3v5a3 3 0 0 1 -3 3h0a3 3 0 0 1 -3 -3z" />
									<path d="M5 10a7 7 0 0 0 14 0" />
									<path d="M8 21l8 0" />
									<path d="M12 17l0 4" />
								</svg>`;
      }
    }

    downloadBtn.addEventListener("click", download);

    clearBtn.addEventListener("click", () => {
      result.innerHTML = `<p class="interim"><span class="text-muted">Text will be shown here</span></p>`;
      downloadBtn.disabled = true;
      saveBtn.disabled = true;
    });

    modalAdd.addEventListener("show.bs.modal", () => {
      stopRecording();
      changeRecordButton();
      const text = result.innerText;
      document.querySelector("#originalText").value = text;
      
      const language = findLanguageByCode(inputLanguage.value);
      document.querySelector("#inputLanguage").value = language.name;
    });

    $(document).ready(function() {
      @if ($errors->any())
        $('#modalAdd').modal('show');
      @endif
    });

    $('#btnSubmit').click(function() {
      $('#formAdd').submit();
    });

    function findLanguageByCode(code) {
      return languages.find((lang) => lang.code === code);
    }
  </script>
@endsection
