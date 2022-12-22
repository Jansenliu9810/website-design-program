<?php
require_once 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AddReview</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Company,Reviews,Job experiences,ReviewsDance" name="keywords">
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

    <style>
        .error {color: #FF0000;}
        .star {color: #FF0000;}
    </style>
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
                    <!--在上处修改链接的html-->
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->

<!-- Main body -->
<!--
/*
*
* Name: Zerong Chen
* Date: 2022/10/21
*
*/
-->
<script>
    function validateForm(){
        var errorCount = 0;

        var overallRatingChecked = false;
        let overallRating_list = document.getElementsByName("overallRating");
        for(var i=0; i<overallRating_list.length; i++){
            if (overallRating_list[i].checked){
                overallRatingChecked = true;
            }
        }
        if (overallRatingChecked == false){
            //overallRating no selection, show warning
            var overallRatingErr = "Please select one option";
            document.getElementById("overallRatingError").innerHTML = overallRatingErr;
            errorCount++;
        }

        var employmentPeriodChecked = false;
        let employmentPeriod_list = document.getElementsByName("employmentPeriod");
        for(var i=0; i<employmentPeriod_list.length; i++){
            if (employmentPeriod_list[i].checked){
                employmentPeriodChecked = true;
            }
        }
        if (employmentPeriodChecked == false){
            //overallRating no selection, show warning
            var employmentPeriodErr = "Please select one option";
            document.getElementById("employmentPeriodError").innerHTML = employmentPeriodErr;
            errorCount++;
        }

        var summary = document.getElementById("addSummary").value;
        if (summary == null || summary == ""){
            var summaryErr = "Cannot be empty";
            document.getElementById("summaryError").innerHTML = summaryErr;
            errorCount++;
        }
        var pros = document.getElementById("addPros").value;
        if (pros == null || pros == ""){
            var prosErr = "Cannot be empty";
            document.getElementById("prosError").innerHTML = prosErr;
            errorCount++;
        }
        var cons = document.getElementById("addCons").value;
        if (cons == null || cons == ""){
            var consErr = "Cannot be empty";
            document.getElementById("consError").innerHTML = consErr;
            errorCount++;
        }

        if (errorCount != 0){
            return false;
        }
        else{
            return true;
        }
    }
</script>
<div class="AddReview">
    <?php
    $company_id = $_GET["company_id"];
    if (!empty($_COOKIE["id"])){
        $user_id = $_COOKIE["id"];
    }
    $company = getCompany($company_id);
    $reviewDateTime = date("Y-m-d H:i:s", time());
    ?>
    <form name='company_review' method='get' onsubmit="return validateForm()" onkeydown="if(event.keyCode===13)return false;" action='review_employer.php'>
        <!--transfer 'employer_id' to review_employer.php -->
        <input type="hidden" name="company_id" value="<?= $company_id ?> " />

        <h1 class="RateCompany">Rate a Company</h1>
        <p id="Description">It only takes a minute! And your anonymous review will help other job seekers.</p>
        <div class="AddCompanyName">
           <h3>Company:   <?= $company->getName() ?></h3>
        </div>
        <br>
        <div class="overall-rating">
            <span class="SpanTab">Overall Rating </span>
            <span class="star">*</span>
            <span class="error" id="overallRatingError"></span>
            <br>
            <input type="radio" id="overallRating_one" name="overallRating" value="1">
            <label for="overallRating_one">1</label>
            <input type="radio" id="overallRating_two" name="overallRating" value="2">
            <label for="overallRating_two">2</label>
            <input type="radio" id="overallRating_three" name="overallRating" value="3">
            <label for="overallRating_three">3</label>
            <input type="radio" id="overallRating_four" name="overallRating" value="4">
            <label for="overallRating_four">4</label>
            <input type="radio" id="overallRating_five" name="overallRating" value="5">
            <label for="overallRating_five">5</label>
        </div>
        <br>
        <div class="employment-period">
            <span class="SpanTab">Are you a current or former employee?</span>
            <span class="star">*</span>
            <span class="error" id="employmentPeriodError"></span>
            <br>
            <input type="radio" id="employmentPeriod_current" name="employmentPeriod" value="1">
            <label for="employmentPeriod_current">Current Employee</label>
            <input type="radio" id="employmentPeriod_former" name="employmentPeriod" value="0">
            <label for="employmentPeriod_former">Former Employee</label>
        </div>
        <br>
        <div class="employment-status">
            <span class="SpanTab">Employment Status</span>
            <br>
            <select class="employment-status-select" id="employmentStatus" name="employmentStatus">
                <option value="">Select Your Option</option>
                <option value="REGULAR">Full-time</option>
                <option value="PART_TIME">Part-time</option>
                <option value="CONTRACT">Contract</option>
                <option value="INTERN">Intern/Trainee</option>
                <option value="FREELANCE">Freelance</option>
            </select>
        </div>
        <br>
        <div class="length-of-employment">
            <span class="SpanTab">Length of Employment</span>
            <br>
            <input type="text" size="25" name="addLengthOfEmployment">
        </div>
        <br>
        <div class="job-title">
            <span class="SpanTab">Your Job Title at <?= $company->getName() ?></span>
            <br>
            <input type="text" size="25" name="addJobTittle">
        </div>
        <br>
        <div class="summary">
            <span class="SpanTab">Review Headline(Summary) </span>
            <span class="star">*</span>
            <span class="error" id="summaryError" ></span>
            <br>
            <input id="addSummary" type="text" size="25" name="addSummary">
        </div>
        <br>
        <div class="pros">
            <span class="SpanTab">Pros </span>
            <span class="star">*</span>
            <span class="error" id="prosError" ></span>
            <br>
            <textarea id="addPros" name="addPros" rows="5" cols="50" placeholder="Share some of the best reasons to work at <?= $company->getName() ?>"></textarea>
        </div>
        <br>
        <div class="cons">
            <span class="SpanTab">Cons </span>
            <span class="star">*</span>
            <span class="error" id="consError" ></span>
            <br>
            <textarea id="addCons" name="addCons" rows="5" cols="50" placeholder="Share some of the downsides of working at <?= $company->getName() ?>"></textarea>
        </div>
        <br>
        <div class="advice">
            <span class="SpanTab">Advice for management?<br></span>
            <textarea name="addAdvice" rows="5" cols="50" placeholder="Share suggestions for how management can improve working at <?= $company->getName() ?>"></textarea>
        </div>
        <br>
        <!-- Optional Review -->
        <div class="optional-ratings">
            <span class="SpanTab">Ratings (Optional)</span>
            <span class="SpanTab">Career Opportunities</span>
            <br>
            <input type="radio" id="careerOpportunitiesRating_one" name="careerOpportunitiesRating" value="1">
            <label for="careerOpportunitiesRating_one">1</label>
            <input type="radio" id="careerOpportunitiesRating_two" name="careerOpportunitiesRating" value="2">
            <label for="careerOpportunitiesRating_two">2</label>
            <input type="radio" id="careerOpportunitiesRating_three" name="careerOpportunitiesRating" value="3">
            <label for="careerOpportunitiesRating_three">3</label>
            <input type="radio" id="careerOpportunitiesRating_four" name="careerOpportunitiesRating" value="4">
            <label for="careerOpportunitiesRating_four">4</label>
            <input type="radio" id="careerOpportunitiesRating_five" name="careerOpportunitiesRating" value="5">
            <label for="careerOpportunitiesRating_five">5</label>
            <br>
            <br>
            <span class="SpanTab">Compensations & Benefits</span>
            <br>
            <input type="radio" id="compensationAndBenefitsRating_one" name="compensationAndBenefitsRating" value="1">
            <label for="compensationAndBenefitsRating_one">1</label>
            <input type="radio" id="compensationAndBenefitsRating_two" name="compensationAndBenefitsRating" value="2">
            <label for="compensationAndBenefitsRating_two">2</label>
            <input type="radio" id="compensationAndBenefitsRating_three" name="compensationAndBenefitsRating" value="3">
            <label for="compensationAndBenefitsRating_three">3</label>
            <input type="radio" id="compensationAndBenefitsRating_four" name="compensationAndBenefitsRating" value="4">
            <label for="compensationAndBenefitsRating_four">4</label>
            <input type="radio" id="compensationAndBenefitsRating_five" name="compensationAndBenefitsRating" value="5">
            <label for="compensationAndBenefitsRating_five">5</label>
            <br>
            <br>
            <span class="SpanTab">Culture & Values</span>
            <br>
            <input type="radio" id="cultureAndValuesRating_one" name="cultureAndValuesRating" value="1">
            <label for="cultureAndValuesRating_one">1</label>
            <input type="radio" id="cultureAndValuesRating_two" name="cultureAndValuesRating" value="2">
            <label for="cultureAndValuesRating_two">2</label>
            <input type="radio" id="cultureAndValuesRating_three" name="cultureAndValuesRating" value="3">
            <label for="cultureAndValuesRating_three">3</label>
            <input type="radio" id="cultureAndValuesRating_four" name="cultureAndValuesRating" value="4">
            <label for="cultureAndValuesRating_four">4</label>
            <input type="radio" id="cultureAndValuesRating_five" name="cultureAndValuesRating" value="5">
            <label for="cultureAndValuesRating_five">5</label>
            <br>
            <br>
            <span class="SpanTab">Diversity & Inclusion</span>
            <br>
            <input type="radio" id="diversityAndInclusionRating_one" name="diversityAndInclusionRating" value="1">
            <label for="diversityAndInclusionRating_one">1</label>
            <input type="radio" id="diversityAndInclusionRating_two" name="diversityAndInclusionRating" value="2">
            <label for="diversityAndInclusionRating_two">2</label>
            <input type="radio" id="diversityAndInclusionRating_three" name="diversityAndInclusionRating" value="3">
            <label for="diversityAndInclusionRating_three">3</label>
            <input type="radio" id="diversityAndInclusionRating_four" name="diversityAndInclusionRating" value="4">
            <label for="diversityAndInclusionRating_four">4</label>
            <input type="radio" id="diversityAndInclusionRating_five" name="diversityAndInclusionRating" value="5">
            <label for="diversityAndInclusionRating_five">5</label>
            <br>
            <br>
            <span class="SpanTab">Senior Management</span>
            <br>
            <input type="radio" id="seniorLeadershipRating_one" name="seniorLeadershipRating" value="1">
            <label for="seniorLeadershipRating_one">1</label>
            <input type="radio" id="seniorLeadershipRating_two" name="seniorLeadershipRating" value="2">
            <label for="seniorLeadershipRating_two">2</label>
            <input type="radio" id="seniorLeadershipRating_three" name="seniorLeadershipRating" value="3">
            <label for="seniorLeadershipRating_three">3</label>
            <input type="radio" id="seniorLeadershipRating_four" name="seniorLeadershipRating" value="4">
            <label for="seniorLeadershipRating_four">4</label>
            <input type="radio" id="seniorLeadershipRating_five" name="seniorLeadershipRating" value="5">
            <label for="seniorLeadershipRating_five">5</label>
            <br>
            <br>
            <span class="SpanTab">Work / Life Balance</span>
            <br>
            <input type="radio" id="workLifeBalanceRating_one" name="workLifeBalanceRating" value="1">
            <label for="workLifeBalanceRating_one">1</label>
            <input type="radio" id="workLifeBalanceRating_two" name="workLifeBalanceRating" value="2">
            <label for="workLifeBalanceRating_two">2</label>
            <input type="radio" id="workLifeBalanceRating_three" name="workLifeBalanceRating" value="3">
            <label for="workLifeBalanceRating_three">3</label>
            <input type="radio" id="workLifeBalanceRating_four" name="workLifeBalanceRating" value="4">
            <label for="workLifeBalanceRating_four">4</label>
            <input type="radio" id="workLifeBalanceRating_five" name="workLifeBalanceRating" value="5">
            <label for="workLifeBalanceRating_five">5</label>
            <br>
            <br>
            <span class="SpanTab">Rate CEO Job Performance</span>
            <br>
            <input type="radio" id="ceoRating_Approve" name="ceoRating" value="Approve">
            <label for="ceoRating_Approve">Approve</label>
            <input type="radio" id="ceoRating_Neutral" name="ceoRating" value="NO_OPINION">
            <label for="ceoRating_Neutral">Neutral</label>
            <input type="radio" id="ceoRating_Disapprove" name="ceoRating" value="Disapprove">
            <label for="workLifeBalanceRating_Disapprove">Disapprove</label>
            <br>
            <br>
            <span class="SpanTab">Recommend to a friend?</span>
            <br>
            <input type="radio" id="recommendToFriendRating_one" name="recommendToFriendRating" value="Positive">
            <label for="recommendToFriendRating_one">Positive</label>
            <input type="radio" id="recommendToFriendRating_two" name="recommendToFriendRating" value="Negative">
            <label for="recommendToFriendRating_two">Negative</label>
            <br>
            <br>
            <span class="SpanTab">6 Month Business Outlook</span>
            <br>
            <input type="radio" id="businessOutlookRating_one" name="businessOutlookRating" value="Positive">
            <label for="businessOutlookRating_one">Positive</label>
            <input type="radio" id="businessOutlookRating_two" name="businessOutlookRating" value="Neutral">
            <label for="businessOutlookRating_two">Neutral</label>
            <input type="radio" id="businessOutlookRating_three" name="businessOutlookRating" value="Negative">
            <label for="businessOutlookRating_two">Negative</label>
        </div>
        <br>
        <div class="submit-review">
            <input type="hidden" name="user_id" value="<?= $user_id ?> " />
            <input type="hidden" name="review_date_time" value="<?= $reviewDateTime ?> " />
            <button type="submit" name="submit_review" value='Submit Review' id="SubmitReview">Submit Review</button>
        </div>
    </form>
</div>
<!-- body End -->

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