<?php
require_once 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Employer</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Company,Reviews,Job experiences" name="keywords">
    <meta content="The most comprehensive information" name="description">
    <meta content="Group 5" name="author">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/SubWebpage.css">

</head>
<body>
<div class="container-fluid py-2 border-bottom d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-decoration-none text-body pe-3" href=""><i class="bi bi-telephone me-2"></i>+021 208 1828</a>
                    <span class="text-body">|</span>
                    <a class="text-decoration-none text-body px-3" href=""><i class="bi bi-envelope me-2"></i>robertaiwanlol@gmail.com</a>

                    <!-- Cookie  Status and Logout -->
                    <span class="text-body">|</span>
                    <?php if(isset($_COOKIE['username'])): ?>
                        <a class = "text-decoration-none text-body px-2"><i class = "bi me-2"></i><?= $_COOKIE['username'] ?></a>
                        <!--<form action="logout.php" method="post"> -->
                        <a class = "text-decoration-none text-body px-0" type="submit" href="logout.php"><i class="bi me-0"></i>logout</a>
                        <!-- </form> -->
                    <?php else: ?>
                        <a class = "text-decoration-none text-body px-2"><i class = "bi me-2"></i>Username</a>
                    <?php endif; ?>
                    <!-- Cookie Coding end -->

                </div>
            </div>

            <div class="col-md-6 text-center text-lg-end">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-body px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-body px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-body px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-body ps-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navbar -->
<div class="container-fluid sticky-top bg-white shadow-sm mb-5">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
            <a href="index.php" class="navbar-brand">
                <!--img class = "position-absolute w-30 h-100 rounded" src="img/ReviewsDance.jpg" style="object-fit:contain;">"-->
                <h1 class="m-0 text-uppercase text-primary"><img src="img/ReviewsDance.jpg" style="width: 120px; height: 120px">ReviewsDance</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="employer_rankings.php" class="nav-item nav-link">Employer Ranking</a>
                    <a href="price.html" class="nav-item nav-link">Contact</a>
                    <!-- Check the status of Log in -->
                    <?php if(!isset($_COOKIE['username'])): ?>
                        <a href="login.php" class="nav-item nav-link">Log In</a>
                    <?php else: ?>
                        <a href="logout.php" class="nav-item nav-link">Log Out</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->

