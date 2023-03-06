<?php
session_start();
  
  if(isset($_SESSION['client-username'])){
    $clientHasLoggedIn = true;
  }

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Serenidad Suites Online Reservation System</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">

    
    <style>
    .social-link {
      width: 30px;
      height: 30px;
      border: 1px solid #ddd;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #666;
      border-radius: 50%;
      transition: all 0.3s;
      font-size: 0.9rem;
    }

    .social-link:hover,
    .social-link:focus {
      background: #ddd;
      text-decoration: none;
      color: #555;
    }

    .faqHeader {
            font-size: 27px;
            margin: 20px;
        }

    .section_padding_130 {
        padding-top: 130px;
        padding-bottom: 130px;
    }
    .faq_area {
        position: relative;
        z-index: 1;
        /* background-color: #f5f5ff; */
    }

    .faq-accordian {
        position: relative;
        z-index: 1;
    }
    .faq-accordian .card {
        position: relative;
        z-index: 1;
        margin-bottom: 1.5rem;
    }
    .faq-accordian .card:last-child {
        margin-bottom: 0;
    }
    .faq-accordian .card .card-header {
        background-color: #ffffff;
        padding: 0;
        border-bottom-color: #ebebeb;
    }
    .faq-accordian .card .card-header h6 {
        cursor: pointer;
        padding: 1.75rem 2rem;
        color: #3f43fd;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -ms-grid-row-align: center;
        align-items: center;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }
    .faq-accordian .card .card-header h6 span {
        font-size: 1.5rem;
    }
    .faq-accordian .card .card-header h6.collapsed {
        color: #070a57;
    }
    .faq-accordian .card .card-header h6.collapsed span {
        -webkit-transform: rotate(-180deg);
        transform: rotate(-180deg);
    }
    .faq-accordian .card .card-body {
        padding: 1.75rem 2rem;
    }
    .faq-accordian .card .card-body p:last-child {
        margin-bottom: 0;
    }

    @media only screen and (max-width: 575px) {
        .support-button p {
            font-size: 14px;
        }
    }

    .support-button i {
        color: #3f43fd;
        font-size: 1.25rem;
    }
    @media only screen and (max-width: 575px) {
        .support-button i {
            font-size: 1rem;
        }
    }

    .support-button a {
        text-transform: capitalize;
        color: #365dcd;
    }
    @media only screen and (max-width: 575px) {
        .support-button a {
            font-size: 13px;
        }
    }

    .accordion-text{
        color: black;
    }

