<?php
/**
 * @Entity @Table(name="eso_crm_traffic")
 **/
class Traffic{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @id_parent @Column(type="integer", nullable=true)**/
    public $id_parent;
	/** @user @Column(type="string", nullable=true)**/
    public $user;
	/** @agent @Column(type="string")**/
    public $agent;
	/** @device @Column(type="string")**/
    public $device;
	/** @referer @Column(type="string")**/
    public $referer;
	/** @ip @Column(type="string")**/
    public $ip;
	/** @pages @Column(type="text")**/
    public $pages;
	/** @checkin @Column(type="integer", nullable=true)**/
    public $checkin;
	/** @checkout @Column(type="integer", nullable=true)**/
    public $checkout;
}
?>