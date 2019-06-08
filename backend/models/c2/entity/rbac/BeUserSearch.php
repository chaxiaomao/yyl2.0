<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-user-extended
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-user-extended
 * @version 0.6.0
 */

namespace backend\models\c2\entity\rbac;

use dektrium\user\models\UserSearch as BaseUserSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class BeUserSearch extends BaseUserSearch {

    /** @var int */
    public $id;

    /** @var string */
    public $username;

    /** @var string */
    public $email;

    /** @var string */
    public $firstname;

    /** @var string */
    public $lastname;

    /** @var string */
    public $birthday;

    /** @var int */
    public $created_at;

    /** @var int */
    public $last_login_at;

    /** @var string */
    public $rule;

    /*@var string*/
    public $mobile_number;

    /** @inheritdoc */
    public function rules() {
        return [
            'fieldsSafe' => [['username', 'firstname', 'lastname', 'birthday', 'email', 'rule', 'registration_ip', 'created_at', 'last_login_at','mobile_number'], 'safe'],
            'createdDefault' => ['created_at', 'default', 'value' => null],
            'lastloginDefault' => ['last_login_at', 'default', 'value' => null],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels() {
        return [
            'id' => \Yii::t('user', 'ID'),
            'username' => \Yii::t('user', 'Username'),
            'firstname' => \Yii::t('userextended', 'Firstname'),
            'lastname' => \Yii::t('userextended', 'Lastname'),
            'birthday' => \Yii::t('userextended', 'Birthday'),
            'email' => \Yii::t('user', 'Email'),
            'rule' => \Yii::t('rbac', 'Rule'),
            'created_at' => \Yii::t('user', 'Registration time'),
            'registration_ip' => \Yii::t('user', 'Registration ip'),
            'last_login_at' => \Yii::t('userextended', 'Last Login'),
            'mobile_number'=>\Yii::t('userextended','Mobile Number'),
        ];
    }

    /**
     * @param $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = $this->finder->getUserQuery();
       //$query->select('*');
        $query->joinWith('profile');

        // Add default Order
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Override Sort Attributes
        $dataProvider->setSort([
            'attributes' => [
                'username',
                'firstname',
                'lastname',
                'birthday',
                'email',
                'rule',
                'mobile_number',
                'created_at' => [
                    'asc' => ['{{%be_user}}.created_at' => SORT_ASC],
                    'desc' => ['{{%be_user}}.created_at' => SORT_DESC],
                ],
                'last_login_at'
            ],
            'defaultOrder' => [
                'created_at' => SORT_DESC
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

//        if ($this->created_at !== null) {
//            $date = strtotime($this->created_at);
//            $query->andFilterWhere(['between', 'created_at', $date, $date + 3600 * 24]);
//        }

        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'profile.firstname', $this->firstname])
                ->andFilterWhere(['like', 'profile.lastname', $this->lastname])
                ->andFilterWhere(['like', 'profile.birthday', $this->birthday])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like','{{%be_user}}.mobile_number',$this->mobile_number])
                ->andFilterWhere(['registration_ip' => $this->registration_ip]);

        if ($this->rule !== "") {
            $query->andWhere('`id` IN (
                SELECT {{%auth_assignment}}.user_id FROM {{%auth_assignment}} 
                WHERE {{%auth_assignment}}.`item_name` = "' . $this->rule . '")'
            );
        }

        // Print SQL query
        //Svar_dump($query->createCommand()->sql); exit();
        return $dataProvider;
    }

    /**
     * Returns list of item names.
     *
     * @return array
     */
    public function getNameList() {
        $rows = (new Query)
                ->select(['name'])
                ->andWhere(['type' => 1])
                ->andWhere('name != "public"')
                ->from(\Yii::$app->authManager->itemTable)
                ->all();

        return ArrayHelper::map($rows, 'name', 'name');
    }

}
