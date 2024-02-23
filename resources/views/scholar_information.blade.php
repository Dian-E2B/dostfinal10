<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <link href="{{ asset('css/all.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #dddddd;

                /*  font-size: 12pt; */
            }

            .tdviewreq {
                padding-left: 15px !important;
            }
        </style>
    </head>

    <body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div class="wrapper">
            @include('layouts.sidebar')
            <div class="main">
                @include('layouts.header')
                {{--  @dd($seisourcerecord) --}}
                {{--  @dd($scholarrequirements) --}}
                <main class="main">
                    <div class="container-fluid p-2">
                        <div class="row">
                            <div class="col-5">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Student Profile</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title mb-0">{{ $seisourcerecord->lname }}, {{ $seisourcerecord->fname }}</h5>
                                        <div class="text-muted mb-2">[Status]</div>
                                    </div>
                                    <hr class="my-0" />
                                    <div class="card-body">
                                        <h3 class="bold" style="color: black; font-weight: 900">Requirements Uploaded</h3>
                                        <table width="100%">
                                            <tr>
                                                <td>Scholarship Agreement</td>
                                                <td class="tdviewreq">[view]</td>
                                            </tr>
                                            <tr>
                                                <td>Information Sheet</td>
                                                <td class="tdviewreq">[view]</td>
                                            </tr>
                                            <tr>
                                                <td>Scholar's Oath</td>
                                                <td class="tdviewreq">[view]</td>
                                            </tr>
                                            <tr>
                                                <td>Prospectus</td>
                                                <td class="tdviewreq">[view]</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <hr class="my-0" />
                                    <div class="card-body">

                                    </div>
                                    <hr class="my-0" />
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
    <script></script>

</html>
