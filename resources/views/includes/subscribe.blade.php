<div class="tp-cta__area mt-10" id="subscribe">
    <div class="tp-cta__bg wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".3s" data-background="assets/img/cta/cta-bg-3s.jpg">
        <div class="container">
            <div class="row align-items-center">
                <div class="tp-footer__list text-center mb-3">
                    <ul>
                        <li><a  style="color:#1d1c1c; font-size:20px; font-weight:500">Subscribe</a></li>
                    </ul>
                </div>

                
                <div class="container">
                    <form class="form" action="{{ route('subscribe') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col postbox__comment-input">
                            <input type="text" class="form-control mb-1 mr-3" placeholder="First Name" name="fName" required="" >
                        </div>
                        <div class="col postbox__comment-input" postbox__comment-input>
                            <input type="text" class="form-control mb-1 mr-3" placeholder="Last Name" name="lName">
                        </div>
                        <div class="col postbox__comment-input" postbox__comment-input>
                            <input type="email" class="form-control mb-1 mr-3" placeholder="Your Email" name="email" required="">
                            @error('email')
                                <div class="text-danger" style="color: #e74c3c;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <button class="tp-btn theme-2-bg wow tpfadeUp" type="submit">Subscribe</button>
                        </div>
                    </div>
                    
                    </form>
                    
                    
                    
                </div>
                
                
            </div>
        </div>
    </div>
</div>