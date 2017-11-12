<?php

use yii\db\Migration;

/**
 * Class m171112_125527_extend_photos_table
 */
class m171112_125527_extend_photos_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createIndex('idx-photos-clinic_id','photos', 'clinic_id');
        $this->addForeignKey('fk-photos-clinic_id' , 'photos', 'clinic_id', 'clinics', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171112_125527_extend_photos_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171112_125527_extend_photos_table cannot be reverted.\n";

        return false;
    }
    */
}
