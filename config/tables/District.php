<?php
/**
 * @Entity @Table(name="eso_location_district")
 **/
class District{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @id_province @Column(type="integer", nullable=true)**/
    public $id_province;
	/** @prefix @Column(type="string", nullable=true)**/
    public $prefix;
	/** @name @Column(type="string", nullable=true)**/
    public $name;
}
?>