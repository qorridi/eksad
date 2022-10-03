<footer>
    <section class="py-5 bg-blue-eksad">
        <div class="container">
            <div class="row">
                <div class="col-md-5 text-center text-md-start">
                    <p class="txt-body2 text-white">Leave your contact info and</p>
                    <p class="txt-body1 text-white font-rubik-bold">Let’s Discuss Business</p>
                    <p class="txt-body4 text-white">We’ll contact you immediately to discuss<br/> potential business </p>
                </div>
                <div class="col-md-7 m-auto">
                    <span id="invalid-data" class="font-weight-bold" style="color:red;display:none;">Data ada yang salah</span>
                    <span id="invalid-submit" class="font-weight-bold" style="color:red;display:none;">Terjadi kendala</span>
                    <span id="success-subscribe" class="font-weight-bold" style="color:white;display:none;">Thank You for Subscribe</span>
{{--                    {{ Form::open(['class' => 'omnisend-subscribe-form', 'id' => 'subscription_form']) }}--}}
                    <div class="row">
                        <div class="col-md">
                            <div class="input-group ">
                                <input type="text" id="subscribe_name" class="form-control" placeholder="Fullname" aria-label="Recipient's username" aria-describedby="button-addon2">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="input-group ">
                                <input type="email" id="subscribe_email" class="form-control" placeholder="Email" aria-label="Recipient's email" aria-describedby="button-addon2">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <button class="btn btn-outline-danger-c w-100 py-2 br-10" type="button" id="subscribe_submit" onclick="submit('Footer')" style="height: 48px;">Send</button>
                            </div><br>
                            <button class=" process text-white subscribe_loading" style="display:none;">
                                <span>PROCESSING...</span>
                            </button>
                        </div>
                    </div>
{{--                    {{ Form::close() }}--}}
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-white" >
        <div class="container">
            <div class="row pb-5">
                <div class="col-md-3 pb-5 text-center text-md-start">
                    <img src="{{asset('images/eksad/logo-eksad.png')}}" style="width: 125px;" alt="">
                    <p class="txt-body3 pt-3 ">Your one stop IT Solution</p>
                    <div class="pt-5">
                        <a href="https://www.linkedin.com/company/pt-tiga-daya-digital-indonesia-triputra-group-eksad-technology" class="">
                            <img src="{{asset('images/eksad/linkedin.png')}}" style="width: 25px;" alt="">
                        </a>
                        <a href="https://twitter.com/eksadtechnology" class="px-3">
                            <img src="{{asset('images/eksad/twitter.jpg')}}" style="width: 25px;" alt="">
                        </a>
                        <a href="https://www.instagram.com/eksad_technology/">
                            <img src="{{asset('images/eksad/instagram.png')}}" style="width: 25px;" alt="">
                        </a>
                        <a href="https://youtube.com/eksad_technology" class="ps-3">
                            <img src="{{asset('images/eksad/youtube.png')}}" style="width: 25px;" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-2 text-dark txt-body3 pb-5 text-center text-md-start">
                    <p class="txt-body5 font-rubik-bold pb-3">Sitemap</p>
                    <a href="{{route('frontend.about')}}" class="text-dark txt-body3"><p class="pb-3 text-decoration-underline ellipsis-footer">About</p>
                    </a>
                    <a href="{{route('frontend.solutions')}}" class="text-dark txt-body3"><p class="pb-3 text-decoration-underline ellipsis-footer">Solutions</p>
                    </a>
                    <a href="{{route('frontend.portfolio')}}" class="text-dark txt-body3"><p class="pb-3 text-decoration-underline ellipsis-footer">Portfolio</p>
                    </a>
                    <a href="{{route('frontend.career')}}" class="text-dark txt-body3"><p class="pb-3 text-decoration-underline ellipsis-footer">Career</p>
                    </a>
                    <a href="{{route('frontend.blogs')}}" class="text-dark txt-body3"><p class="pb-3 text-decoration-underline ellipsis-footer">Blog</p>
                    </a>
                    <a href="{{route('frontend.contact_us')}}" class="text-dark txt-body3"><p class="pb-3 text-decoration-underline ellipsis-footer">Contact Us</p>
                    </a>
                </div>
                <div class="col-md-3 text-dark txt-body3 pb-5 text-center text-md-start">
                    <p class="txt-body5 font-rubik-bold pb-3">Solutions</p>
                    @foreach( $solutions as $category)
                    <a href="{{route('frontend.solutions')}}" class="text-dark txt-body3">
                        <p class="pb-3 text-decoration-underline ellipsis-footer">{{$category->name}}</p>
                    </a>
                    @endforeach
{{--                    <a href="{{route('frontend.solutions')}}" class="text-dark txt-body3"><p class="pb-3 text-decoration-underline">Cloud</p>--}}
{{--                    </a>--}}
{{--                    <a href="{{route('frontend.solutions')}}" class="text-dark txt-body3"><p class="pb-3 text-decoration-underline">IT Resource</p>--}}
{{--                    </a>--}}
                </div>
                <div class="col-md-4 text-dark pb-5">
                    <p class="txt-body5 font-rubik-bold pb-3 text-center text-md-start">Contact</p>
                    <div class="row pb-3">
                        <div class="col-1 px-1">
                            <img src="{{asset('images/eksad/icon-phone.png')}}" class="w-100"  alt="phone icon">
                        </div>
                        <div class="col">
                            <a href="tel:+622157958040" class="txt-body3 text-dark text-decoration-underline">(021) 5795 - 8040</a>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-1 px-1">
                            <img src="{{asset('images/eksad/icon-mail.png')}}" class="w-100"  alt="mail icon">
                        </div>
                        <div class="col">
                            <a href="mailto:info@eksad.com" class="txt-body3 text-dark text-decoration-underline">info@eksad.com</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1 px-1">
                            <img src="{{asset('images/eksad/icon-location.png')}}" class="w-100"  alt="location icon">
                        </div>
                        <div class="col">
                            <p class="txt-body3">PT. Tiga Daya Digital Indonesia The East<br/>
                                Tower 19th Floor Jl. Dr. Ide Anak Agung<br/>
                                Gde Agung Blok E3.2<br/>
                                Mega Kuningan, Jakarta Selatan 12950</p>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="row pb-3">--}}
{{--                <div class="col-12 text-center">--}}
{{--                    <a href="{{route('frontend.privacy')}}"> <span class="text-white text-decoration-underline">Privacy Policy</span></a>--}}

