<?php
/**
 * @Entity @Table(name="eso_crm_ticket")
 **/
class Ticket{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @staff @Column(type="string", nullable=true)**/
    public $staff;
	/** @user @Column(type="string", nullable=true)**/
    public $user;
	/** @name @Column(type="string")**/
    public $name;
	/** @phone @Column(type="string")**/
    public $phone;
	/** @email @Column(type="string", nullable=true)**/
    public $email;
	/** @subject @Column(type="string")**/
    public $subject;
	/** @content @Column(type="text")**/
    public $content;
	/** @comment @Column(type="text", nullable=true)**/
    public $comment;
	/** @created @Column(type="integer")**/
    public $created;
	/** @checked @Column(type="integer", nullable=true)**/
    public $checked;
	/** @checked_by @Column(type="string", nullable=true)**/
    public $checked_by;
	/** @updated @Column(type="integer", nullable=true)**/
    public $updated;
	/** @updated_by @Column(type="string", nullable=true)**/
    public $updated_by;
	/** @completed @Column(type="integer", nullable=true)**/
    public $completed;
	/** @completed_by @Column(type="string", nullable=true)**/
    public $completed_by;
	/** @status @Column(type="integer")**/
    public $status;
}
?>