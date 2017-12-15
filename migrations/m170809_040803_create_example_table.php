<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ward`.
 */
class m170809_040803_create_example_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('go_demo_location', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string(128)->notNull(),
            'body'        => $this->text(),
            'city_id'     => $this->integer(),
            'district_id' => $this->integer(),
            'ward_id'     => $this->integer(),

            'image_base_url' => $this->string(255),
            'image_path'     => $this->string(255),
            'status'         => $this->smallInteger()->defaultValue(1),
            'created_at'     => $this->integer(),
            'updated_at'     => $this->integer(),
            'created_by'     => $this->integer(),
            'updated_by'     => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('go_demo_location');
    }
}
