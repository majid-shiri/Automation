<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%signature}}`.
 */
class m220113_051225_create_signature_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%signature}}', [
            'sig_id' => $this->primaryKey(),
            'sig_us_id' => $this->integer(),
            'sig_let_id' => $this->integer(),
            'sig_state' => $this->smallInteger(),
            'sig_date' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%signature}}');
    }
}
