@extends('member.layouts.main')
@section('title', 'Profile Details')
@section('container')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active" aria-current="page"><a href="#"
                                        style="text-decoration: none">Profile</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Profile</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="mb-3">
                                @if ($data['profile_image'] == null)
                                    <img src="{{ asset('uploads/avatar.jpg') }}"
                                        style="border-radius:50%; width:130px; height:130px">
                                @else
                                    <img src="{{ asset('uploads') }}/{{ $data['profile_image'] }}"
                                        style="border-radius:50%; width:130px; height:130px">
                                @endif
                            </div>
                            <div class="row">

                                <div class="table-responsive">
                                    <table class="table table-borderless table-sm caption-top">
                                        <tbody>
                                            <tr>
                                                <td><b>Business Id</b></td>
                                                <td id="main_musername">{{ $data['memberid'] }}</td>

                                            </tr>
                                            <tr>
                                                <td><b>Name</b></td>
                                                <td id="main_mname">{{ $data['name'] }}</td>

                                            </tr>
                                            <tr>
                                                <td><b>Email</b></td>
                                                <td id="main_memail">{{ $data['email'] }}
                                                </td>

                                            </tr>
                                            <tr>
                                                <td><b>Mobile Number</b></td>
                                                <td id="main_mmobile">{{ $data['mobile'] }}
                                                </td>

                                            </tr>
                                            <tr>
                                                <td><b>Account Status</b></td>
                                                <td id="main_maccount">{{ $data['status'] }}</td>

                                            </tr>

                                            <tr>
                                                <td><b>Sponsor Id</b></td>
                                                <td id="main_msponsorId">{{ $data['sponsorid'] }}</td>
                                            </tr>

                                            <tr>
                                                <td><b>Joining Date</b></td>
                                                <td id="main_mjoin">
                                                    {{ date('d-m-Y H:i:s', strtotime($data['created_at'])) }}
                                                </td>

                                            </tr>

                                            <tr>
                                                <td><b>State</b></td>
                                                <td id="main_mstate">{{ $data['state'] }}</td>

                                            </tr>

                                            <tr>
                                                <td><b>City</b></td>
                                                <td id="main_mcity">{{ $data['city'] }}</td>

                                            </tr>
                                            <tr>
                                                <td><b>Address</b></td>
                                                <td id="main_maddress">{{ $data['address'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                @if (session('failedMsg'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '{{ session('failedMsg') }}',
                            confirmButtonText: 'Ok'
                        });
                    </script>
                @endif
                @if (session()->has('successMsg'))
                    <div class="alert alert-success" role="alert">
                        {{ session('successMsg') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title my-2 mb-3"><b> Profile Update </b></h4>
                        <hr>
                        <div>
                            <form class="forms-sample" action="{{ route('insertProfile') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3 pt-2">
                                    <label for="exampleInputEmail2">Full Name</label>
                                    <div class="">
                                        <input type="text" class="form-control " name="name"
                                            placeholder="Enter Full Name" value="{{ $data['name'] }}">
                                    </div>
                                </div>
                                <div class="form-group mb-3 ">
                                    <label for="exampleInputConfirmPassword2">Email</label>
                                    <div class="">
                                        <input type="text" class="form-control" id="exampleInputEmail2"
                                            placeholder="Enter EmailId" name="email" value="{{ $data['email'] }}">
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 ">
                                    <label for="exampleInputEmail2">Mobile</label>
                                    <div class="">
                                        <input type="number" class="form-control " placeholder="Enter Mobile No."
                                            name="mobile" value="{{ $data['mobile'] }}">
                                        @error('mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3 ">
                                    <label for="exampleInputEmail2">State</label>
                                    <div class="">
                                        <select class="form-control @error('state') is-invalid @enderror" id="state"
                                            name="state">
                                            <option value="">{{ $data['state'] == NULL ? 'Select State' : $data['state'] }}</option>
                                            @foreach ($idata as $state)
                                                <option value="{{ $state->state_name }}"
                                                    {{ old('state') == $state->state_name ? 'selected' : '' }}>
                                                    {{ $state->state_name }}
                                                </option>
                                            @endforeach
                                            @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group mb-3 ">
                                    <label for="exampleInputEmail2">City</label>
                                    <div class="">
                                     <input type="text" class="form-control" id="city" placeholder="Enter City"
                                            name="city" value="{{ $data['city'] }}">
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3 ">
                                    <label for="exampleInputEmail2">Full Address</label>
                                    <div class="">
                                        <input type="text" class="form-control " placeholder="Enter Full Address"
                                            name="address" value="{{ $data['address'] }}">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-3 ">
                                    <label for="exampleInputConfirmPassword2">Profile Image</label>
                                    <div class="">
                                        <input type="file" class="form-control " name="image">
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="{{ $data['id'] }}">
                                <button type="submit" class="btn btn-primary me-2 float-end">Update
                                    Details</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const stateSelect = document.getElementById('state');
            const citySelect = document.getElementById('city');
            if (!stateSelect || !citySelect) return;

            const defaultOption = citySelect.querySelector('option[value=""]');
            const allCityOptions = Array.from(citySelect.querySelectorAll('option')).filter(option => option.value !== '');
            const oldCity = @json(old('city'));
            let isInitialLoad = true;

            function normalize(value) {
                return (value || '').toString().trim().toLowerCase();
            }

            function refreshCityOptions() {
                const selectedState = normalize(stateSelect.value);
                citySelect.innerHTML = '';

                const firstOption = defaultOption.cloneNode(true);
                citySelect.appendChild(firstOption);

                allCityOptions.forEach(option => {
                    const cityState = normalize(option.dataset.state);

                    if (!selectedState || !cityState || cityState === selectedState) {
                        citySelect.appendChild(option.cloneNode(true));
                    }
                });

                citySelect.disabled = !selectedState;

                if (isInitialLoad && oldCity) {
                    const matchedOld = Array.from(citySelect.options).find(option => option.value === oldCity);
                    if (matchedOld) {
                        citySelect.value = oldCity;
                    }
                }

                isInitialLoad = false;
            }

            stateSelect.addEventListener('change', function() {
                citySelect.value = '';
                refreshCityOptions();
            });

            refreshCityOptions();
        })();
    </script>
@endsection
