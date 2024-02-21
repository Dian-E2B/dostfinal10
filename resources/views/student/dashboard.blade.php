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

        @if ($replyStatusId == 1)
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header d-flex align-items-center justify-content-start">
                            <i style="font-size: 40px" class="fas fa-info-circle"></i>
                            <h5 style="margin-top: 0.5rem; margin-left: 0.5rem; font-weight: 900; font-size: 1.5rem" class="" id="exampleModalLabel">
                                Details Of Orientation
                            </h5>
                        </div>
                        <div class="modal-body" style="font-size: 1.5rem">
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
                        </div>
                        <div class="modal-footer">
                            {{--   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                            <button type="button" class="btn btn-primary">Answer Reply Slip</button>
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
