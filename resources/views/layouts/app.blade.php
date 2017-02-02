<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wiki</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/plugins/tinymce/tinymce-lightgray.css">
    <link rel="stylesheet" href="/plugins/tinymce/editor.css">
    <link rel="stylesheet" href="/plugins/vakata-jstree/dist/themes/default/style.css" />
    <link rel="stylesheet" href="/plugins/jcrop/Jcrop.min.css">
    <script>
        var userSlug = "<?php if(Auth::user()) { echo Auth::user()->slug; } ?>";
    </script>
</head>
<body @if(isset($organization)) data-organization="{{ $organization->slug }}" @endif @if(isset($wiki)) data-wiki="{{ $wiki->slug }}" @endif>
    @include('layouts.partials.modals')
    <div style="min-height: 55px;">
        @include('layouts.partials.menu')
    </div>

    @if(Session::get('alert'))
        <div class="alert alert-{{Session::get('alert_type')}}" style="border-radius: 0; margin-bottom: 0px; margin-top: -2px; font-size: 13px;">
            <div class="container">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('alert') }}
            </div>
        </div>
    @endif

    <div class="main-body" id="page-content-wrapper">
        @yield('content')
    </div>

<script src="/js/jquery.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/plugins/tinymce/tinymce.min.js"></script>
<script src="/js/moment.min.js"></script>
<script src="/js/masonry.min.js"></script>
<script src="/js/js.cookie.js"></script>
<script src="/plugins/vakata-jstree/dist/jstree.min.js"></script>
<script src="/js/app.js"></script>
<script src="/plugins/jcrop/Jcrop.min.js"></script>
<script src="/plugins/highchart/highcharts.js"></script>
<script src="/plugins/highchart/data.js"></script>
<script src="/plugins/highchart/drilldown.js"></script>
<script src="/plugins/jquery-infinitescroll/jquery.infinitescroll.min.js"></script>
<script src="/js/laroute.js"></script>
<script src="/js/laravel-delete-req.js"></script>

{{-- <link rel="stylesheet" href="/plugins/sh/styles/shCoreDefault.css">
<script src="/plugins/sh/scripts/shCore.js"></script>
<script src="/plugins/sh/scripts/shLegacy.js"></script>
<script src="/plugins/sh/scripts/shAutoloader.js"></script>
<script src="/plugins/sh/scripts/shBrushXml.js"></script>
<script src="/plugins/sh/scripts/shBrushPhp.js"></script>
<script src="/plugins/sh/scripts/shBrushAppleScript.js"></script>
<script src="/plugins/sh/scripts/shBrushAS3.js"></script>
<script src="/plugins/sh/scripts/shBrushBash.js"></script>
<script src="/plugins/sh/scripts/shBrushColdFusion.js"></script>
<script src="/plugins/sh/scripts/shBrushCpp.js"></script>
<script src="/plugins/sh/scripts/shBrushCSharp.js"></script>
<script src="/plugins/sh/scripts/shBrushCss.js"></script>
<script src="/plugins/sh/scripts/shBrushDelphi.js"></script>
<script src="/plugins/sh/scripts/shBrushDiff.js"></script>
<script src="/plugins/sh/scripts/shBrushGroovy.js"></script>
<script src="/plugins/sh/scripts/shBrushJava.js"></script>
<script src="/plugins/sh/scripts/shBrushJavaFX.js"></script>
<script src="/plugins/sh/scripts/shBrushJScript.js"></script>
<script src="/plugins/sh/scripts/shBrushPerl.js"></script>
<script src="/plugins/sh/scripts/shBrushPlain.js"></script>
<script src="/plugins/sh/scripts/shBrushPowerShell.js"></script>
<script src="/plugins/sh/scripts/shBrushPython.js"></script>
<script src="/plugins/sh/scripts/shBrushRuby.js"></script>
<script src="/plugins/sh/scripts/shBrushSass.js"></script>
<script src="/plugins/sh/scripts/shBrushScala.js"></script>
<script src="/plugins/sh/scripts/shBrushSql.js"></script>
<script src="/plugins/sh/scripts/shBrushVb.js"></script>
<script src="/plugins/sh/scripts/shBrushXml.js"></script> --}}

