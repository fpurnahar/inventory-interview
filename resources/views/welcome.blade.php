<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Inventory App</title>
</head>

<body>
    <div class="col-12">
        <div class="content m-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <ul>
                            {{ $error }}
                        </ul>
                    @endforeach
                </div>
            @endif
            <div class="content-fluid">
                <div class="card">
                    <div class="card-header">
                        <h5 class="float-left">Product</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                            data-target="#exampleModal">
                            Add New Product
                        </button>
                    </div>
                    <div class="card body">
                        <div class="form-group">
                            <input type="text" class="form-control mt-3" id="search" name="search"
                                placeholder="Search ...">
                        </div>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Jumlah Barang</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Acction</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama_barang }}</td>
                                        <td>{{ $row->kode_barang }}</td>
                                        <td>{{ $row->jumlah_barang }}</td>
                                        <td>{{ $row->tanggal }}</td>
                                        <td>
                                            <div class="button-gorup ">
                                                <form action="{{ route('delete', $row) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-sm btn-warning"
                                                        href="{{ route('edit', $row) }}">
                                                        Edit</a>
                                                    <button type="submit" class="btn btn-sm btn-danger" href="">
                                                        Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            <div class="pagination float-right">
                                {{ $product->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="{{ route('store') }}" method="POST">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" placeholder="Enter Name Product"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Kode Barang</label>
                            <input type="text" class="form-control" name="kode_barang" placeholder="Enter Kode Barang"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Jumblah Barang</label>
                            <input type="number" class="form-control" name="jumlah_barang"
                                placeholder="Enter Jumlah Barang" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" placeholder="Enter Tanggal" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $('#search').on('keyup', function() {

            $value = $(this).val();

            $.ajax({

                type: 'get',

                url: '{{ route('search') }}',

                data: {
                    'search': $value
                },

                success: function(data) {
                    // console.log(data);
                    var trHTML = '';

                    data.data.forEach(function(item, index) {
                        console.log(data);
                        index++;
                        trHTML +=
                            `<tr>
                            <td>` + index + `</td>
                            <td>` + item.nama_barang + `</td>
                            <td>` + item.kode_barang + `</td>
                            <td>` + item.jumlah_barang + `</td>
                            <td>` + item.tanggal_barang + `</td>
                            <td>
                                <form action="delete/` + item.id + `" method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <div class="btn-group btn-group-sm">
                                            <a href="edit/` + item.id + `"class="btn btn-sm btn-warning">
                                                Edit
                                            </a>
                                            <button type="submit" class="btn btn-danger"> Delete</button>
                                        </div>
                                </form>
                            </td>
                        </tr>`;

                    });

                    $('tbody').html(trHTML);

                }

            });
        })
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>


</body>

</html>
