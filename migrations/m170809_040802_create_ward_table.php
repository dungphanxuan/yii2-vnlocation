<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ward`.
 */
class m170809_040802_create_ward_table extends Migration {
	/**
	 * @inheritdoc
	 */
	public function up() {
		$this->createTable( 'go_ward', [
			'id'             => $this->primaryKey(),
			'district_id'    => $this->integer()->notNull(),
			'name'           => $this->string( 128 )->notNull(),
			'slug'           => $this->string( 128 ),
			'fullname'       => $this->string( 128 ),
			'short_name'     => $this->string( 64 ),
			'code_vtp'       => $this->string( 32 ),
			'code_spl'       => $this->string( 32 ),
			'priority'       => $this->smallInteger( 1 )->defaultValue( 0 ),
			'image_base_url' => $this->string( 255 ),
			'image_path'     => $this->string( 255 ),
			'lat'            => $this->double(),
			'lng'            => $this->double(),
			'status'         => $this->smallInteger()->defaultValue( 1 ),
			'created_at'     => $this->integer(),
			'updated_at'     => $this->integer(),
		] );

		// Index
		$this->createIndex(
			'idx-ward_district',
			'go_ward',
			'district_id'
		);

		$this->createIndex(
			'idx-ward_status',
			'go_ward',
			'status'
		);
		//Create ForeignKey
		$this->addForeignKey( 'fk_ward_district', 'go_ward', 'district_id', 'go_district', 'id', 'cascade', 'cascade' );

		//Seed data
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->dropTable( 'go_ward' );
		$this->dropForeignKey( 'fk_ward_district', 'go_ward' );
	}
}