<script>
    // SyntaxHighlighter.defaults.toolbar = false;
    // SyntaxHighlighter.all();
    
    // HighChart
    $(function() {
        if($('#highchart-wikis').length > 0) {
            Highcharts.chart('highchart-wikis', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Most visited wikis <strong>Today</strong>'
                },
                subtitle: {
                    // text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        // text: 'Total percent market share'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}%'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                },

                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: [{
                        name: 'Microsoft Internet Explorer',
                        y: 56.33,
                        drilldown: 'Microsoft Internet Explorer'
                    }, {
                        name: 'Chrome',
                        y: 24.03,
                        drilldown: 'Chrome'
                    }, {
                        name: 'Firefox',
                        y: 10.38,
                        drilldown: 'Firefox'
                    }, {
                        name: 'Safari',
                        y: 4.77,
                        drilldown: 'Safari'
                    }, {
                        name: 'Opera',
                        y: 0.91,
                        drilldown: 'Opera'
                    }]
                }],
                drilldown: {
                    series: [{
                        name: 'Microsoft Internet Explorer',
                        id: 'Microsoft Internet Explorer',
                        data: [
                            [
                                'v11.0',
                                24.13
                            ],
                            [
                                'v8.0',
                                17.2
                            ],
                            [
                                'v9.0',
                                8.11
                            ],
                            [
                                'v10.0',
                                5.33
                            ],
                            [
                                'v6.0',
                                1.06
                            ],
                            [
                                'v7.0',
                                0.5
                            ]
                        ]
                    }, {
                        name: 'Chrome',
                        id: 'Chrome',
                        data: [
                            [
                                'v40.0',
                                5
                            ],
                            [
                                'v41.0',
                                4.32
                            ],
                            [
                                'v42.0',
                                3.68
                            ],
                            [
                                'v39.0',
                                2.96
                            ],
                            [
                                'v36.0',
                                2.53
                            ],
                            [
                                'v43.0',
                                1.45
                            ],
                            [
                                'v31.0',
                                1.24
                            ],
                            [
                                'v35.0',
                                0.85
                            ],
                            [
                                'v38.0',
                                0.6
                            ],
                            [
                                'v32.0',
                                0.55
                            ],
                            [
                                'v37.0',
                                0.38
                            ],
                            [
                                'v33.0',
                                0.19
                            ],
                            [
                                'v34.0',
                                0.14
                            ],
                            [
                                'v30.0',
                                0.14
                            ]
                        ]
                    }, {
                        name: 'Firefox',
                        id: 'Firefox',
                        data: [
                            [
                                'v35',
                                2.76
                            ],
                            [
                                'v36',
                                2.32
                            ],
                            [
                                'v37',
                                2.31
                            ],
                            [
                                'v34',
                                1.27
                            ],
                            [
                                'v38',
                                1.02
                            ],
                            [
                                'v31',
                                0.33
                            ],
                            [
                                'v33',
                                0.22
                            ],
                            [
                                'v32',
                                0.15
                            ]
                        ]
                    }, {
                        name: 'Safari',
                        id: 'Safari',
                        data: [
                            [
                                'v8.0',
                                2.56
                            ],
                            [
                                'v7.1',
                                0.77
                            ],
                            [
                                'v5.1',
                                0.42
                            ],
                            [
                                'v5.0',
                                0.3
                            ],
                            [
                                'v6.1',
                                0.29
                            ],
                            [
                                'v7.0',
                                0.26
                            ],
                            [
                                'v6.2',
                                0.17
                            ]
                        ]
                    }, {
                        name: 'Opera',
                        id: 'Opera',
                        data: [
                            [
                                'v12.x',
                                0.34
                            ],
                            [
                                'v28',
                                0.24
                            ],
                            [
                                'v27',
                                0.17
                            ],
                            [
                                'v29',
                                0.16
                            ]
                        ]
                    }]
                }
            }); 
        }  
    });
</script>
</body>
</html>