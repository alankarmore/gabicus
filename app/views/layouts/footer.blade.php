<!-- Footer section Start -->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <div class="copyright wow fadeInUp animated" data-wow-delay=".8s">
                    <p><a href="{{route('about-us')}}" class="margin-right10">About us</a> | <a href="{{route('services')}}" class="margin-left10 margin-right10">Services</a> | <a href="{{route('contact-us')}}" class="margin-left10 margin-right10">Contact us</a></p>
                    <p>Copyright &copy; 2016 GABICUS | All rights reserved.</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class="scroll-top text-center wow fadeInUp animated" data-wow-delay=".6s">
                    <a href="#header"><i class="fa fa-chevron-circle-up fa-2x"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Footer section End -->
<!-- jQuery Load -->
<script src="{{asset('assets/js/jquery-2.1.1.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!-- WOW JS plugin for animation -->
<script src="{{asset('assets/js/wow.js')}}"></script>
<script src="{{asset('assets/js/menu.js')}}"></script> <!-- Resource jQuery -->
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-36251023-1']);
_gaq.push(['_setDomainName', 'jqueryscript.net']);
_gaq.push(['_trackPageview']);

(function () {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
})();

</script>
<!-- All JS plugin Triggers -->
<script src="{{asset('assets/js/main.js')}}"></script>
<!-- Smooth scroll -->
<script src="{{asset('assets/js/smooth-scroll.js')}}"></script>
<!--  -->
<script src="{{asset('assets/js/jasny-bootstrap.min.js')}}"></script>
<!-- Counterup -->
<script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
<!-- waypoints -->
<script src="{{asset('assets/js/waypoints.min.js')}}"></script>
<!-- circle progress -->
<script src="{{asset('assets/js/circle-progress.js')}}"></script>
<!-- owl carousel -->
<script src="{{asset('assets/js/owl.carousel.js')}}"></script>
<!-- lightbox -->
<script src="{{asset('assets/js/lightbox.min.js')}}"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="{{asset('assets/slick/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery.easy-autocomplete.min.js')}}"></script>
<script>
$(document).ready(function () {
    var res;
    $("#myModal").hide();
    $("#country").change(function () {
        var code = $(this).val();
        $("#phoneCode").html(code);
    });

    $('.responsive').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    $('.autoplay').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    $("#contactForm").submit(function (event) {
        var submitButton = $("#submit");
        event.preventDefault();
        $.ajax({
            url: '{{route("post-contact-us")}}',
            data: $(this).serialize(),
            dataType: "JSON",
            type: "POST",
            beforeSend: function () {
                $("#submit").html('sending.....');
            },
            success: function (msg) {
                res = msg;
            },
            complete: function () {
                if (res.success) {
                    $("#contactForm")[0].reset();
                    $(".errorMessage").html('');
                    $("#submit").html('<i class="fa fa-envelope-o"></i>Send');
                    alert(res.success);
                } else {
                    for (var key in res) {
                        $("#error-" + key).html(res[key]);
                    }
                }
                $("#submit").html('<i class="fa fa-envelope-o"></i>Send');
            }
        });
    });

    $("#queryForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: '{{route("post-query")}}',
            data: $(this).serialize(),
            dataType: "JSON",
            type: "POST",
            beforeSend: function () {
                $("#query-submit").html('submitting.....');
            },
            success: function (msg) {
                res = msg;
            },
            complete: function () {
                if (res.success) {
                    $("#queryForm")[0].reset();
                    $(".errorMessage").html('');
                    $("#query-submit").html('Submit');
                    alert(res.success);
                } else {
                    for (var key in res) {
                        $("#error-query-" + key).html(res[key]);
                    }
                }
                $("#submit").html('Submit');
            }
        });
    });

    var options = {
        url: function (phrase) {
            return '{{route("getcourses")}}';
        },
        getValue: function (element) {
            return element.text;
        },
        
        template: {
            type: "links",
            fields: {
                link: "link"
            }
        },        
        ajaxSettings: {
            dataType: "json",
            method: "POST",
            data: {
                dataType: "json"
            }
        },
        preparePostData: function (data) {
            data.phrase = $("#search-courses").val();
            return data;
        },
        requestDelay: 400
    };

    $("#search-courses").easyAutocomplete(options);
});
</script>