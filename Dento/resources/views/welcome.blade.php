<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dentosite - Kunzete</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets2/images/favicon.ico') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets2/style.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>
<style>
    * {
        scroll-behavior: smooth;
    }

    /* Add some basic styles to make the modal visible */
    .modal {
        display: none;
        /* Hide the modal by default */
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 99999999999999999999999999999999999999;
    }

    .modal.show {
        display: block;
        /* Show the modal when the 'show' class is added */
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
</style>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div id="content" style="display: none">
        @if (Session::has('success'))
        <script>
            alert("{{ Session::get('success') }}");
        </script>
        @endif

        @if (Session::has('error'))
            <script>
                alert("{{ Session::get('error') }}");
            </script>
        @endif
        <nav class="nav1">
            <div class="info">
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-location-dot"></i><span class="spans">Sialkot,
                                Pakistan</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-solid fa-envelope"></i><span
                                class="spans">Info@gmail.com</span></a>
                    </li>
                </ul>
            </div>
            <div class="social">
                <ul>
                    <li>
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-google-plus-g"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="nav2">
            <div class="container">
                <a href="{{ route('index') }}"><img src="{{ asset('assets2/img/logo.png.webp') }}" alt="" />
                </a>
                <ul>
                    <li><a href="#" onclick="scrollToSection('home')">HOME</a></li>
                    <li><a href="#">PAGES</a></li>
                    <li><a href="#" onclick="scrollToSection('about')">ABOUT</a></li>
                    <li><a href="#" onclick="scrollToSection('service')">SERVICE</a></li>
                    <li><a href="#" onclick="scrollToSection('pricing')">PRICING</a></li>
                    <li><a href="#" onclick="scrollToSection('blog')">BLOG</a></li>
                    <li><a href="#" onclick="scrollToSection('contact')">CONTACT</a></li>
                    <li><a href="{{ route('account.login') }}">LOGIN</a></li>
                </ul>
                <a href="#" class="book">BOOKING NOW</a>
                <div class="hamburger" id="hamburger">
                    <div class="hamburger-lines"></div>
                    <div class="hamburger-lines"></div>
                    <div class="hamburger-lines"></div>
                </div>
            </div>
        </nav>
        <aside class="menu" id="menu">
            <i class="fa fa-xmark" id="close" style="font-size: 32px; font-weight: 0"></i>
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="#">PAGES</a></li>
                <li><a href="#">ABOUT</a></li>
                <li><a href="#">SERVICE</a></li>
                <li><a href="#">PRICING</a></li>
                <li><a href="#">BLOG</a></li>
                <li><a href="#">CONTACT</a></li>
                <li><a href="{{ route('account.login') }}">LOGIN</a></li>
            </ul>
        </aside>
        <main>
            <div class="carousel" id="home">
                <div class="intro-container">
                    <div class="welcome">
                        <h2>
                            We Believe Everyone Should Have Easy Access To Great Dental Care
                        </h2>
                        <p>
                            As a leading industry innovator, Dento is opening up exciting
                            new opportunities for dental professionals, investors, employees
                            & suppliers. Contact us to find out what we have to offer you
                        </p>
                        <div class="welcome-btn">
                            <a href="{{route('account.register')}}">GET STARTED</a>
                            <a href="#">CONTACT US</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about" id="about">
                <div class="context">
                    <div class="about-image">
                        <img src="{{ asset('assets2/img/15.jpg') }}" alt="" />
                    </div>
                    <div class="about-text">
                        <div class="about-inner-text">
                            <div class="heading">
                                <h2>About Us</h2>
                                <div class="line"></div>
                            </div>
                            <p>
                                Vestibulum condimentum, risus sedones honcus rutrum, salah
                                lacus mollis zurna, nec finibusmi velit advertisis. Proin
                                vitae odin quis magna aliquet laciniae. Etiam auctor, nisi
                                vel. Pellentesque ultrices nisl quam iaculis, nec pulvinar
                                augue.
                            </p>
                            <div class="skill">
                                <span class="tip">
                                    <h4>Experience Dentist</h4>
                                    <h4>80%</h4>
                                </span>
                                <span class="fill1"></span>
                            </div>
                            <div class="skill">
                                <span class="tip">
                                    <h4>Modern Equipment</h4>
                                    <h4>65%</h4>
                                </span>
                                <span class="fill2"></span>
                            </div>
                            <div class="skill">
                                <span class="tip">
                                    <h4>Friendly Staff</h4>
                                    <h4>85%</h4>
                                </span>
                                <span class="fill3"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-line"></div>
            <div class="review">
                <div class="card">
                    <div class="inner-card">
                        <i class="fa-brands fa-react"></i>
                        <h2 class="animated-number" data-target="20">0</h2>
                        <h5>Years Of Experience</h5>
                    </div>
                    <div class="inner-card">
                        <i class="fa-regular fa-heart"></i>
                        <div style="display: flex; flex-direction: row">
                            <h2 class="animated-number" data-target="740">0</h2>
                            <h2>+</h2>
                        </div>
                        <h5>Happy Patients</h5>
                    </div>
                    <div class="inner-card">
                        <i class="fa fa-book"></i>
                        <h2 class="animated-number" data-target="120">0</h2>
                        <h5>Certificate</h5>
                    </div>
                    <div class="inner-card">
                        <i class="fa-regular fa-address-card"></i>
                        <h2 class="animated-number" data-target="{{ $count }}">0</h2>
                        <h5>Dentist</h5>
                    </div>
                </div>
            </div>
            <div class="carousel2" id="service">
                <div class="carousel2-content">
                    <div class="text">
                        <div class="heading">
                            <h2>Our Services</h2>
                            <div class="line"></div>
                        </div>
                        <div class="service">
                            <div class="card">
                                <img src="{{ asset('assets2/img/s1.png') }}" alt="" />
                                <p>Teeth Whitening</p>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets2/img/s2.png') }}" alt="" />
                                <p>Missing Teeth</p>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets2/img/s3.png') }}" alt="" />
                                <p>Teeth Whitening</p>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets2/img/s4.png') }}" alt="" />
                                <p>Cosmetic Dentistry</p>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets2/img/s5.png') }}" alt="" />
                                <p>Examination</p>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets2/img/s1.png') }}" alt="" />
                                <p>Teeth Pain</p>
                            </div>
                        </div>
                    </div>
                    <div class="video">
                        <img src="{{ asset('assets2/img/14.jpg') }}" alt="" />
                    </div>
                </div>
            </div>
            <div class="container3" id="pricing">
                <div class="head">
                    <h2>Pricing</h2>
                    <div class="line3"></div>
                </div>
                @if ($services)
                    <div class="table">
                        <table>
                            <tr>
                                <th>Service Names</th>
                                <th>Stage</th>
                                <th>Price</th>
                            </tr>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->stage }}</td>
                                    <td>{{ $service->price }} PKR</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @elseif($services->isEmpty())
                    <div class="table">
                        <table>
                            <tr>
                                <th>Service Names</th>
                                <th>Stage</th>
                                <th>Price</th>
                            </tr>
                            <tr>
                                <td>No Service At The Moment</td>
                                <td>-</td>
                                <td>-/-</td>
                            </tr>
                        </table>
                    </div>
                @endif
                <div class="end">
                    <div class="btn">
                        <a href="#">READ MORE >></a>
                    </div>
                </div>
            </div>
            <div class="container4" id="contact">
                <div class="container-inside">
                    <div class="heading">
                        <h2>Book An Apointment</h2>
                        <div class="line"></div>
                    </div>
                    <form method="POST" action="{{ route('create.appointment') }}" style="width: 100%;">
                        @csrf
                        <div class="grid">
                            <div class="col">
                                <input type="text" class="@error('name') is-invalid @enderror" name="name"
                                    placeholder="Your name" />
                                @error('name')
                                    <span
                                        style="color:#00AEEF; font-weight:500; font-family: Montserrat, Sans-serif; font-size:14px">Please
                                        enter your name *</span>
                                @enderror
                            </div>

                            <div class="col">
                                <input type="text" name="number" placeholder="Your number"
                                    class="@error('number') is-invalid @enderror" />
                                @error('number')
                                    <span
                                        style="color:#00AEEF; font-weight:500; font-family: Montserrat, Sans-serif; font-size:14px">Please
                                        enter your number *</span>
                                @enderror
                            </div>

                            <div class="col">
                                <input type="email" name="email" placeholder="Your email"
                                    class="@error('email') is-invalid @enderror" />
                                @error('email')
                                    <span
                                        style="color:#00AEEF; font-weight:500; font-family: Montserrat, Sans-serif; font-size:14px">Please
                                        enter your email *</span>
                                @enderror
                            </div>

                            <div class="col">
                                <input type="text" class="@error('address') is-invalid @enderror" name="address"
                                    placeholder="Your address" />
                                @error('address')
                                    <span
                                        style="color:#00AEEF; font-weight:500; font-family: Montserrat, Sans-serif; font-size:14px">Please
                                        enter your address *</span>
                                @enderror
                            </div>

                            <div class="col">
                                <select name="time" class="@error('time') is-invalid @enderror">
                                    <option disabled selected>Choose Your Schedule</option>
                                    <option value="9AM-10AM">9 AM to 10 AM</option>
                                    <option value="11AM-12PM">11 AM to 12 PM</option>
                                    <option value="2PM-4PM">2 PM to 4 PM</option>
                                    <option value="8PM-10PM">8 PM to 10 PM</option>
                                </select>
                                @error('time')
                                    <span
                                        style="color:#00AEEF; font-weight:500; font-family: Montserrat, Sans-serif; font-size:14px">Please
                                        select time *</span>
                                @enderror
                            </div>

                            <div class="col">
                                <select name="day" class="@error('day') is-invalid @enderror">
                                    <option disabled selected>Choose Your Schedule</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                </select>
                                @error('day')
                                    <span
                                        style="color:#00AEEF; font-weight:500; font-family: Montserrat, Sans-serif; font-size:14px">Please
                                        select day *</span>
                                @enderror
                            </div>
                        </div>
                        <div class="grid" style="display:flex; margin: 3% 0px;">
                            <div class="col">
                                <select name="doctor" style="width: 100%"
                                    class="@error('doctor') is-invalid @enderror">
                                    <option disabled selected>Choose Your Dentist</option>
                                    @foreach ($doctors as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                                @error('doctor')
                                    <span
                                        style="color:#00AEEF; font-weight:500; font-family: Montserrat, Sans-serif; font-size:14px">Not
                                        selecting a Dentist? Well who are you booking?</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg">
                            <textarea name="description" placeholder="Your Message"></textarea>
                        </div>
                        <button type="submit"
                            style="width:100%; margin: 2% 0px; padding: 1% 0px; background: #00AEEF; border:none; color:white; font-family: Montserrat; font-size:16px; font-weight: 600; cursor: pointer;">BOOKING
                            NOW</button>
                    </form>
                </div>
            </div>
            <div class="container5">
                <div class="container-inside">
                    <div class="heading">
                        <h2>Our Dentist</h2>
                        <div class="line"></div>
                    </div>
                    <div class="grid">
                        @foreach ($doctors as $d)
                            <div id="card" class="card">
                                @if (!$d->image)
                                    <img src="{{ asset('images/profile/1719328634.webp') }}" alt="Profile">
                                @else
                                    <img src="{{ asset('images/profile/' . $d->image) }}" alt="Profile">
                                @endif
                                <div class="info">
                                    <br>
                                    <h5>{{ $d->name }}</h5>
                                    <br>
                                </div>
                                <div id="social" class="socials">
                                    <i class="fa-brands fa-facebook-f"></i>
                                    <i class="fa-brands fa-twitter"></i>
                                    <i class="fa-brands fa-google-plus-g"></i>
                                </div>
                            </div>
                        @endforeach

                        {{-- <div class="card">
                            <img src="{{ asset('assets2/img/10.png.webp') }}" alt="" />
                            <div class="info">
                                <h5>Talha Shams</h5>
                                <p>Implant Expert</p>
                            </div>
                            <div class="socials">
                                <i class="fa-brands fa-facebook-f"></i>
                                <i class="fa-brands fa-twitter"></i>
                                <i class="fa-brands fa-google-plus-g"></i>
                            </div>
                        </div>
                        <div class="card">
                            <img src="{{ asset('assets2/img/11.png.webp') }}" alt="" />
                            <div class="info">
                                <h5>Taha Shams</h5>
                                <p>Implant Expert</p>
                            </div>
                            <div class="socials">
                                <i class="fa-brands fa-facebook-f"></i>
                                <i class="fa-brands fa-twitter"></i>
                                <i class="fa-brands fa-google-plus-g"></i>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="testimonal">
                <div class="testimonal-inside" id="scrollableDiv">
                    <div class="card">
                        <img src="{{ asset('assets2/img/8.jpg.webp') }}" alt="" />
                        <div class="testimonal-content">
                            <h5>
                                “I'd been avoiding the dentist for years due to bad
                                experiences. A reminder SMS is sent the working day
                                beforehand. I also had a call confirming appointment. I have
                                been a patient ever since. My dentist is very reassuring and
                                very helpful. Excellent treatment and advice.”
                            </h5>
                            <h6>Arron Ramsey</h6>
                            <p>Dental Patient</p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('assets2/img/8.jpg.webp') }}" alt="" />
                        <div class="testimonal-content">
                            <h5>
                                “I'd been avoiding the dentist for years due to bad
                                experiences. A reminder SMS is sent the working day
                                beforehand. I also had a call confirming appointment. I have
                                been a patient ever since. My dentist is very reassuring and
                                very helpful. Excellent treatment and advice.”
                            </h5>
                            <h6>Arron Ramsey</h6>
                            <p>Dental Patient</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog" id="blog">
                <div class="content">
                    <div class="heading">
                        <h2>The Latest News</h2>
                        <div class="line"></div>
                    </div>
                    <div class="grid">
                        <div class="card">
                            <img src="{{ asset('assets2/img/4.jpg.webp') }}" alt="" />
                            <a href="#">How your mouth bacteria can harm your lungs</a>
                            <p>
                                Donec tempor, lorem et euismod eleifend, est lectus laoreet
                                ante, sed accusan justo diam ...
                            </p>
                            <div class="others">
                                <a href="#"> <i class="fa fa-clock"></i> 28 Sep 2022 </a>
                                <a href="#"> <i class="fa fa-comments"></i> 3 Comments </a>
                            </div>
                        </div>
                        <div class="card">
                            <img src="{{ asset('assets2/img/5.jpg.webp') }}" alt="" />
                            <a href="#">How your mouth bacteria can harm your lungs</a>
                            <p>
                                Donec tempor, lorem et euismod eleifend, est lectus laoreet
                                ante, sed accusan justo diam ...
                            </p>
                            <div class="others">
                                <a href="#"> <i class="fa fa-clock"></i> 28 Sep 2022 </a>
                                <a href="#"> <i class="fa fa-comments"></i> 3 Comments </a>
                            </div>
                        </div>
                        <div class="card">
                            <img src="{{ asset('assets2/img/6.jpg.webp') }}" alt="" />
                            <a href="#">How your mouth bacteria can harm your lungs</a>
                            <p>
                                Donec tempor, lorem et euismod eleifend, est lectus laoreet
                                ante, sed accusan justo diam ...
                            </p>
                            <div class="others">
                                <a href="#"> <i class="fa fa-clock"></i> 28 Sep 2022 </a>
                                <a href="#"> <i class="fa fa-comments"></i> 3 Comments </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="card">
                <img src="{{ asset('assets2/img/logo.png.webp') }}" alt="" />
                <p>
                    Etiam sutor risus, dapibus act elefend katen, lacinia sitamet denim.
                    Mauris sagittis kansa interdum dignissim.
                </p>
                <p>
                    <i class="fa fa-location-dot"></i> 28 Jackson Street, Chicago,
                    7788569 USA
                </p>
                <p><i class="fa fa-phone"></i> +84. 2252. 2250. 122</p>
                <p><i class="fa fa-envelope"></i> info.dento@gmail.com</p>
            </div>
            <div class="card2">
                <h5>Opening Hours</h5>
                <ul>
                    <li><span>Mon-Wed</span><span>8.00-18.00</span></li>
                    <li><span>Thu-Fri</span><span>8.00-17.00</span></li>
                    <li><span>Sat</span><span>9.00-17.00</span></li>
                    <li><span>Sun</span><span>10.00-17.00</span></li>
                    <li><span>Holiday</span><span>Closed</span></li>
                </ul>
            </div>
            <div class="card3">
                <h5>Quick Link</h5>
                <ul>
                    <li>
                        <span><a href="#">About</a></span><span><a href="#">FAQ</a></span>
                    </li>
                    <li>
                        <span><a href="#">Contact</a></span><span><a href="#">Policy</a></span>
                    </li>
                    <li>
                        <span><a href="#">News</a></span><span><a href="#">Advisors</a></span>
                    </li>
                    <li>
                        <span><a href="#">Careers</a></span><span><a href="#">Dentist</a></span>
                    </li>
                    <li>
                        <span><a href="#">Services</a></span><span><a href="#">Legals</a></span>
                    </li>
                </ul>
            </div>
            <div class="card4">
                <h5>Newsletter</h5>
                <p>We will send out weekly newest article and some great offers</p>
                <br />
                <form action="#">
                    <input type="email" placeholder="Email Address" required />
                    <button type="submit">
                        <i class="fa-regular fa-paper-plane"></i>
                    </button>
                </form>
                <br />
                <div class="socials">
                    <a href="#" style="color: white; text-decoration: none; margin: 0px 10px;"> <i
                            class="fa-brands fa-facebook-f"></i> </a>
                    <a href="#" style="color: white; text-decoration: none; margin: 0px 10px;"><i
                            class="fa-brands fa-twitter"></i></a>
                    <a href="#" style="color: white; text-decoration: none; margin: 0px 10px;"><i
                            class="fa-brands fa-google-plus-g"></i></a>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('assets2/script.js') }}"></script>
    <script>
        function scrollToSection(sectionId) {
            var section = document.getElementById(sectionId);
            section.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    </script>
</body>

</html>
