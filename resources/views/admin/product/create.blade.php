@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Tambah Buku')])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Tambah Buku') }}</h4>
                <p class="card-category">{{ __('Tambah buku pada form di bawah') }}</p>
            </div>
            <div style="padding : 40px;" class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div>
                                <label for="name" class="col-form-label">Judul Buku <span
                                        class="text-danger">*</span></label>
                                <input id="name" type="text" name="name" placeholder="Masukan Judul Buku"
                                    value="{{ old('name') }}" class="form-control">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div style="margin-top : 20px;">
                                <label for="name" class="col-form-label">ISBN Buku <span
                                        class="text-danger">*</span></label>
                                <input id="name" type="text" name="isbn" placeholder="Masukan ISBN Buku"
                                    value="{{ old('isbn') }}" class="form-control">
                                @error('isbn')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div style="margin-top : 20px;">
                                <label for="summary " class="col-form-label">Rangkuman Buku</label>
                                <input value="{{ old('summary') }}" id="summaryBook" type="hidden" name="summary">
                                <trix-editor input="summaryBook"></trix-editor>
                                @error('summary')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div style="margin-top : 20px;">
                                <label for="description" class="col-form-label">Deskripsi</label>
                                <input value="{{ old('description') }}" id="description" type="hidden"
                                    name="description">
                                <trix-editor input="description"></trix-editor>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div style="margin-top : 20px;">
                                <label for="category_id">Kategori <span class="text-danger">*</span></label>
                                <select name="category_id" id="cat_id" class="form-control">
                                    <option value="">-- Pilih Kategori Buku --</option>
                                    @foreach ($category as $key => $cat_data)
                                        <option value='{{ $cat_data->id }}'>{{ $cat_data->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div style="margin-top : 20px;">
                                <label for="price" class="col-form-label">Harga (Rp.) <span
                                        class="text-danger">*</span></label>
                                <input maxlength="6" id="price" type="number" name="price" placeholder="Enter price"
                                    value="{{ old('price') }}" class="form-control">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div style="margin-top : 20px;">
                                <label for="discount" class="col-form-label">Diskon (%) <span
                                        class="text-danger">*</span></label>
                                <input max="100" id="price" type="number" name="discount"
                                    placeholder="Enter Discount" value="{{ old('discount') }}" class="form-control">
                                @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div style="margin-top : 20px;">
                                <label for="publisher_id">Penerbit</label>
                                {{-- {{$publishers}} --}}

                                <select name="publisher_id" class="form-control">
                                    <option value="">-- Pilih Penerbit --</option>
                                    @foreach ($publishers as $publisher)
                                        <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                    @endforeach
                                </select>
                                @error('publisher_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div style="margin-top : 20px;">
                                <label for="writer_id">Penulis</label>
                                {{-- {{$publishers}} --}}

                                <select name="writer_id" class="form-control">
                                    <option value="">-- Pilih Penulis --</option>
                                    @foreach ($writers as $writer)
                                        <option value="{{ $writer->id }}">{{ $writer->name }}</option>
                                    @endforeach
                                </select>
                                @error('writer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div style="margin-top : 20px;">
                                <label for="stock">Jumlah <span class="text-danger">*</span></label>
                                <input id="quantity" type="number" name="stock" min="0"
                                    placeholder="Masukan Jumlah" value="{{ old('stock') }}" class="form-control">
                                @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div style="margin-top : 20px;">
                                <label for="inputPhoto" class="col-form-label">Photo <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input id="thumbnail" class="form-control" accept=".jpg" type="file"
                                        name="image" value="{{ old('image') }}">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div style="margin-top : 20px;">
                                <div>
                                    <label for="p1 " class="col-form-label">Preview Buku</label>
                                    <input value="{{ old('p1') }}" id="p1" type="hidden" name="p1">
                                    <trix-editor placeholder="Halaman 1" input="p1"></trix-editor>
                                    @error('p1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    
                                    <input value="{{ old('p2') }}" id="p2" type="hidden" name="p2">
                                    <trix-editor value="{{ old('p2') }}" placeholder="Halaman 2" input="p2"></trix-editor>
                                    @error('p2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    
                                    <input value="{{ old('p3') }}" id="p3" type="hidden" name="p3">
                                    <trix-editor placeholder="Halaman 3" input="p3"></trix-editor>
                                    @error('p3')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <input value="{{ old('p4') }}" id="p4" type="hidden" name="p4">
                                    <trix-editor placeholder="Halaman 4" input="p4"></trix-editor>
                                    @error('p4')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <input value="{{ old('p5') }}" id="p5" type="hidden" name="p5">
                                    <trix-editor placeholder="Halaman 5" input="p5"></trix-editor>
                                    @error('p5')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <input value="{{ old('p6') }}" id="p6" type="hidden" name="p6">
                                    <trix-editor placeholder="Halaman 6" input="p6"></trix-editor>
                                    @error('p6')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <input value="{{ old('p7') }}" id="p7" type="hidden" name="p7">
                                    <trix-editor placeholder="Halaman 7" input="p7"></trix-editor>
                                    @error('p7')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div style="margin-top : 20px;">
                                <label for="status" class="col-form-label">Status <span
                                        class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div style="margin-top : 20px;"mb-3">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endpush
