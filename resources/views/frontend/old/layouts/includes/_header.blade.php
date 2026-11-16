<!-- header and navigation -->
<header class="header-section">
        <div class="navigation-container">
            <div class="logo-container">
                <a href="/"><img src="/assets/kalyan-logo.png" alt="kalyan-logo" class="header-logo"></a>
                <img src="/assets/navbar-icon.svg" alt="kalyan-menu" class="navigation-icon">
                <img src="/assets/navigation-cross.svg" alt="kalyan-menu" class="navigation-cross">
            </div>
            @php
            $headerContent='frontend.layouts.includes._header_content._header_content_'. $activeLink;
            @endphp
            <!-- navigation menu -->
            <div class="navigation-menu">
                <a href="/">home</a>
                <a href="/about">about us</a>
                <a href="/service">services</a>
                <a href="/healthcare">healthcare</a>           
                <div class="dropdown-container nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">People</a>
                    <div class="dropdown-menu">
                        <div class="corporate"><a href="/corporate">corporate</a></div>
                        <div class="health-force"><a href="/health-force">health force</a></div>
                        <div class="join-us"><a href="/join-us">join us</a></div>
                    </div>
                </div>
                <a href="/story">stories</a>
                <a href="/locator">Locator</a>
                @if($activeLink !='home')
                <a href="#"><img src="./assets/glory.svg" alt=""></a>
                @endif

            </div>
        </div>
        @include($headerContent)
    </header>
