@extends('layouts.user_type.auth')

@section('content')

<div class="row">
  <div class="col-lg-3 col-md-3 col-12 mt-4 mt-md-0">

    <div class="card mb-3" style="background-image: url('../../../assets/img/curved-images/white-curved.jpeg')">
      <span class="mask bg-gradient-dark opacity-9 border-radius-xl"></span>
      <div class="card-body p-3 position-relative">
        <div class="row">
          <div class="col-6 text-start">
            <div class="icon icon-shape bg-white shadow text-center border-radius-md">
              <i class="ni ni-active-40 text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
            </div>
            <h5 class="text-white font-weight-bolder mb-0 mt-3">
              30
            </h5>
            <span class="text-white text-sm">Quota Revision</span>
          </div>
          <div class="col-6">
            <div class="dropstart text-end mb-6">
              <a href="javascript:;" class="cursor-pointer" id="dropdownUsers2" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-ellipsis-h text-white"></i>
              </a>
              <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownUsers2">
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
              </ul>
            </div>
            <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">Buy Quota</p>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3" style="background-image: url('../../../assets/img/curved-images/white-curved.jpeg')">
      <span class="mask bg-gradient-dark opacity-9 border-radius-xl"></span>
      <div class="card-body p-3 position-relative">
        <div class="row">
          <div class="col-6 text-start">
            <div class="icon icon-shape bg-white shadow text-center border-radius-md">
              <i class="ni ni-time-alarm text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
            </div>
            <h5 class="text-white font-weight-bolder mb-0 mt-3">
              57:00
            </h5>
            <span class="text-white text-sm">Time Left</span>
          </div>
          <div class="col-6">
            <div class="dropstart text-end mb-6">
              <a href="javascript:;" class="cursor-pointer" id="dropdownUsers2" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-ellipsis-h text-white"></i>
              </a>
              <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownUsers2">
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
              </ul>
            </div>
            <!-- <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">Buy Quota</p> -->
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="col-lg-9 col-md-9 col-12 mt-4 mt-md-0">
    <div class="card blur shadow-blur max-height-vh-80">
      <div class="card-header shadow-lg">
        <div class="row">
          <div class="col-md-10">
            <div class="d-flex align-items-center">
              <img alt="Image" src="../../assets/img/team-2.jpg" class="avatar">
              <div class="ms-3">
                <h6 class="mb-0 d-block">Charlie Watson</h6>
                <span class="text-sm text-dark opacity-8">last seen today at 1:53am</span>
              </div>
            </div>
          </div>
          <div class="col-1 my-auto pe-0">
            <button class="btn btn-icon-only shadow-none text-dark mb-0 me-3 me-sm-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Video call">
              <i class="ni ni-camera-compact"></i>
            </button>
          </div>
          <div class="col-1 my-auto ps-0">
            <div class="dropdown">
              <button class="btn btn-icon-only shadow-none text-dark mb-0" type="button" data-bs-toggle="dropdown">
                <i class="ni ni-settings"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end me-sm-n2 p-2" aria-labelledby="chatmsg">
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    Profile
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    Mute conversation
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    Block
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    Clear chat
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <a class="dropdown-item border-radius-md text-danger" href="javascript:;">
                    Delete chat
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body overflow-auto overflow-x-hidden">

        <div class="row mt-4">
          <div class="col-md-12 text-center">
            <span class="badge text-dark">Wed, 3:27pm</span>
          </div>
        </div>

        <div id="message">
        </div>

      </div>
      <div class="card-footer d-block">
        <form id="form" class="align-items-center">
          <div class="d-flex">
            <div class="input-group">
              <input type="text" name="text" class="form-control" placeholder="Type here" aria-label="Message example input">
            </div>
            <button class="btn bg-gradient-primary mb-0 ms-2" name="send">
              <i class="ni ni-send"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
  Pusher.logToConsole = true;


  // Get chat from API
  const getChat = async () => {
    const response = await fetch('/message/get/{{ $room->room_id }}')
    const data = await response.json()

    // Print message
    let chatsHTML = ''

    data.map(r => {
      const dateString = r.created_at;
      const dateObject = new Date(dateString);

      // Format waktu dalam HH:mm
      const time = dateObject.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit'
      });

      // Format hari dalam singkatan tiga huruf
      const day = dateObject.toLocaleDateString('en-US', {
        weekday: 'short'
      });
      const formattedDate = `${time}` + `, ` + `${day}`;


      chatsHTML += `

          <div class="row  ${r.user_id == "{{ Auth::user()->id }}" ? 'justify-content-end text-right' : 'justify-content-start'} mb-4">
            <div class="col-auto">
              <div class="card ${r.user_id == "{{ Auth::user()->id }}" ? 'bg-gray-200' : ''}">
                <div class="card-body py-2 px-3">
                  <p class="mb-1">
                   ${r.message_content}<br>
                  </p>
                  <div class="d-flex align-items-center justify-content-end text-sm opacity-6">
                    <i class="ni ni-check-bold text-sm me-1"></i>
                    <small> ${formattedDate}</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          `
    })

    document.getElementById('message').innerHTML = chatsHTML
  }

  window.addEventListener('load', async (ev) => {
    await getChat()

    // Connect to pusher
    const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
      cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
    })

    // Connect to chat channel
    const channel = pusher.subscribe('chat-channel')

    // Listen for chat-send event
    channel.bind('chat-send', async (data) => {
      await getChat()
    })

    // Send message
    document.getElementById('form').addEventListener('submit', async (ev) => {

      ev.preventDefault()
      const message = document.querySelector('input[name="text"]')


      const response = await fetch('/message/send', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
          message: message.value,
          room: '{{ $room->room_id }}'
        })
      })

      const data = await response.json()

      if (data) {
        // Get chat
        await getChat()

        message.value = ''
      }
    })
  })
</script>

@endsection