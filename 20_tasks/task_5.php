<?php
$contacts = [
    [
         'image' => 'sunny',
         'name' => 'Sunny A.',
         'job' => '(UI/UX Expert)',
         'job2' =>' Lead Author',
         'twitter_link' => 'https://twitter.com/@myplaneticket',
         'twitter' => '@myplaneticket',
         'bost_link' => 'myorange',
         'bost_contact' => 'Contact Sunny'
    ],
    [
        'image' => 'josh',
        'name' => 'Jos K.',
        'job' => '(ASP.NET Developer)',
        'job2' =>'Partner &amp; Contributor',
        'twitter_link' => 'https://twitter.com/@atlantez',
        'twitter' => '@atlantez',
        'bost_link' => 'Walapa',
        'bost_contact' => 'Contact Jos'
    ],
    [
        'image' => 'jovanni',
        'name' => 'Jovanni Lo',
        'job' => '(PHP Developer)',
        'job2' =>'Partner &amp; Contributor',
        'twitter_link' => 'https://twitter.com/@lodev09',
        'twitter' => '@lodev09',
        'bost_link' => 'lodev09',
        'bost_contact' => 'Contact Jovanni'
    ],
    [
                               'image' => 'roberto',
                               'name' => 'Roberto R.',
                               'job' => '(Rails Developer)',
                               'job2' =>'Partner &amp; Contributor',
                               'twitter_link' => 'https://twitter.com/@sildur',
                               'twitter' => '@sildur',
                               'bost_link' => 'sildur',
                               'bost_contact' => 'Contact Roberto'
    ]
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>
            Подготовительные задания к курсу
        </title>
        <meta name="description" content="Chartist.html">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
        <link rel="stylesheet" media="screen, print" href="css/statistics/chartist/chartist.css">
        <link rel="stylesheet" media="screen, print" href="css/miscellaneous/lightgallery/lightgallery.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
    </head>
    <body class="mod-bg-1 mod-nav-link ">
        <main id="js-page-content" role="main" class="page-content">
            <div class="col-md-6">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Задание
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                           <div class="d-flex flex-wrap demo demo-h-spacing mt-3 mb-3">
                            <?php foreach ($contacts as $contact): ?>
                            <div class="rounded-pill bg-white shadow-sm p-2 border-faded mr-3 d-flex flex-row align-items-center justify-content-center flex-shrink-0">
                                <img src="img/demo/authors/<?php echo $contact['image'] ?>.png" alt="<?php echo $contact['name'] ?>" class="img-thumbnail img-responsive rounded-circle" style="width:5rem; height: 5rem;">
                                <div class="ml-2 mr-3">
                                    <h5 class="m-0">
                                        <?php echo $contact['name']; ?> <?php echo $contact['job']; ?>
                                        <small class="m-0 fw-300">
                                            <?php echo $contact['job2']; ?>
                                        </small>
                                    </h5>


                                    <a href="<?php echo $contact['twitter_link']; ?>" class="text-info fs-sm" target="_blank"><?php echo $contact['twitter']; ?></a>

                                    -
                                    <a href="https://wrapbootstrap.com/user/<?php echo $contact['bost_link']; ?>" class="text-info fs-sm" target="_blank" title="<?php echo $contact['bost_contact']; ?>"><i class="fal fa-envelope"></i></a>
                                </div>
                            </div>
                            <?php endforeach;?>





                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        

        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script>
            // default list filter
            initApp.listFilter($('#js_default_list'), $('#js_default_list_filter'));
            // custom response message
            initApp.listFilter($('#js-list-msg'), $('#js-list-msg-filter'));
        </script>
    </body>
</html>
