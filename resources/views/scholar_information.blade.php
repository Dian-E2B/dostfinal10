<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <link href="{{ asset('css/all.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
        <style>
            body,
            html {
                background-color: #dddddd;
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
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
                {{-- @dd($seisourcerecord) --}}
                {{--   @dd($scholarrequirements) --}}
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
                                                <td class="tdviewreq"><a href="#" data-id="{{ $seisourcerecord->id }}" class="viewreqsholarship"><i class="fas fa-eye"></a></i></td>
                                            </tr>
                                            <tr>
                                                <td>Information Sheet</td>
                                                <td class="tdviewreq"><a href="#" data-id="{{ $seisourcerecord->id }}" class="viewreqinformation"><i class="fas fa-eye"></a></i></td>
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
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="viewRequirementsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-fullscreen-xxl-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div id="thisdiv"></div>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <iframe id="ifrm" frameborder="0" scrolling="no" height="100%" width="100%" type="application/pdf"></iframe>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //FOR SCHOLARSHIP ICON
            $(document).on('click', '.viewreqsholarship', function() {
                let modal = new bootstrap.Modal('#viewRequirementsModal');
                modal.show()
                var number = $(this).data('id');
                $('#viewRequirementsModal').on('hidden.bs.modal', function() {
                    console.log('Modal is hidden');
                    $('#viewRequirementsModal #thisdiv').empty();
                    $('#viewRequirementsModal #ifrm').attr('src', '');

                });
                $.ajax({
                    url: '{{ url('/requirements_view/') }}' + '/' + number,
                    method: 'GET',

                    success: function(data) {
                        /*    console.log(data); */
                        var filePath = '/' + data.scholarshipagreement;
                        $('#viewRequirementsModal #thisdiv').append('<h1 class="modal-title fs-5" id="exampleModalLabel">Scholarship Agreement</h1>');
                        $('#viewRequirementsModal #ifrm').attr('src', '{{ url('/') }}' + filePath);
                    },
                    error: function(error) {
                        console.error('Error fetching data for editing:', error);
                    }
                });
            });

            //FOR INFORMARTION
            $(document).on('click', '.viewreqsholarship', function() {
                let modal = new bootstrap.Modal('#viewRequirementsModal');
                modal.show()
                var number = $(this).data('id');
                $('#viewRequirementsModal').on('hidden.bs.modal', function() {
                    console.log('Modal is hidden');
                    $('#viewRequirementsModal #thisdiv').empty();
                    $('#viewRequirementsModal #ifrm').attr('src', '');

                });
                $.ajax({
                    url: '{{ url('/requirements_view/') }}' + '/' + number,
                    method: 'GET',

                    success: function(data) {
                        /*    console.log(data); */
                        var filePath = '/' + data.scholarshipagreement;
                        $('#viewRequirementsModal #thisdiv').append('<h1 class="modal-title fs-5" id="exampleModalLabel">Scholarship Agreement</h1>');
                        $('#viewRequirementsModal #ifrm').attr('src', '{{ url('/') }}' + filePath);
                    },
                    error: function(error) {
                        console.error('Error fetching data for editing:', error);
                    }
                });
            });
        });
    </script>

</html>
