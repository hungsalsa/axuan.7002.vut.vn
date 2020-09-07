<?php
 namespace frontend\models\news;use Yii;use yii\data\Pagination;class FAlbum extends \yii\db\ActiveRecord{public static function tableName(){return 'tbl_album';}public function rules(){return[[['name','slug','cate_id','status','created_at','updated_at','userCreated','userUpdated'],'required'],[['content','keywords','descriptions','short_description'],'string'],[['status','created_at','updated_at','userCreated','userUpdated','view'],'integer'],[['sort'],'number'],[['name','slug','cate_id','title'],'string','max'=>255],[['slug'],'unique'],];}public function attributeLabels(){return['id'=>'ID','name'=>'Name','slug'=>'Slug','cate_id'=>'Cate id','content'=>'Content','title'=>'Title','view'=>'view','keywords'=>'Keywords','descriptions'=>'Descriptions','short_description'=>'short_description','status'=>'Status','view'=>'view','sort'=>'Sort','created_at'=>'Created At','updated_at'=>'Updated At','userCreated'=>'User Created','userUpdated'=>'User Updated',];}public function getDanhmuc(){return $this->hasOne(FCategories::className(),['id'=>'cate_id']);}public function getListImages(){return $this->hasMany(FAlbumImages::className(),['album_id'=>'id']);}public function getOneImages(){return $this->hasOne(FAlbumImages::className(),['album_id'=>'id']);}public function findAllModel($idArray,$limit=16){return self::find()->alias('a')->select(['a.id','a.name','a.view','a.title','a.slug','a.keywords','a.short_description','d.slug as slugCate'])->joinWith('danhmuc d',false)->joinWith(['oneImages as i'=>function(\yii\db\ActiveQuery $query){$query->select(['i.id','i.image','i.album_id','i.sort','i.title']);},],true)->where(['IN','a.id',$idArray])->orderBy(['a.sort'=>SORT_DESC,'a.created_at'=>SORT_DESC])->limit($limit)->asArray()->all();}public function getAlbumsDetail($slug,$status=true){return self::find()->alias('a')->select(['a.id','a.name','a.title','a.slug','a.cate_id','a.content','a.keywords','a.descriptions'])->joinWith(['listImages as im'=>function($query){$query->select(['im.image','im.title','im.descriptions','album_id']);$query->andWhere(['im.status'=>true]);$query->orderBy(['im.sort'=>SORT_DESC]);}])->where('a.status=:status AND a.slug=:slug',[':status'=>$status,':slug'=>$slug])->asArray()->one();}public function getAlbumsByCateList($idCateArray,$pageSize=20,$status=true){$data=self::find()->alias('a')->select(['a.id','a.name','a.title','a.slug','a.cate_id','a.content','a.keywords','a.descriptions'])->andWhere('a.status=:status',[':status'=>$status]);if(!empty($idCateArray)){$data->andWhere(['IN','a.cate_id',$idCateArray]);}$result['pages']=$this->getPagerAlbums($idCateArray);$result['listAlbums']=$data->orderBy(['a.sort'=>SORT_DESC,'a.created_at'=>SORT_DESC,'a.updated_at'=>SORT_DESC])->offset($result['pages']->offset)->limit($result['pages']->limit)->all();return $result;}public function getPagerAlbums($idCateArray,$pageSize=20){$data=self::find()->where(['status'=>true]);if(!empty($idCateArray)){$data->andWhere(['IN','cate_id',$idCateArray]);}$pages=new Pagination(['totalCount'=>$data->count(),'pageSize'=>$pageSize,'forcePageParam'=>false,'pageSizeParam'=>false,]);return $pages;}}