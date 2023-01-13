@extends('user.layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
                    <span class="breadcrumb-item active">Contact</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact
                Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    @if (session('successMsg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('successMsg') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form name="sentMessage" novalidate="novalidate" method="POST"
                        action="{{ route('contact#sendMessage') }}">
                        @csrf
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" placeholder="Your Name"
                                name="customerName" required="required" value="{{ old('customerName') }}"
                                data-toggle="tooltip" title="{{ Auth::user()->name }}" />

                            <p class="help-block text-danger">
                                @error('customerName')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" placeholder="Your Email"
                                name="customerEmail" required="required" value="{{ old('customerEmail') }}"
                                data-toggle="tooltip" title="{{ Auth::user()->email }}" />
                            <p class="help-block text-danger">
                                @error('customerEmail')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="8" id="message" required="required" placeholder="Message"
                                name="customerMessage">{{ old('customerMessage') }}</textarea>
                            <p class="help-block text-danger">
                                @error('customerMessage')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d488799.4874355668!2d95.90137732281359!3d16.838952489748195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1949e223e196b%3A0x56fbd271f8080bb4!2sYangon!5e0!3m2!1sen!2smm!4v1673580864310!5m2!1sen!2smm"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, Yangon, Myanmar</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>admin@gmail.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
