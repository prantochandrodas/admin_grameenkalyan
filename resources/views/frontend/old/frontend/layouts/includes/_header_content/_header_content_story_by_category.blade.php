<div class="header-content">
            <div class="header-tagline d-flex align-items-center justify-content-center">
                <div class="header-leaf-left">
                    <img src="/assets/green-leaf-left.svg" alt="">
                </div>
                <div class="header-tagline-content">
                    <h1 class="health-h1" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">{{$activeCat->name??''}}</h1>
                    <!-- <h1 class="health-h2" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">Our Top Priority</h1> -->
                </div>
            </div>
            <!-- blog-header-image -->
            <div class="blog-header-image" style="background-image: url('{{$activeCat->banner_image??''}}');background-repeat: no-repeat;background-position: center;background-size: cover;"></div>
        </div>
