<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <link href="{{ asset('css/all.css') }}">

        <style>
            body[data-theme=light] .sidebar-item.active .sidebar-link:hover,
            body[data-theme=light] .sidebar-item.active>.sidebar-link {
                background: #48c4d361;
            }

            body[data-theme=light] .sidebar-item.active .sidebar-link:hover,
            body[data-theme=light] .sidebar-item.active>.sidebar-link {
                color: #0758cd;
            }

            .modal-header {
                display: flex;
                align-items: center;
                justify-content: flex-start;
            }
        </style>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">

        {{--  <p>Logged-in scholar_id: {{ auth()->user()->scholar_id }}</p> --}}
        @php
            $replyStatusId = \App\Models\Replyslips::where('scholar_id', auth()->user()->scholar_id)->value('replyslip_status_id');
        @endphp
        {{--    @dd($replyStatusId); --}}

        @if ($replyStatusId == 1 || $replyStatusId == 2)
            <!-- Modal -->
            <div class="wrapper">
                <div class="main">
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header d-flex align-items-center justify-content-start">
                                    <i style="font-size: 40px" class="fas fa-info-circle"></i>
                                    <h5 style="margin-top: 0.5rem; margin-left: 0.5rem; font-weight: 900; font-size: 1.5rem" class="" id="exampleModalLabel">
                                        @if ($replyStatusId == 1)
                                            Details Of Orientation
                                        @elseif ($replyStatusId == 2)
                                            Please Submit your requirements to the DOST office And wait for the confirmation to access the portal.
                                        @endif
                                    </h5>
                                </div>
                                @if ($replyStatusId == 1)
                                    <div class="modal-body">
                                        <span style="font-size: 1.1rem">
                                            @if ($replyStatusId == 2)
                                                Please Submit your requirements to the DOST office. And wait for the confirmation to access the portal.
                                            @endif
                                        </span>
                                        <br>
                                        <span style="font-size: 1.5rem">
                                            @php
                                                $emailcontent = DB::table('emailcontent')->first();
                                                $dateValue = $emailcontent->thisdate;
                                                $venueValue = $emailcontent->venue;
                                                $timeValue = $emailcontent->time;
                                            @endphp
                                            Venue : {{ $venueValue }}
                                            <br>
                                            Date : {{ $dateValue }}
                                            <br>
                                            Time : {{ $timeValue }}
                                        </span>
                                    </div>
                                @endif

                                <div class="modal-footer">
                                    @if ($replyStatusId == 1)
                                        <a href="{{ route('student.replyslipview') }}" class="btn btn-primary">Answer ReplySlip <i class="align-middle me-2" data-feather="edit-3"></i></a>
                                    @endif
                                    <a class="btn btn-light" href="{{ route('student.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="far fa-power-off"></i><span style="margin-left:8px;">Log out</span></a>
                                    <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="wrapper">
                @include('student.layoutsst.sidebar')
                <div class="main">
                    @include('student.layoutsst.header')
                    <div class="content" style="padding: 1.0rem 1.0rem 1.0rem;">
                        <main class="container-fluid p-0">

                            <label>
                                <input style="display: none;" value="{{ $scholarId }}">
                            </label>
                            @php
                                $scholarstatusid = DB::select('SELECT scholar_status_id FROM seis WHERE id = ?', [$scholarId]);
                            @endphp
                            @if ($scholarstatusid[0] === 3)
                            @endif
                            {{--  @dd($scholarstatusid[0]); --}}
                            @if (count($replyslips) > 0)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Reply Slip</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">We are thrilled to offer you the <strong>DOST-SEI S&T Undergraduate
                                                    Scholarship</strong> for the academic year <strong>{{ now()->year }}</strong>. As a
                                                scholarship recipient, we kindly request your prompt response by signing and returning this
                                                reply slip to confirm your acceptance of the award.</p>
                                            @if ($replyslipstatus != 1)
                                                <a href="{{ route('student.replyslipview') }}" class="btn btn-primary">View <i class="align-middle me-2" data-feather="eye"></i></a>
                                            @else
                                                <a href="{{ route('student.replyslipview') }}" class="btn btn-success">View <i class="align-middle me-2" data-feather="edit-3"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                            @endif

                        </main>
                    </div>
                </div>

            </div>
        @endif


    </body>
    <script src="{{ asset('js/all.js') }}"></script>

    {{-- CHECKBOXES DISABLING --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                backdrop: 'static',
                keyboard: false
            });
            myModal.show(); // This will show the modal immediately
        });
    </script>

</html>
