
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Async Popover Control Demo</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="boostrap.min.css">
    <link href="offcanvas.css" rel="stylesheet" />
    <link href="demo.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <![endif]-->
</head>
<body>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sample-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
          </div>
        <div class="collapse navbar-collapse navbar-right" id="bs-sample-navbar-collapse-1">
            
        </div>
    </div>
    <p />
    <div class="container body-content">
        <div class="row row-offcanvas row-offcanvas-right">
            <div class="col-xs-12 col-sm-9">
                <p class="pull-right visible-xs">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                </p>
                <form class="form-signin" role="form">
                    <br />
                    <h3 class="form-signin-heading">Go ahead and type something.</h3>
                    <br />
                    <div>
                        <label for="email-input">Email: </label>
                        <input id="email-input" type="email" class="form-control inline-me" placeholder="me@somplace.org" required autofocus><div id="email-help" class="btn btn-default btn-circle inline-me">?</div>
                        <div class="inline-me">(Hover)</div>
                    </div>
                    <div>
                        <label for="password-input">Password: </label>
                        <input id="password-input" type="password" class="form-control inline-me" placeholder="password" required><div id="password-help" class="btn btn-default btn-circle inline-me">?</div>
                        <div class="inline-me">(Click)</div>
                    </div>
                </form>
            </div>
            
        </div>

        <!--/span-->

        </>
        <!--/row-->
        
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap.min.js"></script>
    <script src="throttle-debounce-min.js"></script>
    <script src="extensions.js"></script>
    
    
    <script type="text/javascript">

        function resizeBodyContent() {

            var footerHeight = $("footer").outerHeight(true);
            var contentHeight = $(".row-offcanvas").outerHeight(true);
            var navBarHeight = $(".navbar").outerHeight(true);
            var totalContentHeight = (footerHeight + contentHeight + navBarHeight);

            // resize logic here ...
            //
        }

        function pad(value) {
            return value < 10 ? '0' + value : value;
        }

        function createGmtOffset(date) {

            var offsetToReturn = {
                offsetHours: 0,
                offsetMinutes: 0
            };

            var sign = (date.getTimezoneOffset() > 0) ? "-" : "+";
            var offset = Math.abs(date.getTimezoneOffset());
            var hours = pad(Math.floor(offset / 60));
            var minutes = pad(offset % 60);

            offsetToReturn.offsetHours = sign + hours;
            offsetToReturn.offsetMinutes = sign + minutes;

            return offsetToReturn;
        }

        $(document).ready(function () {

            $("#email-help").popoverasync({
                "placement": "right", "trigger": "hover", "title": "More Info", "html": true, "content": function (callback, extensionRef) {

                    var currentDate = new Date();
                    var gmtOffset = createGmtOffset(currentDate);

                    $.getJSON("http://mvc5kendoandsignalrdemo.apphb.com/Home/FetchDemoTooltipContent", { "entry": $("#email-input").val(), "gmtOffsetHours": gmtOffset.offsetHours, "gmtOffsetMinutes": gmtOffset.offsetMinutes }, function (fetchedData) {
                        callback(extensionRef, fetchedData);
                    });

                }
            });

            $("#password-help").popoverasync({
                "placement": "right", "trigger": "click", "title": "More Info", "html": true, "content": function (callback, extensionRef) {

                    var currentDate = new Date();
                    var gmtOffset = createGmtOffset(currentDate);

                    $.getJSON("http://mvc5kendoandsignalrdemo.apphb.com/Home/FetchDemoTooltipContent", { "entry": $("#password-input").val(), "gmtOffsetHours": gmtOffset.offsetHours, "gmtOffsetMinutes": gmtOffset.offsetMinutes }, function (fetchedData) {
                        callback(extensionRef, fetchedData);
                    });

                }
            });

            $('[data-toggle=offcanvas]').click(function () {
                $('.row-offcanvas').toggleClass('active');
            });

            $(window).resize($.throttle(300, resizeBodyContent));
            resizeBodyContent();
        });


    </script>
</body>
</html>
