<!--
/*
*
* Name: Zerong Chen
* Date: 2022/10/21
*
*/
-->



<?php
require 'db_connect.php';
require 'Company.php';
require 'Review.php';

/**
 * Create connection to the database
 *
 * @return PDO object which is the connection to the database
 */
function openConnection()
{
    global $attr, $user, $pass, $opts;
    try {
        $pdo = new PDO($attr, $user, $pass, $opts); //initialize a PDO object
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    return $pdo;
}

/**
 * Create connection to the database
 *
 * @return PDO object which is the connection to the database
 */

function searchCompany($nameSearch, $addrSearch, $num){
    $pdo = openConnection(); // connect to the database

    $company_list = array();   //create an empty array for companys

    if (!empty($nameSearch) and empty($addrSearch)){
        //Fuzzy Search by company name
        $query = "SELECT * FROM employer 
                  WHERE company_name LIKE '$nameSearch%' 
                  ORDER BY company_name
                  LIMIT $num";
    }elseif (empty($nameSearch) and !empty($addrSearch)){
        //Fuzzy Search by address
        $query = "SELECT * FROM employer 
                  WHERE company_hq LIKE '%$addrSearch'
                  ORDER BY company_name
                  LIMIT $num";
    }else{
        //Precise Search
        $query = "SELECT * FROM employer e WHERE company_hq LIKE '%$addrSearch' 
                  AND EXISTS(SELECT * FROM employer d WHERE e.employer_id = d.employer_id
                  AND company_name LIKE '$nameSearch%')
                  ORDER BY company_name
                  LIMIT $num";
    }

    $result = $pdo->query($query);

    if (!$result) return false;

    $pdo = null; // close connection to the database

    while ($row = $result->fetch()){
        $id = htmlspecialchars($row["employer_id"]);
        $name = htmlspecialchars($row["company_name"]);
        $addr = htmlspecialchars($row["company_hq"]);
        $url = htmlspecialchars($row["company_url"]);
        $company = new Company($id, $name, $addr, $url);
        array_push($company_list, $company);
    }
    return $company_list;
}

/**
 *  get the Specific Company by "$company_id"
 **/

function getCompany($company_id)
{
    $pdo = openConnection(); // connect to the database

    $query = "SELECT * FROM employer 
              WHERE employer_id = " . $company_id;

    $result = $pdo->query($query);

    $pdo = null; // close connection to the database

    $row = $result->fetch();
    $id = htmlspecialchars($row["employer_id"]);
    $name = htmlspecialchars($row["company_name"]);
    $addr = htmlspecialchars($row["company_hq"]);
    $url = htmlspecialchars($row["company_url"]);
    $company = new Company($id, $name, $addr, $url);

    return $company;
}

/**
 *  get the Reviewed Company from "reviewedemployer_s"
 **/

function getReviewedCompany()
{
    $pdo = openConnection(); // connect to the database

    $company_list = array();   //create an empty array for companys

    //random select company
    $query = "SELECT * FROM reviewedemployer_s
              ORDER BY rand()";

    $result = $pdo->query($query);

    $pdo = null; // close connection to the database

    while ($row = $result->fetch()){
        $id = htmlspecialchars($row["employer_id"]);
        $name = htmlspecialchars($row["company_name"]);
        $addr = htmlspecialchars($row["company_hq"]);
        $url = htmlspecialchars($row["company_url"]);
        $company = new Company($id, $name, $addr, $url);
        array_push($company_list, $company);
    }

    return $company_list;
}

/**
 * Queries the database for all Company.
 *
 * For each result returned from the query create a new Item and add to an array of Items.
 * Order the results returned by name.
 *
 * RETURN @param $company_list array list of Items
 */
function getRandomCompany($num)
{
    $pdo = openConnection(); // connect to the database

    $company_list = array();   //create an empty array for companys

    //random select company
    $query = "SELECT * FROM employer
              ORDER BY rand()   
              LIMIT $num";

    $result = $pdo->query($query);

    $pdo = null; // close connection to the database

    while ($row = $result->fetch()){
        $id = htmlspecialchars($row["employer_id"]);
        $name = htmlspecialchars($row["company_name"]);
        $addr = htmlspecialchars($row["company_hq"]);
        $url = htmlspecialchars($row["company_url"]);
        $company = new Company($id, $name, $addr, $url);
        array_push($company_list, $company);
    }

    return $company_list;
}

/**
 *  Provide address selection
 *
 *  Returns @param $addrs an array of address
 **/

function getAddroption()
{
    $pdo = openConnection(); // connect to the database

    //$addrs = array("region"=>[], "city"=>[], "country"=>[]);   //create a empty array for addresses
    $addrs = array("country"=>[]);
    //random select company
    $query = "SELECT DISTINCT company_hq FROM employer ORDER BY company_hq";

    $result = $pdo->query($query);

    $pdo = null; // close connection to the database

    while ($row = $result->fetch()){
        $addr = htmlspecialchars($row["company_hq"]);
        $split_addr = explode(", ", $addr); //split the address string into array
        if (count($split_addr) == 3){
            array_push($addrs["country"], $split_addr[2]);
        }elseif (count($split_addr) == 2){
            array_push($addrs["country"], $split_addr[1]);
        }elseif (count($split_addr) == 1){
            array_push($addrs["country"], $split_addr[0]);
        }
        $addrs["country"] = array_unique($addrs["country"]);
    }
    return $addrs;
}

/**
 *  Determine if there is a reviewed employers in the table "employerreview_s" by "employee_id".
 **/
function isCompanyInEmployerReview($company_id)
{
    if($company_id > 0){
        $pdo = openConnection(); // connect to the database

        $query = "SELECT employerId FROM employerreview_s 
                  WHERE employerId = " . $company_id;

        $result = $pdo->query($query);

        $pdo = null; // close connection to the database

        $row = $result->fetch();    //result array

        if($row != []){
            return true;
        }else{
            return false;
        }
    }
}

/**
 *  get the rating detail of the Reviewed Company by "employer_id"
 **/
function getCompanyRating($company_id)
{
    $pdo = openConnection(); // connect to the database

    if(isCompanyInEmployerReview($company_id)){
        $query = "SELECT * FROM reviewedemployer_s
                  WHERE employer_id = " . $company_id;

        $result = $pdo->query($query);

        $pdo = null; // close connection to the database

        $row = $result->fetch();
        $id = htmlspecialchars($row["employer_id"]);
        $name = htmlspecialchars($row["company_name"]);
        $addr = htmlspecialchars($row["company_hq"]);
        $url = htmlspecialchars($row["company_url"]);

        $reviews_count = htmlspecialchars($row["reviews_count"]);
        $business_outlook_rating = htmlspecialchars($row["business_outlook_rating"]);
        $career_opportunities_rating = htmlspecialchars($row["career_opportunities_rating"]);
        $ceo_rating = htmlspecialchars($row["ceo_rating"]);
        $compensation_and_benefits_rating = htmlspecialchars($row["compensation_and_benefits_rating"]);
        $culture_and_values_rating = htmlspecialchars($row["culture_and_values_rating"]);
        $diversity_and_inclusion_rating = htmlspecialchars($row["diversity_and_inclusion_rating"]);
        $recommend_to_friend_rating = htmlspecialchars($row["recommend_to_friend_rating"]);
        $senior_leadership_rating = htmlspecialchars($row["senior_leadership_rating"]);
        $work_life_balance_rating = htmlspecialchars($row["work_life_balance_rating"]);
        $overall_rating = htmlspecialchars($row["overall_rating"]);

        $reviewedCompany = new Company($id, $name, $addr, $url);

        $reviewedCompany->setReviewsCount($reviews_count);
        $reviewedCompany->setBusinessOutlookRating($business_outlook_rating);
        $reviewedCompany->setCareerOpportunitiesRating($career_opportunities_rating);
        $reviewedCompany->setCeoRating($ceo_rating);
        $reviewedCompany->setCompensationAndBenefitsRating($compensation_and_benefits_rating);
        $reviewedCompany->setCultureAndValuesRating($culture_and_values_rating);
        $reviewedCompany->setDiversityAndInclusionRating($diversity_and_inclusion_rating);
        $reviewedCompany->setOverallRating($overall_rating);
        $reviewedCompany->setRecommendToFriendRating($recommend_to_friend_rating);
        $reviewedCompany->setSeniorLeadershipRating($senior_leadership_rating);
        $reviewedCompany->setWorkLifeBalanceRating($work_life_balance_rating);

        return $reviewedCompany;    //return a reviewed company with rating
    }
    return getCompany($company_id);     //return a company with default rating
}

/**
 * get all reviews from the employerreview_S table.
 */
function getReviews($company_id)
{
    $pdo = openConnection(); // connect to the database

    $review_list = array();   //create an empty array for companys

    //random select company
    $query = "SELECT * FROM employerreview_S
               WHERE employerID = " . $company_id;

    $result = $pdo->query($query);

    $pdo = null; // close connection to the database

    while ($row = $result->fetch()){
        $userId = htmlspecialchars($row["reviewId"]);
        $reviewDateTime = htmlspecialchars($row["reviewDateTime"]);
        $advice = htmlspecialchars($row["advice"]);
        $cons = htmlspecialchars($row["cons"]);
        $employmentStatus = htmlspecialchars($row["employmentStatus"]);
        $isCurrentJob = htmlspecialchars($row["isCurrentJob"]);
        $jobEndingYear = htmlspecialchars($row["jobEndingYear"]);
        $jobTitle= htmlspecialchars($row["jobTitle"]);
        $lengthOfEmployment = htmlspecialchars($row["lengthOfEmployment"]);
        $pros = htmlspecialchars($row["pros"]);
        $ratingBusinessOutlook = htmlspecialchars($row["ratingBusinessOutlook"]);
        $ratingCareerOpportunities = htmlspecialchars($row["ratingCareerOpportunities"]);
        $ratingCeo = htmlspecialchars($row["ratingCeo"]);
        $ratingCompensationAndBenefits = htmlspecialchars($row["ratingCompensationAndBenefits"]);
        $ratingCultureAndValues = htmlspecialchars($row["ratingCultureAndValues"]);
        $ratingDiversityAndInclusion = htmlspecialchars($row["ratingDiversityAndInclusion"]);
        $ratingOverall = htmlspecialchars($row["ratingOverall"]);
        $ratingRecommendToFriend = htmlspecialchars($row["ratingRecommendToFriend"]);
        $ratingSeniorLeadership = htmlspecialchars($row["ratingSeniorLeadership"]);
        $ratingWorkLifeBalance = htmlspecialchars($row["ratingWorkLifeBalance"]);
        $summary = htmlspecialchars($row["summary"]);

        $review = new Review($userId, $company_id, $reviewDateTime, $isCurrentJob, $pros, $cons, $ratingOverall, $summary);

        $review->setAdvice($advice);
        $review->setEmploymentStatus($employmentStatus);
        $review->setJobEndingYear($jobEndingYear);
        $review->setJobTitle($jobTitle);
        $review->setLengthOfEmployment($lengthOfEmployment);
        $review->setRatingBusinessOutlook($ratingBusinessOutlook);
        $review->setRatingCareerOpportunities($ratingCareerOpportunities);
        $review->setRatingCeo($ratingCeo);
        $review->setRatingCompensationAndBenefits($ratingCompensationAndBenefits);
        $review->setRatingCultureAndValues($ratingCultureAndValues);
        $review->setRatingDiversityAndInclusion($ratingDiversityAndInclusion);
        $review->setRatingRecommendToFriend($ratingRecommendToFriend);
        $review->setRatingSeniorLeadership($ratingSeniorLeadership);
        $review->setRatingWorkLifeBalance($ratingWorkLifeBalance);

        array_push($review_list, $review);
    }
    return $review_list;
}

/**
 * Inserts a review into the employerreview_S table.
 *
 * @param $review The review that will be added
 */
function insertReview($review){
    $pdo = openConnection(); // connect to the database

    $userId = $pdo->quote($review->getUserId());
    $employerId = $pdo->quote($review->getEmployerId());
    $reviewDateTime = $pdo->quote($review->getReviewDateTime());
    $advice = $pdo->quote($review->getAdvice());
    $cons = $pdo->quote($review->getCons());
    $employmentStatus = $pdo->quote($review->getEmploymentStatus());
    $isCurrentJob = $pdo->quote($review->getIsCurrentJob()); //$employmentPeriod
    $jobTittle = $pdo->quote($review->getJobTitle());
    $lengthOfEmployment = $pdo->quote($review->getLengthOfEmployment());
    $pros = $pdo->quote($review->getPros());
    $businessOutlookRating = $pdo->quote($review->getRatingBusinessOutlook());
    $careerOpportunitiesRating = $pdo->quote($review->getRatingCareerOpportunities());
    $ceoRating = $pdo->quote($review->getRatingCeo());
    $compensationAndBenefitsRating = $pdo->quote($review->getRatingCompensationAndBenefits());
    $cultureAndValuesRating = $pdo->quote($review->getRatingCultureAndValues());
    $diversityAndInclusionRating = $pdo->quote($review->getRatingDiversityAndInclusion());
    $overallRating = $pdo->quote($review->getRatingOverall());
    $recommendToFriendRating = $pdo->quote($review->getRatingRecommendToFriend());
    $seniorLeadershipRating = $pdo->quote($review->getRatingSeniorLeadership());
    $workLifeBalanceRating = $pdo->quote($review->getRatingWorkLifeBalance());
    $summary = $pdo->quote($review->getSummary());

    $sql = "INSERT INTO employerreview_S (userId, employerId, reviewDateTime, advice, cons, 
                                          employmentStatus, isCurrentJob, jobTitle, lengthOfEmployment,
                                          pros, ratingBusinessOutlook, ratingCareerOpportunities, ratingCeo, 
                                          ratingCompensationAndBenefits, ratingCultureAndValues, ratingDiversityAndInclusion,
                                          ratingOverall, ratingRecommendToFriend, ratingSeniorLeadership, 
                                          ratingWorkLifeBalance, summary) 
    VALUES ($userId, $employerId, $reviewDateTime, $advice, $cons, :employmentStatus,  $isCurrentJob,
            $jobTittle, :lengthOfEmployment, $pros, :businessOutlookRating, :careerOpportunitiesRating,
            :ceoRating, :compensationAndBenefitsRating, :cultureAndValuesRating, :diversityAndInclusionRating, 
            $overallRating, :recommendToFriendRating, :seniorLeadershipRating, :workLifeBalanceRating, $summary)";

    $query = $pdo->prepare($sql);

    $query->bindValue(':employmentStatus', !empty($employmentStatus) ? $employmentStatus : NULL, PDO::PARAM_STR_CHAR);
    $query->bindValue(':lengthOfEmployment', !empty($lengthOfEmployment) ? (int)$lengthOfEmployment : 0, PDO::PARAM_INT);
    $query->bindValue(':businessOutlookRating', !empty($businessOutlookRating) ? $businessOutlookRating : NULL, PDO::PARAM_STR_CHAR);
    $query->bindValue(':careerOpportunitiesRating', !empty($careerOpportunitiesRating) ? (int)$careerOpportunitiesRating : 0, PDO::PARAM_INT);
    $query->bindValue(':ceoRating', !empty($ceoRating) ? $ceoRating : NULL, PDO::PARAM_STR_CHAR);
    $query->bindValue(':compensationAndBenefitsRating', !empty($compensationAndBenefitsRating) ? (int)$compensationAndBenefitsRating : 0, PDO::PARAM_INT);
    $query->bindValue(':cultureAndValuesRating', !empty($cultureAndValuesRating) ? (int)$cultureAndValuesRating : 0, PDO::PARAM_INT);
    $query->bindValue(':diversityAndInclusionRating', !empty($diversityAndInclusionRating) ? (int)$diversityAndInclusionRating : 0, PDO::PARAM_INT);
    $query->bindValue(':recommendToFriendRating', !empty($recommendToFriendRating) ? $recommendToFriendRating : NULL, PDO::PARAM_STR_CHAR);
    $query->bindValue(':seniorLeadershipRating', !empty($seniorLeadershipRating) ? (int)$seniorLeadershipRating : 0, PDO::PARAM_INT);
    $query->bindValue(':workLifeBalanceRating', !empty($workLifeBalanceRating) ? (int)$workLifeBalanceRating : 0, PDO::PARAM_INT);

    try {
        $query->execute();
    } catch (PDOException $e) {
        fatalError($e->getMessage());
    }

    $pdo = null; // close connection to the database
}


/**
 * Echos an mysql error.
 *
 * @param string $errorMessage The error message passed.
 */
function fatalError($errorMessage)
{
    echo "<p><strong>Something went wrong: $errorMessage</strong></p>";
}
?>
