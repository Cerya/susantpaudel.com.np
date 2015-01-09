<?php include ('analyticstracking.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <script async src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if IE]>
                <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
        <![endif]-->


        <meta name="description" content="The official QM Torrents | QM website. Here you will be able to browse and download all QM rip movies in excellent DVD, 720p, 1080p and 3D quality, all at the smallest file size." />
        <meta name="keywords" content="torrents, movies, movie, download, 720p, 1080p, 3D, browse movies" />

        <meta property="og:title" content="Quality Movie - Home"/>
        <meta property="og:image" content="http://susantpaudel.com.np/img/qm_logo.png"/>
        <meta property="og:description" content="The official QM Torrents | QM website. Here you will be able to browse and download all QM rip movies in excellent DVD, 720p, 1080p and 3D quality, all at the smallest file size."/>
        <meta property="og:url" content="http://susantpaudel.com.np/" />


        <title>Quality Movie- Home</title>

        <!-- Bootstrap -->


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Yanone Kaffeesatz' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
        <link href="css/custom.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <?php include 'includes/header.php'; ?>
            <div class="row">
                <div id="seeds" class="col-sm-9 col-xs-12">
                    <?php
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'http://yts.re/api/list.json?quality=720p&limit=42&sort=seeds');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $data = curl_exec($ch);
                    $array = json_decode($data, true);
                    /* echo '<pre>';
                      print_r ($array);
                      echo '</pre>'; */

                    for ($i = 0; $i < 42; $i++) {
                        ?>
                        <div class="col-sm-6 col-xs-12" id="list">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="<?php echo $array['MovieList'][$i]['CoverImage']; ?>" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $array['MovieList'][$i]['MovieTitleClean']; ?></h4>


                                    <p class="text-danger"><span id="field">Year: </span><?php echo $array['MovieList'][$i]['MovieYear']; ?></p>

                                    <p class="text-danger"><span id="field">Size: </span><?php echo $array['MovieList'][$i]['Size']; ?></p>
                                    <p class="text-danger"><span id="field">Rating: </span><?php echo $array['MovieList'][$i]['MovieRating']; ?></p>

                                    <p class="text-danger"><span id="field">Quality: </span><?php echo $array['MovieList'][$i]['Quality']; ?></p>
                                    <p class="text-danger"><span id="field">Peers/Seeds: </span><?php echo $array['MovieList'][$i]['TorrentPeers'] . '/' . $array['MovieList'][$i]['TorrentSeeds']; ?></p>

                                    <!--                                    <a id="send" data-target="#info" data-toggle="mmodal" class="btn btn-success btn-sm">View Info</a>-->

                                    <a data-toggle="modal" id="infotrig" class="btn btn-success btn-success">View Info</a>

                                    
                                    <input id="value" type="hidden" data-id="<?php echo $array['MovieList'][$i]['MovieID']; ?>" />
                                    <a href="<?php echo $array['MovieList'][$i]['TorrentUrl']; ?>" class="btn btn-success btn-success">Download</a>
                                </div>
                            </div>
                        </div>
                        



                    <?php } ?>
                </div>
                <script>
                    $('#infotrig').click(function(){
                        var value = $('#value').attr('data-id');
                       $('#info').modal('toggle');
                       document.getElementById('id').innerHTML = value;
                    });
                </script>
                <div class="modal fade " id="info" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">



                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 id="modalLabel"></h4>
                            </div>
                            <div class="modal-body">
                                <p id="id"></p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal box start -->
                           <!--<script>
                                   document.getElementById("send").href;
                                   var idd = document.getElementById("send").getAttribute("href"); 
                                   document.write(idd);
                                   </script>-->




                <!--modal end -->

                <div  id="upcoming" class="col-sm-3 col-xs-12">
                    <h1 style="text-align:center" class="media-heading">Upcoming Movies</h1><hr/>

                    <?php
                    $url = 'http://yts.re/api/upcoming.json';

                    $ch1 = curl_init();
                    curl_setopt($ch1, CURLOPT_URL, $url);
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
                    $data1 = curl_exec($ch1);
                    $array1 = json_decode($data1, true);
                    //echo '<pre>';
                    //print_r ($array1);
                    //echo $array1['0']['MovieTitle'];
                    echo '</pre>';
                    for ($u = 0; $u < 22; $u++) {
                        ?>
                        <div class="col-sm-12 col-xs-12" style="padding:5px 0 5px 0; text-align:center">
                            <p><?php echo $array1[$u]['MovieTitle']; ?></p>
                            <a target="_blank" href="<?php echo $array1[$u]['ImdbLink']; ?>" ><img src="<?php echo $array1[$u]['MovieCover']; ?>" ></a>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <?php include 'includes/footer.php'; ?>
        </div>
        <script>
            var x = document.getElementById('seeds').offsetHeight;
            //alert(x);
            //$('#upcoming').css('height', x);

            alert(y);


        </script>
        <!-- scrolling start -->

        <!-- End Scrolling -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

        <!-- Include all compiled plugins (below), or include individual files as needed -->

        <script src="js/bootstrap.min.js"></script>
    </body>
</html>