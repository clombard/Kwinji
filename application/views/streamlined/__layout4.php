<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Streamlined - Contact Management/CRM Template</title>

<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/grid.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/messages.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />

<!--[if lt IE 8]>
<link rel="stylesheet" media="screen" href="css/ie.css" />
<![endif]-->

<!-- jquerytools -->
<script src="js/jquery.tools.min.js"></script>

<script type="text/javascript" src="js/global.js"></script>

<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/PIE.js"></script>
<script type="text/javascript" src="js/IE9.js"></script>
<script type="text/javascript" src="js/ie.js"></script>
<![endif]-->

</head>
<body class="has-promo">
    <div id="wrapper">
        <header>
            <div id="promo">
                <div class="container_8 clearfix">
                    <div class="grid_6">
                        <p class="clearfix">
                            <a href="#" class="close">Hide</a>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                    </div>
                    <div class="grid_2 ar">
                        <a href="#" class="button button-green">Buy Now!</a>
                        <a href="#" class="button button-blue">Learn More &raquo;</a>
                    </div>
                </div>
            </div>
            <div class="container_8 clearfix">
                <h1 class="grid_1"><a href="dashboard.html">Streamlined</a></h1>
                <nav class="grid_5">
                    <ul class="clearfix">
                        <li class="action">
                            <a href="#" class="has-popupballoon button button-blue"><span class="add"></span>New Contact</a>
                            <div class="popupballoon top">
                                <h3>Add new contact</h3>
                                First Name<br />
                                <input type="text" /><br />
                                Last Name<br />
                                <input type="text" /><br />
                                Company<br />
                                <input type="text" />
                                <hr />
                                <button class="button button-orange">Add contact</button>
                                <button class="button button-gray close">Cancel</button>
                            </div>
                        </li>
                        <li class="action">
                            <a href="#" class="has-popupballoon button button-blue"><span class="add"></span>New Task</a>
                            <div class="popupballoon top">
                                <h3>Add new task</h3>
                                <input type="text" /><br /><br />
                                When it's due?<br />
                                <input type="date" /><br />
                                What category?<br />
                                <select><option>None</option></select>
                                <hr />
                                <button class="button button-orange">Add task</button>
                                <button class="button button-gray close">Cancel</button>
                            </div>
                        </li>
                        <li class="active"><a href="dashboard.html">Dashboard</a></li>
                        <li><a href="profile.html">Profile</a></li>
                        <li class="fr"><a href="#">administrator<span class="arrow-down"></span></a>
                            <ul>
                                <li><a href="#">Account</a></li>
                                <li><a href="#">Users</a></li>
                                <li><a href="#">Groups</a></li>
                                <li><a href="#">Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <form class="grid_2">
                    <input class="full" type="text" placeholder="Search..." />
                </form>
            </div>
        </header>
        
        <section>
            <div class="container_8 clearfix">

                <!-- Sidebar -->

                <aside class="grid_1">

                    <nav class="global">
                        <ul class="clearfix">
                            <li><a class="nav-icon icon-house" href="dashboard.html">Overview</a></li>
                            <li><a class="nav-icon icon-time" href="activity.html">Latest Activity</a></li>
                            <li><a class="nav-icon icon-book" href="contacts.html"><span>2</span>Contacts</a></li>
                            <li><a class="nav-icon icon-tick" href="tasks.html"><span>1</span>Tasks</a></li>
                            <li><a class="nav-icon icon-note" href="notes.html">Notes</a></li>
                        </ul>
                    </nav>

                    <nav class="subnav recent">
                        <h4>Recent Contacts</h4>
                        <ul class="clearfix">
                            <li>
                                <a class="contact" href="profile.html"><h5>John Doe</h5><h6>Some Company LTD</h6></a>
                                <div class="tooltip left">
                                    <span class="avatar">
                                    </span>
                                    <h5>John Doe</h5>
                                    <h6>Some Company LTD</h6>
                                    <address>123 Some Street, LA</address>
                                </div>
                            </li>
                            <li>
                                <a class="contact" href="profile.html"><h5>Jane Roe</h5><h6>Other Company Inc.</h6></a>
                                <div class="tooltip left">
                                    <span class="avatar">
                                    </span>
                                    <h5>Jane Roe</h5>
                                    <h6>Other Company Inc.</h6>
                                    <address>456 Other Street, LA</address>
                                </div>
                            </li>
                        </ul>
                    </nav>

                    <nav class="subnav">
                        <h4>Style Templates</h4>
                        <ul class="clearfix">
                            <li class="active"><a href="layouts.html">Layouts</a></li>
                            <li><a href="styles.html">Styles</a></li>
                            <li><a href="forms.html">Forms</a></li>
                            <li><a href="tables.html">Tables</a></li>
                        </ul>
                    </nav>
                </aside>

                <!-- Sidebar End -->
                

                <!-- Main Section -->

                <section class="main-section grid_7">

                    <div class="main-content">
                        <header>
                            <ul class="action-buttons clearfix fr">
                                <li><a href="documentation/index.html" class="button button-gray no-text help" rel="#overlay">Help<span class="help"></span></a></li>
                            </ul>
                            <div class="view-switcher">
                                <h2>Promo Layout <a href="#">&darr;</a></h2>
                                <ul>
                                    <li><a href="layouts.html">Default Layout</a></li>
                                    <li><a href="layout2.html">Preview Pane</a></li>
                                    <li><a href="layout3.html">3 Columns</a></li>
                                    <li><a href="layout4.html">Promo Layout</a></li>
                                </ul>
                            </div>
                        </header>
                        <section class="container_6 clearfix">
                            <div class="grid_6">
                                <div class="message info ac">
                                    <h3>Get started: <a href="#">Add contacts to your account</a></h3>
                                    <p>Vestibulum ultrices vehicula leo ac tristique. Mauris id nisl nibh. Cras egestas vestibulum nisl, nec eleifend nunc pulvinar non.</p>
                                </div>
                            </div>

                            <hgroup class="grid_6 ac">
                                <h2>Sed magna enim, tempus eu rutrum ornare.</h2>
                                <h4>Donec suscipit fermentum turpis, a feugiat felis tincidunt eu</h4>
                            </hgroup>

                            <figure class="grid_2 ac">
                                <img src="images/asset1.jpg" />
                                <h3>Lorem Ipsum Dolor Sit Amet</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
                            </figure>
                            <figure class="grid_2 ac">
                                <img src="images/asset2.jpg" />
                                <h3>Lorem Ipsum Dolor Sit Amet</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
                            </figure>
                            <figure class="grid_2 ac">
                                <img src="images/asset3.jpg" />
                                <h3>Lorem Ipsum Dolor Sit Amet</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
                            </figure>

                            <div class="other-options grid_6">
                                <h3 class="other">Other things to do...</h3>
                                <ul>
                                    <li>
                                        <h4><a href="#">Lorem Ipsum Dolor Sit Amet</a></h4>
                                        <p>Nam sit amet massa at lorem molestie egestas.</p>
                                    </li>
                                    <li>
                                        <h4><a href="#">Lorem Ipsum Dolor Sit Amet</a></h4>
                                        <p>Nam sit amet massa at lorem molestie egestas.</p>
                                    </li>
                                    <li>
                                        <h4><a href="#">Lorem Ipsum Dolor Sit Amet</a></h4>
                                        <p>Nam sit amet massa at lorem molestie egestas.</p>
                                    </li>
                                </ul>
                            </div>
                        </section>
                    </div>

                </section>

                <!-- Main Section End -->

            </div>
            <div id="push"></div>
        </section>
    </div>
    
    <footer>
        <div id="footer-inner" class="container_8 clearfix">
            <div class="grid_8">
                <span class="fr"><a href="#">Documentation</a> | <a href="#">Feedback</a></span>Last account activity from 127.0.0.1 - <a href="#">Details</a> | &copy; 2010. All rights reserved. Theme design by VivantDesigns
            </div>
        </div>
    </footer>
</body>
</html>
