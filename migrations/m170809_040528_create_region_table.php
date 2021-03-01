<?php

use yii\db\Migration;

/**
 * Handles the creation of table `region`.
 */
class m170809_040528_create_region_table extends \dungphanxuan\vnlocation\migrations\BaseMigration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('go_region', [
            'id' => $this->primaryKey(),
            'title' => $this->string(32)->notNull(),
            'slug' => $this->string(32),
            'image_base_url' => $this->string(255),
            'image_path' => $this->string(255),
            'status' => $this->smallInteger(1)->defaultValue(1),
            'created_at' => $this->integer(),
        ]);

        //Seed Region data
        $dataRegion = ['Bắc Bộ', 'Trung Bộ', 'Nam Bộ'];
        foreach ($dataRegion as $key => $item) {
            $this->insert('go_region', [
                'id' => $key + 1,
                'title' => $item,
                'slug' => \yii\helpers\Inflector::slug($item),
                'image_base_url' => '',
                'image_path' => '',
                'status' => 1,
                'created_at' => time(),
            ]);
        }

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('region');
    }
}
