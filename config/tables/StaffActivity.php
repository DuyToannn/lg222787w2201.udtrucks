<?php
/**
 * @Entity @Table(name="eso_hrm_staff_activity")
 **/
class StaffActivity{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @staff @Column(type="string")**/
    public $staff;
	/** @created @Column(type="integer")**/
    public $created;
	/** @type @Column(type="string")**/
    public $type;
	/** @task @Column(type="string")**/
    public $task;
	/** @content @Column(type="text", nullable=true)**/
    public $content;
	/** @ip @Column(type="string")**/
    public $ip;
	/** @agent @Column(type="string")**/
    public $agent;
	/** @device @Column(type="string")**/
    public $device;
}
?>