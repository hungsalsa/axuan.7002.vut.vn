<?php

namespace frontend\models\news;

use Yii;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
class FDownloads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_downloads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'link', 'cate_id', 'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'required'],
            [['descriptions'], 'string'],
            [['sort'], 'number'],
            [['status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['name', 'link', 'category_slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'link' => 'Link',
            'category_slug' => 'Category Slug',
            'cate_id' => 'cate_id',
            'descriptions' => 'Description',
            'sort' => 'Sắp xếp',
            'status' => 'Trạng thái',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userCreated' => 'User Created',
            'userUpdated' => 'User Updated',
        ];
    }

    public function getDanhmuc()
    {
        return $this->hasOne(FCategories::className(),['id'=>'cate_id']);
    } 

    function getAllDownloads($status = true)
    {
        return self::find()->select(['id','name','link','category_slug','descriptions'])->where('status=:status',[':status'=>$status])->orderBy(['sort' => SORT_DESC, 'created_at' => SORT_DESC])->all();
    }

    function getAllCateId($idate,$status = true)
    {
        return ArrayHelper::map(self::find()->alias('a')->select(['cate_id','d.cateName'])->distinct()
        ->joinWith(['danhmuc d'],false)
        ->where('a.status=:status',[':status'=>$status])
        ->andWhere(['IN','a.id',$idate])
        ->orderBy(['cate_id' => SORT_ASC])->asArray()->all(),'cate_id','cateName');
    }

    public function findDownloadIndex($idate,$pageSize = 16,$page = true)
    {
        $data = self::find()->alias('a')->select(['a.id','a.name','a.link','a.descriptions','a.cate_id'])
        ->joinWith(['danhmuc d'],false)
        ->where('a.status=:status',[':status'=>true]);
        if (!empty($idate)) {
            $data->andWhere(['IN','a.cate_id',$idate]);
        }
        
        if ($page) {
            $result['pages'] = new Pagination([
                'totalCount' => $data->count(),
                'pageSize'=>$pageSize,
                    // 'forcePageParam' => 'trang',
                    // 'pageParam' => 'trang',
                    // 'pageParam' => yii\widgets\Pagination::createUrl(100),
                    // 'pageParam' => false,
                    // 'pageSizeParam' => ''
                    // 'pageParam' => 'start', 
                    // 'defaultPageSize' => 2,
                'forcePageParam' => false,
                'pageSizeParam' => false,

                    // 'queryParam' => false
                    // 'route'=>'san-pham/<slug>/trang-<page:\d+>'
            ]);

            $result['downloads'] =  $data->orderBy(['a.cate_id' => SORT_ASC,'a.sort' => SORT_DESC, 'a.created_at' => SORT_DESC])
            ->offset($result['pages']->offset)
            ->limit($result['pages']->limit)
            ->all();
        } else {
            $result =  $data->orderBy(['a.sort' => SORT_DESC, 'a.created_at' => SORT_DESC])
            ->limit($pageSize)
            ->all();
        }
        
        return $result;



    }
    public function findAllModel($idArray,$limit=16)
    {
        return self::find()->alias('a')->select(['a.id','a.name','a.link','a.descriptions','d.slug as slugCate'])
        ->joinWith('danhmuc d',false)
        /*->joinWith([
            'oneImages as i' => function (\yii\db\ActiveQuery $query){
                $query->select(['i.id','i.image','i.album_id','i.sort','i.title']);
                // $query->where(['i.status' => true]);
                // $query->orderBy(['i.order'=>SORT_ASC]);
                // $query->andWhere(['<>','pd.slug', $slug]);
                // $query->orderBy([
                //     'i.order' => SORT_ASC,
                //     'i.updated_at' => SORT_DESC,
                // ]);
            },
        ],true)*/
        ->where(['IN','a.id',$idArray])
        ->orderBy(['a.sort' => SORT_DESC, 'a.created_at' => SORT_DESC])->limit($limit)->asArray()->all();

    }
}