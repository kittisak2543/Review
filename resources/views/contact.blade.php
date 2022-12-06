    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/contact_style.css">
@extends('layouts.master')


@section('content')
    
<section class="ftco-section" style="padding: 10em" >
    <div class="container ">
        @if (session("success"))
        <div class="alert alert-success"> <b> {{session('success')}} </b></div>
     @else
         @error('name')
         <div class="alert alert-danger"> <b> {{$message}} </b></div> 
         @enderror
         @error('email')
         <div class="alert alert-danger"> <b> {{$message}} </b></div> 
         @enderror
         @error('subject')
         <div class="alert alert-danger"> <b> {{$message}} </b></div> 
         @enderror
         @error('message')
         <div class="alert alert-danger"> <b> {{$message}} </b></div> 
         @enderror
     @endif
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="wrapper">
                    <div class="row no-gutters">
                        <div class="col-md-7 d-flex align-items-stretch">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Get in touch</h3>
                                <div id="form-message-warning" class="mb-4"></div> 
                          <div id="form-message-success" class="mb-4">
                        Your message was sent, thank you!
                          </div>
                                <form method="POST" id="{{route('Contact')}} " name="contactForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="message" class="form-control" id="message" cols="30" rows="7" placeholder="Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" value="Send Message" class="btn btn-primary">
                                                <div class="submitting"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 d-flex align-items-stretch">
                            <div class="info-wrap bg-primary w-100 p-lg-5 p-4">
                                <h3 class="mb-4 mt-md-4">Contact us</h3>
                        <div class="dbox w-100 d-flex align-items-start">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-map-marker"></span>
                            </div>
                            <div class="text pl-3">
                            <p><span>Address:</span> 9511 Angola Ct
                                Indianapolis IN 46268-1119
                                USA </p>
                          </div>
                      </div>
                        <div class="dbox w-100 d-flex align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-phone"></span>
                            </div>
                            <div class="text pl-3">
                            <p><span>Phone:</span> <a href="tel://0800757863">+ 080 075 7863</a></p>
                          </div>
                      </div>
                        <div class="dbox w-100 d-flex align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-paper-plane"></span>
                            </div>
                            <div class="text pl-3">
                            <p><span>Email:</span> <a href="mailto:review_movie@gmail.com">review_movie@gmail.com</a></p>
                          </div>
                      </div>
                        
                  </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</section>
<!-- Product Section End -->

    
    
  
@endsection




