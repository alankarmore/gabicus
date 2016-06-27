@extends('layouts.main')
@section('title', 'Contact Us')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/inner.css')}}" />
    <div id="inner-header">
        <div class="container">
            <div class="col-md-12 top-header">
                <div class="logo-menu">
                    <div class="logo pull-left wow fadeInDown animated" data-wow-delay=".2s">
                        <h1 class="ui-title-page">Services</h1>
                    </div>
                        @include('partials.searchmenu')
                    </div>
                    @include('partials.sidebar')
<!-- navigation End -->
            </div>
            <!-- </div>-->
        </div>
    </div>
    <!-- Header Section End -->
    <div class="section-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="wrap-breadcrumb clearfix">
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="icon">&#xf015;</i></a></li>
                            <li class="active">Services</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <main class="main-content">
                    <section class="about rtd">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <h4>Software Development</h4>
                                    <br />
                                    <p>Our teams of software programmers are not only adept at developing software but have an intrinsic understanding of business processes and how to tailor software to deliver solutions the way they are needed. We have full development facilities, testing and deployment capabilities across various platforms. We can develop software using .NET, Java, C++, VB, PHP at one level and even work on PeopleSoft, SAP and enterprise level solutions at another. If you have older software based on Delphi or PowerBuilder we have the capabilities to help migrate and upgrade that in line with current web enablement processes in a finely architectured and integrated package.
</p><br />

                                    <h4>Maintenance</h4><br />
                                    <p>With the passage of time, business needs evolve and we provide continuing maintenance support for all software, helping fine tune software apps to be current and useful the way they are intended to be. Over time databases can become huge and unmanageable and are prone to corruption. Our fine tuned maintenance services ensure your software always runs lean and mean and fast, safeguard your data and keep security features current. 
</p>

                                    <h4>Tech Support
</h4><br />
                                    <p>In spite of the best efforts and thorough testing, issues may crop up during use and while running a software package under actual field conditions. We have a full tech support team, well versed in delivering solutions fast and competently so that you never experience any problems and there is never any downtime affecting your business operations. Our tech support is available 24x7 on phone, through email or online and you will find our tech support staff courteous, friendly and importantly, knowledgeable in being able to help you resolve your issues. 
</p>
                                    <p>With the passage of time, business needs evolve and we provide continuing maintenance support for all software, helping fine tune software apps to be current and useful the way they are intended to be. Over time databases can become huge and unmanageable and are prone to corruption. Our fine tuned maintenance services ensure your software always runs lean and mean and fast, safeguard your data and keep security features current. 
</p><br />
                                    <h4>Outsourcing</h4><br />
                                    <h4>Applicaton Outsourcing</h4>
                                    <br />
                                    <p>With full infrastructure facilities in terms of manpower, hardware and a focus on engineering solutions to meet specific business objectives at a far lower cost, we are the perfect technology partners. We have specialist teams of highly qualified, experienced and expert professionals in virtually all sectors of IT technologies and back it up with timely services and full support throughout the application lifecycle, solving complex problems and increasing each client’s competitiveness in a tough business environment. 
</p><br />
                                    <h4>Business Process Outsourcing
</h4><br />
                                    <p>With local manpower availability issues and high costs on the one hand and a very competitive business environment on the other hand, it makes sound business sense to cut down costs and one very effective way is through outsourcing of common business processes like HR, payroll , accounting and CRM. We have fully qualified and trained staff, well versed with each country specific process. Besides assuring services at very competitive rates, we assure timely completion and above all total data security in each business process for confidentiality in an atmosphere of trust. We offer full support, interaction and communications, working in close cooperation and consultation with each client to deliver outstanding outsourcing services for all business processes. 
</p><br />
                                    <h4>Resource Outsourcing</h4>
                                    <br />
                                    <p>One of the best things to come along, for those hit by intense competition, pressure to reduce costs and prices and make cuts across the board, is resource outsourcing facilities. Our resource outsourcing services gives clients decided advantages like better control at lower costs without the headache of managing resources and keeping them current. We offer extreme flexibility within budgets, dedicated teams made available depending on the level at which service is needed and other benefits depending on the model of resource outsourcing selected. When clients have designated goals then we follow a fixed cost model and when there are lots of changes anticipated in a project we offer the variable cost, time based model. Whatever the path, there is no doubt that resource outsourcing is a smart move that puts you ahead of the competition.  
</p><br />
                                    <h4>Training</h4>
                                    <p>Today’s software and app have reached a fine level of sophistication and one has to be a little bit more than familiar with computers to use custom developed software and applications. Though designed to be user friendly, still, any user would surely benefit by a few hours of hands on training in use of particular softwares and apps. We offer a variety of training programmes and support like IT Training for companies to give their staff handling IT operations specific, practical hands on training with adequate background theoretical support to increase their efficiency and productivity.  Our training is modular, designed to be easy to follow with less time at their disposal and easy to understand and follow. We give hands on training in our facilities, at client’s site and through distance, web based interface according to convenience. Training from us, whether it is IT, Corporate or software, empowers employees with a concentrated mix of what they want to know and should know in order to perform excellently at their jobs and deliver the best. 
</p>
                                </div>
                                
                                
                                
                                <!-- end col -->
                                
                            </div><!-- end row -->
                        </div><!-- end container -->
                    </section><!-- end about -->


        <!--            <div class="section-advantages_mod-a">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <ul class="advantages advantages_mod-c list-unstyled">
                                        <li class="advantages__item">
                                            <span class="advantages__icon decor decor_mod-a"><i class="icon">&#xf0c0;</i></span>
                                            <span class="advantages__title ui-title-inner">SKILLED FACULTY</span>
                                        </li>
                                        <li class="advantages__item">
                                            <span class="advantages__icon decor decor_mod-a"><i class="icon">&#xf091;</i></span>
                                            <span class="advantages__title ui-title-inner">HIGHest RATED</span>
                                        </li>
                                        <li class="advantages__item">
                                            <span class="advantages__icon decor decor_mod-a"><i class="icon">&#xf0ac;</i></span>
                                            <span class="advantages__title ui-title-inner">GLOBALLY RECOGNIZED</span>
                                        </li>
                                        <li class="advantages__item">
                                            <span class="advantages__icon decor decor_mod-a"><i class="icon">&#xf109;</i></span>
                                            <span class="advantages__title ui-title-inner">ONLINE TRAINING</span>
                                        </li>
                                    </ul>
                                </div><!-- end col -->
                            <!--</div>--><!-- end row -->
                        <!--</div><!-- end container -->
                    <!--</div>-->
        <!-- end section-advantages -->
                </main>
@endsection