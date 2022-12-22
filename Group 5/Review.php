<!--
/*
*
* Name: Zerong Chen
* Date: 2022/10/21
* Email: alanchenzr@gmail.com
*
*/
-->
<?php
class Review
{
    private $userId;
    private $employerId;
    private $reviewDateTime;
    private $advice ;
    private $cons ;
    private $employmentStatus;
    private $isCurrentJob;
    private $jobEndingYear;
    private $jobTitle;
    private $lengthOfEmployment;
    private $pros;
    private $ratingBusinessOutlook;
    private $ratingCareerOpportunities;
    private $ratingCeo;
    private $ratingCompensationAndBenefits;
    private $ratingCultureAndValues;
    private $ratingDiversityAndInclusion;
    private $ratingOverall;
    private $ratingRecommendToFriend;
    private $ratingSeniorLeadership;
    private $ratingWorkLifeBalance;
    private $summary;


    public function __construct($userId, $employerId, $reviewDateTime, $isCurrentJob, $pros, $cons, $ratingOverall,
                                $summary)
    {
        $this->userId = $userId;
        $this->employerId = $employerId;
        $this->reviewDateTime = $reviewDateTime;
        $this->isCurrentJob = $isCurrentJob;
        $this->pros = $pros;
        $this->cons = $cons;
        $this->ratingOverall = $ratingOverall;
        $this->summary = $summary;
    }

    public function getEmployerId()
    {
        return $this->employerId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getReviewDateTime()
    {
        return $this->reviewDateTime;
    }

    public function getPros()
    {
        return $this->pros;
    }

    public function getCons()
    {
        return $this->cons;
    }

    public function getAdvice()
    {
        return $this->advice;
    }

    public function getIsCurrentJob()
    {
        return $this->isCurrentJob;
    }

    public function getEmploymentStatus()
    {
        return $this->employmentStatus;
    }

    public function getJobEndingYear(){
        return $this->jobEndingYear;
    }

    public function getJobTitle(){
        return $this->jobTitle;
    }

    public function getLengthOfEmployment(){
        return $this->lengthOfEmployment;
    }

    public function getRatingBusinessOutlook(){
        return $this->ratingBusinessOutlook;
    }

    public function getRatingCareerOpportunities(){
        return $this->ratingCareerOpportunities;
    }

    public function getRatingCeo(){
        return $this->ratingCeo;
    }

    public function getRatingCompensationAndBenefits(){
        return $this->ratingCompensationAndBenefits;
    }

    public function getRatingCultureAndValues(){
        return $this->ratingCultureAndValues;
    }

    public function getRatingDiversityAndInclusion(){
        return $this->ratingDiversityAndInclusion;
    }

    public function getRatingOverall(){
        return $this->ratingOverall;
    }

    public function getRatingRecommendToFriend(){
        return $this->ratingRecommendToFriend;
    }

    public function getRatingSeniorLeadership(){
        return $this->ratingSeniorLeadership;
    }

    public function getRatingWorkLifeBalance(){
        return $this->ratingWorkLifeBalance;
    }

    public function getSummary(){
        return $this->summary;
    }

    public function setAdvice($advice){
        $this->advice = $advice;
    }

    public function setEmploymentStatus($employmentStatus){
        $this->employmentStatus = $employmentStatus;
    }

    public function setJobEndingYear($jobEndingYear){
        $this->jobEndingYear = $jobEndingYear;
    }

    public function setJobTitle($jobTitle){
        $this->jobTitle = $jobTitle;
    }

    public function setLengthOfEmployment($lengthOfEmployment){
        $this->lengthOfEmployment = $lengthOfEmployment;
    }

    public function setRatingBusinessOutlook($ratingBusinessOutlook){
        $this->ratingBusinessOutlook = $ratingBusinessOutlook;
    }

    public function setRatingCareerOpportunities($ratingCareerOpportunities){
        $this->ratingCareerOpportunities = $ratingCareerOpportunities;
    }

    public function setRatingCeo($ratingCeo){
        $this->ratingCeo = $ratingCeo;
    }

    public function setRatingCompensationAndBenefits($ratingCompensationAndBenefits){
        $this->ratingCompensationAndBenefits = $ratingCompensationAndBenefits;
    }

    public function setRatingCultureAndValues($ratingCultureAndValues){
        $this->ratingCultureAndValues = $ratingCultureAndValues;
    }

    public function setRatingDiversityAndInclusion($ratingDiversityAndInclusion){
        $this->ratingDiversityAndInclusion = $ratingDiversityAndInclusion;
    }

    public function setRatingRecommendToFriend($ratingRecommendToFriend){
        $this->ratingRecommendToFriend = $ratingRecommendToFriend;
    }

    public function setRatingSeniorLeadership($ratingSeniorLeadership){
        $this->ratingSeniorLeadership = $ratingSeniorLeadership;
    }

    public function setRatingWorkLifeBalance($ratingWorkLifeBalance){
        $this->ratingWorkLifeBalance = $ratingWorkLifeBalance;
    }
}
?>