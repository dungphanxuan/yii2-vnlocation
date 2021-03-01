<?php

use yii\db\Migration;

/**
 * Handles the creation of table `district`.
 */
class m170809_040713_create_district_table extends \dungphanxuan\vnlocation\migrations\BaseMigration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('go_district', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer()->notNull()->comment('Mã tỉnh/thành phố'),
            'name' => $this->string(32)->notNull(),
            'slug' => $this->string(64),
            'full_name' => $this->string(128),
            'short_name' => $this->string(32),
            'code' => $this->string(32)->notNull(),
            'code_ghn' => $this->string(32),
            'code_vtp' => $this->string(32),
            'code_kerry' => $this->string(32),
            'code_spl' => $this->string(64),
            'kind_from' => $this->integer(),
            'kind_to' => $this->integer(),
            'allow' => $this->smallInteger(1)->defaultValue(0),
            'priority' => $this->smallInteger(1)->defaultValue(0),
            'image_base_url' => $this->string(255),
            'image_path' => $this->string(255),
            'lat' => $this->double(),
            'lng' => $this->double(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // Index
        $this->createIndex(
            'idx-district_code',
            'go_district',
            'code'
        );
        //Create ForeignKey
        $this->addForeignKey('fk_district_city', 'go_district', 'city_id', 'go_city', 'id', 'cascade', 'cascade');

        //Seed Data
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('go_district');
        $this->dropForeignKey('fk_district_city', 'go_district');
    }
}