</style>
  </head>

  <body class="text-center">
    <div class="container marketing">
        <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
            <header class="masthead mb-auto">
                <div class="inner">
                <h3 class="masthead-brand">Serenidad Suites Online</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link" href="reservation.php">Rooms</a>
                    <a class="nav-link active" href="aboutUs.php">About Us</a>
                    
                  <?php 
                      if($clientHasLoggedIn){
                          echo '
                          <a class="nav-link" href="client-login.php">'.$_SESSION['client-username'].' </a>
                          ';
                      }else{
                          echo 
                          ' 
                          <a class="nav-link" href="client-login.php">Login</a>
                          ';
                      }
                  ?>
                </nav>
                </div>
            </header>
            <main role="main" class="inner cover">
                <div class="row mt-4">
                    <div class="row h-100 align-items-center py-5">
                    <div class="col-lg-6">
                        <h1 class="display-3">About us</h1>
                        <hr>
                        <h1 class="display-4">Serenidad Suites</h1>
                        <!-- <p class="lead text-muted mb-0">Create a minimal about us page using Bootstrap 4.</p>
                        <p class="lead text-muted">Snippet by <a href="https://bootstrapious.com/snippets" class="text-muted"> 
                                    <u>Bootstrapious</u></a> -->
                        </p>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block"><img src="assets/svg/online_calender.svg" alt="" class="img-fluid"></div>
                </div>
                    
                </div><!-- /.row -->

            </main>

          

            <footer class="mastfoot mt-auto">
              <div class="inner">
                <a href="https://www.facebook.com/ss.matabungkay.batangas" target="_blank" rel="noopener noreferrer">
                    <button type="submit"  class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Accept Reservation" >
                        <i data-feather="facebook"></i>
                    </button>
                </a>

                <a href="https://www.instagram.com/ss.matabungkay.batangas" target="_blank" rel="noopener noreferrer">
                    <button type="submit"  class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Accept Reservation" >
                        <i data-feather="instagram"></i>
                    </button>
                </a>
              </div>
          </footer>
        </div>

        <!-- Three columns of text below the carousel -->
       

        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">
        <div class="container">
                <div class="row justify-content-center">
                    <!-- FAQ Area-->
                    <div class="col-12 ">
                        <div class="accordion faq-accordian" id="faqAccordion">

                            <hr class="featurette-divider">

                            <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="card-header" id="headingOne">
                                    <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Where is Serenidad Suites Location?<span class="lni-chevron-up"></span></h6>
                                </div>
                                <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#faqAccordion">
                                    <div class="card-body">
                                    <p class="font-weight-bold accordion-text"> We are located @ Lian, Batangas, Calabarzon, Philippines</p>
                                    </div>
                                </div>
                            </div>

                            <hr class="featurette-divider">

                            <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="card-header" id="headingOne">
                                    <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">Can I cancel my reservation?<span class="lni-chevron-up"></span></h6>
                                </div>
                                <div class="collapse" id="collapse2" aria-labelledby="headingOne" data-parent="#faqAccordion">
                                    <div class="card-body">
                                    <p class="font-weight-bold accordion-text"> Cancellation: 3-4 days before check in </p>
                                    </div>
                                </div>
                            </div>

                            <hr class="featurette-divider">

                            <div class="card border-0 wow fadeInUp" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                <div class="card-header" id="headingTwo">
                                    <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">What this place offers?<span class="lni-chevron-up"></span></h6>
                                </div>
                                <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                                    <div class="card-body ">
                                        <ul >
                                          <li> <p class="font-weight-bold accordion-text">* Bedroom and laundry</p> </li>
                                          <li> <p class="font-weight-bold accordion-text">* Entertainment</p> </li>
                                          <li> <p class="font-weight-bold accordion-text">* Heating and cooling</p> </li>
                                          <li> <p class="font-weight-bold accordion-text">* Home safety</p> </li>
                                          <li> <p class="font-weight-bold accordion-text">* Kitchen and dining</p> </li>
                                          <li> <p class="font-weight-bold accordion-text">* Location features</p> </li>
                                          <li> <p class="font-weight-bold accordion-text">* Outdoor</p> </li>
                                          <li> <p class="font-weight-bold accordion-text">* Parking and facilities</p> </li>
                                          <li> <p class="font-weight-bold accordion-text">* Services</p> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <hr class="featurette-divider">

                            <div class="card border-0 wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                <div class="card-header" id="headingThree">
                                    <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">Things to know<span class="lni-chevron-up"></span></h6>
                                </div>
                                <div class="collapse" id="collapseThree" aria-labelledby="headingThree" data-parent="#faqAccordion">
                                    <div class="card-body row">
                                      <div class="col-6">
                                        <h1 class="display-5 accordion-text">House rules</h1>
                                        <ul>
                                          <li>
                                            <p class="font-weight-bold accordion-text">* Check-in: 3:00 PM - 6:00 PM</p>
                                          </li>
                                          <li>
                                            <p class="font-weight-bold accordion-text">* Checkout: 12:00 PM</p>
                                          </li>
                                          <li>
                                            <p class="font-weight-bold accordion-text">* No pets</p>
                                          </li>
                                          <li>
                                            <p class="font-weight-bold accordion-text">* Smoking is allowed</p>
                                          </li>
                                        </ul>
                                      </div>
                                      <div class="col-6">
                                        <h1 class="display-5 accordion-text">Health & safety</h1>
                                        <ul>
                                          <li>
                                            <p class="font-weight-bold accordion-text">* Carbon monoxide alarm not reported</p>
                                          </li>
                                          <li>
                                            <p class="font-weight-bold accordion-text">* Pool/hot tub without a gate or lock</p>
                                          </li>
                                          <li>
                                            <p class="font-weight-bold accordion-text">* Nearby lake, river, other body of water</p>
                                          </li>
                                          <li>
                                            <p class="font-weight-bold accordion-text">* Smoke alarm</p>
                                          </li>
                                        </ul>
                                      </div>
                                     
                                    </div>
                                </div>
                            </div>

                            <hr class="featurette-divider">

                            <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="card-header" id="headingOne">
                                    <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#contactUsCollapse" aria-expanded="true" aria-controls="contactUsCollapse">Can't find your answers? Contact Us:<span class="lni-chevron-up"></span></h6>
                                </div>
                                <div class="collapse" id="contactUsCollapse" aria-labelledby="headingOne" data-parent="#faqAccordion">
                                    <div class="card-body">
                                        <p class="font-weight-bold accordion-text"> Phone: 0945 309 6347 </p>
                                        <p class="font-weight-bold accordion-text"> Email: trs.matabungkay.batangas@gmail.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <!-- /END THE FEATURETTES -->
    </div><!-- /.container -->


    <?php include_once('footer.php');?>

