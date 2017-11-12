<?php

use yii\db\Migration;

/**
 * Handles the creation of table `photos`.
 */
class m171111_130732_create_photos_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        /*$this->createTable('photos', [
            'id' => $this->primaryKey(),
            'clinic_id' => $this->integer()->notNull(),
            'url' => $this->string()->notNull(),
            'filePath' => $this->string()->notNull()
        ]);*/
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('photos');
    }
}
