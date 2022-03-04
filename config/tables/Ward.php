<?php
/**
 * @Entity @Table(name="eso_location_ward")
 **/
class Ward{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @id_province @Column(type="integer", nullable=true)**/
    public $id_province;
	/** @id_district @Column(type="integer", nullable=true)**/
    public $id_district;
	/** @prefix @Column(type="string", nullable=true)**/
    public $prefix;
	/** @name @Column(type="string")**/
    public $name;
}
?>