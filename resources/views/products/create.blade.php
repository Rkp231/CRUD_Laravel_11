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
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg my-2">
                    <div class="card-header bg-dark">
                        <h4 class="text-white">Create Product</h4>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('products.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="mb-2">
                                <label for="name" class="form-label h5">Name</label>
                                <input type="text" value="{{ old('name') }}"
                                    class="@error('name')
                                    is-invalid
                                @enderror form-control form-control-lg"
                                    placeholder="Name" name="name" id="">
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="name" class="form-label h5">Sku</label>
                                <input type="text" value="{{ old('sku') }}"
                                    class="@error('sku')
                                    is-invalid
                                @enderror form-control form-control-lg"
                                    placeholder="Sku" name="sku" id="">
                                @error('sku')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="name" class="form-label h5">Price</label>
                                <input type="text" value="{{ old('price') }}"
                                    class="@error('price')
                                    is-invalid
                                @enderror
                                 form-control form-control-lg"
                                    placeholder="Price" name="price" id="">
                                @error('price')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="name" class="form-label h5">Description</label>
                                <textarea class="form-control form-control-lg" aceholder="Description" cols="30" name="description" id="">{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-2">
                                <label for="name" class="form-label h5">Image</label>
                                <input type="file" class="form-control form-control-lg" name="image"
                                    id="">
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
