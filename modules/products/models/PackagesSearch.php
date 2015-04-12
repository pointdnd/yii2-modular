<?php

namespace mii\modules\products\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use mii\modules\products\models\Packages;

/**
 * PackagesSearch represents the model behind the search form about `mii\modules\products\models\Packages`.
 */
class PackagesSearch extends Packages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'money'], 'integer'],
            [['name', 'owner', 'email', 'phone', 'info', 'files'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Packages::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'money' => $this->money,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'owner', $this->owner])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'files', $this->files]);

        return $dataProvider;
    }
}
