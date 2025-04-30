<?php

/*
 * A LeadDyno API client.
 */

namespace Programster\LeadDyno;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class Affiliate
{
    private int $id;
    private string $email;
    private string $firstName;
    private string $lastName;
    private string $affiliateCode;
    private ?int $referringAffiliateId;
    private string $createdAt;
    private string $updatedAt;
    private string $status;
    private string $paypalEmail; // will be empty string if not set.
    private bool $unsubscribed;
    private bool $archived;
    private bool $pendingApproval;
    private string $affiliateUrl;
    private string $affiliateDashboardUrl;
    private string $compensationTierCode;
    private array $customFields;
    private string $referrerDomain; // empty string if not set
    private int $totalLeads;
    private int $totalVisitors;
    private int $totalPurchases;


    private function __construct()
    {
    }


    /**
     * Create an affiliate object from a LeadDyno response to fetching affiliates.
     * @param array $affiliateArray
     * @return Affiliate
     */
    public static function createFromLeadDynoResponse(array $affiliateArray) : Affiliate
    {
        $affiliate = new Affiliate();
        $affiliate->id = $affiliateArray['id'];
        $affiliate->email = $affiliateArray['email'];
        $affiliate->firstName = $affiliateArray['first_name'];
        $affiliate->lastName = $affiliateArray['last_name'];
        $affiliate->affiliateCode = $affiliateArray['affiliate_code'];
        $affiliate->referringAffiliateId = $affiliateArray['referring_affiliate_id'];
        $affiliate->createdAt = $affiliateArray['created_at'];
        $affiliate->updatedAt = $affiliateArray['updated_at'];
        $affiliate->status = $affiliateArray['status'];
        $affiliate->paypalEmail = $affiliateArray['paypal_email']; // will be empty string if not set.
        $affiliate->unsubscribed = $affiliateArray['unsubscribed'];
        $affiliate->archived = $affiliateArray['archived'];
        $affiliate->pendingApproval = $affiliateArray['pending_approval'];
        $affiliate->affiliateUrl = $affiliateArray['affiliate_url'];
        $affiliate->affiliateDashboardUrl = $affiliateArray['affiliate_dashboard_url'];
        $affiliate->compensationTierCode = $affiliateArray['compensation_tier_code'];
        $affiliate->customFields = $affiliateArray['custom_fields'];
        $affiliate->referrerDomain = $affiliateArray['referrer_domain']; // empty string if not set
        $affiliate->totalLeads = $affiliateArray['total_leads'];
        $affiliate->totalVisitors = $affiliateArray['total_visitors'];
        $affiliate->totalPurchases = $affiliateArray['total_purchases'];
        return $affiliate;
    }
    
    
    public function getId() : int { return $this->id; }
    public function getEmail() : string { return $this->email; }
    public function getFirstName() : string { return $this->firstName; }
    public function getLastName() : string { return $this->lastName; }
    public function getAffiliateCode() : string { return $this->affiliateCode; }
    public function getReferringAffiliateId() : ?int { return $this->referringAffiliateId; }
    public function getCreatedAt() : string { return $this->createdAt; }
    public function getUpdatedAt() : string { return $this->updatedAt; }
    public function getStatus() : string { return $this->status; }
    public function getPaypalEmail() : string { return $this->paypalEmail; }
    public function getUnsubscribed() : bool { return $this->unsubscribed; }
    public function getArchived() : bool { return $this->archived; }
    public function getPendingApproval() : bool { return $this->pendingApproval; }
    public function getAffiliateUrl() : string { return $this->affiliateUrl; }
    public function getAffiliateDashboardUrl() : string { return $this->affiliateDashboardUrl; }
    public function getCompensationTierCode() : string { return $this->compensationTierCode; }
    public function getCustomFields() : array { return $this->customFields; }
    public function getReferrerDomain() : string { return $this->referrerDomain; }
    public function getTotalLeads() : int { return $this->totalLeads; }
    public function getTotalVisitors() : int { return $this->totalVisitors; }
    public function getTotalPurchases() : int { return $this->totalPurchases; }
}