{{--                    <a href="{{route('frontend.term')}}"><span class="text-white mx-4 text-decoration-underline">Terms and Condition </span></a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row " style="border:1px solid lightgrey;width: auto"></div>
            <div class="row pt-5">
                <div class="col-md-12  text-center">
                    <p class="text-dark d-none d-md-block txt-body3">PT. Tiga Daya Digital Indonesia © 2018, All Rights Reserved</p>
                    <p class="text-dark d-block d-md-none txt-body3">PT. Tiga Daya Digital Indonesia © 2018,<br/> All Rights Reserved</p>
                </div>
            </div>
        </div>
    </section>

</footer>

<style>
    .process{
        background-color: transparent;
        border: none;
    }
    .ellipsis{
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis !important;

    }
</style>

<script>
    function submit(type){
        //e.preventDefault();
        if(type == 'Footer'){
            var name = $('#subscribe_name').val();
            var email = $('#subscribe_email').val();
        }
        else{
            var email = $('#subscribe_email_home').val();
        }

        $(".subscribe_submit").hide();
        $(".subscribe_loading").show();
        $('#invalid-data').hide();
        $('#invalid-data_home').hide();
        $('#invalid-submit').hide();
        $('#invalid-submit_home').hide();
        $("#success-subscribe").hide();
        $("#success-subscribe_home").hide();

        $.ajax({
            type: 'POST',
            url: '{{ route('frontend.subscribe.save') }}',
            datatype : "application/json",
            data: {
                '_token': '{{ csrf_token() }}',
                'name': name,
                'email': email
            }, // no need to stringify
            success: function (result) {
                console.log(result);
                console.log('masuk success');
                $(".subscribe_submit").show();
                $(".subscribe_loading").hide();
                if(result.success == "VALID"){
                    $('#subscribe_name').val("");
                    $('#subscribe_email').val("");
                    $('#subscribe_phone').val("");
                    $('#subscribe_email_home').val("");

                    if(type == 'Footer'){
                        $("#success-subscribe").show();
                    }
                    else{
                        $("#success-subscribe_home").show();
                    }
                }
                else if(result.success == "INVALID DATA"){
                    if(type == 'Footer'){
                        $('#invalid-data').show();
                    }
                    else{
                        $('#invalid-data_home').show();
                    }
                }
                else{
                    if(type == 'Footer'){
                        $('#invalid-submit').show();
                    }
                    else{
                        $('#invalid-submit_home').show();
                    }
                }
            },
            error: function (e){
                console.log(e);
            }
        });
    }
    // $('#subscribe_submit').on('click', function(e) {
    //
    // });
</script>

