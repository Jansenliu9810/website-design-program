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
class company
{
    private $company_id;
    private $company_name;
    private $company_addr;
    private $company_url;

    private $reviews_count = 0;
    private $business_outlook_rating = 0.0;
    private $career_opportunities_rating =0.0;
    private $ceo_rating = 0.0;
    private $compensation_and_benefits_rating =0.0;
    private $culture_and_values_rating =0.0;
    private $diversity_and_inclusion_rating = 0.0;
    private $recommend_to_friend_rating = 0.0;
    private $senior_leadership_rating = 0.0;
    private $work_life_balance_rating = 0.0;
    private $overall_rating = 0.0;

    public function __construct($id, $name, $addr, $url)
    {
        $this->company_id = $id;
        $this->company_name  = $name;
        $this->company_addr = $addr;
        $this->company_url = $url;
    }

    public function getId()
    {
        return $this->company_id;
    }

    public function getName()
    {
        return $this->company_name;
    }

    public function getAddr()
    {
        return $this->company_addr;
    }

    public function getUrl()
    {
        return $this->company_url;
    }

    public function setReviewsCount($reviews_count){
        $this->reviews_count = $reviews_count;
    }

    public function setBusinessOutlookRating($business_outlook_rating){
        $this->business_outlook_rating  = $business_outlook_rating;
    }

    public function setCareerOpportunitiesRating ($career_opportunities_rating){
        $this->career_opportunities_rating = $career_opportunities_rating;
    }

    public function setCeoRating($ceo_rating){
        $this->ceo_rating = $ceo_rating;
    }

    public function setCompensationAndBenefitsRating($compensation_and_benefits_rating){
        $this->compensation_and_benefits_rating = $compensation_and_benefits_rating;
    }

    public function setCultureAndValuesRating($culture_and_values_rating){
        $this->culture_and_values_rating = $culture_and_values_rating;
    }

    public function setDiversityAndInclusionRating($diversity_and_inclusion_rating){
        $this->diversity_and_inclusion_rating = $diversity_and_inclusion_rating;
    }

    public function setRecommendToFriendRating($recommend_to_friend_rating){
        $this->recommend_to_friend_rating = $recommend_to_friend_rating;
    }

    public function setSeniorLeadershipRating($senior_leadership_rating){
        $this->senior_leadership_rating = $senior_leadership_rating;
    }

    public function setWorkLifeBalanceRating($work_life_balance_rating){
        $this->work_life_balance_rating = $work_life_balance_rating;
    }

    public function setOverallRating($overall_rating){
        $this->overall_rating = $overall_rating;
    }

    public function getReviewsCount(){
        return $this->reviews_count;
    }

    public function getBusinessOutlookRating(){
        return $this->business_outlook_rating;
    }

    public function getCareerOpportunitiesRating(){
        return $this->career_opportunities_rating;
    }

    public function getCeoRating(){
        return $this->ceo_rating;
    }

    public function getCompensationAndBenefitsRating(){
        return $this->compensation_and_benefits_rating;
    }

    public function getCultureAndValuesRating(){
        return $this->culture_and_values_rating;
    }

    public function getDiversityAndInclusionRating(){
        return $this->diversity_and_inclusion_rating;
    }

    public function getRecommendToFriendRating(){
        return $this->recommend_to_friend_rating;
    }

    public function getSeniorLeadershipRating(){
        return $this->senior_leadership_rating;
    }

    public function getWorkLifeBalanceRating(){
        return $this->work_life_balance_rating;
    }

    public function getOverallRating(){
        return $this->overall_rating;
    }
}
?>