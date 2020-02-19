<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%data}}`.
 */
class m200219_162038_create_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%data}}', [
            'id' => $this->primaryKey(),
            'card_number' => $this->string(20)->null()->defaultValue(null),
            'date' => $this->dateTime()->notNull(),
            'volume' => $this->float()->notNull(),
            'service' => $this->string(100)->notNull(),
            'address_id' => $this->integer()->null()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%data}}');
    }
}
