<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="bg-dark py-1">
        <h3 class="text-white text-center"> Crud Operation</h3>
    </div>
    <div class="container">
        <div class="row justify-content-cnter mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.create') }}" class="btn btn-dark">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
                <div class="col-md-10 mt-4">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif

            <div class="col-md-6">
                <div class="card border-0 shadow-lg my-2">
                    <div class="card-header bg-dark">
                        <h4 class="text-white">Products</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>NAME</th>
                                <th>SKU</th>
                                <th>PRICE</th>
                                <th>CREATED AT</th>
                                <th>Action</th>
                            </tr>

                            @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if ($product->image != '')
                                                <img width='50'
                                                    src="{{ asset('upload/products/' . $product->image) }}"
                                                    alt="">
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->price }} </td>
                                        <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-dark">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-dark">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            @endif
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
