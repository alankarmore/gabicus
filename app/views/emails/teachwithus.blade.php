<html>
    <head>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gabicus India</title>
        <style>
            /* -------------------------------------
                GLOBAL
            ------------------------------------- */
            * {
                font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                font-size: 100%;
                line-height: 1.6em;
                margin: 0;
                padding: 0;
            }

            img {
                max-width: 600px;
                width: 100%;
            }

            body {
                -webkit-font-smoothing: antialiased;
                height: 100%;
                -webkit-text-size-adjust: none;
                width: 100% !important;
            }


            /* -------------------------------------
                ELEMENTS
            ------------------------------------- */
            a {
                color: #348eda;
            }

            .btn-primary {
                Margin-bottom: 10px;
                width: auto !important;
            }

            .btn-primary td {
                background-color: #348eda;
                border-radius: 25px;
                font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
                font-size: 14px;
                text-align: center;
                vertical-align: top;
            }

            .btn-primary td a {
                background-color: #348eda;
                border: solid 1px #348eda;
                border-radius: 25px;
                border-width: 10px 20px;
                display: inline-block;
                color: #ffffff;
                cursor: pointer;
                font-weight: bold;
                line-height: 2;
                text-decoration: none;
            }

            .last {
                margin-bottom: 0;
            }

            .first {
                margin-top: 0;
            }

            .padding {
                padding: 10px 0;
            }


            /* -------------------------------------
                BODY
            ------------------------------------- */
            table.body-wrap {
                padding: 20px;
                width: 100%;
            }

            table.body-wrap .container {
                border: 1px solid #f0f0f0;
            }


            /* -------------------------------------
                FOOTER
            ------------------------------------- */
            table.footer-wrap {
                clear: both !important;
                width: 100%;
            }

            .footer-wrap .container p {
                color: #666666;
                font-size: 12px;

            }

            table.footer-wrap a {
                color: #999999;
            }


            /* -------------------------------------
                TYPOGRAPHY
            ------------------------------------- */
            h1,
            h2,
            h3 {
                color: #111111;
                font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
                font-weight: 200;
                line-height: 1.2em;
                margin: 40px 0 10px;
            }

            h1 {
                font-size: 36px;
            }
            h2 {
                font-size: 28px;
            }
            h3 {
                font-size: 22px;
            }

            p,
            ul,
            ol {
                font-size: 14px;
                font-weight: normal;
                margin-bottom: 10px;
            }

            ul li,
            ol li {
                margin-left: 5px;
                list-style-position: inside;
            }

            /* ---------------------------------------------------
                RESPONSIVENESS
            ------------------------------------------------------ */

            /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
            .container {
                clear: both !important;
                display: block !important;
                Margin: 0 auto !important;
                max-width: 600px !important;
            }

            /* Set the padding on the td rather than the div for Outlook compatibility */
            .body-wrap .container {
                padding: 20px;
            }

            /* This should also be a block element, so that it will fill 100% of the .container */
            .content {
                display: block;
                margin: 0 auto;
                max-width: 100%;
            }

            /* Let's make sure tables in the content area are 100% wide */
            .content table {
                width: 100%;
            }
        </style>
    </head>
    <body bgcolor="#f6f6f6">
        <!-- body -->
        <table class="body-wrap" bgcolor="#f6f6f6">
            <tbody><tr>
                    <td></td>
                    <td class="container" bgcolor="#FFFFFF">
                        <!-- content -->
                        <div class="content">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>Hi there,</p>
                                            <p><b>{{ucwords($data['name'])}}</b> has trying to reach with us by filling teach with us form. He has posted following information</p>
                                            <p><b>User Email :</b> {{$data['email']}}</p>
                                            <p><b>Qualification :</b> {{ucfirst($data['qualification'])}}</p>
                                            <p><b>Contact Number:</b> {{$data['contact_number']}}</p>
                                            <p><b>IT Experience:</b> {{$data['itexperience']}}</p>
                                            <p><b>Training Course can conduct:</b> {{$data['training_courses']}}</p>
                                            <p><b>Location:</b> {{$data['location']}}</p>
                                            <p><b>Message:</b> {{$data['message']}}</p>
                                            <p><b>Resume:</b> <a href="{{route('file.download',array('file' => $data['fileName']))}}">Download Resume</a></p>
                                            <p>Thanks,</p>
                                            <p>Gabicus India Team.</p>
                                            <p><a href="http://www.gabicusindia.com">Gabicus India</a></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /content -->
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- /body -->
    </body>
</html>