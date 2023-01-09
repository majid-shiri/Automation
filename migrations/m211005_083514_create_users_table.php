<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m211005_083514_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'us_id' => $this->primaryKey(),
            'us_username' => $this->string()->notNull()->unique(),
            'us_password' => $this->string()->notNull(),
            'us_fname' => $this->string(200)->notNull(),
            'us_lname' => $this->string(200)->notNull(),
            'us_apsnelcode' => $this->integer(10)->notNull()->unique(),
            'us_gender' => $this->boolean()->notNull(),
            'us_online' => $this->boolean()->notNull(),
            'us_status' => $this->smallInteger()->notNull()->defaultValue(1),
            'us_nickname' => $this->string(25)->notNull(),
            'us_mobile' => $this->integer(25),
            'us_phone' => $this->integer(25),
            'us_email' => $this->string()->notNull()->unique(),
            'us_role' => $this->integer(50)->notNull(),
            'us_pic' => $this->string(255),
            'us_sign' => $this->string(255),
            'us_created_at' => $this->integer()->notNull(),
            'us_updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
