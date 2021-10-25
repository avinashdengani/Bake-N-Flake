<footer class="p-0 pt-5 mt-5" style="background: #2F2E2E">
    <div class="container">
        <div class="d-flex flex-column ">
            <div class="d-flex flex-row justify-content-between section-divider">
                <div class="about-us p-0">
                    <div class="footer-logo">
                        <h4>
                            <a class="my-navbar-brand text-white" href="{{ url('/') }}">
                                <img src="{{ asset('images/logo/logo.jpg') }}" alt="company-logo" width="40px" height="52px" class="m-0 p-0"> BAKE N FLAKE
                            </a>
                        </h4>
                    </div>
                    <p class="font-italic text-white">
                        Bake N Flake is known as bakery unique for our square cupcakes and cakes. We take pride in using natural ingredients in our cupcakes, pastries and cakes. Our treats are as deliciously wholesome as they are beautifully decorated. Choose from our signature cupcakes, weekly and holiday specials or custom created pastries.
                    </p>
                </div>
                <div class="contact-us">
                    <div class="number">
                        <i class="fa fa-phone m-1 fa-lg text-white"></i>
                        <strong class="text-white">Phone</strong>
                        <div class="mob">
                            <a href="tel:+913855118245" class="d-block nav-link  p-0 text-white">+91 3855118245</a>
                            <a href="tel:+913854814003" class="d-block nav-link  p-0 text-white">+91 3854814003</a>
                        </div>
                    </div>
                    <div class="email">
                        <i class="fa fa-envelope m-1 fa-lg text-white" ></i>
                        <strong class="text-white">Email</strong>
                        <div class="email d-block ">
                            <a href="mailto:enquiry@bakenflake.com" class="d-block nav-link  p-0 text-white">enquiry@bakenflake.com</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-between pt-3 pb-3">
                <div class="copyright">
                    <strong class="text-white">&copy; {{ now()->year }} Bake N Flake. All rights reserved.</strong>
                </div>
                <div class="social-links d-flex">
                    <ul class="d-flex">
                        <li class="pl-2 pr-2"><a href="https://www.facebook.com/" class="text-white"><i class="bi bi-facebook" ></i></a></li>
                        <li class="pl-2 pr-2"><a href="https://www.instagram.com/" class="text-white"><i class="bi bi-instagram" ></i></a></li>
                        <li class="pl-2 pr-2"><a href="https://twitter.com/" class="text-white"><i class="bi bi-twitter" ></i></a></li>
                        <li class="pl-2 pr-2"><a href="https://www.linkedin.com/signup" class="text-white"><i class="bi bi-linkedin" ></i></a></li>
                      </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
