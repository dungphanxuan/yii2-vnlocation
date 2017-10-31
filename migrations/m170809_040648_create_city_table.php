<?php

use yii\db\Migration;

/**
 * Handles the creation of table `city`.
 */
class m170809_040648_create_city_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('go_city', [
            'id'             => $this->primaryKey(),
            'region_id'      => $this->integer()->notNull(),
            'name'           => $this->string(32)->notNull()->comment('Tên tỉnh/thành phố'),
            'slug'           => $this->string(32),
            'short_name'     => $this->string(32),
            'code'           => $this->string(32)->notNull(),
            'code_ghn'       => $this->string(32),
            'code_vtp'       => $this->string(32),
            'code_njv'       => $this->string(32),
            'code_kerry'     => $this->string(32),
            'allow'          => $this->smallInteger(1)->defaultValue(0),
            'priority'       => $this->smallInteger(1)->defaultValue(0),
            'image_base_url' => $this->string(255),
            'image_path'     => $this->string(255),
            'lat'            => $this->double(),
            'lng'            => $this->double(),
            'status'         => $this->smallInteger()->defaultValue(1),
            'created_at'     => $this->integer(),
            'updated_at'     => $this->integer(),
        ]);

        // Index
        $this->createIndex(
            'idx-city_code',
            'go_city',
            'code'
        );
        $this->createIndex(
            'idx-city_status',
            'go_city',
            'status'
        );
        //Create ForeignKey
        $this->addForeignKey('fk_city_region', 'go_city', 'region_id', 'go_region', 'id', 'cascade', 'cascade');

        //Seed data
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('go_city');
        $this->dropForeignKey('fk_city_region', 'go_city');
    }
}
