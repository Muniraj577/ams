@extends('layouts.admin.app')
@section('title', 'Artist')
@section('artist', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>All Artists</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title float-right">
                                <a href="{{route('admin.artist.create')}}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Artist
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="Artist" class="table table-responsive-xl">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>DOB</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>First Release Year</th>
                                    <th>No. of Albums Released</th>
                                    <th class="hidden">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($artists as $key => $artist)
                                    <tr>
                                        <td>{{++$id}}</td>
                                        <td>{{$artist->name}}</td>
                                        <td>{{getFormattedDate('Y-m-d',$artist->dob)}}</td>
                                        <td>{{App\Enum\GenderEnum::getLabel($artist->gender)}}</td>
                                        <td>{{$artist->address}}</td>
                                        <td>{{$artist->first_release_year}}</td>
                                        <td>{{$artist->no_of_albums_released}}</td>
                                        <td>
                                            <div class="d-inline-flex">
                                                <a href="{{ route('admin.artist.edit', $artist->id) }}"
                                                   class="edit btn btn-sm" title="Edit Artist">
                                                    <i class='fas fa-edit' style='color: blue;'></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                   onclick="deleteData('{{$artist->id}}', '{{ route('admin.artist.delete', $artist->id) }}')"
                                                   class="edit btn btn-sm" title="Delete Artist">
                                                    <i class='fas fa-trash' style='color: red;'></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $("#Artist").DataTable({
                "responsive": false,
                "autoWidth": false,
                "dom": 'lBfrtip',
                "buttons": [{
                    extend: 'collection',
                    text: "<i class='fa fa-ellipsis-v'></i>",
                    buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    },
                        {
                            extend: 'csv',

                            exportOptions: {
                                columns: 'th:not(:last-child)'
                            }
                        },
                        {
                            extend: 'excel',

                            exportOptions: {
                                columns: 'th:not(:last-child)'
                            }
                        },
                        {
                            extend: 'pdf',

                            exportOptions: {
                                columns: 'th:not(:last-child)'
                            }
                        },
                        {
                            extend: 'print',

                            exportOptions: {
                                columns: 'th:not(:last-child)'
                            },

                        },
                    ],

                },
                    {
                        extend: 'colvis',
                        columns: ':not(.hidden)'
                    }
                ],

                "language": {
                    "infoEmpty": "No entries to show",
                    "emptyTable": "No data available",
                    "zeroRecords": "No records to display",
                }
            });
            dataTablePosition();


            $("#artistImportModal").on("hidden.bs.modal", function (e) {
                e.preventDefault();
                $('.require').css('display', 'none');
                $("#importArtistForm")[0].reset();
            });
        });


        function importArtist(e) {
            e.preventDefault();
            $('.require').css('display', 'none');
            let url = $("#importArtistForm").attr("action");
            $.ajax({
                url: url,
                type: 'post',
                data: new FormData($("#importArtistForm")[0]),
                processData: false,
                contentType: false,

                beforeSend: function () {
                    setSubmittingAnimation('importArtist');
                },
                success: function (data) {
                    if (data.db_error) {
                        $(".alert-warning").css('display', 'block');
                        $(".db_error").html(data.db_error);
                    } else if (data.errors) {
                        var error_html = "";
                        $.each(data.errors, function (key, value) {
                            error_html = '<div>' + value + '</div>';
                            $('.' + key).css('display', 'block').html(error_html);
                        });
                    } else if (!data.errors && !data.db_error) {
                        toastr.success(data.msg);
                        $("#importArtistForm")[0].reset();
                        $("#artistImportModal").modal('hide');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }

                },
                complete: function () {
                    clearAnimatedInterval('importArtist', 'Save Changes');
                },
            })
        }


    </script>
@endsection