<!-- Main Body -->
<!--
/*
*
* Name: Zerong Chen
* Date: 2022/10/21
*
*/
-->
<div class="company-detail">
    <div class="company-overview">
        <?php
        $company_id = $_GET["company_id"];
        $company = getCompany($company_id);
        ?>
            <div class="company-name">
                <h2><?= $company->getName() ?> Overview</h2>
            </div>
            <ul class="CompanyInfo">
                <li>
                    <label>Website:</label>
                    <a href="<?= $company->getUrl() ?>"><?= $company->getUrl() ?></a>
                </li>
                <li>
                    <label>Headquarters:</label>
                    <label><?= $company->getAddr() ?></label>
                </li>
                <li>
                    <label>Size:</label>
                </li>
                <li>
                    <label>Founded:</label>
                </li>
                <li>
                    <label>Type:</label>
                </li>
                <li>
                    <label>Industry:</label>
                </li>
                <li>
                    <label>Revenue:</label>
                </li>
            </ul>
    </div>
    <div class="AddReview">
        <?php
        /*
         * Determine whether the data passed from add_review exists, and then store it,
         *  distinguishing between optional and mandatory options
         * */

        if (isset($_GET['overallRating'], $_GET['employmentPeriod'],
            $_GET['addSummary'], $_GET['addPros'], $_GET['addCons'])){

            $userId = $_GET["user_id"];
            $reviewDateTime = $_GET["review_date_time"];

            //Required option
            $employmentPeriod = (int)$_GET['employmentPeriod'];
            $addPros = $_GET['addPros'];
            $addCons = $_GET['addCons'];
            $overallRating = (int)$_GET['overallRating'];
            $addSummary = $_GET['addSummary'];

            $review = new Review($userId, $company_id, $reviewDateTime, $employmentPeriod, $addPros, $addCons,
                                 $overallRating, $addSummary);

            //Optional
            $employmentStatus = $_GET['employmentStatus'];
            $addLengthOfEmployment = $_GET['addLengthOfEmployment'];
            $addJobTittle = $_GET['addJobTittle'];
            $addAdvice = $_GET['addAdvice'];

            isset($_GET['careerOpportunitiesRating']) ?
                $careerOpportunitiesRating = $_GET['careerOpportunitiesRating'] :
                $careerOpportunitiesRating = 0;

            isset($_GET['compensationAndBenefitsRating']) ?
                $compensationAndBenefitsRating = $_GET['compensationAndBenefitsRating'] :
                $compensationAndBenefitsRating = 0;

            isset($_GET['cultureAndValuesRating']) ?
                $cultureAndValuesRating = $_GET['cultureAndValuesRating'] :
                $cultureAndValuesRating = 0;

            isset($_GET['diversityAndInclusionRating']) ?
                $diversityAndInclusionRating = $_GET['diversityAndInclusionRating'] :
                $diversityAndInclusionRating = 0;

            isset($_GET['seniorLeadershipRating']) ?
                $seniorLeadershipRating = $_GET['seniorLeadershipRating'] :
                $seniorLeadershipRating = 0;

            isset($_GET['workLifeBalanceRating']) ?
                $workLifeBalanceRating = $_GET['workLifeBalanceRating'] :
                $workLifeBalanceRating = 0;

            isset($_GET['ceoRating']) ?
                $ceoRating = $_GET['ceoRating'] :
                $ceoRating = NULL;

            isset($_GET['recommendToFriendRating']) ?
                $recommendToFriendRating = $_GET['recommendToFriendRating'] :
                $recommendToFriendRating = NULL;

            isset($_GET['businessOutlookRating']) ?
                $businessOutlookRating = $_GET['businessOutlookRating'] :
                $businessOutlookRating = NULL;

            $review->setEmploymentStatus($employmentStatus);
            $review->setLengthOfEmployment($addLengthOfEmployment);
            $review->setJobTitle($addJobTittle);
            $review->setAdvice($addAdvice);
            $review->setRatingCareerOpportunities($careerOpportunitiesRating);
            $review->setRatingCompensationAndBenefits($compensationAndBenefitsRating);
            $review->setRatingCultureAndValues($cultureAndValuesRating);
            $review->setRatingDiversityAndInclusion($diversityAndInclusionRating);
            $review->setRatingSeniorLeadership($seniorLeadershipRating);
            $review->setRatingWorkLifeBalance($workLifeBalanceRating);
            $review->setRatingCeo($ceoRating);
            $review->setRatingRecommendToFriend($recommendToFriendRating);
            $review->setRatingBusinessOutlook($businessOutlookRating);

            insertReview($review);
        }?>
        <?php
        //check login status
        if (!empty($_COOKIE["id"])) {
            $target_url = "add_review.php";
        } else {
            $target_url = "login.php";
        }
        ?>
        <form name='add_company_review' method='get' action='<?= $target_url ?>'>
            <!--transfer 'employer_id' to add_review.php -->
            <input type="hidden" name="company_id" value="<?= $company_id ?> " />
            <input type='submit' name="add_review" value='Add a Review' id="AddReviewButton"/>
        </form>
    </div>
    <div class="company-review">
        <h3 id="ReviewTitle">Review</h3>
        <?php
        /*
        * According to the company_id display different company information with comments and ratings,
        * if the given company does not have comments only show the company information for the time being,
        * and after the user comments in the display of ratings and comments, ratings only after more than
        * 10 users have commented to take the average display.
        * */
        $companyRating = getCompanyRating($company_id);
        ?>
        <div class="company-rating">
            <ul id="subRating">
                <h3>Rating</h3>
                <li>
                    <label>Overall</label>
                    <label><?= $companyRating->getOverallRating(); ?></label>
                </li>
                <li>
                    <label>Culture & Values</label>
                    <label><?= $companyRating->getCultureAndValuesRating(); ?></label>
                </li>
                <li>
                    <label>Diversity & Inclusion</label>
                    <label><?= $companyRating->getDiversityAndInclusionRating(); ?></label>
                </li>
                <li>
                    <label>Work/Life Balance</label>
                    <label><?= $companyRating->getWorkLifeBalanceRating(); ?></label>
                </li>
                <li>
                    <label>Senior Management</label>
                    <label><?= $companyRating->getSeniorLeadershipRating(); ?></label>
                </li>
                <li>
                    <label>Compensation and Benefits</label>
                    <label><?= $companyRating->getCompensationAndBenefitsRating(); ?></label>
                </li>
                <li>
                    <label>Career Opportunities</label>
                    <label><?= $companyRating->getCareerOpportunitiesRating(); ?></label>
                </li>
            </ul>
            <ul>
                <!-- Recommend rating -->
                <h3>Recommend Rating</h3>
                <li>
                    <label>Recommend to a Friend</label>
                    <label><?= $companyRating->getRecommendToFriendRating(); ?></label>
                </li>
                <li>
                    <label>Approve of CEO</label>
                    <label><?= $companyRating->getCeoRating(); ?></label>
                </li>
                <li>
                    <label>Positive Business Outlook</label>
                    <label><?= $companyRating->getBusinessOutlookRating(); ?></label>
                </li>
            </ul>
        </div>
        <div class="company-reviews-block">
            <ol>
                <?php
                if (isCompanyInEmployerReview($company_id)):
                    $review_list = getReviews($company_id);
                    for ($i=0; $i<5; $i++): ?> <!--TODO
                                                   count($review_list) too large,
                                                   need to use JS show the reviews -->
                        <li>
                            <!-- show reviews -->
                            <div class="single-review">
                                <span class="rating-number"><?= $review_list[$i]->getRatingOverall() ?></span>
                                <?php
                                $isCurrentJob = $review_list[$i]->getIsCurrentJob();
                                $jobEndingYear = $review_list[$i]->getJobEndingYear();
                                $employmentPeriod = "Current Employee";
                                if ($isCurrentJob == 0){
                                    if (!empty($jobEndingYear)){
                                        $durationOfDeparture = date("Y", time()) - $jobEndingYear;
                                        $employmentPeriod = "Former Employee, more than "
                                            . $durationOfDeparture . " years";
                                    }else{
                                        $employmentPeriod = "Former Employee";
                                    }
                                }
                                ?>
                                <span class="employment-period"><?= $employmentPeriod ?></span>
                                <span class="Summary"><h3><?= $review_list[$i]->getSummary() ?></h3></span>
                                <?php
                                $jobTitle = $review_list[$i]->getJobTitle();
                                $reviewerJobTitle = "Anonymous Employee";
                                if (!empty($jobTitle)){
                                    $reviewerJobTitle = $jobTitle;
                                }
                                ?>
                                <span class="reviewDateTime">
                                    <?= $review_list[$i]->getReviewDateTime() ."-". $reviewerJobTitle; ?>
                                </span>
                                <span class="Pros">
                                    <h4>Pros</h4>
                                    <?= $review_list[$i]->getPros() ?>
                                </span>
                                <span class="Cons">
                                    <h4>Cons</h4>
                                    <?= $review_list[$i]->getCons() ?>
                                </span>
                            </div>
                        </li>
                        <br>
                    <?php endfor;
                else:?>
                    <span>No Review</span>
                <?php endif; ?>
            </ol>
        </div>
    </div>
</div>
<!-- Body End -->

<div class="container-fluid bg-dark text-light mt-5 py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Get In Touch</h4>
                <p class="mb-4">We will satisfy you with the best service.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>123 Street, University of Canterbury, NZ</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>robertaiwanlol@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>+021 208 1828</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Quick Links</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Home</a>
                    <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Our Services</a>
                    <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contact Us</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Popular Links</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Home</a>
                    <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Our Services</a>
                    <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contact Us</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Newsletter</h4>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-3 border-0" placeholder="Your Email Address">
                        <button class="btn btn-primary">Sign Up</button>
                    </div>
                </form>
                <h6 class="text-primary text-uppercase mt-4 mb-3">Follow Us</h6>
                <div class="d-flex">
                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-dark text-light border-top border-secondary py-4">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-md-0">&copy; <a class="text-primary" href="#">ReviewsDance</a>. Help users collect and view information</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="mb-0">Designed by Group 5</p>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>
</html>

